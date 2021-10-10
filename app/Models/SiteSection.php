<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSection extends Model
{
    use HasFactory;
    protected $table = 'site_section';
    protected $guarded = [];

    public function scopeActive($query){
        return $query->where('status',1);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function getAvarage(){
        $sum =  ReportSection::where('site_section_id',$this->id)->whereHas('report',function($q){
            $q->where('site_id',$this->site_id);
        })->active()->sum('rating');
        $count =  ReportSection::where('site_section_id',$this->id)->whereHas('report',function($q){
            $q->where('site_id',$this->site_id);
        })->active()->count();
        return round($sum / $count,1);
    }
}
