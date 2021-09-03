<?php

namespace App\Http\Controllers\Customer\Auth;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function register()
    {
        session()->put('keep_return_url', url()->previous());
        return view('customer-view.auth.register');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'phone' => 'unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        if ($request['password'] != $request['con_password']) {
            return response()->json(['errors' => ['code' => '', 'message' => 'password does not match.']],403);
        }

        if (session()->has('keep_return_url')==false){
            session()->put('keep_return_url', url()->previous());
        }

        DB::table('users')->insert([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => bcrypt($request['password'])
        ]);

        if (auth('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return response()->json(['message' => 'Sign up process done successfully!', 'url' => session('keep_return_url')]);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Something went wrong.']);
    }
}
