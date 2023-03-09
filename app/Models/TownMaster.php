<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TownMaster extends Model
{
    use HasFactory;

    protected $table = 'town_master';

    public $timestamps = false;

    protected $primaryKey = 'town_id';

    protected $fillable = [
        'town_name',
        'city_id',
        'user_id',
        'date_added',
        'active',
    ];
}
