<?php

namespace App\Listeners;

use App\Events\UsuarioRegistrado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UsuarioRegistrado $event): void
    {
        //
        Mail::to($event->user->email)->send(new \App\Mail\CorreoDeBienvenida($event->user));
    }
}
