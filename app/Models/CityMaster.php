<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityMaster extends Model
{
    use HasFactory;

    protected $table = 'city_master';

    public $timestamps = false;

    protected $primaryKey = 'city_id';

    protected $fillable = [
        'city_name',
        'country_id',
        'user_id',
        'date_added',
        'active'
    ];
}
