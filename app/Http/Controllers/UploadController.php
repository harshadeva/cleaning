<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file') && $request['file'] != null) {
            $file = $request['file'];
            $extension = $file->extension();
            $imageName = 'csmt' . '_' . date('Y_m_d_H_i_s') . '_' . uniqid() . '.' . $extension;

            Storage::makeDirectory(Media::getFolderPath('public', 'original'));
            Image::make(file_get_contents($request->file))->save(public_path(Media::getFolderPath('storage', 'original') . $imageName));
            $imagesizes = config('common.imagesSize');
            foreach ($imagesizes as $imagesize) {
                $folderName = $imagesize['name'];
                Storage::makeDirectory(Media::getFolderPath('public', $folderName));
                Image::make($file)->resize($imagesize['width'], $imagesize['height'])->save(public_path(Media::getFolderPath('storage', $folderName) . $imageName));
            }

            $record = new Media();
            $record->name = $imageName;
            $record->status = 1;
            $record->save();

            return response()->json(['successMessage' => 'File uploaded', 'upload_id' => $record->id], 200);
        }
        return response()->json(['errorMessage' => 'No file found'], 401);
    }

    public function getDefault(){
        return  Media::defaultImagesArray();
    }

    public function storeSignature(Request $request)
    {
        Log::info($request->all());
            if ($request->has('file') && $request['file'] != null) {
                $imageName = 'csmt' . '_' . date('Y_m_d_H_i_s') . '_' . uniqid() . '.png';

                Storage::makeDirectory(Media::getFolderPath('public', 'original'));
                Image::make(file_get_contents($request->file))->save(public_path(Media::getFolderPath('storage', 'original') . $imageName));

                $imagesizes = config('common.imagesSize');
                foreach ($imagesizes as $imagesize) {
                    $folderName = $imagesize['name'];
                    Storage::makeDirectory(Media::getFolderPath('public', $folderName));
                    Image::make(file_get_contents($request->file))->resize($imagesize['width'], $imagesize['height'])->save(public_path(Media::getFolderPath('storage', $folderName) . $imageName));
                }

                $record = new Media();
                $record->name = $imageName;
                $record->status = 1;
                $record->save();

                return response()->json(['successMessage' => 'File uploaded', 'upload_id' => $record->id], 200);
            }
            return response()->json(['errorMessage' => 'No file found'], 401);
    }

    public function storeLogo(Request $request)
    {
        try {
        if ($request->has('file') && $request->file != null) {
            $imageName = 'logo' . '_' . date('Y_m_d_H_i_s') . '_' . uniqid() . '.png';

            Storage::makeDirectory(Media::getFolderPath('public', 'original'));
            Image::make(file_get_contents($request['file']))->save(public_path(Media::getFolderPath('storage', 'original') . $imageName));

            $imagesizes = config('common.imagesSize');
            foreach ($imagesizes as $imagesize) {
                $folderName = $imagesize['name'];
                Storage::makeDirectory(Media::getFolderPath('public', $folderName));
                Image::make(file_get_contents($request->file))->resize($imagesize['width'], $imagesize['height'])->save(public_path(Media::getFolderPath('storage', $folderName) . $imageName));
            }

            $record = new Media();
            $record->name = $imageName;
            $record->status = 1;
            $record->save();
            return $record;
        }
        } catch (Exception $e) {
            return null;
        }
    }

}
