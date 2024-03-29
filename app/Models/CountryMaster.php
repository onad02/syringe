<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMaster extends Model
{
    use HasFactory;

    protected $table = 'country_master';

    public $timestamps = false;

    protected $fillable = [
        'country_name',
        'user_id',
        'date_added',
        'active',
    ];
}
