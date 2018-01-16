<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class SilenceWp404s
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		global $wp_query;
		$wp_query->is_404=false;
		return $next($request);
    }

	public function terminate($request, $response)
	{
		return $response;
	}
}
