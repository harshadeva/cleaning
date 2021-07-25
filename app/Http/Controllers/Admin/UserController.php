<?php

namespace App\Http\Controllers\Admin;

use App\Classes\CatchErrors;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        try {
            $records = User::companyAdmin()->get();
            return view('admin.user.index', ['records' => $records]);
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $record = User::find($id);
            $record->status = !$record->status;
            $record->save();
            DB::commit();
            return ['success' => 'User status changed'];
        } catch (Exception $e) {
            return CatchErrors::rollback($e);
        }
    }
}
