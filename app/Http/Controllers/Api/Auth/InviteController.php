<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InviteController extends BaseController
{
    public function invitation(Request $request){
        $inputs = $request->all();
        $validator = Validator::make($inputs,['email' => 'required|email']);

        if ($validator->fails()) {
            return returnResponse($validator->errors()->first(),[],422);
        }

        $email = $inputs['email'];
        $invites = Invite::where('email',$email)->first();

        if (!$invites) {
            Invite::create(['email' => $email]);
        }else{
            return $this->sendError('Invitation to this email was already send!',401);
        }

        $invitation = config('constants.local') . '/signup';

        $user = Auth::user();

        Mail::send('auth.emails.inviteReceivedEmail', ['invitation' => $invitation, 'name' => $user->name], function ($mail) use ($email) {
            $mail->to($email)->subject('');
        });

        return response()->json(['message' => 'We will send  an invitation to ' . $email . ' Check your email.']);

    }
}
