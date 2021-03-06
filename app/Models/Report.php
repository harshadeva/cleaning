<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'report';

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function site(){
        return $this->belongsTo(Site::class,'site_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function signature(){
        return $this->belongsTo(Media::class, 'signature_id');
    }

    public function reportSections()
    {
        return $this->hasMany(ReportSection::class, 'report_id');
    }

    public function siteAdminMedias()
    {
        return $this->hasMany(SiteAdminMedia::class, 'report_id');
    }

    public function getOverallRating(){
        $ratingsSum = $this->reportSections()->active()->sum('rating');
        $reportSectionsCount = $this->reportSections()->active()->count();
        if($reportSectionsCount == 0) return 0;
        return round($ratingsSum / $reportSectionsCount);
    }

}
