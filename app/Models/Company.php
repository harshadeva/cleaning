<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';

    public function admin(){
        return $this->employees()->admin()->first();
    }

    public function employees(){
        return $this->hasMany(Employee::class);
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
}
