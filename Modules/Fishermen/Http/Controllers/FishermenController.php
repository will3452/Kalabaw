<?php

namespace Modules\Fishermen\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Barangay\Entities\Barangay;
use Modules\Fishermen\Entities\Fishermen;

class FishermenController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (Fishermen::_COLUMNS as $value) {
            if (in_array($value, Fishermen::_EXCLUDE_TO_FORM)) {
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
        $fishermens = [];

        if (! $barangay) {
            $fishermens = Fishermen::get();
        } else {
            $barangay = Barangay::find($barangay)->name;
            $fishermens = Fishermen::whereBarangay($barangay)->get();
        }

        $columns = $this->getColumns();
        return view('fishermen::index', compact('columns', 'fishermens'))->withSuccess($request->success ?? null);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Fishermen::class;
        return view('fishermen::create', compact('columns', 'model'));
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
        Fishermen::create($data);
        return back()->withSuccess('Fisherman has been added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Fishermen $fishermen)
    {
        $fishermen->load('areas');
        return view('fishermen::show', compact('fishermen'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Fishermen $fishermen)
    {
        $columns = $this->getColumns();
        $model = Fishermen::class;
        return view('fishermen::edit', compact('fishermen', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Fishermen $fishermen)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $fishermen->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Fishermen $fishermen)
    {
        $fishermen->update(['status' => request()->status]);
        $fishermen->delete();
        return back()->withSuccess('Record has been archived! ');
    }
}
