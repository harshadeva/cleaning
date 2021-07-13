<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $table  = 'user';
    protected $appends = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function companyAdminAccount()
    {
        return $this->employees()->admin()->first();
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function scopeCompanyAdmin($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        });
    }

    public function scopeCompany($query, $companyId)
    {
        return $query->whereHas('employees', function ($q) use ($companyId) {
            $q->where('company_id', $companyId);
        });
    }

    public static function register($data)
    {
        $record = new self();
        $record->first_name = $data['first_name'];
        $record->last_name = $data['last_name'];
        $record->email = $data['email'];
        $record->password = Hash::make($data['password']);
        $record->status = 1;
        $record->save();
        return $record;
    }
}
