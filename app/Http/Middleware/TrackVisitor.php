<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        try {
            Visit::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'page' => $request->getPathInfo(),
                'visited_at' => now(),
            ]);
        } catch (\Throwable $exception) {
            // Fail silently on tracking so it does not break the site.
            report($exception);
        }

        return $next($request);
    }
}
