<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    use HasFactory;
    protected $table = 'product_properties';
    protected $fillable = [
        'product_id',
        'title',
        'content',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
