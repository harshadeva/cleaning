<?php

namespace App\Http\Controllers;

use App\Classes\CatchErrors;
use App\Http\Requests\SiteStoreRequest;
use App\Http\Requests\SiteUpdateRequest;
use App\Models\Employee;
use App\Models\Section;
use App\Models\Site;
use App\Models\SiteSection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function index()
    {
        try {
            $records = Site::authCompany()->latest()->get();
            return view('site.index', ['records' => $records]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function create()
    {
        try {
            return view('site.create');
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function edit($id)
    {
        try {
            $record = Site::find($id);
            return view('site.edit', ['record' => $record]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function show($id)
    {
        try {
            $record = Site::find($id);
            return view('site.show', ['record' => $record]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function store(SiteStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->storeFirstUser($request);
            $this->storeSite($request, $user);
            DB::commit();
            return redirect()->route('site.index')->with(['successMessage' => 'Site saved']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    public function destroy($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $record = Site::find($id);
            $record->status = !$record->status;
            $record->save();
            DB::commit();
            return ['success' => 'Company status changed'];
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    public function update($id, SiteUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $site = Site::find($id);
            $this->updateFirstUser($site->site_admin_id, $request);
            $this->updateSite($id, $request);
            DB::commit();
            return redirect()->route('site.index')->with(['successMessage' => 'Site updated']);
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }

    private function updateSite($id, $request)
    {
        $record = Site::find($id);
        $record->name = $request->site_name;
        $record->address = $request->address;
        $record->contact_no1 = $request->contact_no_1;
        $record->contact_no2 = $request->contact_no_2;
        $record->save();
        return $record;
    }

    private function updateFirstUser($userId, $request)
    {
        $user = User::find($userId);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $user;
    }


    private function storeFirstUser($request)
    {
        $user = User::register($request);
        $user->syncRoles('site admin');
        return $user;
    }

    private function storeSite($request, $user)
    {
        return Site::register($request, $user);
    }

    public function getSections()
    {
        return Section::active()->get();
    }
}
