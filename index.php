<?php
  require_once('./vendor/autoload.php');
  //Namespace
  use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
  use \LINE\LINEBot;
  use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

  // Token
  $channel_token = 'WuQLwcvhUG82GtQK5belpZQJBJuBNR+G1JGGEoLbZjPWMiWMDOOysJRIveqGsW0YjuAPsXHJb0mnOpCs5IHmGG5pm4OSuGlGVIW7329WWnrA6zWyV5pbeFXdAZjeKjmwoCPWr+yZo8mbJE3mZ2IV/QdB04t89/1O/w1cDnyilFU=';
  $channel_secret = 'e6190998d06ed34a6540c014d384d350';

  $httpClient = new CurlHTTPClient($channel_token);
  $bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));

  //Get Message from Line API
  $content = file_get_contents('php://input');
  $events  = json_decode($content,true);

  if(!is_null($events['events'])){
      // Loop through each event
      foreach($events['events'] as $event){
        // Get Reply Token 
        $replyToken = $event['replyToken'];

        //Sticker
        $packageId = 1;
        $stickerId = 618;

        $textMessageBuilder = new StickerMessageBuilder($packageId,$stickerId);
        $response = $bot->replyMessage($replyToken,$textMessageBuilder);
      }
  }
  echo 'OK2';
?>
