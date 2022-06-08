<?php

namespace Modules\Farmer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineAndEquipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'farmer_id',
        'type',
        'serial_number',
        'number_of_units',
        'year_acquired',
        'note',
        'repair_date',
        'status',
    ];

    const _COLUMNS = [
        'farmer_id',
        'serial_number',
        'type',
        'number_of_units',
        'year_acquired',
        'note',
        'repair_date',
        'status',
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



    const _EXCLUDE_TO_FORM = ['status'];

    protected static function newFactory()
    {
        return \Modules\Farmer\Database\factories\MachineAndEquipmentFactory::new();
    }
}
