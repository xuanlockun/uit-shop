<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;



class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // tu tu cap nhat
    }


    public function boot(): void
    {
        
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')->view('emails.verify', ['url' => $url])->action('Verify Email Address', $url);
        });
    }
}
