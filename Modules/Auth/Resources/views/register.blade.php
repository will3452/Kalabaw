<x-auth-layout>
    <div class="header">
        <div class="logo text-center"><img src="/assets/img/logo-dark.png" alt="Logo here"></div>
        <p class="lead">Register</p>
    </div>
    <form class="form-auth-small" action="{{route('auth.register')}}" method="POST">
        @csrf
        <x-form.input name="first_name" type="text" label="First Name" />
        <x-form.input name="last_name" type="text" label="Last Name" />
        <x-form.input name="email" type="email" label="Email" />
        <x-form.input name="password" type="password" label="Password" />
        <x-form.input name="password_confirmation" type="password" label="Re-type password" />
        <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
        <div class="bottom">
            <span class="helper-text"><i class="fa fa-user"></i> <a href="{{route('auth.login')}}">Already have an account?</a></span>
        </div>
    </form>
</x-auth-layout>
