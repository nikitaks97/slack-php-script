<?php
require_once 'vendor/rmccue/requests/src/Autoload.php';
WpOrg\Requests\Autoload::register();

$response =  WpOrg\Requests\Requests::post(
  'https://hooks.slack.com/services/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',
  array(
    'Content-Type' => 'application/json'
  ),
  json_encode(array (
    'blocks' => 
        array (
            array (
                "type" => "section",
                "text" => array (
                    "type" => "mrkdwn",
                    "text" => 'Message',
                ),
            ),
            array (
                "type" => "section",
                "fields" => array (
                    array (
                        "type" => "mrkdwn",
                        "text" => "*Repository:*\nRepository",
                    ),
                    array (
                        "type" => "mrkdwn",
                        "text" => "*Event:*\nEvent",
                    ),
                    array (
                        "type" => "mrkdwn",
                        "text" => "*Ref:*\nRef",
                    ),
                    array (
                        "type" => "mrkdwn",
                        "text" => "*SHA:*\nSHA",
                    ),
                ),
            ),
        ),
))
);

if(!$response->success) {
  echo $response->body;
  exit(1);
  echo "Message sent successfully!\n";
}
