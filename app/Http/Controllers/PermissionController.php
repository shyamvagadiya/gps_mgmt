<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $data['roles'] = Role::select('id', 'name', 'slug')->get();
        $data['selected_role'] = Role::whereId(request('role_id'))->first();
        $data['permissions'] = Permission::get();
        return view('spatie-role.table')->with($data);
    }
    public function assign_permissions(Request $request, $role_id)
    {
        $selected_permissions = collect(request('permissions'))->keys()->toArray();
        $role = Role::findOrFail($role_id);
        $role->syncPermissions($selected_permissions);
        return redirect()->back()->with('success', "Permissions are assigned successfully to selected role.");
    }
}
