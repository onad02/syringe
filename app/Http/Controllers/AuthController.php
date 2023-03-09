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

        $user = ApplicantMaster::firstOrNew(['email_id' =>  $request->email]);
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