<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory,HasApiTokens;

    protected $guarded = [];

    public function staff():BelongsTo
    {
        return $this->belongsTo(Staff::class,"user_id");
    }

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getPermissions()
    {
        return $this->role->permissions->pluck('permission');
    }

    public function hasPermission($permission)
    {
        return $this->tokenCan($permission);
    }

}
