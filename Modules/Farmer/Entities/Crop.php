<?php

namespace Modules\Farmer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MapTag\Entities\Traits\MapTagTrait;

class Crop extends Model
{
    use HasFactory, MapTagTrait, SoftDeletes;

    protected $fillable = [
        'farmer_id',
        'farm_location',
        'total_farm_area',
        'tenure_type',
        'land_owner_last_name',
        'land_owner_first_name',
        'land_owner_middle_name',
        'crop_or_commodities',
        'size',
        'organically_grown',
        'source_of_water',
    ];

    const _COLUMNS = [
        'farmer_id',
        'farm_location',
        'total_farm_area',
        'tenure_type',
        'land_owner_last_name',
        'land_owner_first_name',
        'land_owner_middle_name',
        'crop_or_commodities',
        'size',
        'organically_grown',
        'source_of_water',
    ];

    const _NAMES = [
        'land_owner_last_name', 'land_owner_first_name', 'land_owner_middle_name'
    ];

    const _INLINES = ['farmer_id', 'farm_location', 'total_farm_area', 'tenure_type', 'crop_or_commodities', 'size', 'organically_grown'];

    const _EXCLUDE_TO_FORM = [];

    const _SELECT = [
        'tenure_type',
        'organically_grown',
        'farmer_id',
        'farm_location',
    ];

    const _TYPE = [];

    const _CHECKBOX = [
        'source_of_water',
    ];

    const _OPTIONS = [
        'tenure_type' => [
            'leasehold' => 'Leasehold',
            'owned' => 'Owned',
        ],
        'organically_grown' => [
            'yes' => 'Yes',
            'no' => 'No',
        ],
        'source_of_water' => [
            'deep well' => 'deep well',
            'tube well' => 'tube well',
        ],
    ];

    public function title($map = false)
    {
        if ($map) {
            return Farmer::withTrashed()->find($this->farmer_id)->title();
        }
        return $this->id;
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public function location()
    {
        return $this->farm_location;
    }

    public function getRelation($rel)
    {
        if ($rel == 'farmer') {
            return Farmer::withTrashed()->find($this->farmer_id);
        }
    }


    protected static function newFactory()
    {
        return \Modules\Barangay\Database\factories\CropFactory::new();
    }

    public static function boot () {
        parent::boot();

        static::deleted(function ($model) {
            $model->mapTag()->delete();
        });
    }

}
