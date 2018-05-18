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

   $httpClient = new CurlHTTPClient($channel_token);
   $bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret)); 

   // Get mess age from Line API
   $content  = file_get_contents('php://input');
   $events = json_decode($content,true);

   if(!is_null($events['events'])){
       // Loop through each event
       foreach($events['events'] as $event){
           // Line API send a lot of event type, we interested in message only
           if($event['type']=='message'){              
              
            // Get replyToken
              $replyToken = $event['replyToken'];
              $ask = $event['message']['text'];

              switch(strtolower($ask))
              {
                 case 'f' :
                   $respMessage = 'https://www.facebook.com';
                   break;
                 case 'g' :
                   $respMessage = 'https://www.google.com';
                   break;
                 case 'i' :
                   $respMessage = 'https://www.instagram.com';
                   break;  
                 case 't' :
                   $respMessage = 'https://twitter.com';
                   break;
                 case 'y' : 
                   $respMessage = 'https://www.youtube.com';
                   break; 
                 default : 
                   $respMessage = 'What is your website to visit<br>f = facebook <br>g = goole <br>i = instragram <br>t = twitter <br>y = youtube <br>';
              }

            //   switch($event['message']['type'])
            //   {
                // case 'location' : 
                //     $address = $event['message']['address'];
                //     //Reply Message
                //     $respMessage = 'Hello , Your Address is '.$address;
                //     break;
                // case 'audio' :
                //     $messageID = $event['message']['id'];
                //     // Create audio file on server
                //     $fileID =  $event['message']['id'];
                //     $response = $bot->getMessageContent($fileID);
                //     $fileName = 'linebot.m4a';
                //     $file = fopen($fileName,'w');
                //     fwrite($file,$response->getRawBody());
                //     //Reply Message
                //     $respMessage = 'Hello , your audio ID is'.$messageID;                   
                //     break;
                // case 'video' :
                //     $messageID = $event['message']['id'];                    
                //     // Create video file on Server
                //     $fileID = $event['message']['id'];  
                //     $response = $bot->getMessageContent($fileID);
                //     $fileName = 'linebot.mp4';
                //     $file = fopen($fileName,'w');
                //     fwrite($file,$response->getRawBody());
                //     //Reply Message
                //     $respMessage = 'Hello, Your video is '.$messageID; 
                //     break;
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
                //     // Reply Token
                //     $respMessage = 'Hello, your message is '.$event['message']['text'];            
                //     break;               
            //     default : 
            //         $respMessage = 'Please Send text or image or sticker or video only';
            //         break;                  
            //   }              
              
              $textMessageBuilder = new TextMessageBuilder($respMessage);
              $response = $bot->replyMessage($replyToken,$textMessageBuilder);
           }

       }
   }
   echo 'OK';
?>