<?php

namespace Modules\Farmer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MachineAndEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'number_of_units',
        'year_acquired',
        'farmer_id',
    ];

    const _COLUMNS = [
        'type',
        'number_of_units',
        'year_acquired',
        'farmer_id',
    ];

    const _TYPE = [
        'year_acquired' => 'date',
        'number_of_units' => 'number',
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



    const _EXCLUDE_TO_FORM = [];

    protected static function newFactory()
    {
        return \Modules\Farmer\Database\factories\MachineAndEquipmentFactory::new();
    }
}
