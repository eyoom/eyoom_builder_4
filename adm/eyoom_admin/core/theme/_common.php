<?php
define('_EYOOM_IS_ADMIN_', true);
include_once('../../../../common.php');

if($is_admin != 'super') alert('접근권한이 없습니다.');