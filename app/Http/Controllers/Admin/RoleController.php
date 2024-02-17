<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Role view|Role create|Role edit|Role delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Role create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Role update', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Role delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $perPage = $request->input('perPage') ?: 10;

        return Inertia::render('Roles/Index', [
            'roles' => Role::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate($perPage),
            'filters' => $request->only(['search', 'perPage'])
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return Inertia::render('Roles/Create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->syncPermissions($request->permissions);
        return Redirect::route('roles.index')->with('success', 'Role created successfully.');
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
    public function edit($id)
    {
        $permissions = Permission::all()->groupBy('group');
        $role = Role::with('permissions')->findOrFail($id);

        // dd($role->permissions);
        return Inertia::render('Roles/Edit', compact('permissions', 'role'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role->id),
            ],
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->syncPermissions($request->permissions);
        return Redirect::route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return Redirect::route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
