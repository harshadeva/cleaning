<?php

namespace App\Http\Controllers\Admin;

use App\Classes\CatchErrors;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStoreReqest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        try {
            $records = Company::all();
            return view('admin.company.index')->with(['records' => $records]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function create()
    {
        try {
            return view('admin.company.create');
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function edit($id)
    {
        try {
            $record = Company::find($id);
            return view('admin.company.edit', ['record' => $record]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function show($id)
    {
        try {
            $record = Company::find($id);
            return view('admin.company.show', ['record' => $record]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function store(CompanyStoreReqest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->storeFirstUser($request);
            $company = $this->storeCompany($request);
            $companyAdmin = $this->storeCompanyAdmin($user, $company);
            $request['company_admin_id'] = $companyAdmin->id;
            DB::commit();
            return redirect()->route('admin.company.index')->with(['successMessage' => 'Company saved']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    public function update($id, CompanyUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $company = $this->updateCompany($id, $request);
            $this->updateCompanyAdmin($company, $request);
            DB::commit();
            return redirect()->route('admin.company.index')->with(['successMessage' => 'Company updated']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    public function destroy($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $record = Company::find($id);
            $record->status = !$record->status;
            $record->save();
            DB::commit();
            return ['success' => 'Company status changed'];
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    private function storeFirstUser($request)
    {
        return User::register($request);
    }

    private function storeCompanyAdmin($user, $company)
    {
        return Employee::register($user, $company, 1); // 1 is company admin value
    }

    private function storeCompany($request)
    {
        return Company::register($request);
    }

    private function updateCompany($id, $request)
    {
        $record = Company::find($id);
        $record->name = $request->company_name;
        $record->address = $request->address;
        $record->contact_no1 = $request->contact_no_1;
        $record->contact_no2 = $request->contact_no_2;
        $record->start_date = $request->start_date;
        $record->save();
        return $record;
    }

    private function updateCompanyAdmin($company, $request)
    {
        $user = $company->admin()->user;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $user;
    }
}
