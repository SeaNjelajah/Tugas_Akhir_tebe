<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersAdminController extends Controller
{
    public function index () {
        $users = User::all();
        return view('admin.user_admin.index', compact('users'));
    }

    public function update (Request $request, $id) {
        
        

        $request->validate([
            'username' . $id => ['required', 'string', 'max:255'],
            'email' . $id => ['required', 'string', 'email', 'max:255'],
        ]);

        
        if ($request->get('password' . $id)) {

            $request->validate([
                'password' . $id => ['required', 'confirmed', Rules\Password::defaults()]
            ]);

            $password = Hash::make( $request->get("password" . $id) );

        }
        
        $user = User::find($id);
        
        $user->update([
            "username" => $request->get("username" . $id),
            "email" => $request->get("email" . $id),
        ]);

        if (!empty($password)) {
            $user->update([
                "password" => $password
            ]);
        }

        return redirect()->back()->with('success', "Update user berhasil");
    }

    public function destroy ($id) {
        
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with("success", "Berhasil Menghapus user!");
    }

}
