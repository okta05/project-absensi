<?php


namespace App\Helpers;

use GuzzleHttp\Client;

class TelegramHelper
{
    public static function sendMessage($chatId, $message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";
        
        $client = new Client();
        $response = $client->post($url, [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        ]);

        return $response->getStatusCode() == 200;
    }
}
