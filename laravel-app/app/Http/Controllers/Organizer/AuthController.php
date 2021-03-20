<?php

namespace App\Http\Controllers\Organizer;

use App\Organizer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\OrganizerAuthLoginRequest;
use App\Traits\Api\Response\ResponseHandler;

class AuthController extends Controller
{
    use ResponseHandler;
    public function login(OrganizerAuthLoginRequest $request)
    {
        $user = Organizer::where('email' , $request->email )->first();
        if(Hash::check( $request->password , $user->password ?? '' ))
        {
            $user->token =  $user->createToken($user->email . ' Access Token')->accessToken;
            return $this->responseData(new UserResource($user) , 'Logged In Successfully');
        }
        return $this->responseError('Invalid Email OR Password');
    }
}
