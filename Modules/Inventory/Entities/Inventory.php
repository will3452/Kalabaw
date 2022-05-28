<?php

namespace Modules\Inventory\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'movement',
        'quantity',
        'destination',
        'recipient',
        'user_id',
    ];
    const _COLUMNS = [
        'item_id',
        'movement',
        'quantity',
        'destination',
        'recipient',
        'user_id',
    ];

    const _TYPE = [
        'quantity' => 'number',
    ];

    const _SELECT = [
        'user_id',
        'item_id',
        'movement',
        'destination',
    ];

    const _OPTIONS = [
        'movement' => [
            'Inbound' => 'Inbound',
            'Outbound' => 'Outbound',
        ],
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

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function getRelation($rel)
    {
        if ($rel == 'user') {
            return $this->user;
        }

        if ($rel == 'item') {
            return $this->item;
        }
    }


    const _EXCLUDE_TO_FORM = [
        'user_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InventoryFactory::new();
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
