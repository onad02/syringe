<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryMaster extends Model
{
    use HasFactory;

    protected $table = "inquiry_master";

    public $timestamps = false;

    protected $primaryKey = 'inquiry_id';

    protected $fillable = ['company_name', 'contact_person', 'contact_number', 'type', 'gender', 'email_id', 'country', 'city', 'inquiry_date'];
    
}
