@php
    $url = url()->current();
    $path = parse_url($url, PHP_URL_PATH);
    $pathinfo = pathinfo($path);
    $dirname = $pathinfo['dirname'] == "\\" ? "" : $pathinfo['dirname'];
    $basename = $pathinfo['basename'];
@endphp

<div class="panel" style="padding:.5em;">
    <a href="{{$dirname}}">{{$dirname}}</a>/{{$basename}}
</div>
