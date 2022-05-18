<?php

namespace Modules\Fishermen\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $fishermens = Fishermen::get();
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
        return back()->withSuccess('Record has been Added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('fishermen::show');
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
        $fishermen->delete();
        return back()->withSuccess('Record has been deleted!');
    }
}
