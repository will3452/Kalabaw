<?php

namespace Modules\Fishermen\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fishermen extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'barangay',
        'contact_no',
        'sex',
        'highest_formal_education',
        'spouse_last_name',
        'spouse_first_name',
        'spouse_middle_name',
        'occupation',
        'other_source_of_income',
        '4ps_family',
        'birth_date',
        'recorded_by_id',
    ];

    const _EXCLUDE_TO_FORM = [
        'recorded_by_id',
    ];

    const _SELECT = [
        '4ps_family',
        'sex',
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
        'sex' => [
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
            'contact_no',
            'sex',
            'highest_formal_education',
            'spouse_last_name',
            'spouse_first_name',
            'spouse_middle_name',
            'occupation',
            'other_source_of_income',
            '4ps_family',
            'birth_date',
            'recorded_by_id',
        ];

    protected static function newFactory()
    {
        return \Modules\Fishermen\Database\factories\FishermenFactory::new();
    }

    public static function boot () {
        parent::boot();
        static::creating(function ($model) {
            $model->recorded_by_id = auth()->id();
        });
    }
}
