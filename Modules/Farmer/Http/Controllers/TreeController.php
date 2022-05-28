<?php

namespace Modules\Farmer\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Farmer\Entities\Tree;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class TreeController extends Controller
{
    public function getColumns()
    {
        $result = [];
        foreach (Tree::_COLUMNS as $value) {
            if (in_array($value, Tree::_EXCLUDE_TO_FORM)) {
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
        $trees = Tree::get();
        $columns = $this->getColumns();
        return view('farmer::tree.index', compact('columns', 'trees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Tree::class;
        return view('farmer::tree.create', compact('columns', 'model'));
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
        Tree::create($data);
        return back()->withSuccess('Tree has been added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('farmer::tree.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Tree $tree)
    {
        $columns = $this->getColumns();
        $model = Tree::class;
        return view('farmer::tree.edit', compact('tree', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Tree $tree)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $tree->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Tree $tree)
    {
        $tree->delete();
        return back()->withSuccess('Record has been archived! ');
    }
}
