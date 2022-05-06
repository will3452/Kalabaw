<x-dashboard.layout>
    <x-panel title="Register trees">
        <form action="{{route('tree.store')}}" method="POST">
            @csrf
            @foreach ($columns as $c)
                @if (! isExcludeToForm($c, $model))
                    @if (isSelectField($c, $model))
                        <x-form.select name="{{$c}}" label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </x-form.select>
                    @elseif(isCheckboxField($c, $model))
                    <x-form.checkbox-group label="{{getFieldLabel($c)}}">
                        @foreach (getFieldsOption($c, $model) as $key=>$value)
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input  type="checkbox" name="{{$c}}[]" value="{{$value}}">
                                    <span>{{$value}}</span>
                                </label>
                            </div>
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
    @push('body-script')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(function () {
                $('.select2').select2();
            })
        </script>
    @endpush
</x-dashboard.layout>
