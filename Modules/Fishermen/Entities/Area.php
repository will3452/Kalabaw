<?php

namespace Modules\Fishermen\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\MapTag\Entities\Traits\MapTagTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, MapTagTrait, SoftDeletes;

    protected $fillable = [
        'fishermen_id',
        'tenure_type',
        'fish_cage_sq_dot_m',
        'fish_cage_owner_last_name',
        'fish_cage_owner_first_name',
        'fish_cage_owner_middle_name',
        'fish_cage_number',
        'fish_pond_sq_dot_m',
        'fish_pond_owner_last_name',
        'fish_pond_owner_first_name',
        'fish_pond_owner_middle_name',
        'fish_pond_number',
        'fishermen_using_nets',
        'barangay',
        'name_of_river',
        'north',
        'south',
        'east',
        'west',
    ];
    const _COLUMNS = [
        'fishermen_id',
        'tenure_type',
        'fish_cage_owner_last_name',
        'fish_cage_owner_first_name',
        'fish_cage_owner_middle_name',
        'fish_cage_number',
        'fish_cage_sq_dot_m',
        'fish_pond_owner_last_name',
        'fish_pond_owner_first_name',
        'fish_pond_owner_middle_name',
        'fish_pond_number',
        'fish_pond_sq_dot_m',
        'fishermen_using_nets',
        'barangay',
        'name_of_river',
        'north',
        'south',
        'east',
        'west',
    ];

    const _BOUNDARIES = [
        'north',
        'south',
        'west',
        'east',
    ];

    const _OPTIONS = [
        'tenure_type' => [
            'leasehold' => 'Leasehold',
            'owned' => 'Owned',
        ],
    ];
    const _NAMES = ['fish_cage_owner_last_name', 'fish_cage_owner_first_name', 'fish_cage_owner_middle_name', 'fish_pond_owner_last_name',
'fish_pond_owner_first_name', 'fish_pond_owner_middle_name'];
    const _INLINES = ['fish_cage_number', 'fish_cage_sq_dot_m', 'tenure_type','north', 'south', 'east', 'west','fishermen_id', 'name_of_river', 'fish_pond_sq_dot_m', 'fish_pond_number', 'fishermen_using_nets', 'barangay'];
    const _TYPE = [
        'fish_cage_number' => 'number',
        'fish_cage_sq_dot_m' => 'number',
        'fish_pond_sq_dot_m' => 'number',
        'fish_pond_number' => 'number',
    ];

    const _SELECT = [
        'fishermen_id',
        'barangay',
        'tenure_type',
    ];

    public function location()
    {
        return $this->barangay;
    }

    const _CHECKBOX = [];

    const _EXCLUDE_TO_FORM = [
    ];


    public function title($map = false)
    {
        if ($map) {
            return Fishermen::withTrashed()->find($this->fishermen_id)->title();
        }
        return $this->id;
    }

    public function fishermen()
    {
        return $this->belongsTo(Fishermen::class, 'fishermen_id');
    }

    public function getRelation($rel)
    {
        if ($rel == 'fishermen') {
            return Fishermen::withTrashed()->find($this->fishermen_id);
        }
    }

    protected static function newFactory()
    {
        return \Modules\Fishermen\Database\factories\AreaFactory::new();
    }

    public static function boot () {
        parent::boot();

        static::deleted(function ($model) {
            $model->mapTag()->delete();
        });
    }
}
