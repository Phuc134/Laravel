<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}
