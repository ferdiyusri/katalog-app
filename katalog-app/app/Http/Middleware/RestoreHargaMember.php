<?php

namespace App\Http\Middleware;

use App\Models\PriceRegistration;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestoreHargaMember
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('harga_member') && $request->cookie('harga_member_email')) {
            $email = $request->cookie('harga_member_email');
            $member = PriceRegistration::where('email', $email)->first();

            if ($member) {
                session(['harga_member' => [
                    'nama'   => $member->nama,
                    'email'  => $member->email,
                    'telpon' => $member->telpon,
                ]]);
            }
        }

        return $next($request);
    }
}
