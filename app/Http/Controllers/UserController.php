<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    
    
    public function index(Request $request)
{
    $query = User::with('userRole');

    // Search by name or email
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');

        });
    }

    // Filter by role
    if (
        $request->filled('role') &&
        in_array($request->role, ['admin', 'user'])
    ) {
    
        $query->whereHas('userRole', function ($q) use ($request) {
            $q->where('name', $request->role);
        });
    }

    $users = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('users.index', compact('users'));
}

public function updateRole(Request $request, User $user)
{
    $request->validate([
        'role' => ['required', 'in:user,admin'],
    ]);

    // Prevent admin from removing their own admin role
    if ($user->id === auth()->id() && $request->role !== 'admin') {
        return back()->with('error', 'You cannot remove your own admin role.');
    }

    $role = Role::where('name', $request->role)->firstOrFail();

    $user->update([
        'role_id' => $role->id,
    ]);

    return back()->with('success', 'User role updated successfully.');
}
    public function destroy(User $user)
    {
        // Prevent admin from deleting their own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
