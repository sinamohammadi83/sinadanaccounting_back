<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function factorProduct()
    {
        return $this->belongsToMany(Product::class,'factor_products')->withPivot([
            'description',
            'unit',
            'count',
            'unit_price',
            'discount',
            'tax',
            'total_price'
        ]);
    }

    public function person():BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function document()
    {
        return $this->hasMany(document::class);
    }
}
