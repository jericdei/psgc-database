<?php

namespace Jericdei\PsgcDatabase\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jericdei\PsgcDatabase\PsgcDatabase
 */
class PsgcDatabase extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Jericdei\PsgcDatabase\PsgcDatabase::class;
    }
}
