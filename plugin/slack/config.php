<?php
if (!defined('_GNUBOARD_')) exit;

/*
https://api.slack.com/methods/chat.postMessage
https://api.slack.com/custom-integrations/legacy-tokens
*/

if ($config['cf_slack_token'] && $config['cf_slack_channel']) {
	define('G5_SLACK_USE', true);
} 

if(!defined('G5_SLACK_USE') || G5_SLACK_USE !== true)
    return;

define('G5_SLACK_TOKEN',    "{$config['cf_slack_token']}");
define('G5_SLACK_USERNAME', 'Slack Bot');

// 경로설정
define('G5_SLACK_PATH', G5_PLUGIN_PATH.'/'.G5_SLACK_DIR);