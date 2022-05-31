<?php

namespace App\NotificationChannels\WhatsApp\Resources;

interface Resource
{
    /**
     * @return array
     */
    public function toArray(): array;
}
