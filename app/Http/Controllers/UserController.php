<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        $users = User::all();
        return Inertia::render('User/Index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        return Inertia::render('User/Create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'eth_address' => 'required', // Validasi untuk eth_address
        ]);

        User::create($request->only('name', 'email', 'eth_address'));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return Inertia::render('User/Show', compact('user'));
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'eth_address' => 'required', // Validasi untuk eth_address
        ]);

        $user->update($request->only('name', 'email', 'eth_address'));

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
