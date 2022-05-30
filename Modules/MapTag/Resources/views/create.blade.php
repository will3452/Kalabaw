<x-dashboard.layout>
    <x-page.title>Add to Map <small>{{$model->location()}}</small> </x-page.title>
    <div id="map"></div>
    <br/>
    @if (request()->has('edit'))
        <div>
            <div>
                <label for="color" class="form-control-label">Set Color</label>
                <input type="text"  id="color" class="" style="width:100px">
            </div>
            <br/>

            <button class="btn btn-danger" onclick="(()=>{window.location.reload()})()">reset bounds</button>
            <a class="btn btn-primary" onclick="" href="/maptag/create?edit={{request()->edit}}&id={{request()->id}}&type={{request()->type}}&module={{request()->module}}&{{is_null(request()->mapstyle) ? 'mapstyle=satellite-v9' : ''}}">Change Map Style</a>
            <button class="btn btn-success" onclick="save()">save</button>
        </div>
    @else
        <a href="{{url()->full()}}&edit=true" class="btn btn-success">Edit</a>
    @endif

    @push('head-script')
        <style>
            #map { height: 50vh; }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    @endpush

    @push('body-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/evol-colorpicker.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
    <link href="/css/evol-colorpicker.css" rel="stylesheet" type="text/css">
    <script>
        var edit = {{request()->has('edit') ? 1:0}};
        var map = L.map('map').setView([{{getLat($model->location())}}, {{getLng($model->location())}}], 18);
        let area = [];
        var color = '#000';
        var isStreet = true;
        var config = {
            attribution: '',
            maxZoom: 42,
            id: `mapbox/{{ request()->mapstyle ?? 'streets-v11' }}`,
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw'
        };

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', config).addTo(map);
            var polygon = null;

            //exising tags rendering
            @foreach($tags as $tag)
                let tag{{$tag->id}} = L.polygon({{$tag->area}}, {color:'{{$tag->color}}'}).addTo(map);
                tag{{$tag->id}}.bindPopup('<h5>{{optional($tag->model)->title() ?? "---"}}</h5>').openPopup();
            @endforeach

            const render = (newarea, color = '#000') => {
                if (newarea.length == 0) {
                    area = [];
                    polygon.remove(); // this will reset the marker
                }
                polygon = L.polygon(newarea, {color}).addTo(map);
            }

            $('#color').on('change', function () {
                color = $(this).val();
                render(area, color);
            });

            map.on('click', ({latlng})=>{
                if (!edit) return;
                if (polygon != null) {
                    polygon.remove();// this will reset the marker
                }
                let {lat, lng} = latlng;
                area[area.length] = [lat, lng];
                console.log(area);
                render(area);
            });

            function save () {
                if (area.length <= 2) {
                    bootbox.alert('Please set bound first!');
                    return;
                }

                axios.post('/api/maptag', {
                    'type' : `{{$type}}`,
                    'module' : `{{$module}}`,
                    'id' : {{$model->id}},
                    'color' : `${color}`,
                    'area' : area,
                    }).then(function (res) {
                        bootbox.alert('The {{$type == "Crop" ? "Farm":$type}} has been tagged!');
                        console.log(res)
                    }).catch(err => console.log(err))
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#color").colorpicker();
        });
    </script>
    @endpush

</x-dashboard.layout>
