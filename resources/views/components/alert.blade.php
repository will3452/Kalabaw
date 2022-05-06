@props(['type' => 'primary', 'icon' => 'fa-info-circle',])
<div class="alert alert-{{$type}} alert-dismissible" role="alert">
    <i class="fa {{$icon}}"></i> {{$slot}}
</div>
