<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    
    public function login(Request $request){
        
        try{
            
            $validator = Validator::make($request->json()->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()]);
            }
            
            $creds = $request->json()->all();
            if(!$token = auth()->setTTL(7200)->attempt($creds)){
                $error=[];
                $error['msg']='invalid credential';
                return response()->json(['errors' => $error]);
            }
           
        }catch(JWTException $e){
                return response()->json(['errors' => $e->getMessage(), $e->getStatusCode()]);
        }catch(Exception $e){
             return response()->json(['errors' => $e]);
        }

       
        
        return response()->json(['token' => $token]);
    }
    public function register(Request $request){

        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'user_type' => 'required'
                ]);
             
            $user = User::create([
                'name' => $request->json()->get('name'),
                'email' => $request->json()->get('email'),
                'password' => Hash::make($request->json()->get('password')),
                'user_type' => $request->json()->get('user_type')
        ]);
            $token = auth()->attempt($request->all());
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    
        return response()->json([
             'token' => $token,
              'msg' => 'Registered successfully'
            ]);
    }
    public function me(Request $request){
        if($request->header('Authorization')){
            $user = $this->isAuth();
        }
        return response()->json([ 'user' => $user]);
    }
    public function refresh(){
        return response()->json(auth()->refresh());
    }
    
   
}

