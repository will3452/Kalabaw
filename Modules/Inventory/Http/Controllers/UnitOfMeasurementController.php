<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Entities\UnitOfMeasurement;

class UnitOfMeasurementController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (UnitOfMeasurement::_COLUMNS as $value) {
            if (in_array($value, UnitOfMeasurement::_EXCLUDE_TO_FORM)) {
                continue;
            }
            $result[] = $value;
        }
        return $result;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $units = UnitOfMeasurement::get();
        $columns = $this->getColumns();
        return view('inventory::unit.index', compact('columns', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = UnitOfMeasurement::class;
        return view('inventory::unit.create', compact('columns', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $unit = UnitOfMeasurement::create($data);
        return back()->withSuccess('UnitOfMeasurement has been added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('inventory::unit.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(UnitOfMeasurement $unit)
    {
        $columns = $this->getColumns();
        $model = UnitOfMeasurement::class;
        return view('inventory::unit.edit', compact('unit', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, UnitOfMeasurement $unit)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $unit->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(UnitOfMeasurement $unit)
    {
        $unit->delete();
        return back()->withSuccess('Record has been deleted!');
    }
}
