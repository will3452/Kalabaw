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
        'fish_cage_sq_dot_m',
        'fish_cage_number',
        'fish_pond_sq_dot_m',
        'fish_pond_owner',
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
        'fish_cage_sq_dot_m',
        'fish_cage_number',
        'fish_pond_sq_dot_m',
        'fish_pond_owner',
        'fish_pond_number',
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

    const _TYPE = [
        'fish_cage_number' => 'number',
        'fish_cage_sq_dot_m' => 'number',
        'fish_pond_sq_dot_m' => 'number',
        'fish_pond_number' => 'number',
    ];

    const _SELECT = [
        'fishermen_id',
        'barangay',
    ];

    public function location()
    {
        return $this->barangay;
    }

    const _CHECKBOX = [];

    const _EXCLUDE_TO_FORM = [
    ];


    public function title()
    {
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
