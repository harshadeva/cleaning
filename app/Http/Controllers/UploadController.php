<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request['file'];
            $extension = $file->extension();
            $companyId = Auth::user()->getCompany()->id;
            $imageName = $companyId.'_'.date('Y_m_d_H_i_s').'_'.uniqid().'.'.$extension;
            Storage::putFileAs(Media::getFolderPath(), $file , $imageName);
        }
        $record = new Media();
        $record->name = $imageName;
        $record->status = 1;
        $record->save();

        return response()->json(['successMessage' => 'File uploaded', 'upload_id' => $record->id], 200);
    }
}
