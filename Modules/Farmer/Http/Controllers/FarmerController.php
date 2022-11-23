<?php

namespace Modules\Farmer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Farmer\Entities\Farmer;
use Modules\Barangay\Entities\Barangay;
use Illuminate\Contracts\Support\Renderable;

class FarmerController extends Controller
{
    public function generatePrintable(Farmer $farmer)
    {
        return view('farmer::printable', compact('farmer'));
    }
    public function getColumns()
    {
        $result = [];
        foreach (Farmer::_COLUMNS as $value) {
            if (in_array($value, Farmer::_EXCLUDE_TO_FORM)) {
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
    public function index(Request $request)
    {
        $barangay = auth()->user()->barangay_id;
        $farmers = [];

        if (! $barangay) {
            $farmers = Farmer::get();
        } else {
            $barangay = Barangay::find($barangay)->name;
            $farmers = Farmer::whereBarangay($barangay)->get();
        }
        $columns = $this->getColumns();
        return view('farmer::index', compact('columns', 'farmers'))->withSuccess($request->success ?? null);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Farmer::class;
        return view('farmer::create', compact('columns', 'model'));
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
            $fieldsToValidate[$value] = ['required'];
            if ($value == 'contact_no') { // validation dedicated for contact number
                array_push($fieldsToValidate[$value], 'max:11');
            }
        }
        $data = $request->validate($fieldsToValidate);
        Farmer::create($data);
        return back()->withSuccess('Farmer has been Added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Farmer $farmer)
    {
        $relations = ['crops', 'machineAndEquipments', 'livestockOrPoultries', 'trees'];
        $farmer->load($relations);
        return view('farmer::show', compact('farmer'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Farmer $farmer)
    {
        $columns = $this->getColumns();
        $model = Farmer::class;
        return view('farmer::edit', compact('farmer', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Farmer $farmer)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $farmer->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Farmer $farmer)
    {

        $farmer->update(['status' => request()->status]);
        $farmer->delete();
        return back()->withSuccess('Record has been archived! ');
    }
}
