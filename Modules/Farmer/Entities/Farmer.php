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

    const _DISPLAY = [
        "Personal" => [
            ['last_name', 'first_name', 'middle_name'],
            ['gender', 'birth_date'],
            ['barangay', 'contact_no'],
            ['civil_status', 'occupation'],
            ['spouse_last_name', 'spouse_first_name', 'spouse_middle_name'],
            ['other_source_of_income', '4ps_family'],
            ['beneficiary_last_name', 'beneficiary_first_name', 'beneficiary_middle_name'],
            ['annual_income_last_year_farming', 'annual_income_last_year_non_farming'],
        ],
    ];

    const _NAMES = [
        'last_name','first_name','middle_name', 'suffix',
        'beneficiary_last_name','beneficiary_first_name','beneficiary_middle_name',
        'spouse_last_name','spouse_first_name','spouse_middle_name',
    ];

    public function getNameOfFarmerAttribute() {
        $suffix = $this->suffix != '--' ? $this->suffix :'';
        return "$this->last_name $suffix, $this->first_name $this->middle_name";
    }


    public function getNameOfSpouseAttribute() {
        return "$this->spouse_last_name , $this->spouse_first_name $this->spouse_middle_name";
    }

    public function getBeneficiaryAttribute() {
        return "$this->beneficiary_last_name , $this->beneficiary_first_name $this->beneficiary_middle_name";
    }

    const _TABLE = [
            'name_of_farmer',
    ];

    const _INLINES = [
        'association_id', 'gender','birth_date','barangay', 'contact_no', 'civil_status', 'occupation', 'other_source_of_income', '4ps_family','annual_income_last_year_farming', 'annual_income_last_year_non_farming'
    ];


    protected $fillable = [
        'first_name',
        'last_name',
        'suffix',
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
        'beneficiary_last_name',
        'beneficiary_first_name',
        'beneficiary_middle_name',
        'annual_income_last_year_farming',
        'annual_income_last_year_non_farming',
        'association_id',
        'recorded_by_id',
        'status',
    ];

    const _EXCLUDE_TO_FORM = [
        'recorded_by_id',
        'status',
        // 'barangay',
    ];

    const _SELECT = [
        'suffix',
        '4ps_family',
        'association_id',
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
        'suffix' => [
            '--' => '--',
            'Jr' => 'Jr',
            'Sr' => 'Sr',
            'III' => 'III',
        ],
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

    const _MONEY = [
        'annual_income_last_year_farming',
        'annual_income_last_year_non_farming',
    ];

    const _COLUMNS = [
            'last_name',
            'first_name',
            'middle_name',
            'suffix',
            'barangay',
            'gender',
            'birth_date',
            'contact_no',
            'civil_status',
            'association_id',
            'spouse_last_name',
            'spouse_first_name',
            'spouse_middle_name',
            'occupation',
            'other_source_of_income',
            '4ps_family',
            'beneficiary_last_name',
            'beneficiary_first_name',
            'beneficiary_middle_name',
            'annual_income_last_year_farming',
            'annual_income_last_year_non_farming',
            'recorded_by_id',
            'status',
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
