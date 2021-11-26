<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class USerController extends Controller
{
    //
    public function index(Request $request)

    {
        // return 'hi';
        $user=User::where('email',$request->email)->first();
        
        if(!$user || !Hash::check($request->password,$user->password))
        {
            return response([
                "message"=>['these credidentials do not match our record.']
            ],404);
            
        }
            $token=$user->createToken('my-app-token')->plainTextToken;

            $response=[
                'user'=>$user,
                'token'=>$token
            ];
            return response( $response,201);

        
    }
}
