<x-dashboard.layout>
    <x-page.title>Farmer's Details</x-page.title>
    @foreach (\Modules\Farmer\Entities\Farmer::_DISPLAY as $section => $rows)
        <h4 class="kalabaw-section">{{$section}}</h4>
        @foreach ($rows as $row)
        <div class="kalabaw-row">
            @foreach ($row as $col)
                <div class="col">
                    <div class="kalabaw-label">
                        {{getFieldLabel($col)}}
                    </div>
                    {{$farmer[$col]}}
                </div>
            @endforeach
        </div>
        @endforeach
        <div>
    @endforeach
            <h4 class="kalabaw-section">For Crops</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Farm Location
                    </th>
                    <th>
                        Total Farm Area
                    </th>
                    <th>
                        Tenure Type
                    </th>
                    <th>
                        Name of land owner
                    </th>
                    <th>
                        Crop / Commodities
                    </th>
                    <th>
                        Size
                    </th>
                    <th>
                        Organically Grown
                    </th>
                    <th>
                        Source Of Water
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($farmer->crops as $n => $crop)
                    <tr>
                        <td>
                            {{$n + 1}}
                        </td>
                        <td>
                            {{$crop->farm_location}}
                        </td>
                        <td>
                            {{$crop->total_farm_area}}
                        </td>
                        <td>
                            {{$crop->tenure_type}}
                        </td>
                        <td>
                            {{$crop->land_owner_last_name}}, {{$crop->land_owner_fist_name}}, {{$crop->land_owner_middle_name}}
                        </td>
                        <td>
                            {{$crop->crop_or_commodities}}
                        </td>
                        <td>
                            {{$crop->size}}
                        </td>
                        <td>
                            {{$crop->organically_grown}}
                        </td>
                        <td>
                            {{getFieldValue($crop, 'source_of_water')}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tbody>
            </tbody>
        </table>
        </div>

        <div>

            <h4 class="kalabaw-section">Machineries And Equipments</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            No. Of Units
                        </th>
                        <th>
                            Year Acquired
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($farmer->machineAndEquipments as $key=>$item)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$item->type}}
                        </td>
                        <td>
                            {{$item->number_of_units}}
                        </td>
                        <td>
                            {{$item->year_acquired}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div>

            <h4 class="kalabaw-section">Trees</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Kind
                        </th>
                        <th>
                            No. Of Trees
                        </th>
                        <th>
                            Number of months
                        </th>
                        <th>
                            Remarks
                        </th>
                        <th>
                            Record of production
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($farmer->trees as $key=>$item)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$item->kind}}
                        </td>
                        <td>
                            {{$item->number_of_trees}}
                        </td>
                        <td>
                            {{$item->number_of_months}}
                        </td>
                        <td>
                            {{$item->remarks}}
                        </td>
                        <td>
                            {{$item->records_of_production}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div>

            <h4 class="kalabaw-section">Livestock/Poultry</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Male (No. Of Heads)
                        </th>
                        <th>
                            Female (No. Of Heads)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($farmer->livestockOrPoultries as $key=>$item)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$item->type}}
                        </td>
                        <td>
                            {{$item['number_of_heads_(male)']}}
                        </td>
                        <td>
                            {{$item['number_of_heads_(female)']}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @push('head-script')
        <style>
            .kalabaw-section {
                background:#222;
                color:white;
                padding:0.25em;
            }
            .kalabaw-row .kalabaw-label {
                font-weight:900 !important;
            }
            .kalabaw-row {
                /* margin-bottom: 1em; */
                /* border:1px solid #aaa; */
                padding:0.5em;
                display:flex;
            }
            .kalabaw-row .col {
                /* margin:0px 1em; */
                border:1px solid #ddd;
                padding:1em;
            }
        </style>
    @endpush
</x-dashboard.layout>
