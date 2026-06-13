<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Branch extends Model
{
    use HasFactory;

    public function persons():HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function storages():hasMany
    {
        return $this->hasMany(Storage::class);
    }

    public function factors():HasMany
    {
        return $this->hasMany(Factor::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
