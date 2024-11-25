<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index', 'show']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role-permission.role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);
        Role::create($validated);
        return redirect('roles')
            ->with('success', 'Role créée avec succès!');
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
        return view('role-permission.role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);
        $role->update([
            'name' => $request->name
        ]);
        return redirect('roles')
            ->with('success', 'Role modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        return redirect('roles')
            ->with('success', 'Role supprimée avec succès!');
    }

    function addPermissionToRole(string $roleId)
    {
        $permissions = Permission::orderBy('name', 'desc')->get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $roleId)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        $data = [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ];
        return view('role-permission.role.add-permissions', $data);
    }
    function givePermissionToRole(Request $request, string $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()
            ->back()
            ->with('success', 'Permissions ajoutées aux roles avec succès!');
    }
}