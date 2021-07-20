<?php

namespace App\Http\Controllers;

use App\Classes\CatchErrors;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        try {
            $auth = User::find(Auth::user()->id);
            if ($auth->hasRole('company admin')) {
                $records = User::company($auth->companyAdminAccount()->company_id)->get();
            }
            return view('employee.index', ['records' => $records]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function create()
    {
        try {
            $userRoles = Role::whereIn('id', [3, 4])->get();
            return view('employee.create', ['userRoles' => $userRoles]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function show(User $user)
    {
        try {
            return view('employee.show', ['record' => $user]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::with('roles')->find($id);
            $employeeTypes = EmployeeType::where('id', '!=', 1)->get();
            return view('employee.edit', ['record' => $user, 'employeeTypes' => $employeeTypes]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function store(EmployeeStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::register($request);
            $company = User::find(Auth::user()->id)->companyAdminAccount()->company;
            Employee::register($user, $company, $request['user_role_id']);
            DB::commit();
            return redirect()->back()->with(['successMessage' => 'Employee Registerd Successfully']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    public function update($id, EmployeeUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::edit($id, $request);
            $company_id = User::find(Auth::user()->id)->companyAdminAccount()->company_id;
            Employee::edit($user->id, $company_id, $request['employee_type_id']);
            DB::commit();
            return redirect()->back()->with(['successMessage' => 'Employee Updated Successfully']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }
}
