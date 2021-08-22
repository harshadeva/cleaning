<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $appends = ['logo_path'];

    public function admin()
    {
        return $this->employees()->admin()->first();
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function logo()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function getLogoPathAttribute(){
       return  $this->logo ? $this->logo :['path'=> Media::defaultImagesArray(), 'raw_path'=> Media::getDefaultRawPathArray()] ;
    }


    public static function register($data)
    {
        $record = new self();
        $record->name = $data['company_name'];
        $record->address = $data['address'];
        $record->contact_no1 = $data['contact_no_1'];
        $record->contact_no2 = $data['contact_no_2'];
        $record->start_date = $data['start_date'];
        $record->status = 1;
        $record->save();
        return $record;
    }

    public static function getAuth()
    {
        return  self::with(['logo'])->whereHas('employees', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();
    }
}
