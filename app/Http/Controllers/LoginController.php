<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
     public function loginUser(Request $request)
    {
        try {
          
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid Credentials',
                ]);
            }

            $code = rand(100000, 999999);
            $updateResult = $user->update([
                'otp_code' => $code,
            ]);

            
        //    Http::asForm()->post('https://api.semaphore.co/api/v4/messages', [
        //    'apikey' => env('SMS_API_KEY'),
        //    'number' => '09950097282', 
        //    'message' => 'This is your OTP Code: ' . $code,
        //    ]);

        Mail::to($user->email)->send(new NewUserMail());
        
            if ($updateResult) {
                return response()->json([
                    'status' => true,
                    'message' => 'OTP sent successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to send OTP',
                ], 500); 
            }

           
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            $validateOTP = Validator::make($request->all(), [
                'otp_code' => 'required|digits:6' 
            ]);
    
            if($validateOTP->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateOTP->errors()
                ], 401);
            }
    
            // Check if the OTP code matches with the user's stored OTP code
            $user = User::where('otp_code', $request->otp_code)->first();
    
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP',
                ], 401);
            }
    
            // Clear the OTP code after successful verification
            $user->update(['otp_code' => null]);
    
            return response()->json([
                'status' => true,
                'message' => 'OTP Verified Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function dashboard()
    {
        return view("dashboard");
    }

    public function welcome()
    {
        return view("welcome");
    }
    public function home()
    {
        return view("home");
    }
}

    