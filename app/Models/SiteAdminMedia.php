<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAdminMedia extends Model
{
    use HasFactory;
    protected $table = 'site_admin_media';
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
