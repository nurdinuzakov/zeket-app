<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessToken extends Model
{
    use HasFactory;

    protected $table = 'access_tokens';

    protected $guarded = ['id'];

    public function contact() : BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function createAccessToken($contactID): self
    {
        $code  = random_int(100000, 999999);
        $date  = new \DateTime();
        $token = AccessToken::create([
            'contact_id'       => $contactID,
            'access_token'  => $this->createToken($contactID),
            'access_code'   => $code,
            'code_expires'  => $date->modify('+5 minutes'),
            'code_used' => false,

        ]);



        return $token;
    }

    public function createToken($Id): string
    {
        return  md5(time() . $Id);
    }

    public function validateAccessTokenAndCode($token, $code)
    {
        $accessToken = AccessToken::where(['access_token' => $token, 'access_code' => $code])->first();

        if (!$accessToken) {
            return ['isSuccess' => false, 'response' => 'Code is not valid'];
        }

        if ($accessToken->code_used == true) {
            return ['isSuccess' => false, 'response' => 'Code already has been used'];
        }

        if ($accessToken->code_expires < date('Y-m-d H:i:s')) {
            return ['isSuccess' => false, 'response' => 'Code expired'];
        }

        $contact = Contact::find($accessToken->contact_id);
        $accessToken->code_used = true;
        $accessToken->save();

        if (!$contact) {
            return ['isSuccess' => false, 'response' => 'Contact not found'];
        }

        return ['isSuccess' => true, 'contact' => $contact];
    }

}
