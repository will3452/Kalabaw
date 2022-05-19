<?php

namespace Modules\Farmer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Barangay\Entities\Barangay;

class Farmer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'barangay',
        'contact_no',
        'gender',
        'civil_status',
        'spouse_last_name',
        'spouse_first_name',
        'spouse_middle_name',
        'occupation',
        'other_source_of_income',
        '4ps_family',
        'birth_date',
        'beneficiary',
        'annual_income_last_year_farming',
        'annual_income_last_year_non_farming',
        'recorded_by_id',
    ];

    const _EXCLUDE_TO_FORM = [
        'recorded_by_id',
    ];

    const _SELECT = [
        '4ps_family',
        'gender',
        'barangay',
        'civil_status',
    ];

    const _CHECKBOX = [
    ];

    const _TYPE = [
        'contact_no' => 'number',
        'birth_date' => 'date',
    ];

    const _OPTIONS = [
        '4ps_family' => [
            'yes' => 'Yes',
            'no' => 'No',
        ],
        'gender' => [
            'male' => 'Male',
            'female' => 'Female'
        ],
        'barangay' => [],
        'civil_status' => [
            'single' => 'Single',
            'engaged' => 'Engaged',
            'married' => 'Married',
            'separated' => 'Separated',
            'divorced' => 'Divorced',
            'widowed' => 'Windowed',
        ],
    ];

    public function title()
    {
        return "$this->first_name $this->middle_name $this->last_name";
    }

    const _COLUMNS = [
            'last_name',
            'first_name',
            'middle_name',
            'barangay',
            'gender',
            'birth_date',
            'contact_no',
            'civil_status',
            'spouse_last_name',
            'spouse_first_name',
            'spouse_middle_name',
            'occupation',
            'other_source_of_income',
            '4ps_family',
            'beneficiary',
            'annual_income_last_year_farming',
            'annual_income_last_year_non_farming',
            'recorded_by_id',
        ];

    public function crops()
    {
        return $this->hasMany(Crop::class, 'farmer_id');
    }

    public function machineAndEquipments()
    {
        return $this->hasMany(MachineAndEquipment::class, 'farmer_id');
    }

    public function livestockOrPoultries()
    {
        return $this->hasMany(LivestockOrPoultry::class, 'farmer_id');
    }

    public function trees()
    {
        return $this->hasMany(Tree::class, 'farmer_id');
    }

    protected static function newFactory()
    {
        return \Modules\Farmer\Database\factories\FarmerFactory::new();
    }

    public static function boot () {
        parent::boot();
        static::creating(function ($model) {
            $model->recorded_by_id = auth()->id();
        });

        static::deleted(function ($model) {
            $model->crops->each(fn ($e) => $e->delete());
            $model->machineAndEquipments->each(fn ($e) => $e->delete());
            $model->livestockOrPoultries->each(fn ($e) => $e->delete());
            $model->trees->each(fn ($e) => $e->delete());
        });
    }
}
