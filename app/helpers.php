<?php

use Modules\Association\Entities\Association;
use Nwidart\Modules\Facades\Module;
use Modules\Barangay\Entities\Barangay;
use Modules\Farmer\Entities\Farmer;
use Modules\Fishermen\Entities\Fishermen;
use Modules\Inventory\Entities\Item;
use Modules\Inventory\Entities\UnitOfMeasurement;

if ( ! function_exists('hasModule')) {
    function hasModule($str): bool
    {
        return Module::has($str);
    }
}

if ( ! function_exists('isActive')) {
    function isActive ($str): bool
    {
        return url()->current() === $str;
    }
}

if ( ! function_exists('getVendor')) {
    function getVendor($str): string
    {
        return "/vendor/$str";
    }
}

//form helpers

if ( ! function_exists('isSelectField')) {
    function isSelectField($column, $model): bool
    {
        return in_array($column, ($model)::_SELECT);
    }
}

if ( ! function_exists('isCheckboxField')) {
    function isCheckboxField($column, $model): bool
    {
        return in_array($column, ($model)::_CHECKBOX);
    }
}

if ( ! function_exists('getFieldLabel')) {
    function getFieldLabel($c): string
    {
        $words = explode('_', $c);
        $strArr = [];
        foreach ($words as $w) {
            if ($w != 'id') {
                if ($w == 'dot') {
                    $strArr[] = ".";
                } else {
                    $strArr[] = $w;
                }
            }
        }
        return \Str::upper(implode(' ', $strArr));
    }
}

if ( ! function_exists('getFieldsOption')) {
    function getFieldsOption($c, $model): array
    {
        if ($c == 'destination') {
            $result = [];
            $result['ket office'] = 'ket office';
            $destinations = Association::get(['id', 'name', 'barangay']);
            foreach ($destinations as $value) {
                $result[$value['id']] = $value['name'] . '-' . $value['barangay'];
            }

            return $result;
        }
        if ($c == 'farmer_id') {
            $result = [];
            $farmers = Farmer::get(['id', 'first_name', 'last_name', 'middle_name']);
            foreach ($farmers as $value) {
                $result[$value['id']] = $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'];
            }

            return $result;
        }
        $locations = ['barangay', 'farm_location'];
        if (in_array($c, $locations)) {
            return Barangay::get()->pluck('name', 'name')->toArray();
        }

        if ($c == 'unit_of_measurement') {
            return UnitOfMeasurement::get()->pluck('name', 'name')->toArray();
        }

        if ($c == 'item_id') {
            return Item::get()->pluck('name', 'id')->toArray();
        }

        if ($c == 'fishermen_id') {
            $result = [];
            $fishermens = Fishermen::get(['id', 'first_name', 'last_name', 'middle_name']);
            foreach ($fishermens as $value) {
                $result[$value['id']] = $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'];
            }

            return $result;
        }

        return $model::_OPTIONS[$c];
    }
}


if ( ! function_exists('isExcludeToForm')) {
    function isExcludeToForm($column, $model): bool
    {
        return in_array($column, ($model)::_EXCLUDE_TO_FORM);
    }
}

if ( ! function_exists('getFieldType')){
    function getFieldType($column, $model): string
    {
        if (array_key_exists($column, ($model)::_TYPE)) {
            return ($model)::_TYPE[$column];
        }
        return "text";
    }
}

if ( ! function_exists('getFieldValue')){
    function getFieldValue($column, $key)
    {
        // the word has id in the last
        $words = explode('_', $key);
        $strArr = [];
        if (end($words) == 'id') {
            foreach ($words as $w) {
                if ($w == 'id') continue;
                $strArr[] = $w;
            }
            $relation = implode("_", $strArr);
            return optional($column->getRelation($relation))->title() ?? 'Deleted';
        }

        if (isCheckboxField($key, get_class($column))) {
            $array = json_decode($column[$key]);
            if (count($array) == 0) {
                return '---';
            }
            return implode(', ', $array);
        }
        return $column[$key];
    }
}


if ( ! function_exists('getLat')) {
    function getLat($address): string
    {
        return Barangay::whereName($address)->first()->latitude;
    }
}

if ( ! function_exists('getLng')) {
    function getLng($address): string
    {
        return Barangay::whereName($address)->first()->longitude;
    }
}

if ( ! function_exists('getModel')) {
    function getModel($module, $type)
    {
        return ("Modules\\$module\\Entities\\$type");
    }
}
