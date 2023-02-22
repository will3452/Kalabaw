@props(['model' => "", 'type' => 'text', 'name' => 'no-name', 'required' => true, 'placeholder' => null, 'label' => 'label', 'id' => \Str::random(16), 'value' => null])
<div class="form-group text-left">
    <label for="{{$id}}" class="control-label">{{$label}}  {!!$required ? '<span class="text-danger">*</span>':''!!}</label>
    @if ($name === 'message')
    <textarea x-model="{{$model}}" maxlength="100" name="{{$name}}" id="{{$id}}" {{$required ? 'required':''}} rows="2" class="form-control" placeholder="{{$placeholder ?? $label}}">{{$value ?? old($name)}}</textarea>
    <small>100 characters only.</small>
    @else
    <input @if ($model != "")
    x-model="{{$model}}"
    @endif  type="{{$type}}" {{$required ? 'required':''}} name="{{$name}}" class="form-control" id="{{$id}}" value="{{$value ?? old($name)}}" placeholder="{{$placeholder ?? $label}}">
    @endif
    @error($name)
        <div class="text-danger text-left "><small>{{$message}}</small></div>
    @enderror
</div>
