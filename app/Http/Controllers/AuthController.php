<?php
namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;

use App\CustomResponse\EmailService;
use Illuminate\Http\Request;
use App\Notifications\EmailVerifyNotification;
use App\Http\Requests\LoginRequest;
use App\Notifications\LoginNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
//use Validator;

class AuthController extends Controller
{


    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            //'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }


    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
                // $user->notify(new EmailVerifyNotification());
               // $user->generate_code();
             //   EmailService::sendHtmlEmail($user->email,$user->code);
              //  $user->reset_code();
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    public function update(Request $request , User $user){
        //return $request;
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $user->id,
            'phone' => 'string',
            'address' => 'string'
        ]);
        $user->update($request->all());
        return response()->json([
            'message' => 'User successfully Updated',
        ], 201);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    //  public function refresh() {
    //      return $this->createNewToken(auth()->refresh());
    //  }


public function userProfile() {
    return response()->json(
         [
           'id' => auth()->user()->id,
           'name' => auth()->user()->name,
           'email' => auth()->user()->email,
           'phone' => auth()->user()->phone,
           'address' => auth()->user()->address,
           'image' => auth()->user()->image?asset(auth()->user()->image):null,
           'type' => auth()->user()->type,
           'code' => auth()->user()->code,
           'created_at' => auth()->user()->created_at,
           'updated_at' => auth()->user()->updated_at,
      ]
    );
}


     protected function createNewToken($token){
         return response()->json([
             'access_token' => $token,
             'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
             'user' => auth()->user()
         ]);
     }
}
