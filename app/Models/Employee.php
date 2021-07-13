<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public static function register($user, $company,$employeeTypeId)
    {
        $record = new self();
        $record->user_id  = $user->id;
        $record->company_id  = $company->id;
        $record->employee_type_id  = $employeeTypeId;
        $record->status = 1;
        $record->save();

        self::storeUserRoles($user,$employeeTypeId);
        return $record;
    }

    private static function storeUserRoles($user,$employeeTypeId){
        if($employeeTypeId == 1){
            $user->assignRole('company admin');
        } else if ($employeeTypeId == 2) {
            $user->assignRole('supervisor');
        } else if ($employeeTypeId == 3) {
            $user->assignRole('worker');
        }
    }
}
