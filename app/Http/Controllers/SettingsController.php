<?php

namespace App\Http\Controllers;

use App\Classes\CatchErrors;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index(){
        $company = Company::getAuth();
        return view('setting.index',['record'=>$company]);
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $media = app(UploadController::class)->storeLogo($request);

            $company = Company::getAuth();
            $company->name = $request['name'];
            if($media != null){
                $company->media_id = $media->id;
            }
            $company->save();
            DB::commit();
            return response()->json(['successMessage'=>'Company Details Updated']);
        } catch (Exception $e) {
            return CatchErrors::axiosRollback($e);
        }

    }
}
