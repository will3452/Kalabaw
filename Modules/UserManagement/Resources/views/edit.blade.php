<x-dashboard.layout>
    <x-panel title="Edit">
        <form action="{{route('usermanagement.update', ['user' => $user->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group text-left">
                <label for="br" class="control-label">Designated Barangay</label>
                <select name="barangay_id" id="br" class="form-control">
                    @foreach (\Modules\Barangay\Entities\Barangay::get() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <x-form.input name="first_name" label="First Name" :value="$user->first_name"/>
            <x-form.input name="last_name" label="Last Name" :value="$user->last_name"/>
            <x-form.input name="email" label="Email" :value="$user->email"/>
            <x-form.input name="password" label="New Password" type="password" />
            <x-form.input name="password_confirmation" label="Confirm Password" type="password" />
            <button class="btn btn-primary" type="submit">Save changes</button>
        </form>
    </x-panel>
</x-dashboard.layout>
