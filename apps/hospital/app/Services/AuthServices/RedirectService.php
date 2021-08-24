<?php

namespace App\Services\AuthServices;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class RedirectService
{
    public function toDashboard($user): ?RedirectResponse
    {
        switch ($user->role_id) {
            case config('roles.receptionist'):
                return redirect()->route('receptionist-dashboard');
            case config('roles.doctor'):
                return redirect()->route('doctor-dashboard');
            default:
                Log::channel('hospital')->alert('Role id mismatch in toDashboard()');
                return null;
        }
    }

    public function dashboardName($user): ?string
    {
        switch ($user->role_id) {
            case config('roles.receptionist'):
                return 'receptionist-dashboard';
            case config('roles.doctor'):
                return 'doctor-dashboard';
            default:
                Log::channel('hospital')->alert('Role id mismatch in dashboardName()');
                return null;
        }
    }
}
