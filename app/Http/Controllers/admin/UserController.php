<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->user()->id == $user->id) {
            return redirect()->back()->with([
                'error' => 'You can\'t demote yourself.',
            ]);
        }

        $user->update([
            'role' => $user->role == 0 ? 1 : 0,
        ]);

        return redirect()->back()->with([
            'success' => 'User role updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->back()->with([
                'error' => 'You can\'t delete yourself.',
            ]);
        }

        $user->delete();

        return redirect()->back()->with([
            'success' => 'User deleted successfully.',
        ]);
    }
}
