<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'report';

    public function site(){
        return $this->belongsTo(Site::class,'site_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportSections()
    {
        return $this->hasMany(ReportSection::class, 'report_id');
    }

    public function getOverallRating(){
        $ratingsSum = $this->reportSections()->active()->sum('rating');
        $ratingsCount = $this->reportSections()->active()->count();
        return round($ratingsSum / $ratingsCount);
    }

}
