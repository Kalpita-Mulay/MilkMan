<?php

use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use paragraph1\phpFCM\Notification;

require_once 'FCM/autoload.php';

class Fcm {

    public function send_android_notification($data, $type = false) {
        //pre($data);
        $apiKey = FCM_KEY;
        $client = new Client();
        $client->setApiKey($apiKey);
        $client->injectHttpClient(new \GuzzleHttp\Client());

        $note = new Notification($data['subject'], $data['message']);
        $note->setIcon('notification_icon_resource_name')
                ->setColor('#ffffff')
                ->setBadge(1);

        $message = new Message();
        $message->addRecipient(new Device($data['token']));
        if (isset($data ['message_data']) && !empty($data ['message_data'])) {
            $message->setNotification($note)
                    ->setData(array('type' => $data['type'], 'sender' => $data['sender'], 'receiver' => $data['receiver'], 'message_data' => $data['message_data']));
        } else {
            $message->setNotification($note)
                    ->setData(array('type' => $data['type'], 'sender' => $data['sender'], 'receiver' => $data['receiver']));
        }
        $response = $client->send($message);
        return $response->getStatusCode();
    }

}

?>