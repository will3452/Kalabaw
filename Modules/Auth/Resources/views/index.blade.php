<x-auth-layout>

    <div class="header">
        <div style="display:flex; justify-content:center;">
            <x-logo></x-logo>
        </div>
        <p class="lead">Login to your account</p>
    </div>
    <form class="form-auth-small" action="{{route('auth.login')}}" method="POST">
        @csrf
        <x-form.input name="email" type="email" label="Email" />
        <x-form.input name="password" type="password" label="Password" />
        {{-- <x-form.checkbox name="remember" label="Remember me" /> --}}
        <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
        <a href="{{route('auth.register')}}" class="btn btn-secondary btn-lg btn-block">REGISTER</a>
        {{-- <div class="bottom">
            <span class="helper-text"><i class="fa fa-lock"></i> <a href="javascript:alert('comming soon')">Forgot password?</a></span>
        </div> --}}
    </form>
</x-auth-layout>
