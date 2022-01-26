<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Models\AccessToken;
use App\Models\Contact;
use App\Models\User;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseController
{
    public function notAuthorized()
    {
        return  $this->sendError(['message' => 'not authorized'],401);
    }

    public function loginStore(Request $request){
        $inputs = $request->only('email','password');
        $validator = Validator::make($inputs,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()) return $this->sendError($validator->errors()->first(),422);

        $user = User::with('contact')->where('email',$inputs['email'])->first();
        if(!$user || !$user->contact->email_confirmed) return $this->sendError('email is not confirmed',422);

        if(!Hash::check($inputs['password'],$user->password)) return $this->sendError('email or password is not correct',422);


        $api_token = $this->user->create_api_token($user);

        return $this->sendSuccess('success',['access_token' => $api_token]);
    }

    public function sendCodeToEmail(Request $request){
        $email = $request->email;

        $validator = Validator::make(['email' => $email],[
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),422);
        }

        $config = config('app.invitation');

        if (!$config) {
            $checkEmail = Invite::where('email', $email)->first();

            if (!$checkEmail) {
                return $this->sendError("this email wasn't invited",422);
            }

            if ($checkEmail->invitation_used) {
                return $this->sendError("this invitation was used",422);
            }
        }

        $contact = Contact::where('email', $email)->first();

        if ($contact and $contact->email_confirmed) {
            return $this->sendError('this email is already exits',422);
        }

        if (!$contact) {
            $contact =  Contact::create(['email' => $email]);
        }

//        if($contact->email_time_limit > date('Y-m-d H:i:s')){
//            return $this->sendError('Code can be sent only once in 24 hours' ,422);
//        }

        $access_token = $this->accessToken->createAccessToken($contact->id);
        $date  = new \DateTime();
        $contact->email_time_limit = $date->modify('+1 day');
        $contact->save();

        Mail::send('auth.emails.confirmationCode', ['code' => $access_token->access_code], function ($mail) use ($email) {
            $mail->to($email)->subject('');
        });

        return $this->sendSuccess('We will send a code to ' . $email,['access_token' => $access_token->access_token]);

    }

    public function confirmEmail(Request $request){
        $inputs = $request->only('access_token', 'code');
        $validator = Validator::make($inputs,[
            'code' => 'required',
            'access_token' => 'required',
        ]);
        if($validator->fails()) return $this->sendError($validator->errors()->first(),422);

        $response = $this->accessToken->validateAccessTokenAndCode($inputs['access_token'], $inputs['code']);
        if(!$response['isSuccess']) return $this->sendError($response['response'],422);

        $contact = $response['contact'];
        $contact->email_confirmed = true;
        $contact->save();

        $access_token = $this->accessToken->createAccessToken($contact->id,$contact->email);

        return $this->sendSuccess('code confirmed',['email' => $contact->email, 'access_token' => $access_token->access_token]);
    }

    public function register(Request $request){

        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'name'             => 'required',
            'last_name'             => 'required',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required',
            'password_confirm' => 'required|same:password',
            'access_token' => 'required',
            'account_type' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),422);
        }

        $contact = Contact::where('email',$inputs['email'])->first();

        if (!$contact || !$contact->email_confirmed) {
            return  $this->sendError('email is not confirmed',422);
        }

        $access_token = AccessToken::where('access_token', $inputs['access_token'])->first();

        if (!$access_token ||$access_token->contact_id != $contact->id) {
            return $this->sendError('access_token is not valid',422);
        }

        if($contact->user && $contact->user->account_type) return $this->sendError('this email already registered',422);

        if(!$contact->user){
            $user = User::create([
                'name' => $inputs['name'],
                'last_name' => $inputs['last_name'],
                'email' => $inputs['email'],
                'password' => bcrypt($inputs['password']),
                'account_type' => $inputs['account_type']
            ]);
            $contact->user_id = $user->id;
            $contact->save();
        }

        $api_token = $this->user->create_api_token($user);

        $config = config('app.invitation');

        if (!$config) {
            $checkEmail = Invite::where('email', $inputs['email'])->first();
            $checkEmail->invitation_used = true;
            $checkEmail->save();
        }

        $email = $user->email;

        Mail::send('auth.emails.createdAccount', ['name' => $user->name], function ($mail) use ($email) {
            $mail->to($email)->subject('');
        });

        return $this->sendSuccess('success',['access_token' => $api_token]);
    }


    public function forgotPassword(Request $request){
        $email = $request->email;
        $validator = Validator::make(['email' => $email],[
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(),422);
        }

        $contact = Contact::where('email', $email)->first();

        if(!$contact or !$contact->email_confirmed) return $this->sendError('this email is not registered',422);



//        if($contact->email_time_limit > date('Y-m-d H:i:s')){
//            return $this->sendError('Code can be sent only once in hours' ,422);
//        }

        $access_token = $this->accessToken->createAccessToken($contact->id,$email);
        $date  = new \DateTime();
        $contact->email_time_limit = $date->modify('+1 day');
        $contact->save();

        Mail::send('auth.emails.confirmationCode', ['code' => $access_token->access_code], function ($mail) use ($email) {
            $mail->to($email)->subject('');
        });

        return $this->sendSuccess('We will send a code to ' . $email,['access_token' => $access_token->access_token]);

    }

    public function forgotPasswordConfirm(Request $request){
        $inputs = $request->all();

        $validator = Validator::make($inputs,[
            'code' => 'required',
            'access_token' => 'required',
        ]);
        if($validator->fails()) return $this->sendError($validator->errors()->first(),422);

        $result =  $this->accessToken->validateAccessTokenAndCode($request->access_token, $request->code);

        if (!$result['isSuccess']) {
            return $this->sendError($result['response'],422);
        }
        $contact = $result['contact'];
        $user = $contact->user;
        $token = $this->accessToken->createToken($user->id);
        $user->password_reset_token = $token;
        $user->save();

        return $this->sendSuccess( 'Code confirmed',['reset_token' => $user->password_reset_token]);

    }

    public function setNewPassword(Request $request){
        $inputs = $request->only('reset_token', 'password', 'password_confirm');

        $validator = Validator::make($inputs,[
            'reset_token' => 'required',
            'password'         => 'required',
            'password_confirm' => 'required|same:password',

        ]);

        if($validator->fails()) return $this->sendError($validator->errors()->first(),422);

        $user = User::where('password_reset_token', $inputs['reset_token'])->first();

        if(!$user) return $this->sendError('reset_token is not valid',422);


        $user->password = bcrypt($inputs['password']);
        $user->password_reset_token = null;
        $user->save();
        $api_token = $this->user->create_api_token($user);


        return $this->sendSuccess('success',['access_token' => $api_token]);
    }

    public function login()
    {
        return $this->sendError('not authorized',401);
    }


    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->logout();

        return $this->sendSuccess('success',['Successfully logged out!']);
    }

    public function googleCallback(Request $request)
    {
        try {
            /** @var \Laravel\Socialite\Two\User $user */
            $user   = Socialite::driver('google')->stateless()->user();

            $isUser = User::where('google_id', $user->id)->first();

            if ($isUser) {
                $api_token = $this->user->create_api_token($isUser);
            } else {
                $createUser = User::where('email', $user->email)->first();
                if ($createUser) {
                    $createUser->update([
                        'google_id' => $user->id,
                    ]);
                } else {
                    $createUser = User::create([
                        'name' => $user->name,
                        'last_name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt(time())
                    ]);
                }
                $api_token = $this->user->create_api_token($createUser);
            }
            return $this->sendSuccess('success',[
                'access_token' => $api_token
            ]);
        } catch (Exeption $exception) {
            return $this->sendError($exception->getMessage(),422);
        }
    }

    public function facebookCallback(Request $request)
    {
        try {
            /** @var \Laravel\Socialite\Two\User $user */
            $user   = Socialite::driver('facebook')->stateless()->user();

            $isUser = User::where('facebook_id', $user->id)->first();

            if ($isUser) {
                $api_token = $this->user->create_api_token($isUser);
            } else {
                $createUser = User::where('email', $user->email)->first();
                if ($createUser) {
                    $createUser->update([
                        'facebook_id' => $user->id,
                    ]);
                } else {
                    $createUser = User::create([
                        'name' => $user->name,
                        'last_name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->id,
                        'password' => encrypt(time())
                    ]);
                }
                $api_token = $this->user->create_api_token($createUser);
            }
            return $this->sendSuccess('success',[
                'access_token' => $api_token
            ]);
        } catch (Exeption $exception) {
            return $this->sendError($exception->getMessage(),422);
        }
    }
}

