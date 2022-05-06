<?php

namespace Modules\MapTag\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'color',
        'area',
    ];

    public function model()
    {
        return $this->morphTo();
    }



    protected static function newFactory()
    {
        return \Modules\MapTag\Database\factories\MapTagFactory::new();
    }
}
