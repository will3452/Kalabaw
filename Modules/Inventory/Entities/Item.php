<?php

namespace Modules\Inventory\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'amount_per_item',
        'unit_of_measurement',
        'expiration_date',
        'user_id',
    ];
    const _COLUMNS = [
        'name',
        'amount_per_item',
        'unit_of_measurement',
        'user_id',
    ];

    const _TYPE = [
        'amount_per_item' => 'number',
    ];

    const _SELECT = [
        'user_id',
        'unit_of_measurement',
    ];

    const _OPTIONS = [
        'unit_of_measurement' => [
            'pc' => 'pc',
        ]
    ];

    const _CHECKBOX = [];

    public function balance()
    {
        if (! $this->inventories()->exists()) {
            return "---";
        }
        $total = $this->inventories()->whereMovement('Inbound')->sum('quantity');
        $diff = $this->inventories()->whereMovement('Outbound')->sum('quantity');

        return $total - $diff;
    }

    public function totalCost()
    {
        if ($this->balance() === '---') {
            return "---";
        }
        return $this->balance() * $this->amount_per_item;
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'item_id');
    }


    public function title()
    {
        return "$this->name";
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
        return \Modules\Inventory\Database\factories\ItemFactory::new();
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
