<?php
   // Edit by i9 
   // change echo "Hello World" to echo phpinfo()
   // echo phpinfo();
   require_once('./vendor/autoload.php');

   //Namespace

   use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
   use \LINE\LINEBot;
   use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

   $channel_token = 'WuQLwcvhUG82GtQK5belpZQJBJuBNR+G1JGGEoLbZjPWMiWMDOOysJRIveqGsW0YjuAPsXHJb0mnOpCs5IHmGG5pm4OSuGlGVIW7329WWnrA6zWyV5pbeFXdAZjeKjmwoCPWr+yZo8mbJE3mZ2IV/QdB04t89/1O/w1cDnyilFU=';
   $channel_secret = 'e6190998d06ed34a6540c014d384d350';

   // Get message from Line API
   $content  = file_get_contents('php://input');
   $events = json_decode($content,true);

   if(!is_null($events['events'])){
       // Loop through each event
       foreach($events['events'] as $event){
           // Line API send a lot of event type, we interested in message only
           if($event['type']=='message'){
              $httpClient = new CurlHTTPClient($channel_token);
              $bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret)); 
              switch($event['message']['type'])
              {
                case 'video' :
                    $messageID = $event['message']['id'];
                    // Create video file on Server
                    $fileID = $event['message']['id'];  
                    $response = $bot->getMessageContent($fileID);
                    $fileName = 'linebot.mp4';
                    $file = fopen($fileName,'w');
                    fwrite($file,$response->getRawBody());
                    //Reply Message
                    $respMessage = 'Hello, Your video is '.$messageID; 
                    break;
                // case 'sticker':  // not pass
                //     $messageID = $event['message']['packageId'];
                //     //Reply Message
                //     $respMessage = 'Hello , your Sticker Package ID is '.$messageID;  
                //     break;
                // case 'image' :  // not pass
                //     $messageID = $event['message']['id'];
                //     $respMessage = 'Hello Your image ID is '.$messageID;
                //     break;  
                // case 'text' :
                //     // Get replyToken
                //     $replyToken = $event['replyToken'];
                //     // Reply Token
                //     $respMessage = 'Hello, your message is '.$event['message']['text'];            
                //     break;               
                default : 
                    $respMessage = 'Please Send text or image or sticker or video only';
                    break;                  
              }              
              
              $textMessageBuilder = new TextMessageBuilder($respMessage);
              $response = $bot->replyMessage($replyToken,$textMessageBuilder);
           }

       }
   }
   echo 'OK';
?>
