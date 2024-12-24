<?php

namespace App\Service;

use Telegram\Bot\Api;

class Telegram
{
    protected $telegram;

    public function __construct($token)
    {
        $this->telegram = new Api($token);
    }

    public function send($message): int
    {
        if (!$this->telegram instanceof Api) {
            throw new \Exception('Telegram API is not initialized correctly.');
        }

        $response = $this->telegram->sendMessage([
            'chat_id' => 648211202,
            'text' => $message
        ]);

        $messageId = $response->getMessageId();

        return $messageId;
    }
}