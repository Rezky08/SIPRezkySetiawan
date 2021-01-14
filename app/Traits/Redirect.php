<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;

/**
 *
 */
trait Redirect
{
    public function redirectByRole($role_name)
    {
        // redirect after check by role name
        switch (strtolower($role_name)) {
            case 'admin':
                return redirect(RouteServiceProvider::ADMIN_HOME);
                break;
            case 'user':
                return redirect(RouteServiceProvider::USER_HOME);
                break;

            default:
                return redirect(RouteServiceProvider::HOME);
                break;
        }
    }
}
