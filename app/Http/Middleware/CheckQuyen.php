<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckQuyen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'message' => 'Bạn phải đăng nhập để truy cập trang này.'
            ]);
        }

        $userRole = Auth::user()->idQuyen;
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request);
            }
        }
        if (Auth::check()){
            return redirect()->route('user')->withErrors([
                'message' => 'Bạn không có quyền truy cập vào trang này.'
            ]);
        }
        else{
            return redirect()->route('home')->withErrors([
                'message' => 'Bạn không có quyền truy cập vào trang này.'
            ]);
        }
        return $next($request);
    }
}
