<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Modules\User\Models\User ;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Facades\Mail ;
use Modules\User\Models\VerificationCode ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth ;

class AuthController extends Controller
{
 
    public function sendCode(Request $request)
    {
        $request->validate([

            'email' => 'required|email|unique:users,email' ,    

        ]);

        VerificationCode::where('email' , $request->email)->where('purpose' , 'register')->delete() ;
        $plainCode = (string) random_int(100000 , 999999) ;

        VerificationCode::create([

                'email' => $request->email ,
                'code' => $plainCode ,
                'expire_at' => now()->addMinutes(20) ,
                'purpose' => 'register' ,

        ]);

        Mail::raw("your verify code is : {$plainCode} "  , function($message) use($request){

                $message->to($request->email) ;
                $message->subject('send verify code') ;

        });

        return response()->json([

            'message' => 'verifiction code sent successfuly' . $plainCode ] , 200);

    }


    public function veriifyCode(Request $request)
    {

            $request->validate([

                "name" => "required" ,
                "email" => "required|email|unique:users" ,
                "password" => "required|min:5|confirmed" ,
                "role_id" => "required|exists:roles,id",
                'code' => 'required|digits:6'

            ]);

            $verification = VerificationCode::where('email' , $request->email)->where('purpose' , 'register')
            ->latest()->first() ;

            if (!$verification) {

                return response()->json([

                 'message' => 'verification code not found' ,

                ],422 );

            }

            if ($verification-> expire_at->isPast()) {

                return response()->json([

                    'message' => 'your code expire' ,

                ], ) ;

            }

            if ($request->code !== $verification->code) {

                return response()->json([

                        'message' => 'your code invalid'

                ] );
            }

            $verifiToken = Str::random(64);

            $verification->update([

                'verify_at' => now() ,
                'verify_token' => hash('sha256', $verifiToken),

            ]);


        $user = User::create([

            "name" => $request->name ,
            "email" => $request->email ,
            "password" => Hash::make($request->password) ,
            "role_id" => $request->role_id ,
            "email_verify" => now()


        ]);

        $token = $user->createToken('my-app-token')->plainTextToken;


        $response = [
            
            'message' => 'User registered successfully',
            'user' => $user ,
            'token' => $token

        ];


        return response()->json($response , 201);


    }

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email|exists:users,email' ,
            'password' => 'required|min:6'


        ]);

        $user = User::where('email' , $request->email)->first() ;

        if (!$user || !Hash::check( $request->password , $user->password )) {
                
                return response()->json([

                            'message' => 'your email or password invalid'
                ]);

        }

        $token = $user->createToken('my-app-token')->plainTextToken;
                
        return response()->json([

                           'message' => 'user login' ,
                           'user' => $user ,
                           'token' => $token
                ] );        
        
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
                           
            'message' => 'user logout successfuly' ,
           


        ]) ;
    }


}



