<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Site extends Model
{
    use HasFactory;
    protected $table = 'site';

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'site_admin_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'site_id');
    }

    public function scopeAuthCompany($query)
    {
        return $query->where('company_id', User::find(Auth::user()->id)->companyAdminAccount()->company_id);
    }

    public static function register($data, $user)
    {
        $record = new self();
        $record->company_id = User::find(Auth::user()->id)->companyAdminAccount()->company_id;
        $record->site_admin_id = $user->id;
        $record->name = $data['site_name'];
        $record->address = $data['address'];
        $record->contact_no1 = $data['contact_no_1'];
        $record->contact_no2 = $data['contact_no_2'];
        $record->status = 1;
        $record->save();
        return $record;
    }
}
