<?php

namespace Modules\Bin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Farmer\Entities\Crop;
use Modules\Farmer\Entities\Farmer;
use Modules\Farmer\Entities\LivestockOrPoultry;
use Modules\Farmer\Entities\MachineAndEquipment;
use Modules\Farmer\Entities\Tree;
use Modules\Fishermen\Entities\Area;
use Modules\Fishermen\Entities\Fishermen;
use Modules\MapTag\Entities\MapTag;

class BinController extends Controller
{
    public function restore(Request $request)
    {
        $modelClass = $this->getTypes($request->type);
        ($modelClass['path'])::withTrashed()->findOrFail($request->id)->restore();
        return back()->withSuccess('restored!');
    }

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
            ]
        ];
        if (!is_null($key)) {
            return $data[$key];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $type = $request->type ?? "Farmer";
        $modelType = $type;
        $modelClass = $this->getTypes($type);
        $types = $this->getTypes();
        $raw  = ($modelClass['path'])::onlyTrashed()->get();
        $data = [];
        foreach ($raw as $item) {
            $dayOld = now()->diffInDays($item->deleted_at);

            if ($dayOld>= 30) {
                continue;
            }

            $data[] = $item;
        }
        $columns = ($modelClass['path'])::_COLUMNS;
        return view('bin::index', compact('data', 'columns', 'types', 'modelType'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('bin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
