<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();
        
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(
               $user instanceof User && $user->hasPermissionTo('dashboard')
                    ? route('admin.dashboard')
                    : route('index')
            );
    }

}