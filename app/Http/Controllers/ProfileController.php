<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function view_profile()
    {
        $user_id = Auth::user()->id;
        $data['getUser'] = User::getSingle($user_id);
        $data['getOrder'] = Order::getOrderByUser($user_id);
        return view('profile.view', $data);
    }

    public function edit()
    {
        $user_id = Auth::user()->id;
        $data['getUser'] = User::getSingle($user_id);
        return view('profile.edit', $data);
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::getSingle($user_id);
        if(!empty($request->password)) {
            $user->password = trim(Hash::make($request->password));
        }
        $user->name = trim($request->name);
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->address = trim($request->address);
        $user->job = trim($request->job);
        $user->save();

        return redirect('profile')->with('success', 'Profile updated successfully !');
    }
}
