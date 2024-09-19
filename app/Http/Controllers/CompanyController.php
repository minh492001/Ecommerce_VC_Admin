<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CompanyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function list()
    {
        $data['getRecord'] = CompanyModel::getRecord();
        $data['header_title'] = "Company";
        return view('company.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "New Company";
        return view('company.add', $data);
    }

    static public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:company'
        ]);

        $company = new CompanyModel;
        $company->name = trim($request->name);
        $company->status = trim($request->status);
        $company->created_by = Auth::user()->id;
        $company->save();

        return redirect('company/list')->with('success', 'Company added successfully !');
    }

    public function edit($id)
    {
        if (Auth::user()->company_id == $id || Auth::user()->company_id == 1) {
            $data['getRecord'] = CompanyModel::getSingle($id);
            $data['header_title'] = "Edit Company";
            return view('company.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|unique:company,name,'.$id
        ]);

        $company = CompanyModel::getSingle($id);
        $company->name = trim($request->name);
        $company->status = trim($request->status);
        $company->save();

        return redirect('company/list')->with('success', 'Company updated successfully !');
    }

    public function delete($id)
    {
        $company = CompanyModel::getSingle($id);
        $company->is_delete = 1;
        $company->save();

        return redirect()->back()->with('success', 'Company deleted successfully !');
    }
}
