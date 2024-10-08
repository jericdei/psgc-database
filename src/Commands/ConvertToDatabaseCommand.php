<?php

namespace Jericdei\PsgcDatabase\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Jericdei\PsgcDatabase\Models\Barangay;
use Jericdei\PsgcDatabase\Models\City;
use Jericdei\PsgcDatabase\Models\Municipality;
use Jericdei\PsgcDatabase\Models\Province;
use Jericdei\PsgcDatabase\Models\Region;
use Jericdei\PsgcDatabase\Models\SubMunicipality;
use Spatie\SimpleExcel\SimpleExcelReader;

use function Laravel\Prompts\confirm;

class ConvertToDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'psgc-db:convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert PSGC excel data to database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Region::count() !== 0) {
            $confirm = confirm('PSGC database is not empty. Do you want to remove all data?');

            if (! $confirm) {
                $this->error('Action cancelled.');

                return;
            }

            DB::table('regions')->truncate();
            DB::table('provinces')->truncate();
            DB::table('cities')->truncate();
            DB::table('municipalities')->truncate();
            DB::table('sub_municipalities')->truncate();
            DB::table('barangays')->truncate();

            $this->info('All data has been removed.');
        }

        $file = storage_path('app/public/psgc/latest.xlsx');

        if (! File::exists($file)) {
            $this->info('Downloading latest PSGC file...');
            $this->call('psgc-db:download');
        }

        $this->info('Reading PSGC Excel file...');

        $worksheet = Cache::rememberForever(
            'psgc-latest',
            fn() => SimpleExcelReader::create($file)->fromSheetName('PSGC')->getRows()->toArray()
        );

        array_shift($worksheet);

        $this->info('Writing to database...');

        $bar = $this->output->createProgressBar(count($worksheet));

        $bar->start();

        // Guide
        // 0 -> code
        // 1 -> name
        // 2 -> old_code
        // 3 -> type
        // 4 -> old_name
        foreach ($worksheet as $row) {
            $code = $row['10-digit PSGC'];

            if ($code === null) {
                continue;
            }

            $type = strtolower($row['Geographic Level']);

            $data = [
                'code' => $code,
                'old_code' => $row['Correspondence Code'],
                'region_code' => mb_substr($code, 0, 2),
                'province_code' => mb_substr($code, 2, 3),
                'municipality_code' => mb_substr($code, 2, 5),
                'city_code' => mb_substr($code, 2, 5),
                'sub_municipality_code' => mb_substr($code, 5, 2),
                'barangay_code' => mb_substr($code, 2, 8),
                'name' => trim($row['Name']),
                'old_name' => $row['Old names'] ? trim($row['Old names']) : null,
            ];

            DB::transaction(fn() => match ($type) {
                'reg' => Region::create($data),
                'prov' => Province::create($data),
                'mun' => Municipality::create($data),
                'city' => City::create($data),
                'submun' => SubMunicipality::create($data),
                'bgy' => Barangay::create($data),
                default => null,
            });

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Done~!');
    }
}
