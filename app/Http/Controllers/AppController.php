<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public  function index()
    {
        $usuario = auth()->user();
        return view('app',['usuario' => $usuario]);
    }
}
