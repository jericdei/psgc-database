<?php

namespace Jericdei\PsgcDatabase\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class DownloadPsgcLatestDataCommand extends Command
{
    public $signature = 'psgc-db:download';

    public $description = 'Downloads the latest PSGC Database data from the official website and store it on your `storage` directory.';

    public function handle(): int
    {
        $this->info('Visiting PSGC website...');

        $psgcUrl = 'https://psa.gov.ph/classification/psgc';

        $html = Http::get($psgcUrl)->body();

        $crawler = new Crawler($html);

        $link = $crawler->filterXPath('//a[text()="Publication"]')->first();

        $spinner = $this->spinner();
        $spinner->setMessage('Downloading latest PSGC file...');
        $spinner->start();

        $excel = Http::connectTimeout(999999)
            ->withOptions([
                'progress' => fn() => $spinner->advance()
            ])
            ->get($link->attr('href'))
            ->body();

        $spinner->finish();
        $this->newLine();

        $this->info('Storing the file...');

        Storage::disk('public')->put("psgc/latest.xlsx", $excel);

        $this->info('PSGC file has been downloaded successfully!');

        return self::SUCCESS;
    }
}
