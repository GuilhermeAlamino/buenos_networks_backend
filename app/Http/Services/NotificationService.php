<?php

namespace App\Http\Services;

use App\Models\User;
use GuzzleHttp\Client;

class NotificationService
{
  public function sendNotification($title = null, $body = null, $device_token = null)
  {
    $url = 'https://fcm.googleapis.com/fcm/send';

    $FcmToken = User::where('device_token', $device_token)->first();

    $serverKey = 'AAAAS1oMc28:APA91bGhZaYeuzuDzsfLUJ_Ub84KQS6bB05hJo9qIhOyqxNZHH6QQA2efkSyJ_GUhjJP14w6YwsoAFy08aD12PzwtLUGipGBKtiIJmQMNgH8Zr3MzZMAutfdm_tEwuVd8gj2HB8kOBVq';

    $data = [
      "registration_ids" => [$FcmToken['device_token']],
      "notification" => [
        "title" => $title,
        "body" => $body,
      ]
    ];

    $client = new Client();

    $response = $client->post($url, [
      'headers' => [
        'Authorization' => 'key=' . $serverKey,
        'Content-Type' => 'application/json',
      ],
      'json' => $data,
    ]);

    return json_decode($response->getBody()->getContents(), true);
  }
}
