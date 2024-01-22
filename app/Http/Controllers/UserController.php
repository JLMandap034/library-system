<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('id', auth()->user()->id)->where('is_admin', 0)->withTrashed()->paginate(10);

        return view('users.index', [
            'users' => $users,
            'columns' => ['Name', 'E-mail', 'Action'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->all();
            if (!isset($data['password'])) {
                $data = $request->except(['password', 'password_confirmation']);
            } else {
                $data['password'] = Hash::make($validated['password']);
            }
            $user->update($data);

            return redirect()->route('users.edit', $user)->with('user-updated', 'User Updated!');
        } catch (\Throwable $th) {
            return redirect()->route('users.edit', $user)->with('error', 'Library User Not Added!');
        }
    }
}
