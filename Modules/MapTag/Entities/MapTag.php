<?php

namespace Modules\MapTag\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'model_id',
        'model_type',
        'color',
        'area',
    ];

    const _COLUMNS = [
        'model_id',
        'model_type',
        'color',
        'area',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    const _CHECKBOX = [];

    public function getRelation($rel)
    {
        return ($this->model_type)::withTrashed()->find($this->model_id);
    }



    protected static function newFactory()
    {
        return \Modules\MapTag\Database\factories\MapTagFactory::new();
    }
}
