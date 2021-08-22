<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSectionUpdate;
use App\Models\Section;
use App\Models\Site;
use App\Models\SiteSection;
use Illuminate\Http\Request;

class SiteSectionController extends Controller
{
    public function edit($siteId,Request $request){
        $site = Site::with(['siteSections.section'])->find($siteId);
        $sections = Section::active()->get();
        return view('site_section.edit',['site'=> $site, 'sections'=> $sections]);
    }

    public function update(SiteSectionUpdate $request){
        $siteId = $request['site_id'];
        $siteSections = $request['site_sections'];
        $siteSectionsArray = array_column($siteSections, 'section_id');
        SiteSection::where('site_id',$siteId)->whereNotIn('section_id', $siteSectionsArray)->delete();
        foreach($siteSections as $siteSection){
            SiteSection::updateOrCreate(['site_id'=>$siteId,'section_id'=> $siteSection['section_id']],['status'=>1]);
        }
        return response()->json(['successMessage' => 'Sections saved']);
    }
}
