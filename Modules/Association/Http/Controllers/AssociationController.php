<?php

namespace Modules\Association\Http\Controllers;

use App\Models\User;
use ReflectionClass;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Association\Entities\Association;

class AssociationController extends Controller
{
    public function getMember (Request $request, Association $association) {
        $request->validate(['type' => 'required']);
        $type = $request->type;
        $modelClass = getModel($type, $type);
        $label = "$association->name members";
        $data  = ($modelClass)::whereAssociationId($association->name)->get();

        $rc = new ReflectionClass($modelClass);

        if ($rc->hasConstant('_TABLE')) {
            $columns = ($modelClass)::_TABLE;
        } else {
            $columns = ($modelClass)::_COLUMNS;
        }

        return view('generate-report', compact('data', 'columns', 'label'));
    }
    public function getColumns()
    {
        $result = [];
        foreach (Association::_COLUMNS as $value) {
            if (in_array($value, Association::_EXCLUDE_TO_FORM)) {
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
        $assocs = Association::get();
        $columns = $this->getColumns();
        return view('association::index', compact('columns', 'assocs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $columns = $this->getColumns();
        $model = Association::class;
        return view('association::create', compact('columns', 'model'));
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
        Association::create($data);
        return back()->withSuccess('Record has been saved!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('association::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Association $association)
    {
        $columns = $this->getColumns();
        $model = Association::class;
        return view('association::edit', compact('association', 'columns', 'model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Association $association)
    {
        $fields = $this->getColumns();
        $fieldsToValidate = [];
        foreach ($fields as $value) {
            $fieldsToValidate[$value] = 'required';
        }
        $data = $request->validate($fieldsToValidate);
        $association->update($data);
        return back()->withSuccess('Changes has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Association $association)
    {
        $association->delete();
        return back()->withSuccess('The Record has been archived! ');
    }
}
