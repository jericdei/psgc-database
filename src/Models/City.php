<?php

namespace Jericdei\PsgcDatabase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'old_code',
        'region_code',
        'province_code',
        'city_code',
        'name',
        'old_name',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_code', 'province_code');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_code', 'region_code');
    }

    public function barangays(): HasMany
    {
        return $this->hasMany(Barangay::class, 'province_code', 'province_code');
    }

    public function subMunicipalities(): HasMany
    {
        return $this->hasMany(SubMunicipality::class, 'province_code', 'province_code');
    }
}
