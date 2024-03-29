<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;

class Authenticate implements AuthenticatesRequests
{

    protected $auth;
    protected  $guard;


    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }


    protected function authenticate($request, array $guards)
    {


        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            $this->guard = $guard;
            if ($this->auth->guard($guard)->check()) {

                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }


    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }


    protected function redirectTo($request)
    {

        if(!$request->expectsJson()){
            return route('not_authorized');
        }

    }
    /*   protected function redirectTo($request)
       {
           if (! $request->expectsJson()) {
               return route('login');
           }


       }*/
}
