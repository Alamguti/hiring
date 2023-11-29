<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function logout()
    {
        
        Auth::guard('user')->logout();
        
        return redirect('/'); // Redirige a la página principal o a donde desees después del cierre de sesión.
    }
}
