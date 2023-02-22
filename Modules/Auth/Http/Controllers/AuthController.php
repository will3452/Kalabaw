<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;

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
        $excludes = \App\Models\User::whereNotNull('barangay_id')->select('barangay_id')->get()->pluck('barangay_id');

        $barangays = DB::table('barangays')->whereNotIn('id', $excludes)->get();

        return view('auth::register', compact('barangays'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'barangay_id' => ['required'],
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['confirmed', 'min:8'],
            'phone' => ['required', 'max:11'],
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
