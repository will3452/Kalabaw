<x-dashboard.layout>
    <x-page.title>Fishermen's Details</x-page.title>
    @foreach (\Modules\Fishermen\Entities\Fishermen::_DISPLAY as $section => $rows)
        <h4 class="kalabaw-section">{{$section}}</h4>
        @foreach ($rows as $row)
        <div class="kalabaw-row">
            @foreach ($row as $col)
                <div class="col">
                    <div class="kalabaw-label">
                        {{getFieldLabel($col)}}
                    </div>
                    {{$fishermen[$col]}}
                </div>
            @endforeach
        </div>
        @endforeach
    @endforeach
    <div>
        <h4 class="kalabaw-section">Area</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Fish cage (Sq.m)
                    </th>
                    <th>
                        Fish cage No.
                    </th>
                    <th>
                        Fish pond (Sq.m)
                    </th>
                    <th>
                        Fish pond No.
                    </th>
                    <th>Fish pond owner</th>
                    <th>Barangay</th>
                    <th>Name of river</th>
                    <th>Boudaries (N - S - W - E)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fishermen->areas as $key=>$item)
                <tr>
                    <td>
                        {{$key + 1}}
                    </td>
                    <td>
                        {{$item->fish_cage_sq_dot_m}}
                    </td>
                    <td>
                        {{$item->fish_cage_number}}
                    </td>
                    <td>
                        {{$item->fish_pond_sq_dot_m}}
                    </td>
                    <td>
                        {{$item->fish_pond_number}}
                    </td>
                    <td>
                        {{$item->fish_pond_owner}}
                    </td>
                    <td>
                        {{$item->barangay}}
                    </td>
                    <td>
                        {{$item->name_of_river}}
                    </td>
                    <td>
                        {{$item->north}} - {{$item->south}} - {{$item->west}} - {{$item->east}}
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
