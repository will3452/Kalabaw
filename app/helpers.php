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
    function getFieldLabel($c, $isName = false): string
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
        if ($isName) {
            $lastIndex = count($strArr) - 1;
            $label = implode(' ', [$strArr[$lastIndex - 1], $strArr[$lastIndex]]);
            return \Str::upper($label);
        }
        return \Str::upper(implode(' ', $strArr));
    }
}

if (! function_exists('isMoney')) {
    function isMoney($c, $model): bool
    {
        $obj = new ReflectionClass($model);
        if (! $obj->hasConstant('_MONEY')) {
            return false;
        }
        return in_array($c, $model::_MONEY);
    }
}

if (! function_exists('getMoney')) {
    function getMoney($val) {
        return "PHP " . number_format((float)$val, 2);
    }
}

if ( ! function_exists('getFieldsOption')) {
    function getFieldsOption($c, $model): array
    {
        if ($c == 'destination') {
            $result = [];
            $result['N/a'] = 'N/a';
            $result['Office'] = 'Office';
            $destinations = Association::get(['id', 'name', 'barangay']);
            foreach ($destinations as $value) {
                $result[$value['name'] . '-' . $value['barangay']] = $value['name'] . '-' . $value['barangay'];
            }

            return $result;
        }

        if ($c == 'association_id') {
            $result = [];
            $result['None'] = 'None';
            $modelArr = explode("\\", $model);
            $associations = Association::whereGroupOf(end($modelArr))->get(['id', 'name', 'barangay']);

            foreach ($associations as $value) {
                $result[$value['name']] = $value['name'] . '-' . $value['barangay'];
            }
            return $result;
        }

        if ($c == 'farmer_id') {
            $result = [];
            $farmers = Farmer::get(['id', 'first_name', 'last_name', 'middle_name']);
            foreach ($farmers as $value) {
                $key = $value['id'] . '***' . implode('---', [$value['first_name'], $value['middle_name'], $value['last_name']]);
                $result[$key] = $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'];
            }

            return $result;
        }
        $locations = ['barangay', 'farm_location'];
        if (in_array($c, $locations)) {
            return auth()->user()->barangay_id ? Barangay::whereId(auth()->user()->barangay_id)->get()->pluck('name', 'name')->toArray() : Barangay::get()->pluck('name', 'name')->toArray();
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
                $key = $value['id'] . '***' . implode('---', [$value['first_name'], $value['middle_name'], $value['last_name']]);
                $result[$key] = $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'];
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

if ( ! function_exists('isName')){
    function isName($column, $model): bool
    {
        return in_array($column, ($model)::_NAMES);
    }
}

if ( ! function_exists('isInline')){
    function isInline($column, $model): bool
    {
        return in_array($column, ($model)::_INLINES);
    }
}

if ( ! function_exists('getFieldValue')){
    function getFieldValue($column, $key)
    {
        if ($key == "association_id") {
            return $column[$key];
        }
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

if (! function_exists('sendMessage')) {
    function sendMessage($phone, $message)
    {
        $ch = curl_init();
        $parameters = array(
            'apikey' => env('SMS_API_KEY'),
            'number' => $phone,
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        //Show the server response
        echo $output;
    }
}
