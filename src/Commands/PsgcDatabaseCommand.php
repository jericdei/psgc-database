<?php

namespace Jericdei\PsgcDatabase\Commands;

use Illuminate\Console\Command;

class PsgcDatabaseCommand extends Command
{
    public $signature = 'psgc-database';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
