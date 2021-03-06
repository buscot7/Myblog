<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $name = $user->name;
        return view ('users.edit', compact('user', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);
        return back()->with(['ok' => __('Le profil a bien été mis à jour')]);
    }
}
