<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('type', '!=', 'admin')->get();

        return view('user.index', compact('users'));
    }

    public function updateStatus(Request $request)
    {
        $userId = $request->input('userId');
        dd($userId);
        
    }
}
