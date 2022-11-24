<x-dashboard.layout>
    <x-page.title>Map</x-page.title>
    <div id="map"></div>
    @push('head-script')
        <style>
            #map { height: 60vh; }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    @endpush
    @push('body-script')
    <script>
        var map = L.map('map').setView([16.9753758, 121.81070790000001], 10);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: '',
                maxZoom: 42,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw'
            }).addTo(map);

            //exising tags rendering
            @foreach($tags as $tag)
                let tag{{$tag->id}} = L.polygon({{$tag->area}}, {color:'{{$tag->color}}'}).addTo(map);
                tag{{$tag->id}}.bindPopup('<h5>{{optional($tag->model)->title(true)}}</h5>').openPopup();
            @endforeach
    </script>
    @endpush
</x-dashboard.layout>
