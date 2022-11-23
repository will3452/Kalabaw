<x-dashboard.layout>
    <x-panel title="Edit">
        <form action="{{route('usermanagement.store')}}" method="POST">
            @csrf
            <div class="form-group text-left">
                <label for="br" class="control-label">Designated Barangay</label>
                <select name="barangay_id" id="br" class="form-control">
                    <option value="">All</option>
                    @foreach (\Modules\Barangay\Entities\Barangay::get() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
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
