<?php

namespace App\Providers;

use App\Models\AdminLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Event::listen(Login::class, function (Login $event) {
            AdminLog::create([
                'admin'  => $event->user->email,
                'aksi'   => 'Login',
                'detail' => 'Berhasil masuk ke panel admin',
                'ip'     => Request::ip(),
            ]);
        });

        Event::listen(Logout::class, function (Logout $event) {
            AdminLog::create([
                'admin'  => $event->user?->email ?? '-',
                'aksi'   => 'Logout',
                'detail' => 'Keluar dari panel admin',
                'ip'     => Request::ip(),
            ]);
        });
    }
}
