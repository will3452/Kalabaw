<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getTypes($key = null)
    {
        $data = [
            'Farmer' => [
                'path' => '\\Modules\\Farmer\\Entities\\Farmer',
                'label' => 'Farmer'
            ],
            'Farm' => [
                'path' => '\\Modules\\Farmer\\Entities\\Crop',
                'label' => 'Farm'
            ],
            'LivestockOrPoultry' => [
                'path' => '\\Modules\\Farmer\\Entities\\LivestockOrPoultry',
                'label' => 'Livestock or Poultries'
            ],
            'MachineAndEquipment' => [
                'path' => '\\Modules\\Farmer\\Entities\\MachineAndEquipment',
                'label' => 'Machine And Equipments'
            ],
            'Tree' => [
                'path' => '\\Modules\\Farmer\\Entities\\Tree',
                'label' => 'Tree'
            ],
            'Area' => [
                'path' => '\\Modules\\Fishermen\\Entities\\Area',
                'label' => 'Area'
            ],
            'Fishermen' => [
                'path' => '\\Modules\\Fishermen\\Entities\\Fishermen',
                'label' => 'Fishermen'
            ],
            // 'Map' => [
            //     'path' => '\\Modules\\MapTag\\Entities\\MapTag',
            //     'label' => 'Map Tag'
            // ],
            'Association' => [
                'path' => '\\Modules\\Association\\Entities\\Association',
                'label' => 'Association',
            ],
            'Item' => [
                'path' => '\\Modules\\Inventory\\Entities\\Item',
                'label' => 'Item in Inventory'
            ],
            'Inventory' => [
                'path' => "\\Modules\\Inventory\\Entities\\Inventory",
                'label' => 'Record of transactions',
            ],
        ];
        if (!is_null($key)) {
            return $data[$key];
        }
        return $data;
    }

    public function index()
    {
        $types = $this->getTypes();
        return view('report', compact('types'));
    }

    public function generate(Request $request)
    {
        $request->validate(['type' => 'required']);
        $type = $request->type;
        $modelType = $type;
        $modelClass = $this->getTypes($type);
        $label = $modelClass['label'];
        $data  = ($modelClass['path'])::get();
        $columns = ($modelClass['path'])::_COLUMNS;
        return view('generate-report', compact('data', 'columns', 'label'));
    }
}
