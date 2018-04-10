<?php
# File: app\Http\Middleware\CORS.php
# Create file with below code in above location. And at the end of the file there are other instructions also.
# Please check.

namespace App\Http\Middleware;

use Closure;

class CORS
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
        if ($request->getMethod() == "OPTIONS") {
            return response(['OK'], 200)->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Allow-Headers' => 'Authorization, Content-Type',
            ]);
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
            ->header('Access-Control-Allow-Credentials', true)
            ->header('Access-Control-Allow-Headers', 'Authorization,Content-Type');
    }
}
