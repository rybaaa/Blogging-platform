<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class DebugMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $result = $next($request);
        if($result instanceof JsonResponse){            
            $responseData = $result->getData(true);

            $execution_time_milliseconds = (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000;
            $responseData['debug-info'] = ['execution-time-milliseconds'=>$execution_time_milliseconds, 
                                            'requested-get-parameters'=>$request->query->all(),
                                            'requested-post-body'=>$request->request->all()
        ];
            $result->setData($responseData);
        }

        return $result;
    }
}
