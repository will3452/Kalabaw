@props(['name' => '', 'label' => '', 'value' => true])
<div class="form-group clearfix">
    <label class="fancy-checkbox element-left">
        <input type="checkbox" name="{{$name}}" value="{{$value}}">
        <span>{{$label}}</span>
    </label>
</div>
