<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache as FacadesCache;
use Illuminate\Contracts\Auth\Guard;

class AdminActivity
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // dd(auth('admin')->user());

    //   dd(Auth::guard('admin')->user());
        if (Auth::guard('admin')->check()) {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            FacadesCache::put('user-is-online-' . auth()->user('admin')->id, true, $expiresAt);

            /* last seen */
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['last_seen' => now()]);
        }
        return $next($request);
    }
}
