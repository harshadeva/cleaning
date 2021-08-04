<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSectionMedia extends Model
{
    use HasFactory;
    protected $table = 'report_section_media';
    protected $guarded = [];

    public function reportSection()
    {
        return $this->belongsTo(ReportSection::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
