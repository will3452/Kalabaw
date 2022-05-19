<?php

namespace Modules\Farmer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tree extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'farmer_id',
        'kind',
        'number_of_trees',
        'number_of_months',
        'remarks',
        'records_of_production',
    ];
    const _COLUMNS = [
        'farmer_id',
        'kind',
        'number_of_trees',
        'number_of_months',
        'remarks',
        'records_of_production',
    ];

    const _TYPE = [
        'number_of_months' => 'number',
        'number_of_trees' => 'number',
    ];

    const _OPTIONS = [
        'remarks' => [
            'Bearing' => 'Bearing',
            'Non-Bearing' => 'Non-Bearing',
        ],
    ];

    const _SELECT = [
        'farmer_id',
        'remarks',
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


    const _EXCLUDE_TO_FORM = [];

    protected static function newFactory()
    {
        return \Modules\Farmer\Database\factories\TreeFactory::new();
    }
}
