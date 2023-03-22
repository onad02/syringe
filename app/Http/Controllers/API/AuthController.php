<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Laravel\Socialite\Facades\Socialite;
use App\Models\ApplicantMaster;
use App\Models\SkillGroupMaster;
use App\Models\SkillMaster;
use App\Models\ImmigrationStatus;
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
                //send otp
                $otp = mt_rand(1000,9999);;
                Cache::put($request->email, $otp, now()->addMinutes(10));

                Mail::to($request->email)->send(new EmailVerification($otp));

                 return response()->json([
                    'message' => 'Success! OTP successfully sent!'
                ], 200);

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

            } else if($action == 'check-email'){

                //lets check first if email already exist
                $user = ApplicantMaster::where('email_id',$request->email)->first();
                if($user){

                    //login user
                    return response()->json([
                        'user_found' => true
                    ], 200);

                } else {

                    return response()->json([
                        'user_found' => false
                    ], 200);
                }

            } else if($action == 'user-information'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'applicant_name' => $request->name,
                        'gender' => $request->gender,
                        'dob' => $request->birth_date,
                        'email_verified' => 'Y',
                        'registered_on' =>  Carbon::now()->format('d/m/Y'),
                        'registered_type' => ucfirst(substr($request->provider,0,1))
                    ]
                );

                if($request->hasFile('avatar')){
                    $avatar = $request->file('avatar');
                    $f_name = $avatar->getClientOriginalName();
                    $file_size = $avatar->getSize();
                    $file_extension = $avatar->getClientOriginalExtension();
                    $newfilename = md5($user->applicant_id."_".round(microtime(true))) . '.'.$file_extension;
                    $avatar->move(public_path('images/applicant/'), $newfilename);

                    if(!empty($user->image) && ($user->registered_type == 'M' || $user->registered_type == 'W')){
                        unlink(public_path('images/applicant/').$user->image);
                    }
                    $user->image = $newfilename;
                    $user->save();
                } else if($request->has('avatar')){
                    $newfilename = md5($user->applicant_id."_".round(microtime(true))) . '.jpg';
                    $image = file_get_contents($request->avatar);
                    file_put_contents(public_path('images/applicant/'.$newfilename), $image);
                    $user->image = $newfilename;
                    $user->save();
                }

                return response()->json([
                    'message' => 'Success! User Information saved!'
                ], 200);

            } else if($action == 'personal-details'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'applicant_name' => $request->name,
                        'gender' => $request->gender,
                        'dob' => $request->birth_date,
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

            } else if($action == 'skill'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'sgm_id' => $request->skill
                    ]
                );

                $specializations = SkillMaster::where('sgm_id',$request->skill)->select('skills_id','skills_name','image')->get();

                return response()->json([
                    'specializations' => $specializations
                ], 200);

            } else if($action == 'specialization'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'skills_id' => $request->specialization
                    ]
                );

                return response()->json([
                    'message' => 'Success! Specialization saved!',
                    'immigration_status' => ImmigrationStatus::get()
                ], 200);

            } else if($action == 'working-status'){

                $user = ApplicantMaster::updateOrCreate(
                    ['email_id' =>  $request->email],
                    [
                        'immigration_id' => $request->immigration_id
                    ]
                );

                auth()->guard('applicant')->login($user);
                            
                return response()->json([
                    'message' => 'Success! Working status saved!',
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

    public function socialLogin(Request $request, $provider)
    {
        try {
          
            $auth = Socialite::driver($provider)->stateless()->user();
            $email = $auth->getEmail();

            $applicantExists = ApplicantMaster::where('email_id', $email)->where('registered_type',ucfirst(substr($provider,0,1)))->first();
            if($applicantExists && $applicantExists->sgm_id != NULL){
                
                auth()->guard('applicant')->login($applicantExists);
                        
                return response()->json([
                    'account_exists' => true
                ], 200);

            } else {

                return response()->json([
                    'account_exists' => false,
                    'provider' => $provider,
                    'token' => $auth->token,
                    'name' => $auth->name,
                    'email' => $email,
                    'avatar' => $provider == 'facebook' ? $auth->getAvatar().'&access_token='.$auth->token : $auth->getAvatar(),
                ]);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Oppes! Something went wrong!'
            ], 500);

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
