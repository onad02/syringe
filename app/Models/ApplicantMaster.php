<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class ApplicantMaster extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'applicant_name',
        'email_id',
        'password',
        'gender',
        'email_verified',
        'mobile_number',
        'whats_app',
        'image',
        'country_id',
        'city_id',
        'town_id',
        'nationality',
        'passport',
        'dob',
        'sgm_id',
        'skills_id',
        'immigration_id',
        'registered_on',
        'registered_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'applicant_master';

    protected $primaryKey = 'applicant_id';

    public $timestamps = false;
}
