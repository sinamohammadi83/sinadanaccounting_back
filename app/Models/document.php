<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function documentRows()
    {
        return $this->hasMany(documentRows::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function accept_staff(){
        return $this->belongsTo(Staff::class,'accept_staff_id');
    }
}
