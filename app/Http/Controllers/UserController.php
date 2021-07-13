<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $auth = User::find(Auth::user()->id);
        if($auth->hasRole('super admin')){
            $records = User::companyAdmin()->get();
        }
        else if($auth->hasRole('company admin')){
            $records = User::company($auth->companyAdminAccount()->company_id)->get();
        }

        return view('user.index',['records'=>$records]);
    }

    public function create(){
        $userRoles = Role::whereIn('id',[3,4])->get();
        return view('user.create',['userRoles'=> $userRoles]);
    }

    public function store(Request $request){
        $user = User::register($request);
        $company = User::find(Auth::user()->id)->companyAdminAccount()->company;
        Employee::register($user,$company,$request['user_role_id']);
        return redirect()->back()->with(['successMessage'=>'Employee Registerd Successfully']);
    }
}
