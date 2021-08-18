<?php

namespace App\Http\Controllers;

use App\Classes\CatchErrors;
use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Models\Employee;
use App\Models\Report;
use App\Models\ReportSection;
use App\Models\ReportSectionMedia;
use App\Models\Section;
use App\Models\Site;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        try {

            if(User::find(Auth::user()->id)->hasRole('site admin')){
                $records = Report::where('site_id', User::find(Auth::user()->id)->siteAdmins()->first()->id )->latest()->get()->map(function ($item) {
                    $item['sum_rating'] = $item->getOverallRating();
                    return $item;
                });
            }
            else{
                $records = Report::whereHas('site', function ($q) {
                    $q->where('company_id', User::find(Auth::user()->id)->employees()->first()->company_id);
                })->latest()->get()->map(function ($item) {
                    $item['sum_rating'] = $item->getOverallRating();
                    return $item;
                });
            }

            return view('report.index', ['records' => $records, 'successMessage' => $request['successMessage']]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function create(Request $request)
    {
        try {
            $sites = Site::where('company_id', User::find(Auth::user()->id)->employees()->first()->company_id)->get();
            $sections = Section::active()->get();
            $employees = Employee::with(['user'])->auth()->worker()->active()->get()->map(function ($item) {
                $item['name'] = $item->user->name;
                return $item;
            });
            return view('report.create', ['sites' => $sites, 'employees' => $employees, 'sections' => $sections]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function store(ReportStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $record = new Report();
            $record->site_id = $request['site_id'];
            $record->signature_id = $request['signature_id'];
            $record->user_id = Auth::user()->id;
            $record->date = $request['date'];
            $record->supervisor_comment = $request['supervisor_comment'];
            $record->site_admin_comment = $request['site_admin_comment'];
            $record->status = 1;
            $record->save();
            $this->storeSections($record, $request);
            DB::commit();
            return response()->json(['successMessage' => 'Report saved']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    private function storeSections($report, $request)
    {
        $sections = $request['site_sections'];
        $arrayColumns = array_column($sections, 'id');
        ReportSection::where('report_id', $report->id)->whereNotIn('id', $arrayColumns)->delete();
        foreach ($sections as $section) {
            $reportSection =  ReportSection::updateOrCreate([
                'id' => $section['id'] ?? null,
                'report_id' => $report->id
            ], [
                'section_id' => $section['section_id'],
                'employee_id' => $section['employee_id'],
                'rating' => $section['rating'],
                'description' => $section['remark'],
                'status' => 1,
            ]);
            $this->storeOrUpdateReportSectionMedia($reportSection, $section);
        }
    }

    public function storeOrUpdateReportSectionMedia($reportSection, $section)
    {
        ReportSectionMedia::where('report_section_id', $reportSection->id)->whereNotIn('media_id', $section['files'])->delete();
        foreach ($section['files'] as $mediaId) {
            ReportSectionMedia::updateOrCreate([
                'report_section_id' => $reportSection->id,
                'media_id' => $mediaId
            ]);
        }
    }

    public function show($id)
    {
        try {
            $record = Report::with(['site', 'signature', 'reportSections.employee.user', 'reportSections.section', 'reportSections.reportSectionMedias.media'])->find($id);
            return view('report.show', ['record' => $record]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function edit($id)
    {
        try {
            $record = Report::with(['site','signature', 'reportSections.employee.user', 'reportSections.section', 'reportSections.reportSectionMedias.media'])->find($id);
            $sections = Section::active()->get();
            $employees = Employee::with(['user'])->auth()->worker()->active()->get();
            return view('report.edit', ['record' => $record, 'employees' => $employees, 'sections' => $sections]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function update($id, ReportUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $record = Report::find($id);
            $record->date = $request['date'];
            $record->signature_id = $request['signature_id'];
            $record->supervisor_comment = $request['supervisor_comment'];
            $record->site_admin_comment = $request['site_admin_comment'];
            $record->save();
            $this->storeSections($record, $request);
            DB::commit();
            return response()->json(['successMessage' => 'Report Updated']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }
}
