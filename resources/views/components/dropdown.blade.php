@props(['id' => \Str::random(8), 'label' => 'New Dropdown'])
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!!$label!!} <i class="icon-submenu lnr lnr-chevron-down"></i></a>
    <ul class="dropdown-menu">
        {{$slot}}
    </ul>
</li>
