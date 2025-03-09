<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    protected $domains = [
        "http://localhost:5173/api/user",
        'http://localhost:5173/login/admin',
        'http://serverC.ru',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // проверим, присутствует ли заголовок HTTP_ORIGIN в запросе
        // и разрешен ли домен
        $origin = $request->headers->get('Origin');
        if(!$origin || !in_array($origin, $this->domains, true)) {
            return new Response('Forbidden', 403);
        }
        //если есть, то устанавливаем нужные заголовки
        return $next($request)
        ->header('Access-Control-Allow-Origin', $origin)
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
        ->header('Access-Control-Allow-Credentials', 'true')
        ->header(
            'Access-Control-Allow-Headers',
            'Authorization, Origin, X-Requested-With, Accept, X-PINGOTHER, Content-Type'
        );
    }
}
