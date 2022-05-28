<?php

namespace Modules\Farmer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Farmer\Entities\MachineAndEquipment;

class MachineAndEquipmentController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (MachineAndEquipment::_COLUMNS as $value) {
            if (in_array($value, MachineAndEquipment::_EXCLUDE_TO_FORM)) {
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
        $maes = MachineAndEquipment::get();
        $columns = $this->getColumns();
        return view('farmer::mae.index', compact('columns', 'maes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = MachineAndEquipment::class;
        return view('farmer::mae.create', compact('columns', 'model'));
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
        MachineAndEquipment::create($data);
        return back()->withSuccess('Machinery/Equipment has been added! ');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('farmer::crop.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(MachineAndEquipment $mae)
    {
        $columns = $this->getColumns();
        $model = MachineAndEquipment::class;
        return view('farmer::mae.edit', compact('mae', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, MachineAndEquipment $mae)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $mae->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(MachineAndEquipment $mae)
    {
        $mae->update(['status' => request()->status]);
        $mae->delete();
        return back()->withSuccess('Record has been archived! ');
    }
}
