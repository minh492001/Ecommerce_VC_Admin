<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CompanyModel;

class AdminController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Admin";
        $data['getRecord'] = User::getAdmin();
        return view('admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "New Admin";
        $data['getCompany'] = CompanyModel::getRecord();
        return view('admin.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->company_id = $request->company_id;
        $user->password = trim(Hash::make($request->password));
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin/list')->with('success', 'Admin added successfully !');
    }

    public function edit($id)
    {
        $data['header_title'] = "Edit Admin";
        $data['getRecord'] = User::getSingle($id);
        return view('admin.edit', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->is_admin = $request->is_admin;
        $user->status = $request->status;
        $user->save();

        return redirect('admin/list')->with('success', 'Admin updated successfully !');
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', 'Admin deleted successfully !');

    }
}
