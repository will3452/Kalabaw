@props(['icon', 'count' => 0, 'link' => '#', 'name' => 'view'])
<div class="metric" style="width:250px; margin:0.5em;">
    <img src="{{$icon}}" alt="" class="icons">
    <p>
        <span class="number">{{$count ?? 0}}</span>
        <a class="title" style="color:white; font-weight:900;" href="{{$link}}">{{$name}}</a>
    </p>
</div>
