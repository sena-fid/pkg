<?php

namespace App\Models\Settings;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'type',
        'title',
        'content',
    ];


    public function paraBirimi()
    {
        return $this->hasMany(Offer::class, 'curency', 'id');
    }

    public function onYazi()
    {
        return $this->hasMany(Offer::class, 'cover_letter', 'id');
    }

    public function genelSartlar()
    {
        return $this->hasMany(Offer::class, 'condition', 'id');
    }




}
