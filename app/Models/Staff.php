<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Branch():BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id');
    }
}
