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

    public function signatures()
    {
        return $this->hasMany(Report::class,'signature_id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'media_id');
    }

    public function siteAdminMedias()
    {
        return $this->hasMany(SiteAdminMedia::class, 'media_id');
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
        return $type . '/' . 'images/_office/' . $size . '/';
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

    public static function defaultImagesArray()
    {
        $imageArray = [];
        $imagesizes = config('common.imagesSize');
        array_push($imagesizes, ['name' => 'original']);
        foreach ($imagesizes as $imagesize) {
            $folderName = $imagesize['name'];
            $path = asset('assets/images/defaults/'. $folderName.'/default.jpg');
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
            $path = self::getFolderPath('/storage/app/public/', $folderName) . $this->name;
            $imageArray[$folderName] = $path;
        }
        return $imageArray;
    }

    public static function getDefaultRawPathArray()
    {
        $imageArray = [];
        $imagesizes = config('common.imagesSize');
        array_push($imagesizes, ['name' => 'original']);
        foreach ($imagesizes as $imagesize) {
            $folderName = $imagesize['name'];
            $path = asset('assets/images/defaults/' . $folderName . '/default.jpg');
            $imageArray[$folderName] = $path;
        }
        return $imageArray;
    }
}
