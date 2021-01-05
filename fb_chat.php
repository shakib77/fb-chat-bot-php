<?php
     $my_verify_token = "FBSOFTBD123";

     $challenge = $_GET['hub_challenge'];
     $verify_token = $_GET['hub_verify_token'];

     if ($my_verify_token === $verify_token) {
         echo $challenge;
         exit ();
     }

     $access_token = "past_page_access_token";

     $response = file_get_contents("php//input");


//     file_put_contents("text.txt", $response);

     $response = json_decode($response, true);

     $message = $response['entry'][0]['messaging'][0]['message']['text'];

     $reply_message = '{
          "messaging_type": "RESPONSE",
          "recipient": {
            "id": "<PSID>"
          },
          "message": {
            "text": "hello, world!"
          }
        }';

     send_reply($access_token, $reply_message);

     function send_reply ($access_token = '', $reply = '') {
         $url = "https://graph.facebook.com/v9.0/me/messages?access_token=<PAGE_ACCESS_TOKEN>";
         $ch = curl_init();
         $headers = array("Content-type: application/json");
         curl_setopt ($ch, CURLOPT_URL, $url);
         curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt ($ch, CURLOPT_POST, 1);
         curl_setopt ($ch, CURLOPT_POSTFIELDS, $reply);
         curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
         $st = curl_exec($ch);
         return json_decode($st, TRUE);
     }