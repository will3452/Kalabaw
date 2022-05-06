<x-dashboard.layout>
    <x-panel title="Edit">
        <form action="{{route('usermanagement.update', ['user' => $user->id])}}" method="POST">
            @csrf
            @method('PUT')
            <x-form.input name="first_name" label="First Name" :value="$user->first_name"/>
            <x-form.input name="last_name" label="Last Name" :value="$user->last_name"/>
            <x-form.input name="email" label="Email" :value="$user->email"/>
            <x-form.input name="password" label="New Password" type="password" />
            <x-form.input name="password_confirmation" label="Confirm Password" type="password" />
            <button class="btn btn-primary" type="submit">Save changes</button>
        </form>
    </x-panel>
</x-dashboard.layout>
