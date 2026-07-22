<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TraceIdMiddleware
{
    public function handle($request, Closure $next)
    {
        $traceId = (string) Str::uuid();

        $request->attributes->set('trace_id', $traceId);

        Log::withContext([
            'trace_id' => $traceId,
        ]);

        return $next($request);
    }
}
