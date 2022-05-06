<x-dashboard.layout>
    <x-panel title="Edit Unit Details">
        <form action="{{route('unit.update', ['unit' => $unit])}}" method="POST">
            @csrf
            @method('PUT')
            @foreach ($columns as $c)
                @if (! isExcludeToForm($c, $model))
                    @if (isSelectField($c, $model))
                        <x-form.select name="{{$c}}" label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <option value="{{$key}}" {{$key == $unit[$c] ? 'selected':''}}>{{$value}}</option>
                            @endforeach
                        </x-form.select>
                    @elseif(isCheckboxField($c, $model))
                        <x-form.checkbox-group label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                @php
                                    $selected = json_decode($unit[$c]);
                                @endphp
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input {{in_array($key, $selected) ? 'checked':''}} type="checkbox" name="{{$c}}[]" value="{{$value}}">
                                        <span>{{$value}}</span>
                                    </label>
                                </div>
                            @endforeach
                        </x-form.checkbox-group>
                    @else
                        <x-form.input type="{{getFieldType($c, $model)}}" value="{{$unit[$c]}}" name="{{$c}}" label="{{getFieldLabel($c)}}"/>
                    @endif
                @endif
            @endforeach
            <button class="btn btn-primary">Submit</button>
        </form>
    </x-panel>
</x-dashboard.layout>
