<?php

namespace Modules\Barangay\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barangay extends Model
{
    protected $table = 'barangays';
    use HasFactory;

    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'recorded_by_id',
    ];

    const _EXCLUDE_TO_FORM = [
        'recorded_by_id',
    ];

    const _SELECT = [];

    const _CHECKBOX = [];

    const _TYPE = [];

    const _COLUMNS = [
        'name',
        'longitude',
        'latitude',
        'recorded_by_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Barangay\Database\factories\BarangayFactory::new();
    }

    public static function boot () {
        parent::boot();
        static::creating(function ($model) {
            $model->recorded_by_id = auth()->id();
        });
    }
}
