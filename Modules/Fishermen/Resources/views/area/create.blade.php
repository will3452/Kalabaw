<x-dashboard.layout>
    <x-panel title="Register New Area">
        <form action="{{route('area.store')}}" method="POST"
        x-data="{
            @foreach ($columns as $c)
                {{$c}}:'',
            @endforeach
            setName() {
                if (this.tenure_type == 'owned') {
                    let name = this.fishermen_id.split('***')[1]
                    let arrayName = name.split('---')
                    this.fish_pond_owner_first_name = arrayName[0];
                    this.fish_pond_owner_middle_name = arrayName[1];
                    this.fish_pond_owner_last_name = arrayName[2];
                    this.fish_cage_owner_first_name = arrayName[0];
                    this.fish_cage_owner_middle_name = arrayName[1];
                    this.fish_cage_owner_last_name = arrayName[2];
                } else {
                    this.fish_pond_owner_first_name = '';
                    this.fish_pond_owner_middle_name = '';
                    this.fish_pond_owner_last_name = '';
                    this.fish_cage_owner_first_name = '';
                    this.fish_cage_owner_middle_name = '';
                    this.fish_cage_owner_last_name = '';
                }
            }
        }">
            @csrf
            @php
                $open = false;
                $openInline = false;
            @endphp
            <div class="alert alert-warning">
                Put <b>N/A</b> if the field isn't applicable/available.
            </div>
            @foreach ($columns as $c)
            @if ($c === 'fish_cage_owner_last_name')
                    <div class="row"></div>
                    <div class="input-label">
                        Fish Cage Owner
                    </div>
                @elseif ($c == 'fish_pond_owner_last_name')
                    <div class="row"></div>
                    <div class="input-label">
                        Fish Pond Owner
                    </div>
                @elseif ($c == 'north')
                    <div class="row"></div>
                    <div class="input-label">
                        Boundaries
                    </div>
                @endif
            @php
                    if (!$open && isName($c, $model)) $open = true;
                    elseif ($open && ! isName($c, $model)) $open = false;
                    $openInline = isInline($c, $model);
                @endphp
                @if ($open)
                        <div class="col-md-4" style="margin-left:-10px;">
                @elseif ($openInline)
                        <div class="col-md-4" style="margin-left:-10px;">
                @else
                        <div >
                @endif
                @if (! isExcludeToForm($c, $model))
                    @if (isSelectField($c, $model))
                        @if (request()->has('fishermen') && $c == 'fishermen_id')
                            <div style="margin-bottom: 1em;">
                                Fishermen: {{\Modules\Fishermen\Entities\Fishermen::find(request()->fishermen)->title()}}
                                <input model="{{$c}}"  type="hidden" name="fishermen_id" value="{{request()->fishermen}}" />
                            </div>
                        @else
                            <x-form.select model="{{$c}}" name="{{$c}}" label="{{getFieldLabel($c)}}">
                                <option value="" disabled default selected>---</option>
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
                        <x-form.input model="{{$c}}"  type="{{getFieldType($c, $model)}}" name="{{$c}}" label="{{getFieldLabel($c)}}"/>
                    @endif
                @endif
            </div>
            @endforeach
            <div class="row"></div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </x-panel>
</x-dashboard.layout>
