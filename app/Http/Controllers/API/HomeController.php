<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SkillGroupMaster;
use App\Models\CityMaster;
use App\Models\CompanyMaster;
use App\Models\HealthCareSetting;

class HomeController extends Controller
{

    public function siteData(){

        $websiteInfos = CompanyMaster::first();
        $skills = SkillGroupMaster::get();

        return response()->json([
            'skills' => $skills,
            'website_infos' => $websiteInfos,
        ], 200);
        
    }

    public function homeData(){

        $ids = ['1','6','10','12','4','13'];
        $ids_ordered = implode(',', $ids);
        
        $skills = SkillGroupMaster::get();
        $majorCities = CityMaster::whereIn('city_id',$ids)->orderByRaw("FIELD(city_id, $ids_ordered)")->get();
        $employerSetting = HealthCareSetting::get();
        $websiteInfos = CompanyMaster::first();

        return response()->json([
            'skills' => $skills,
            'major_cities' => $majorCities,
            'employer_setting' => $employerSetting,
            'website_infos' => $websiteInfos
        ], 200);
        
    }


}
