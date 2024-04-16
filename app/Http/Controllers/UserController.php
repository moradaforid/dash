<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all the sharks
        $users = User::with('roles')->get();


        // load the view and pass the sharks
        // return View::make('user.index')
        //     ->with('users', $users);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // User::create($input);
        // return redirect("users")->with('flash_message', 'User Added!');



        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $input = $request->all();

        unset($input['role']);

        // $user->syncRoles(['writer', 'admin']);


        $user = User::create($input);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'Company has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //$user = User::findOrFail($id);

        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'))->with('status', '');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $roles = Role::all();

        //$user = User::findOrFail($id);
        $input = $request->all();

        unset($input['role']);

        // if password hasn't changed
        if (empty($request->password)) {
            unset($input['password']);
        }

        // $user->assignRole('admin');

        // $user->syncRoles(['writer', 'admin']);


        $user->update($input);
        $user->syncRoles($request->role);
        //return view('user.edit')->with('user', $user)->with('flash_message', 'updated');
        return view('user.edit', compact('user', 'roles'))->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect('users')->with('status', 'deleted');
    }
}
