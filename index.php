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
              switch($event['message']['type'])
              {
                case 'text' :
                    // Get replyToken
                    $replyToken = $event['replyToken'];
                    // Reply Token
                    $respMessage = 'Hello, your message is '.$event['message']['text'];            
                    break;
                case 'image' :
                    $messageID = $event['message']['id'];
                    $respMessage = 'Hello Your image ID is '.$messageID;
                    break;
                default : 
                    $respMessage = 'Please Send text or image only';
                    break;                  
              }              
              $httpClient = new CurlHTTPClient($channel_token);
              $bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));
              $textMessageBuilder = new TextMessageBuilder($respMessage);
              $response = $bot->replyMessage($replyToken,$textMessageBuilder);
           }

       }
   }
   echo 'OK';
?>
