@props(['icon' => '', 'active' => false, 'href' => '#'])
<li>
    <a href="{{$href}}" class="{{$active ? 'active':''}}">
        <i class="{{$icon}}"></i>
        <span>{{$slot}}</span>
    </a>
</li>
