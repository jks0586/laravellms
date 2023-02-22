<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {

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
        $token = $user->createToken(microtime())->accessToken;
        $this->data['token'] = $token;
        $this->data['user'] = $user;
        return $this->response();
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return $this->response();
        }
        
        $credentials = $request->only('email', 'password');
        $auth = Auth::attempt($credentials);

        if (!$auth) {
            $this->message = __('auth.login.errors.failed');
            return $this->response(false);
        }

        $user = Auth::user();
        $token = $user->createToken(microtime())->accessToken;
        $this->data['user'] = $user;
        $this->data['token'] = $token;
        return $this->response();
    }   
}