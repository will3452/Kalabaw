<x-dashboard.layout>
    <x-panel title="Register New Farmer">
        <form action="{{route('farmer.store')}}" method="POST">
            @csrf
            <div class="alert alert-warning">
                Put <b>N/A</b> if the field isn't applicable/available.
            </div>

            @php
                $open = false;
                $openInline = false;
            @endphp
            @foreach ($columns as $c)

                @if ($c === 'last_name')
                    <div class="row"></div>
                    <div class="input-label">
                        Farmer
                    </div>
                @elseif ($c == 'spouse_last_name')
                    <div class="row"></div>
                    <div class="input-label">
                        Spouse
                    </div>
                @elseif ($c == 'beneficiary_last_name')
                    <div class="row"></div>
                    <div class="input-label">
                        Benificiary
                    </div>
                @endif

                        @php
                            if (!$open && isName($c, $model)) $open = true;
                            elseif ($open && ! isName($c, $model)) $open = false;
                            $openInline = isInline($c, $model);
                        @endphp
                        @if ($open)
                                <div class="col-md-3" style="margin-left:-10px;">
                        @elseif ($openInline)
                                <div class="col-md-3" style="margin-left:-10px;">
                        @else
                                <div >
                        @endif

                @if (! isExcludeToForm($c, $model))
                    @if (isSelectField($c, $model))
                        <x-form.select name="{{$c}}" label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </x-form.select>
                    @elseif(isCheckboxField($c, $model))
                    <div class="row">
                        <x-form.checkbox-group label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <x-form.checkbox label="{{$value}}" value="{{$value}}" name="{{$key}}"/>
                            @endforeach
                        </x-form.checkbox-group>
                    </div>

                    @else

                        <x-form.input type="{{getFieldType($c, $model)}}" name="{{$c}}" label="{{getFieldLabel($c, isName($c, $model))}}"/>

                    @endif
                @endif
            </div>
            @endforeach
            <div class="row"></div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </x-panel>
</x-dashboard.layout>
