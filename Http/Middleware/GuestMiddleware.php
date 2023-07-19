<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Modules\User\Contracts\Authentication;

class GuestMiddleware
{
    /**
     * @var Authentication
     */
    private $auth;

    public function __construct()
    {
//        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->auth->check()) {
            return redirect()->route(config('modules.user.config.redirect_route_after_login'));
        }

        return $next($request);
    }
}
