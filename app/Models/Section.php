<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'section';

    public function scopeActive($query){
        return $query->where('status',1);
    }

    public function siteSections()
    {
        return $this->hasMany(SiteSection::class);
    }

}
