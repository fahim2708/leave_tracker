<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }


    public function create(RegisterRequest $request)
    {

        $user = new User();
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password = Hash::make($request->password);
        $user->type =  $request->type ?? 'employee';
        $user->save();

        $employee = Employee::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email
        ]);

        //Send Verification Email
        // event(new Registered($user));

        //authenticate
        Auth::attempt($request->only('email', 'password'));

        return redirect('/');
    }
}
