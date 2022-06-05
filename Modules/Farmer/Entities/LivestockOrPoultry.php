<?php

namespace Modules\Farmer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LivestockOrPoultry extends Model
{
    use HasFactory, SoftDeletes;

    const _MONEY = [];

    protected $fillable = [
        'farmer_id',
        'type',
        'number_of_heads_(male)',
        'number_of_heads_(female)',
        'status',
    ];

    const _NAMES = [];
    const _INLINES = ['number_of_heads_(male)', 'number_of_heads_(female)', 'type'];
    const _COLUMNS = [
        'farmer_id',
        'type',
        'number_of_heads_(male)',
        'number_of_heads_(female)',
        'status',
    ];

    const _TYPE = [
        'number_of_heads_(male)' => 'number',
        'number_of_heads_(female)' => 'number',
    ];

    const _SELECT = [
        'farmer_id',
    ];

    const _CHECKBOX = [];


    public function title()
    {
        return $this->farmer->title();
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public function getRelation($rel)
    {
        if ($rel == 'farmer') {
            return $this->farmer;
        }
    }


    const _EXCLUDE_TO_FORM = ['status'];

    protected static function newFactory()
    {
        return \Modules\Farmer\Database\factories\LivestockOrPoultryFactory::new();
    }
}
