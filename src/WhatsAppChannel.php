<?php

namespace NotificationChannels\WhatsApp;

use NotificationChannels\WhatsApp\Exceptions\CouldNotSendNotification;
use NotificationChannels\WhatsApp\WhatsAppMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Events\Dispatcher;

class WhatsAppChannel
{
    /** @var WhatsApp */
    private $wa;

    /**
     * WhatsAppChannel constructor.
     */
    public function __construct(WhatsApp $wa)
    {
        $this->wa = $wa;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\WhatsApp\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $phone = $notifiable->routeNotificationFor('whatsapp', $notification);

        if (empty($phone)) {
            return false;
        }

        // Get the message from the notification class
        $whatsAppMessage = $notification->toWhatsApp($notifiable);
        
        if (! $whatsAppMessage instanceof WhatsAppMessage) {
            throw CouldNotSendNotification::invalidMessage();
        }
        
        // TODO: Need to validate and sanitise the phone numbers provided
        $whatsAppMessage->setTo("918072254450");

        $response = null;

        try {
            $response = $response = $this->wa->send($whatsAppMessage->toArray());
        } catch (MessagingException $exception) {
            $this->failedNotification($notifiable, $notification, $exception);
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }

        return $response;
    }
}
