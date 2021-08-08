<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request['file'];
            $extension = $file->extension();
            $companyId = Auth::user()->getCompany()->id;
            $imageName = $companyId.'_'.date('Y_m_d_H_i_s').'_'.uniqid().'.'.$extension;

            Storage::putFileAs(Media::getFolderPath('public','original'), $file, $imageName);

            $imagesizes = config('common.imagesSize');
            foreach ($imagesizes as $imagesize) {
                $folderName = $imagesize['name'];
                Storage::makeDirectory(Media::getFolderPath('public',$folderName));
                Image::make($file)->resize($imagesize['width'], $imagesize['height'])->save(public_path(Media::getFolderPath('storage', $folderName) . $imageName));
            }

        }
        $record = new Media();
        $record->name = $imageName;
        $record->status = 1;
        $record->save();
        

        return response()->json(['successMessage' => 'File uploaded', 'upload_id' => $record->id], 200);
    }
}
