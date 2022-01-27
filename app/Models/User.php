<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'google_id',
        'facebook_id',
        'twitter_id',
        'oauth_type',
        'name',
        'last_name',
        'email',
        'password',
        'account_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function contact(){
        return $this->hasOne(Contact::class);
    }
    public function api_token(){
        return $this->hasOne(ApiToken::class);
    }

    public function watchlist(){
        return $this->belongsToMany(
            Property::class,
            'properties_users',
            'user_id',
            'property_id');
    }


    public function properties(){
        return $this->belongsToMany(
            Property::class,
            'properties_users',
            'user_id',
            'property_id');
    }


    public function create_api_token($user){
        $api_token = $user->api_token;
        if(!$api_token) $api_token = ApiToken::create(['user_id' => $user->id]);
        $api_token->api_token = $this->createToken($user->id);
        $date  = new \DateTime();
        $api_token->api_token_expires = $date->modify('+30 day');
        $api_token->save();

        return $api_token->api_token;
    }
    public function createToken($Id): string
    {
        return  md5(time() . $Id);
    }

    public function logout()
    {
        $now = date('Y-m-d H:i:s');
        ApiToken::where([
            ['user_id', '=', $this->id],
            ['api_token_expires', '>', $now]
        ])->update([
            'api_token_expires' => $now
        ]);
    }

    public function notifications()
    {
        return $this->hasOne(Notification::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invite::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
