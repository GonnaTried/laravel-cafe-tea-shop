<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Fetch users with pagination
        $users = User::orderBy('id')->paginate(30); // Or order by 'created_at'

        // Return the index view, passing the users
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Return the create user view
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'phone' => 'required|string|unique:users|max:255', // Phone must be unique
            'password' => 'required|string|min:8', // Minimum password length
            // You might add validation for other fields if you add them later
        ]);

        // 2. Create the new User
        $user = User::create([
            'phone' => $request->phone,
            'password' => Hash::make($request->password), // HASH the password!
            // Add other fields if you add them to the migration later
        ]);

        // 3. Redirect the user with a success message
        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user) // Route model binding automatically fetches the user
    {
        // Return the show user view, passing the user
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user) // Route Model Binding
    {
        // Return the edit user view, passing the user
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'phone' => 'required|string|unique:users,phone,' . $user->id . '|max:255', // Phone unique, but ignore current user's phone
            'password' => 'nullable|string|min:8', // Password is nullable for update, only required if provided
            // Add validation for other fields
        ]);

        // 2. Prepare data for update
        $dataToUpdate = [
            'phone' => $request->phone,
            // Add other fields
        ];

        // Only update password if a new one was provided
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        // 3. Update the User
        $user->update($dataToUpdate);

        // 4. Redirect the user with a success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user) // Route model binding
    {
        // You might want to add checks here (e.g., prevent deleting the current logged-in user)

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
