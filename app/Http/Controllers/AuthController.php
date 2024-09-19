<?php

namespace App\Http\Controllers;

use App\Models\CompanyModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0, 'is_delete' => 0], $remember)){
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('error', 'Please enter correct email or password');
        }
    }

    public function register()
    {
        $data['getCompany'] = CompanyModel::getRecord();
        if (!empty(Auth::check())) {
            return redirect('dashboard');
        }
        return view('auth.register', $data);
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);
        if (($request->password) === ($request->confirm_password)) {
            if(empty($checkEmail)) {
                $save = new User;
                $save->name = trim($request->name);
                $save->age = trim($request->age);
                $save->gender = trim($request->gender);
                $save->address = trim($request->address);
                $save->email = trim($request->email);
                $save->company_id = $request->company_id;
                $save->job = trim($request->job);
                $save->password = trim(Hash::make($request->password));
                $save->is_admin = 0;
                $save->status = 0;
                $save->save();

                return redirect('/')->with('success', 'You have been registered successfully !');
            } else {
                return redirect()->back()->with('error', 'Email already exists !');
            }
        }
        else {
            return redirect()->back()->with('error', 'Password and retype password do not match !');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
