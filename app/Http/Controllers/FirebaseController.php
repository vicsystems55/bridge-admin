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
        $authToken = 'ya29.c.c0ASRK0Gb2V3d74fmNeqaBGEsFmDKLgRz5JF7eQsnYFRk-fLlBbgcEsI6GZX9tt_ZoyO0U949b4ajldQWBxGjqO-Sa940RHPtAIw9W9szsK36F1eDqk1pwg7er__rFIlpyINc-auYCV4R1gHi1-EsmLg2Vxv-dhreJ3pKtdqRniLiyBfEJX5VECuoDobrYYf9LvgVKOev2_JmQtd4HhNMRJdrIJ2lFwAR-jnCBpXNYSkxT8Q81Unnig6jke-zM2qxglhJ2a5udynnF-J36bjTmxX0fa-F3AUN114Iwx3aiLIdVAQEkUdqM7Mmr_aBYRgEAsijN_qUg1K2Au0P_3CuSWvsRKB3IuNvOTgNS-U-zZRd7oym_7HO7uGIL384PzIa43bw-f_iRX1klqlYRtOZiZ2olegzV5FrwSmQsX5h7O5yi-pZsVc6usQnMk1F1far2Yip9wz50tlpJFY8q8q7x9U5ho_Y2plXfZQcpun4fXRti4oeOWIW5vUZ_1z8cOB0cs2OQvzafxq07i5VmlcokOcxBmI99R0x_gx22w2kk5XbqJSeZuZd1wvFi1_mp7d-s2u9Rg0qM8ous2IOZcnWgQogfXgo1WliMVlMfemaqqcptx4QumcRcn2r93W7yaJM4tg6YpvsImaWbBe6dfbqq1lomI8jRot-Ybndx2xhbvgB0OZnFfJ1-2e_stkjV_jxWV3RuhyspIQZlibkyIObwdzb-mh9whQoy8S1J6MijyU-WIvymV-wQ9VigMwklSeU4xVn_jwdoY3qXR6l2z4bpr1Mrk6t3ncUraJl5ZQqJh-kUFhJ2l3rZupRgX45F5adY8FY9WceO3vh-ud5imocckFrYdY8iqY7MeMU89rW4x3YsIoF1ubJen0lBWpMIVmI4e8W8aJfl1oh3X3I30ot4y5-eOWjy4u5FQZhgB8bZr911sfiRm4_hdBJ7go84FXBbSlw5Ore3O0d9QzycckJSFhO3OWkmtvl8egBzd58svhmvOxicw_1nnu1';
        // $authToken = '';
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
