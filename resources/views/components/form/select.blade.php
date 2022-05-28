@props(['model' => \Str::random(),'type' => 'text', 'name' => 'no-name', 'required' => true, 'placeholder' => null, 'label' => 'label', 'id' => \Str::random(16), 'value' => null])
<div class="form-group">
    <label for="{{$id}}" class="control-label">{{$label}}  {!!$required ? '<span class="text-danger">*</span>':''!!}</label>
    <select x-on:change="setName" x-model="{{$model}}" name="{{$name}}" class="select2 form-control" id="{{$id}}">
        {{$slot}}
    </select>
</div>
