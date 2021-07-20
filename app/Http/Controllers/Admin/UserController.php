<?php

namespace App\Http\Controllers\Admin;

use App\Classes\CatchErrors;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

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
}
