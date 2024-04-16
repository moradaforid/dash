<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all the sharks
        $roles = Role::all();

        // load the view and pass the sharks
        // return View::make('user.index')
        //     ->with('users', $users);

        //return view('role.index')->with('roles', $roles);
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role.create', compact('roles', 'permissions'));
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
            'permissions' => 'required',
        ]);

        $role = Role::create($request->all());


        // $role->syncPermissions(['edit articles', 'delete articles']);

        // $role->givePermissionTo('edit_user');
        $role->givePermissionTo($request->permissions);



        return redirect()->route('roles.index')->with('success', 'Role has been created successfully.');
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
    public function edit(Role $role)
    {
        //$role = Role::findOrFail($id);
        $permissions = Permission::all();
        $role_permissions = $role->permissions->pluck('name')->toArray();

        return view('role.edit', compact('role', 'permissions', 'role_permissions'))->with('status', '');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $permissions = Permission::all();
        //$role = Role::findOrFail($id);
        $input = $request->all();

        $role->update($input);

        $role->syncPermissions($request->permissions);
        $role_permissions = $role->permissions->pluck('name')->toArray();

        //return view('user.edit')->with('user', $user)->with('flash_message', 'updated');
        return view('role.edit', compact('role', 'permissions', 'role_permissions'))->with('status', 'updated');
        //return redirect()->route('role.edit')->with('success', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect('roles')->with('status', 'deleted');
    }
}
