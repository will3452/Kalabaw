@if (auth()->user()->type == \App\Models\User::TYPE_ADMIN)
    {{$slot}}
@endif
