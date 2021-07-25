<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $appends = ['name'];


    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reportSections()
    {
        return $this->hasMany(ReportSection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeAuth($query)
    {
        return $query->where('company_id', User::find(Auth::user()->id)->companyAdminAccount()->company_id);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeAdmin($query)
    {
        return $query->where('employee_type_id', 1);
    }

    public function scopeSupervisor($query)
    {
        return $query->where('employee_type_id', 2);
    }

    public function scopeWorker($query)
    {
        return $query->where('employee_type_id', 3);
    }

    public static function register($user, $company, $userRoleId)
    {
        $record = new self();
        $record->user_id  = $user->id;
        $record->company_id  = $company->id;
        $record->employee_type_id  = self::getEmployeeType($userRoleId);
        $record->status = 1;
        $record->save();

        self::storeUserRoles($user, $userRoleId);
        return $record;
    }

    private static function getEmployeeType($userRoleId)
    {
        if ($userRoleId == 2) {
            return 1;
        } else if ($userRoleId == 3) {
            return 2;
        } else if ($userRoleId == 4) {
            return 3;
        }
    }

    private static function storeUserRoles($user, $userRoleId)
    {
        if ($userRoleId == 2) {
            $user->syncRoles('company admin');
        } else if ($userRoleId == 3) {
            $user->syncRoles('supervisor');
        } else if ($userRoleId == 4) {
            $user->syncRoles('worker');
        }
    }

    public static function edit($userId, $compayId, $employeeTypeId)
    {
        $record = self::where('company_id', $compayId)->where('user_id', $userId)->first();
        $record->employee_type_id  = $employeeTypeId;
        $record->save();

        self::storeUserRoles($record->user, $employeeTypeId);
    }
}
