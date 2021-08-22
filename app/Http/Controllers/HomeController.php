<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Report;
use App\Models\Section;
use App\Models\Site;
use App\Models\SiteSection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (User::find(Auth::user()->id)->hasRole('super admin')) {
            return $this->superAdminDashboard();
        }
        else if (User::find(Auth::user()->id)->hasRole('company admin')) {
            return $this->companyAdminDashboard();
        }
        else if (User::find(Auth::user()->id)->hasRole('site admin')) {
            return $this->siteAdminDashboard();
        }
        else{
            return view('home');
        }
    }

    public function companyAdminDashboard(){
        $sitesCount = Site::active()->where('company_id', Auth::user()->employees()->first()->company_id)->count();
        $reportsCount = Report::active()->whereHas('site',function($q){
            $q->where('company_id', Auth::user()->employees()->first()->company_id);
        })->count();
        $employeesCount = Employee::active()->where('company_id', Auth::user()->employees()->first()->company_id)->count();
        return view('home', ['sitesCount' => $sitesCount, 'reportsCount' => $reportsCount, 'employeesCount' => $employeesCount]);
    }

    public function superAdminDashboard(){
        $subscriptionsCount = Site::active()->count();
        $reportsCount = Report::active()->count();
        return view('home', ['subscriptionsCount' => $subscriptionsCount, 'reportsCount' => $reportsCount]);
    }

    public function siteAdminDashboard()
    {
        $sectionsCount = SiteSection::active()->whereHas('site',function($q){
            $q->where('site_admin_id', Auth::user()->id);
        })->count();
        $reportsCount = Report::active()->whereHas('site', function ($q) {
            $q->where('site_admin_id', Auth::user()->id);
        })->count();
        return view('home', ['sectionsCount' => $sectionsCount, 'reportsCount' => $reportsCount]);
    }
}
