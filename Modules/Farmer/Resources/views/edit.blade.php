<x-dashboard.layout>
    <x-panel title="Edit Farmer Details">
        <form action="{{route('farmer.update', ['farmer' => $farmer])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="alert alert-warning">
                Put <b>N/A</b> if the field isn't applicable/available.
            </div>
            @foreach ($columns as $c)
                @if (! isExcludeToForm($c, $model))
                    @if (isSelectField($c, $model))
                        <x-form.select name="{{$c}}" label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <option value="{{$key}}" {{$key == $farmer[$c] ? 'selected':''}}>{{$value}}</option>
                            @endforeach
                        </x-form.select>
                    @elseif(isCheckboxField($c, $model))
                        <x-form.checkbox-group label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <x-form.checkbox label="{{$value}}" {{$key == $farmer[$c] ? 'checked':''}} value="{{$value}}" name="{{$key}}"/>
                            @endforeach
                        </x-form.checkbox-group>
                    @else
                        <x-form.input type="{{getFieldType($c, $model)}}" value="{{$farmer[$c]}}" name="{{$c}}" label="{{getFieldLabel($c)}}"/>
                    @endif
                @endif
            @endforeach
            <button class="btn btn-primary">Submit</button>
        </form>
    </x-panel>
</x-dashboard.layout>
