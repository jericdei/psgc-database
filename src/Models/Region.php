<?php

namespace Jericdei\PsgcDatabase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'old_code',
        'region_code',
        'name',
        'old_name',
    ];

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class, 'region_code', 'region_code');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'region_code', 'region_code');
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class, 'region_code', 'region_code');
    }

    public function subMunicipalities(): HasMany
    {
        return $this->hasMany(SubMunicipality::class, 'region_code', 'region_code');
    }

    public function barangays(): HasMany
    {
        return $this->hasMany(Barangay::class, 'region_code', 'region_code');
    }
}
