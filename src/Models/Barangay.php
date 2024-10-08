<?php

namespace Jericdei\PsgcDatabase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barangay extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'old_code',
        'region_code',
        'province_code',
        'municipality_code',
        'sub_municipality_code',
        'barangay_code',
        'name',
        'old_name',
    ];

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_code', 'municipality_code');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'province_code', 'province_code');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_code', 'province_code');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_code', 'region_code');
    }
}
