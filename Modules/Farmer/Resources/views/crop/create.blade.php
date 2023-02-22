<x-dashboard.layout>
    <x-panel title="Register New Farm">
        <form
            action="{{route('crop.store')}}"
            method="POST"
            x-data="{
                @foreach ($columns as $c)
                {{$c}}:'',
                @endforeach
                setName() {
                    console.log('hell world')
                    if (this.tenure_type == 'owned') {
                        let name = this.farmer_id.split('***')[1]
                        let arrayName = name.split('---')
                        this.land_owner_first_name = arrayName[0];
                        this.land_owner_middle_name = arrayName[1];
                        this.land_owner_last_name = arrayName[2];
                    } else {
                        this.land_owner_first_name = '';
                        this.land_owner_middle_name = '';
                        this.land_owner_last_name = '';
                    }
                }
            }"
        >
            @csrf
            @php
                $open = false;
                $openInline = false;
            @endphp
            @foreach ($columns as $c)
                @if ($c === 'land_owner_last_name')
                    <div class="row"></div>
                    <div class="input-label">
                        Land Owner
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
                        @if (request()->has('farmer') && $c == 'farmer_id')
                        <div style="margin-bottom: 1em;">
                            Farmer: {{\Modules\Farmer\Entities\Farmer::find(request()->farmer)->title()}}
                            <input model="{{$c}}" type="hidden" name="farmer_id" value="{{request()->farmer}}" />
                        </div>
                        @else
                            <x-form.select model="{{$c}}" name="{{$c}}" label="{{getFieldLabel($c)}}">
                                <option value="" default selected disabled>---</option>
                                @foreach (getFieldsOption($c, $model) as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </x-form.select>
                        @endif

                    @elseif(isCheckboxField($c, $model))
                    <div class="row">
                        <x-form.checkbox-group label="{{getFieldLabel($c)}}">
                            @foreach (getFieldsOption($c, $model) as $key=>$value)
                                <div class="form-group">
                                    <label class="fancy-checkbox element-left">
                                        <input  type="checkbox" name="{{$c}}[]" value="{{$value}}">
                                        <span>{{$value}}</span>
                                    </label>
                                </div>
                            @endforeach
                        </x-form.checkbox-group>
                    </div>
                    @else
                        <x-form.input model="{{$c}}" type="{{getFieldType($c, $model)}}" name="{{$c}}" label="{{getFieldLabel($c, isName($c, $model))}}"/>
                    @endif
                @endif
            </div>
            @endforeach
            <div class="row"></div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </x-panel>
    @push('body-script')
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(function () {
                $('.select2').select2();
            })
        </script> --}}
    @endpush
</x-dashboard.layout>
