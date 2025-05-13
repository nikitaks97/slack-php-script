<?php
require_once 'vendor/rmccue/requests/src/Autoload.php';
WpOrg\Requests\Autoload::register();

$response =  WpOrg\Requests\Requests::post(
  'https://hooks.slack.com/services/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',
  array(
    'Content-Type' => 'application/json'
  ),
  json_encode(array (
    'text' => 'Test message from PHP script' 
  ))
);

if(!$response->success) {
  echo "Error sending message to Slack:\n";
  echo $response->body;
  exit(1);
} else {
  echo "Message sent successfully!\n";
}
?>
