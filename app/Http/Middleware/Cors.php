<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
         $response = $next($request);

         $headers = [

                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type'


         ];

         if($request->getMethod() === 'OPTIONS') {

            return response(null, 200, $headers);
         }

         foreach($headers as $key=> $value) {

            $response->header($key, $value);
         }

         return $response;
    }
}
