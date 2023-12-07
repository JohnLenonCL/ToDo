<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    // app/Http/Controllers/AdminController.php

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
