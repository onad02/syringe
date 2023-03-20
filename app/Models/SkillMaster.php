<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillMaster extends Model
{
    use HasFactory;

    protected $table = 'skills_master';

    public function group()
    {
        return $this->belongsTo(SkillGroupMaster::class,'sgm_id');
    }
}
