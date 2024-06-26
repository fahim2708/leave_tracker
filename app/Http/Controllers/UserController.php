<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        if(request('search')){
            // $users = User::where('name', 'like', '%' . request('search') . '%')->paginate(5);
            $users = User::whereAny(['name', 'email'], 'LIKE', '%' . request('search') . '%')->paginate(5);
        }
        else{
            $users = User::where('type', '!=', 'admin')->paginate(5);
        }

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

    public function deleteUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->delete();
        
        return redirect('/users');

    }
}
