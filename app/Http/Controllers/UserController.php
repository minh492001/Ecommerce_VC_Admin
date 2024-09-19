<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        $data['header_title'] = "User";
        $company_id = Auth::user()->company_id;
        $data['getCompany'] = CompanyModel::getSingle($company_id);
        $data['getRecord'] = User::getCustomer($company_id);
        $data['TotalUsers'] = User::getTotalCustomer($company_id);
        return view('user.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "New Admin";
        if (Auth::user()->company_id != 1) {
            $company_id = Auth::user()->company_id;
            $data['getCompany'] = CompanyModel::getSingle($company_id);
        } else {
            $data['getCompany'] = CompanyModel::getRecord();
        }

        return view('user.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = trim(Hash::make($request->password));
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->address = trim($request->address);
        $user->company_id = $request->company_id;
        $user->job = trim($request->job);
        $user->status = $request->status;
        $user->is_admin = 0;
        $user->save();

        return redirect('user/list')->with('success', 'User added successfully !');
    }

    public function edit($id)
    {
        $data['header_title'] = "Edit User";
        $data['getRecord'] = User::getSingle($id);

        if (Auth::user()->company_id != 1) {
            $company_id = Auth::user()->company_id;
            $data['getCompany'] = CompanyModel::getSingle($company_id);
        } else {
            $data['getCompany'] = CompanyModel::getRecord();
        }
        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)) {
            $user->password = trim(Hash::make($request->password));
        }
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->address = trim($request->address);
        $user->company_id = $request->company_id;
        $user->job = trim($request->job);
        $user->is_admin = $request->is_admin;
        $user->status = $request->status;
        $user->save();

        return redirect('user/list')->with('success', 'User updated successfully !');
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', 'Admin deleted successfully !');

    }
}
