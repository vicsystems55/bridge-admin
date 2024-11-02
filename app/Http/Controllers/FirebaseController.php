<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Messaging\CloudMessage;


class FirebaseController extends Controller
{
  public function sendPushNotification($fcmToken, $title, $body)
  {


    $firebase = (new Factory)->withServiceAccount(storage_path('app/public/bridgepushnotifications-firebase-adminsdk-cyugc-95763c3edb.json'));


    $messaging = $firebase->createMessaging();

    // return $messaging;

    $message = CloudMessage::withTarget('token', $fcmToken)
      ->withNotification(['title' => $title, 'body' => $body]);

      // return $message;



    $messaging->send($message);
  }

  public function sendToUser(Request $request)
  {


        // Define the authorization token
        // $authToken = 'ya29.c.c0ASRK0Gbo4xPFLT2ECTu7aDEnUoSe39nFfbeSWmOP2J3rZjUYVllJTEmwxjz8KFbt8wtVB8-ZA8uuQ9XgX9nisZCcUEaK6oXAa2j95BKRXqlZTBrd3iOqRVvUwOS28pNHZfltKMvNtu-eVn6B7cWmr8Jo4vqN1X_WEnmsxSDF7LDOTjXhSvus83FJI-og_vxS5l6vKt6RSZyvzoFq0Kx0hsm5UpPDwFSqsU0KGmin1hUoGpaZM5531O1Nn5VSGx7YiPAT7i6MJdSMXdy-C2CJ0HSYf9VEnUdId8GlNVvlIwISplomC_Mnhv7XOrbJbCgJ1A-b-jkPLzEzlB08X8CM9He4S3fB7Vcpt84pjZJelq-TxYGTCKAwM6EN384Kds5IFkkpRgaSMboRsvI4k3YB0tgk_eZs8age5cIM0BIOWlyyB-ev8QIg1U1M0U53vIXmyZxZt3IrrY6ae2ZBfr_j4yWaheJSzdvbcUdRb063bRc66QXX2R6rWVrvYWIzk0svg0g-OOgs3WZpdhVe5-3fh_MJoBp_6VMxyyJMVc0n5fpd5h0t63RlbeMi_lc_5WFJ3qfiRtUgaZIjybqzrWvZQeXvjXzQ2UzyMu_6vmtJXoc2e4_9bX2e7b7bvvFoaWchrXyjmgRwozmF9SZmmOScOUkmg6cqf8hc-0zuqmj71f2sWt5_QhkcoFB3deVhJVj-h_9XodU21MpU54Wz_it1rac1i4WbcboMyq7BIcBX9Qf-pFnsIpnragpJfuluR_1jkUFX0dk-20SY2ra2R9hUBviZyfSiijz56MmrQfcbX4sbndJXsZ50krdMIW-1ui3BOStItXU9d1jWzSgB5wYa_tOe5XU0nFei0XsZzylJo85QVXlwnakcz8Yafe3FWV9rWn3wz1UjFt772Jf0OVSWWyswBJ658RuYJ8-ddXwy1iIVa5d9bFmYOxvfZhgel80aOMm7d4pYcwUFOVgJgFaJfvvQ28zhxjxJy11Wh3wJpvfnbywVM4lIi9h';
        $authToken = '';
        // Define the payload
        $payload = [
            'message' => [
                'topic' => 'news',
                'notification' => [
                    'title' => 'Breaking News',
                    'body' => 'New news story available.',
                ],
                'data' => [
                    'story_id' => 'story_12345',
                ],
            ],
        ];

        // Send the POST request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $authToken,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/v1/projects/bridgepushnotifications/messages:send', $payload);

        // Handle the response
        if ($response->successful()) {
            return response()->json(['message' => 'Notification sent successfully.']);
        } else {
            return response()->json(['error' => 'Failed to send notification.', 'details' => $response->json()], $response->status());
        }


  }
}
