<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Psy\Exception\ErrorException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
        ]);

        if (count($validator->errors())) {
            return response()->json(['registerErrors' => $validator->errors(), 'status' => 0], 400);
        }

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->roles()->attach(Role::where('name', 'user')->first());

            \Auth::loginUsingId($user->id);

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response(['status' => 0], 400);
        }
    }

}
