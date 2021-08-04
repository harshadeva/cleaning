<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $appends = ['path'];

    public function reportSectionMedias(){
        return $this->hasMany(ReportSectionMedia::class);
    }

    public function getPathAttribute(){
        return asset('storage/images/' . Auth::user()->getCompany()->id . '_office') .'/'. $this->name;
    }

    public static function getFolderPath(){
        return 'public/images/' . Auth::user()->getCompany()->id . '_office/';
    }

}
