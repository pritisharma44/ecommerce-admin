<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_variant_id', 'quantity','size'];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
