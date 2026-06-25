<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        "name",
        "buy_price",
        "sell_price",
        "count",
        "branch_id",
        "category_id",
        "staff_id",
        'product_code'
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function storage():BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }
}
