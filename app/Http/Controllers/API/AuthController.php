<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Laravel\Socialite\Facades\Socialite;
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

    public function login(Request $request)
    {
        if($request->has('action')){

            $user = ApplicantMaster::where('email_id',$request->email)->first();
            if($user){

                if($request->action == 'login-password'){

                    if (auth()->guard('applicant')->attempt(['email_id' => $request->email, 'password' => $request->password])) {
                        return response()->json([
                            'success' => 'Successfully loggedin!'
                        ], 200);
                    }

                    return response()->json([
                        'message' => 'Error! Incorrect password!'
                    ], 500);

                } else if($request->action == 'login-otp'){

                    if (Cache::has($request->email)) {

                        $otp = Cache::get($request->email);
                        if($otp == $request->otp){

                            auth()->guard('applicant')->login($user);
                            
                            return response()->json([
                                'success' => 'Successfully loggedin!'
                            ], 200);
                        }

                        return response()->json([
                            'message' => 'Error! Incorrect OTP!'
                        ], 500);
                    }

                } else if($request->action == 'send-login-otp'){
                    //send otp
                    $otp = mt_rand(1000,9999);
                    Cache::put($request->email, $otp, now()->addMinutes(10));

                    Mail::to($request->email)->send(new EmailVerification($otp));

                    return response()->json([
                        'message' => 'Success! OTP successfully sent!'
                    ], 200);
  
                } 
            }
        }
    }

    public function register(Request $request)
    {   
        if($request->has('action')){

            $action = $request->action;
            if($action == 'send-otp'){

                //lets check first if email already exist
                $user = ApplicantMaster::where('email_id',$request->email)->first();
                if($user){

                    //login user
                    return response()->json([
                        'user_found' => true
                    ], 200);

                } else {

                    //send otp
                    $otp = mt_rand(1000,9999);;
                    Cache::put($request->email, $otp, now()->addMinutes(10));

                    Mail::to($request->email)->send(new EmailVerification($otp));

                    return response()->json([
                        'user_found' => false
                    ], 200);
                }
            } else if($action == 'verify-otp'){

                if (Cache::has($request->email)) {

                    $otp = Cache::get($request->email);
                    if($otp == $request->otp){

                        $user = ApplicantMaster::updateOrCreate(
                            ['email_id' =>  $request->email],
                            [
                                'email_verified' => 'Y',
                                'registered_type' => 'W',
                                'registered_on' =>  Carbon::now()->format('d/m/Y')
                            ]
                        );

                        return response()->json([
                            'message' => 'Success! OTP successfully verified!'
                        ], 200);
                    } 

                } 

                return response()->json([
                    'message' => 'OTP is incorrect!'
                ], 404);

            } else if($action == 'personal-details'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'applicant_name' => $request->name,
                        'gender' => $request->gender,
                        'mobile_number' => $request->mobile_number,
                        'whats_app' => $request->whats_app,
                    ]
                );

                return response()->json([
                    'message' => 'Success! Personal details saved!'
                ], 200);

            } else if($action == 'additional-security'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'password' => bcrypt($request->password)
                    ]
                );

                return response()->json([
                    'message' => 'Success! Password saved!'
                ], 200);

            } else if($action == 'location'){

                if(!isset($request->country['country_id'])){
                    $country = CountryMaster::create(
                        [
                            'user_id' => 1,
                            'country_name' => ucwords($country),
                            'date_added' => Carbon::now()->toDateString(),
                            'active' => 'Y'
                        ]
                    );
                } 
                $country_id = $country->country_id ?? $request->country['country_id'];

                if(!isset($request->city['city_id'])){
                    $city = new CityMaster;
                    $city->user_id = 1;
                    $city->city_name = ucwords($request->city);
                    $city->country_id = $country_id;
                    $city->date_added = Carbon::now()->toDateString();
                    $city->active = 'Y';
                    $city->save();
                }
                $city_id = $request->city['city_id'] ?? $city->city_id;

                if(!isset($request->town['town_id'])){
                    $town = new TownMaster;
                    $town->user_id = 1;
                    $town->town_name = ucwords($request->town);
                    $town->city_id = $city_id;
                    $town->date_added = Carbon::now()->toDateString();
                    $town->save();
                }
                $town_id = $town->town_id ?? $request->town['town_id'];


                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'country_id' => $country_id,
                        'city_id' => $city_id,
                        'town_id' => $town_id,
                    ]
                );

                return response()->json([
                    'message' => 'Success! Location saved!'
                ], 200);

            } else if($action == 'additional-info'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'nationality' => $request->nationality,
                        'passport' => $request->passport,
                        'dob' => $request->birth_date,
                        'whats_app' => $request->whats_app,
                    ]
                );

                return response()->json([
                    'message' => 'Success! Additional Info saved!'
                ], 200);

            } else if($action == 'skills'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'sgm_id' => $request->skill
                    ]
                );

                return response()->json([
                    'message' => 'Success! Skill saved!'
                ], 200);

            } 

            
        }

    }

    public function redirectToProvider($provider)
    {
        return response()->json([
            'target_url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ]);
    }


    public function handleProviderCallback($provider)
    {
        $auth = Socialite::driver($provider)->stateless()->user();
        $email = $auth->getEmail();
        
        if ($provider == 'google') {

            $applicantExists = ApplicantMaster::where('email_id', $email)->first();
            if($applicantExists && $applicantExists->email_verified == 'Y'){
                
                $applicantExists->token = $auth->token;
                $applicantExists->save();

                return response()->json([
                    'provider' => $provider,
                    'token' => $auth->token,
                ]);

            } else {

                return response()->json([
                    'provider' => $provider,
                    'token' => $auth->token,
                    'name' => $auth->name,
                    'email' => $email,
                    'avatar' => $auth->avatar_original,
                ]);
            }
        }
        

        return redirect('/');
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
