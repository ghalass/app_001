<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('role-permission.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8|max:20',
            'roles'     => 'required',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('users')
            ->with('success', 'User créée avec succès!');
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
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $data = [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ];
        return view('role-permission.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'password'  => 'nullable|string|min:8|max:20',
            'roles'     => 'required',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password'  => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('users')
            ->with('success', 'user modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('users')
            ->with('success', 'User supprimée avec succès!');
    }
}