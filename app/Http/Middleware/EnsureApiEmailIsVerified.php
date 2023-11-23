<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Closure;

class EnsureApiEmailIsVerified
{
    public function handle($request, Closure $next)
    {
        if (!@$request->user()->email_verify_at) {
            return ResponseHelper::error(__("email-not-verified"), null, 403);
        }

        return $next($request);
    }
}
