<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        // Get per page value or default to 10
        $perPage = $request->input('perPage', 10);

        return Inertia::render('Users/Index', [
            'users' => User::query()
                // Filter users by name, email, or type
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%");
                })
                ->orderBy('created_at', 'desc') // Sort users by created_at date
                ->paginate($perPage), // Paginate results
            'filters' => $request->only(['search', 'perPage']) // Return search and perPage filters
        ]);
    }


    public function create()
    {
        $roles = Role::get();
        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole([$request->role]);

        $user->save();
        return Redirect::route('users.index');
    }
    public function getUserRole()
    {
        $role = Role::select('name')->get();
        return  $role;
    }
}
