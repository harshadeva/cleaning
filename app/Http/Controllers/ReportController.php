<?php

namespace App\Http\Controllers;

use App\Classes\CatchErrors;
use Exception;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        try {
            return view('report.index');
        } catch (Exception $e) {
            return CatchErrors::render($e);
        }
    }
}
