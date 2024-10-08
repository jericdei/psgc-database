<?php

namespace Jericdei\PsgcDatabase\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'old_code',
        'region_code',
        'province_code',
        'name',
        'old_name',
    ];

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

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'province_code', 'province_code');
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class, 'province_code', 'province_code');
    }

    /**
     * Get merged collection of cities and municipalities.
     *
     * @return Collection<int, City|Municipality>
     */
    public function getCitiesAndMunicipalities(): Collection
    {
        $cities = $this->cities->map(fn(City $city) => [
            'code' => $city->city_code,
            'name' => $city->name,
        ]);

        $municipalities = $this->municipalities->map(fn(Municipality $municipality) => [
            'code' => $municipality->municipality_code,
            'name' => $municipality->name,
        ]);

        return $municipalities->merge($cities);
    }
}
