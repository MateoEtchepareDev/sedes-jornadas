<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all();
        return view('pages.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password_hash' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password_hash' => bcrypt($request->password_hash),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = Users::findOrFail($id);

        return view('pages.admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = Users::findOrFail($id);

        return view('pages.admin.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = Users::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($users->id),
            ],
            'password_hash' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->is_admin = $request->is_admin;

        if ($request->filled('password_hash')) {
            $users->password_hash = bcrypt($request->password_hash);
        }

        $users->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = Users::findOrFail($id);
        $users->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}