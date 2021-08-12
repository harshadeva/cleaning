<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $appends = ['path','raw_path'];

    public function reportSectionMedias()
    {
        return $this->hasMany(ReportSectionMedia::class);
    }

    public function getPathAttribute()
    {
        return $this->getImagesArray();
    }

    public function getRawPathAttribute()
    {
        return $this->getRawPathArray();
    }

    public static function getFolderPath($type, $size)
    {
        return $type . '/' . 'images/' . Auth::user()->getCompany()->id . '_office/' . $size . '/';
    }

    public function getImagesArray()
    {
        $imageArray = [];
        $imagesizes = config('common.imagesSize');
        array_push($imagesizes,['name'=>'original']);
        foreach ($imagesizes as $imagesize) {
            $folderName = $imagesize['name'];
            $path = asset(self::getFolderPath('storage', $folderName) . $this->name);
            $imageArray[$folderName] = $path;
        }
        return $imageArray;
    }

    public function getRawPathArray()
    {
        $imageArray = [];
        $imagesizes = config('common.imagesSize');
        array_push($imagesizes, ['name' => 'original']);
        foreach ($imagesizes as $imagesize) {
            $folderName = $imagesize['name'];
            $path = '/public/'.self::getFolderPath('storage', $folderName) . $this->name;
            $imageArray[$folderName] = $path;
        }
        return $imageArray;
    }
}
