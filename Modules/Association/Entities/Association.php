<?php

namespace Modules\Association\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Association extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'group_of',
        'description',
        'barangay',
    ];


    const _COLUMNS = [
        'name',
        'group_of',
        'description',
        'barangay',
    ];

    const _EXCLUDE_TO_FORM = [];


    const _TYPE = [];

    const _OPTIONS = [
        'group_of' => [
            'Farmer' => 'Farmer',
            'Fishermen' => 'Fishermen',
        ],
    ];

    const _SELECT = [
        'barangay',
        'group_of',
    ];

    const _CHECKBOX = [];

    protected static function newFactory()
    {
        return \Modules\Association\Database\factories\AssociationFactory::new();
    }
}
