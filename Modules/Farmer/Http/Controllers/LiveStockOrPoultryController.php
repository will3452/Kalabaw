<?php

namespace Modules\Farmer\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Farmer\Entities\LivestockOrPoultry;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class LivestockOrPoultryController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (LivestockOrPoultry::_COLUMNS as $value) {
            if (in_array($value, LivestockOrPoultry::_EXCLUDE_TO_FORM)) {
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
        $lops = LivestockOrPoultry::get();
        $columns = $this->getColumns();
        return view('farmer::lop.index', compact('columns', 'lops'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = LivestockOrPoultry::class;
        return view('farmer::lop.create', compact('columns', 'model'));
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
        LivestockOrPoultry::create($data);
        return back()->withSuccess('Record has been saved!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('farmer::lop.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(LivestockOrPoultry $lop)
    {
        $columns = $this->getColumns();
        $model = LivestockOrPoultry::class;
        return view('farmer::lop.edit', compact('lop', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, LivestockOrPoultry $lop)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $lop->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(LivestockOrPoultry $lop)
    {
        $lop->delete();
        return back()->withSuccess('Record has been deleted!');
    }
}
