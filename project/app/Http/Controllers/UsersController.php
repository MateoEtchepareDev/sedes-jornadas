<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;

use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password_hash' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        Users::create($request->only([
            'name',
            'email',
            'password_hash',
            'is_admin',
        ]));

        $user->access_code = strtoupper(Str::random(6));
        $user->save();

        return redirect()->route('users.index')
                        ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password_hash' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        $users->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password_hash'=>$request->password_hash,
            'is_admin'=>$request->is_admin,
        ]);

        return redirect()->route('users.index')
                        ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users->delete();

        return redirect()->route('users.index')
                        ->with('success', 'Usuario eliminado correctamente.');
    }
}
