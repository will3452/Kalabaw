<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectAfterLogin()
    {
        return '/dashboard';
    }

    public function redirectAfterRegistered()
    {
        return route('auth.login');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showLoginForm()
    {
        return view('auth::index');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($data, $request->remember)) {
            if (! auth()->user()->wasApproved()) {
                auth()->logout();
                return back()->withError("Your request to registered has been sent to the Admin. Please wait for approval.");
            }
            return redirect($this->redirectAfterLogin());
        }

        return back()->withError('Wrong credentials!');
    }

    public function showRegisterForm()
    {
        return view('auth::register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['confirmed', 'min:8'],
            'first_name' => ['required'],
            'last_name' => ['required'],
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['type'] = User::DEFAULT_TYPE;
        User::create($data);

        return redirect($this->redirectAfterRegistered())->withSuccess('Registered! please login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('auth.login'));
    }
}
