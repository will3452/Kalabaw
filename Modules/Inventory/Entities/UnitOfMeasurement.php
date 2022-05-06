<?php

namespace Modules\Inventory\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitOfMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];
    const _COLUMNS = [
        'name',
        'user_id',
    ];

    const _TYPE = [
    ];

    const _SELECT = [
    ];

    const _OPTIONS = [
    ];

    const _CHECKBOX = [];


    public function title()
    {
        return $this->user->title();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRelation($rel)
    {
        if ($rel == 'user') {
            return $this->user;
        }
    }


    const _EXCLUDE_TO_FORM = [
        'user_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\UnitOfMeasurementFactory::new();
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
