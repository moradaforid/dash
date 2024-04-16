<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\App;
use App\Models\Country;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        $permissions = Permission::all();

        // return view('role.index');
        return view('role.index', compact('permissions'));
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $roles = Role::with('permissions')
            ->paginate($per_page, ['id', 'name', 'created_at']);

        return $roles->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);

        // saving to database
        $role = new Role;
        $role->name = $request->name;
        $role->save();

        // $role->syncPermissions(['edit articles', 'delete articles']);

        // $role->givePermissionTo('edit_user');
        $role->givePermissionTo($request->permissions);

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        // $role->givePermissionTo($request->permissions);

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return ['status' => 'deleted'];
    }
}
