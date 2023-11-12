<?php
namespace App\Http\Controllers;

use App\Services\UserAuth;
use App\Services\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user_registration = null;
    protected $user_auth = null;

    public function __construct()
    {
        $this->user_registration = new UserRegistration();
        $this->user_auth = new UserAuth();
    }
    public function register(Request $request)
    {
        $user = $this->user_registration->register($request->all(), $request->file('avatar'));
        return response($user, 200);
    }

    public function login(Request $request)
    {
        $user = $this->user_auth->auth($request->all());
        $token = $user->createToken('app-token')->accessToken;

        return response(['user'=>$user,'token'=>$token], 200);
    }
}
