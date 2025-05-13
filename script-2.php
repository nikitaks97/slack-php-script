<?php
require_once 'vendor/rmccue/requests/src/Autoload.php';
WpOrg\Requests\Autoload::register();

// Read environment variables from GitHub Actions
$repository = getenv('GITHUB_REPOSITORY') ?: 'unknown';
$event = getenv('GITHUB_EVENT_NAME') ?: 'unknown';
$ref = getenv('GITHUB_REF') ?: 'unknown';
$sha = getenv('GITHUB_SHA') ?: 'unknown';

// Slack webhook URL (update this to your real webhook)
$webhookUrl = 'https://hooks.slack.com/services/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';

$response = WpOrg\Requests\Requests::post(
    $webhookUrl,
    array(
        'Content-Type' => 'application/json'
    ),
    json_encode(array(
        'blocks' => array(
            array(
                "type" => "section",
                "text" => array(
                    "type" => "mrkdwn",
                    "text" => '🚀 *GitHub Action Triggered!*'
                )
            ),
            array(
                "type" => "section",
                "fields" => array(
                    array(
                        "type" => "mrkdwn",
                        "text" => "*Repository:*\n$repository"
                    ),
                    array(
                        "type" => "mrkdwn",
                        "text" => "*Event:*\n$event"
                    ),
                    array(
                        "type" => "mrkdwn",
                        "text" => "*Ref:*\n$ref"
                    ),
                    array(
                        "type" => "mrkdwn",
                        "text" => "*SHA:*\n$sha"
                    )
                )
            )
        )
    ))
);

if (!$response->success) {
    echo "Error sending message to Slack:\n";
    echo $response->body;
    exit(1);
}

echo "✅ Message sent successfully to Slack!\n";
