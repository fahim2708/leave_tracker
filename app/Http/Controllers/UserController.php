<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('type', '!=', 'admin')->get();

        return view('user.index', compact('users'));
    }

    public function updateStatus(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user->active_status == 2) {
            $user->active_status = 1;
        } else {
            $user->active_status = 2;
        }

        $user->save();
        return redirect('/users');
    }
}
