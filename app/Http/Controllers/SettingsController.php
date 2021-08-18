<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(){
        $company = Auth::user()->employees()->first()->company;
        return view('setting.index',['record'=>$company]);
    }
}
