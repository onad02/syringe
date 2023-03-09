<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Models\ApplicantMaster;
use App\Models\SkillGroupMaster;
use App\Models\CountryMaster;
use App\Models\CityMaster;
use App\Models\TownMaster;
use Carbon\Carbon;
use Mail;
use Cache;


class AuthController extends Controller
{
    public function register(Request $request)
    {   
        if($request->has('action')){

            $action = $request->action;
            if($action == 'send-otp'){

                $otp = mt_rand(1000,9999);;
                Cache::put($request->email, $otp, now()->addMinutes(10));

                Mail::to($request->email)->send(new EmailVerification($otp));

                return response()->json([
                    'message' => 'Success! OTP successfully emailed!'
                ], 200);

            } else if($action == 'verify-otp'){

                if (Cache::has($request->email)) {

                    $otp = Cache::get($request->email);
                    if($otp == $request->otp){

                        $user = new ApplicantMaster;
                        $user->email_id = $request->email;
                        $user->email_verified = 'Y';
                        $user->registered_type = 'W';
                        $user->registered_on = Carbon::now()->format('d/m/Y');
                        $user->save();

                        return response()->json([
                            'message' => 'Success! OTP successfully verified!'
                        ], 200);
                    } 

                } 

                return response()->json([
                    'message' => 'OTP is incorrect!'
                ], 404);

            } else if($action == 'personal-detail'){

                $user = User::updateOrCreate(
                    ['email' =>  $request->email],
                    [
                        'applicant_name' => $request->name,
                        'mobile_number' => $request->mobile_number,
                        'whats_app' => $request->whats_app,
                    ]
                );

                return response()->json([
                    'message' => 'Success! Personal details saved!'
                ], 200);



            }

            
        }

    }

    public function skillsData(Request $request)
    {   
        $skills = SkillGroupMaster::select('sgm_id','group_name','image')->get();
        
        return response()->json([
            'skills' => $skills,
        ], 200);
    }

    public function countryData(Request $request)
    {   
        $countries = CountryMaster::select('country_id','country_name','nationality')->get();
        
        return response()->json([
            'countries' => $countries,
        ], 200);
    }

    public function cityData(Request $request)
    {   
        $cities = CityMaster::where('country_id',$request->country_id)->select('city_id','city_name','country_id')->get();
        
        return response()->json([
            'cities' => $cities,
        ], 200);
    }

    public function townData(Request $request)
    {   
        $towns = TownMaster::where('city_id',$request->city_id)->select('town_id','town_name','city_id')->get();
        
        return response()->json([
            'towns' => $towns,
        ], 200);
    }
}
