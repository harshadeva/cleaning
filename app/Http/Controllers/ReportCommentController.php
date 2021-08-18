<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SiteAdminMedia;
use Illuminate\Http\Request;

class ReportCommentController extends Controller
{
    public function create($id)
    {
        $report = Report::with(['siteAdminMedias.media'])->find($id);
        return view('report.comment.create')->with(['report' => $report]);
    }

    public function store(Request $request)
    {
        $report = Report::find($request['report_id']);
        $report->site_admin_comment = $request['comment'];
        $report->save();

        $this->storeImages($report, $request['images']);
        return response()->json(['successMessage' => 'Comment added']);
    }

    private function storeImages($report, $images)
    {
        SiteAdminMedia::where('report_id', $report->id)->whereNotIn('media_id', $images)->delete();
        foreach ($images as $mediaId) {
            SiteAdminMedia::updateOrCreate(['report_id' => $report->id, 'media_id' => $mediaId], ['status' => 1]);
        }
    }
}
