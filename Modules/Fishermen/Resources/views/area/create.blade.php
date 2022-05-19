<x-dashboard.layout>
    <x-panel title="Register New Area">
        <form action="{{route('area.store')}}" method="POST">
            @csrf
            <div class="alert alert-warning">
                Put <b>N/A</b> if the field isn't applicable/available.
            </div>
            @foreach ($columns as $c)
                @if (! isExcludeToForm($c, $model))
                    @if (isSelectField($c, $model))
                        @if (request()->has('fishermen') && $c == 'fishermen_id')
                            <div style="margin-bottom: 1em;">
                                Fishermen: {{\Modules\Fishermen\Entities\Fishermen::find(request()->fishermen)->title()}}
                                <input type="hidden" name="fishermen_id" value="{{request()->fishermen}}" />
                            </div>
                        @else
                            <x-form.select name="{{$c}}" label="{{getFieldLabel($c)}}">
                                @foreach (getFieldsOption($c, $model) as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </x-form.select>
                        @endif
                    @elseif(isCheckboxField($c, $model))
                        <x-form.checkbox-group label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <x-form.checkbox label="{{$value}}" value="{{$value}}" name="{{$key}}"/>
                            @endforeach
                        </x-form.checkbox-group>
                    @else
                        <x-form.input type="{{getFieldType($c, $model)}}" name="{{$c}}" label="{{getFieldLabel($c)}}"/>
                    @endif
                @endif
            @endforeach
            <button class="btn btn-primary">Submit</button>
        </form>
    </x-panel>
</x-dashboard.layout>
