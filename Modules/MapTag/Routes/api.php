<?php

use Illuminate\Http\Request;


Route::post('/maptag', function (Request $request) {
    $data['area'] = json_encode($request->area);
    $data['color'] = $request->color;
    $model = getModel($request->module, $request->type)::find($request->id);
    if ($model->mapTag()->exists()) {
        $tag = $model->mapTag()->update($data);
        return 'updated';
    } else {
        $tag = $model->mapTag()->create($data);
        return 'new';
    }
    return $tag;
});
