<?php

namespace App\Listeners;

use App\Events\SendOtpOnLoginEvent;
use App\Mail\SendLoginOtpMail;
use App\Models\Otp;
use App\Traits\SendExternalApiTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOtpOnLoginNotification implements ShouldQueue
{
    use InteractsWithQueue, SendExternalApiTrait;

    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(SendOtpOnLoginEvent $event): void
    {
        $random_char = str_shuffle("0123456789");
        $otp = substr($random_char, 0, 6);
        Otp::create([
            'otp' => $otp,
            'type' => 'login',
            'user_id' => $event->user->id,
        ]);
        $data['name'] = $event->user->name;
        $data['otp'] = $otp;

        $mobile = $event->user->mobile;
        $postData = array(
            "template_id" => "6634c73ad6fc0515e35377a3",
            "short_url" => "0",
            "recipients" => [
                [
                    "mobiles" => "91$mobile",
                    "var1" => "$otp",
                ]
            ]
        );

        //$this->sendSms($postData);
        Mail::to($event->user->email)->send(new SendLoginOtpMail($data));
    }
}
