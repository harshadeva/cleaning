<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSection extends Model
{
    use HasFactory;
    protected $table = 'site_section';

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
