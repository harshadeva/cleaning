<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view('user.create');
    }
}
