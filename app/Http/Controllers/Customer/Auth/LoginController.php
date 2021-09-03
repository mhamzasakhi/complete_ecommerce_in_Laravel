<?php

namespace App\Http\Controllers\Customer\Auth;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Wishlist;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public $company_name;

    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function login()
    {
        session()->put('keep_return_url', url()->previous());
        return view('customer-view.auth.login');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $this->company_name = BusinessSetting::where('type', 'company_name')->first();
        $remember = ($request['remember']) ? true : false;

        $user = User::where(['email' => $request['email']])->first();
        if (isset($user) && $user->is_active && auth('customer')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            session()->put('wish_list', Wishlist::where('customer_id', auth('customer')->user()->id)->pluck('product_id')->toArray());
            if ($request->ajax()) {
                return response()->json(['message' => 'Signed in successfully!', 'url' => session('keep_return_url')]);
            }
            Toastr::info('Welcome to ' . $this->company_name->value . '!');
            return redirect(session('keep_return_url'));
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Credentials do not match or account has been suspended.'], 401);
        }

        Toastr::error('Credentials do not match or account has been suspended.');
        return back();
    }

    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();
        Toastr::info('Come back soon, ' . '!');
        return redirect()->route('home');
    }
}
