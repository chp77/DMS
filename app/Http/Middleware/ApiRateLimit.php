<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;

class ApiRateLimit extends ThrottleRequests
{
    protected $defaultLimit = 60000; // Requests per minute
    protected $defaultKey = 'api';

    public function handle($request, Closure $next, $limit = 500000, $key = 'api')
    {
        return parent::handle($request, $next, $limit, $key);
    }
}
