<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use App\Models\requestmodel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequestEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $mahasiswa_id = Mahasiswa::where('user_id', Auth::id())->pluck('id')->first();

            if ($mahasiswa_id && requestmodel::where('mahasiswa_id', $mahasiswa_id)->exists()) {
                return $next($request);
            }
        }

        return abort(403, 'Unauthorized access');
    }
}
