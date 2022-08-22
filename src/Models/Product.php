<?php

namespace App\Product\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'title',
        'seri_no',
        'barcode_no',
        'price',
        'price_type',
        'unit',
        'category_id',
        'brand_id',
        'image',
        'path',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function productProperties()
    {
        return $this->hasMany(ProductProperty::class, 'product_id', 'id');
    }

    public function productOffers()
    {
        return $this->hasMany(OfferProduct::class, 'product_id', 'id');
    }


    public function offers()
    {
        return $this->hasMany(Offer::class, 'offer_id', 'id');
    }

}
