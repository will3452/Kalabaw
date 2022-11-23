<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class UserManagementController extends Controller
{

    public function approve(User $user)
    {
        $str = null;
        if ($user->wasApproved()) {
            $user->markUnApprove();
        } else {
            $str = $user->markApprove();
        }
        return back()->withSuccess(is_null($str) ? 'Done!': $str);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('usermanagement::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('usermanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'barangay_id' => '',
            'email' => ['required', 'unique:users,email'],
            'password' => ['min:8', 'required', 'confirmed'],
            'first_name' => ['required'],
            'type' => ['required'],
            'last_name' => ['required'],
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect(route('usermanagement.index'))->withSuccess("User created!");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(User $user)
    {
        return view('usermanagement::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        return view('usermanagement::edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, User $user)
    {
        $id = $user->id;
        $data = $request->validate([
            'email' => ['required', "unique:users,email,$id", 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'first_name' => ['required'],
            'last_name' => ['required'],
        ]);

        $data['password'] = bcrypt($data['password']);
        $user->update($data);
        return back()->withSuccess('Updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->withSuccess('User Deleted!');
    }
}
