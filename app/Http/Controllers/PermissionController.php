<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all the sharks
        $permissions = Permission::all();

        // load the view and pass the sharks
        // return View::make('user.index')
        //     ->with('users', $users);

        return view('permission.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('permission.create');
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
        ]);

        Permission::create($request->all());

        return redirect()->route('permissions.index')->with('success', 'Company has been created successfully.');
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
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.edit')->with('permission', $permission)->with('status', '');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);
        $input = $request->all();

        $permission->update($input);
        //return view('user.edit')->with('user', $user)->with('flash_message', 'updated');
        return view('permission.edit')->with('permission', $permission)->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::destroy($id);
        return redirect('permissions')->with('status', 'deleted');
    }
}
