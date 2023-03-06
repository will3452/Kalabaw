<?php

namespace Modules\Farmer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Farmer\Entities\Crop;

class CropController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (Crop::_COLUMNS as $value) {
            if (in_array($value, Crop::_EXCLUDE_TO_FORM)) {
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
        $crops = Crop::get();
        $columns = $this->getColumns();
        return view('farmer::crop.index', compact('columns', 'crops'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Crop::class;
        return view('farmer::crop.create', compact('columns', 'model'));
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
        $data['farmer_id'] = explode('***', $data['farmer_id'])[0];
        $data['source_of_water'] = json_encode($data['source_of_water']);
        $data['crop_or_commodities'] = json_encode($data['crop_or_commodities']);
        $crop = Crop::create($data);
        return redirect(route('maptag.create', ['edit' => 1, 'id' => $crop->id, 'type' => 'Crop', 'module' => 'Farmer']))->withSuccess('The farm has been added! Pin to map now');
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
    public function edit(Crop $crop)
    {
        $columns = $this->getColumns();
        $model = Crop::class;
        return view('farmer::crop.edit', compact('crop', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Crop $crop)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $crop->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Crop $crop)
    {
        $crop->delete();
        return back()->withSuccess('Record has been archived! ');
    }
}
