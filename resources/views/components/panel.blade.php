@props(['title' => ''])
<br/>
<div class="panel" >
    <div class="panel-heading">
        <div class="panel-title">{{$title}}</div>
    </div>
    <div class="panel-body" style="overflow-x: auto">
        {{$slot}}
    </div>
</div>
