<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Toastr;
use Alert;

class checkLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('loyal_customer')->check()) {
            return redirect('/login');
            toast('Vui lòng đăng nhập để tiếp tục','info');
        }
        return $next($request);
    }
}
