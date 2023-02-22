<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller{

    public function register(Request $request){
        // print_r($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:191',
            'name' => 'required|max:191',
            'password' => 'required|min:8|max:25',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return $this->response();
        }

        $user = User::create([            
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);
        // $this->send_email_verification_email($user);
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $this->data['token'] = $token;
        $this->data['user'] = $user;
        return $this->response();

       

    }
    
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }   

    

}
