<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSectionUpdate;
use App\Models\Employee;
use App\Models\Section;
use App\Models\Site;
use App\Models\SiteSection;
use Illuminate\Http\Request;

class SiteSectionController extends Controller
{
    public function edit($siteId,Request $request){
        $site = Site::with(['siteSections.employee'])->find($siteId);
        $employees = Employee::active()->auth()->worker()->get();
        return view('site_section.edit',['site'=> $site, 'employees'=> $employees]);
    }

    public function update(SiteSectionUpdate $request){
        $siteId = $request['site_id'];
        $siteSections = $request['site_sections'];
        $siteSectionsArray = array_column($siteSections, 'id');
        SiteSection::where('site_id',$siteId)->whereNotIn('id', $siteSectionsArray)->delete();
        foreach($siteSections as $siteSection){
            SiteSection::updateOrCreate(['id'=> $siteSection['id']],['site_id'=>$siteId, 'employee_id' => $siteSection['employee_id'], 'name' => $siteSection['section'],'status'=>1]);
        }
        return response()->json(['successMessage' => 'Sections saved']);
    }
}
