<x-dashboard.layout>
    <x-panel title="Edit">
        <form action="{{route('usermanagement.store')}}" method="POST">
            @csrf
            <x-form.select name="type" label="Type of Account">
                <option value="Agriculturist">Agriculturist</option>
                <option value="Administrator">Administrator</option>
            </x-form.select>
            <x-form.input name="first_name" label="First Name" />
            <x-form.input name="last_name" label="Last Name" />
            <x-form.input name="email" label="Email"/>
            <x-form.input name="password" label="Password" type="password" />
            <x-form.input name="password_confirmation" label="Confirm Password" type="password" />
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </x-panel>
</x-dashboard.layout>
