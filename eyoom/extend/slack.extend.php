<?php
/**
 * file : /eyoom/extend/slack.extend.php
 */
if (!defined('_EYOOM_')) exit;

define('G5_SLACK_DIR', 'slack');

if(is_file(G5_PLUGIN_PATH.'/'.G5_SLACK_DIR.'/config.php'))
    include_once(G5_PLUGIN_PATH.'/'.G5_SLACK_DIR.'/config.php');