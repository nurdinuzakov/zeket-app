<?php

namespace App\Providers;

use App\Models\ApiToken;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('member_access_token', function ($request){
            $token = ApiToken::where('api_token',$request->bearerToken())->first();
            if(!$token || $token->api_token_expires < date('Y-m-d H:i:s')){
                return null;
            }

            return $token->user;
        });

    }
}
