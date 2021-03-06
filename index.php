<?php
  require_once('./vendor/autoload.php');

  // Namespace
  use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
  use \LINE\LINEBot;
  use \LINE\LINEBot\MessageBuilder\VideoMessageBuilder;

  // Token
  $channel_token = 'WuQLwcvhUG82GtQK5belpZQJBJuBNR+G1JGGEoLbZjPWMiWMDOOysJRIveqGsW0YjuAPsXHJb0mnOpCs5IHmGG5pm4OSuGlGVIW7329WWnrA6zWyV5pbeFXdAZjeKjmwoCPWr+yZo8mbJE3mZ2IV/QdB04t89/1O/w1cDnyilFU=';
  $channel_secret = 'e6190998d06ed34a6540c014d384d350';

  $httpClient = new CurlHTTPClient($channel_token);
  $bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));

  // Get Message from Line API
  $content = file_get_contents('php://Input');
  $events = json_decode($content,true);

  if(!is_null($events['events']))
  {
     // Loop through each event
     foreach($events['events'] as $event)
     {
          // Get Reply Token
          $replyToken = $event['replyToken'];

          // Video
          $originContentUrl = 'https://www.select2web.com.com/the-fuji.mp4';
          $previewImageUrl = 'https://www.select2web.com.com/the-fuji.jpg';

          $vdoMessageBuilder = new VideoMessageBuilder($originContentUrl,$previewImageUrl);
          $response = $bot->replyMessage($replyToken,$vdoMessageBuilder);
     }
  }
  echo 'OK3';
?> 