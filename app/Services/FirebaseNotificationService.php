<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationService {
    protected $firebase;
    protected $messaging;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(config('services.firebase.credentials.file'));
        $this->messaging = $this->firebase->createMessaging();
    }

    public function sendNotification($token, $title, $body)
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $token)
            ->withNotification($notification);

        $this->messaging->send($message);
    }
}
