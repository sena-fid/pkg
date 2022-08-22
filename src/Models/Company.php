<?php

namespace App\Models\Companies;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'title',
        'sector',
        'address',
        'city',
        'distric',
        'email',
        'phone',
        'gsm',
        'url',
    ];


    public function companyOfficials()
    {
        return $this->hasMany(CompanyOfficial::class, 'company_id', 'id');
    }


    public function offers()
    {
        return $this->hasMany(Offer::class, 'company_id', 'id');
    }

}
