<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApplicantMaster;
use App\Models\SkillGroupMaster;
use App\Models\CountryMaster;
use App\Models\CityMaster;
use App\Models\TownMaster;
use Carbon\Carbon;
use Session;
use Hash;
  
class AuthController extends Controller
{

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (auth()->guard('applicant')->attempt(['email_id' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Successfully loggedin!'
            ], 200);
        }

        return response()->json([
            'message' => 'Oppes! You have entered invalid credentials'
        ], 500);

    }
      

    public function postRegistration(Request $request)
    {  

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

        $user = ApplicantMaster::firstOrNew(['email_id' =>  $request->email]);
        $user->applicant_name = $request->name;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->mobile_number = $request->mobile_number;
        $user->whats_app = $request->whats_app;
        $user->country_id = $country_id;
        $user->city_id = $city_id;
        $user->town_id = $town_id;
        $user->nationality = $request->nationality;
        $user->passport = $request->passport;
        $user->dob = $request->birth_date;
        $user->sgm_id = $request->skill;
        $user->save();

        auth()->guard('applicant')->login($user);

        return response()->json([
            'message' => 'Successfully registered!'
        ], 200);
    }
    

    public function postLogout() {
        Session::flush();
        Auth::logout();
        return response()->json([
            'message' => 'Successfully loggedout!'
        ], 200);
    }
}