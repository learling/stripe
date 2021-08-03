<?php
require_once("config/apis.php");

function twilio_sms($msg = "text using twilio rest api") {
  $command = 
    'curl -X POST https://api.twilio.com/2010-04-01/Accounts/' . TWILIO_SID . '/Messages.json \
    --data-urlencode "Body=' . $msg . '" \
    --data-urlencode "From=' . FROM_MOBILE . '" \
    --data-urlencode "To=' . TO_MOBILE . '" \
    -u ' . TWILIO_SID . ':' . TWILIO_TOKEN;
  shell_exec($command);
}

$body = @file_get_contents("php://input");
// Your Twilio Account is currently suspended due to a lack of funds. 
//twilio_sms($body);
echo $body;
?>