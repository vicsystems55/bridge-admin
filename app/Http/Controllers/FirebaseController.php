<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
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

    // return $request->fcmToken;
    $fcmToken = $request->fcmToken;
    $title = "Hello User!";
    $body = "This is a test push notification.";

    $this->sendPushNotification($fcmToken, $title, $body);

    return response()->json(['success' => true]);
  }
}
