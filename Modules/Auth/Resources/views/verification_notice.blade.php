<x-auth-layout>
    <form class="form-auth-small" action="{{route('verification.resend')}}" method="POST">
        @csrf
        <p>
            Before proceeding, please check your email for a verification link.
        </p>
        <p>
            If you did not receive the email
        </p>
        <button type="submit" class="btn btn-primary btn-lg btn-block">click here to request another</button>
    </form>
    <a href="{{route('auth.logout')}}" lass="btn btn-danger btn-lg btn-block">Logout for now.</a>
</x-auth-layout>
