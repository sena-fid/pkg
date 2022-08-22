<?php

namespace App\Models\Settings;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'offer_status';
    protected $fillable = [
        'title',
        'color',
    ];



     public function status()
    {
        return $this->hasMany(Offer::class, 'offer_status', 'id');
    }
}
