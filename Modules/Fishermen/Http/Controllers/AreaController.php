<?php

namespace Modules\Fishermen\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Fishermen\Entities\Area;

class AreaController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (Area::_COLUMNS as $value) {
            if (in_array($value, Area::_EXCLUDE_TO_FORM)) {
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
        $areas = Area::get();
        $columns = $this->getColumns();
        return view('fishermen::area.index', compact('columns', 'areas'))->withSuccess($request->success ?? null);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Area::class;
        return view('fishermen::area.create', compact('columns', 'model'));
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
        $area =  Area::create($data);
        return redirect(route('maptag.create', ['edit' => 1, 'id' => $area->id, 'type' => 'Area', 'module' => 'Fishermen']))->withSuccess('Area has been added, pin to map now.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('fishermen::area.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Area $area)
    {
        $columns = $this->getColumns();
        $model = Area::class;
        return view('fishermen::area.edit', compact('area', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Area $area)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $area->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return back()->withSuccess('Record has been deleted!');
    }
}
