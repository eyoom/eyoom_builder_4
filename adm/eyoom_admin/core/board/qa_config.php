<?php
/**
 * @file    /adm/eyoom_admin/core/board/qa_config.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300500";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=qa_config_update&amp;smode=1';

require_once G5_EDITOR_LIB;

auth_check_menu($auth, $sub_menu, 'r');

// DB 테이블 생성
if (!sql_query(" DESCRIBE `{$g5['qa_config_table']}` ", false)) {
  sql_query(
      " CREATE TABLE IF NOT EXISTS `{$g5['qa_config_table']}` (
                `qa_id` int(11) NOT NULL auto_increment,
                `qa_title` varchar(255) NOT NULL DEFAULT'',
                `qa_category` varchar(255) NOT NULL DEFAULT'',
                `qa_skin` varchar(255) NOT NULL DEFAULT '',
                `qa_mobile_skin` varchar(255) NOT NULL DEFAULT '',
                `qa_use_email` tinyint(4) NOT NULL DEFAULT '0',
                `qa_req_email` tinyint(4) NOT NULL DEFAULT '0',
                `qa_use_hp` tinyint(4) NOT NULL DEFAULT '0',
                `qa_req_hp` tinyint(4) NOT NULL DEFAULT '0',
                `qa_use_sms` tinyint(4) NOT NULL DEFAULT '0',
                `qa_send_number` varchar(255) NOT NULL DEFAULT '',
                `qa_admin_hp` varchar(255) NOT NULL DEFAULT '',
                `qa_use_editor` tinyint(4) NOT NULL DEFAULT '0',
                `qa_subject_len` int(11) NOT NULL DEFAULT '0',
                `qa_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
                `qa_page_rows` int(11) NOT NULL DEFAULT '0',
                `qa_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
                `qa_image_width` int(11) NOT NULL DEFAULT '0',
                `qa_upload_size` int(11) NOT NULL DEFAULT '0',
                `qa_insert_content` text NOT NULL,
                `qa_include_head` varchar(255) NOT NULL DEFAULT '',
                `qa_include_tail` varchar(255) NOT NULL DEFAULT '',
                `qa_content_head` text NOT NULL,
                `qa_content_tail` text NOT NULL,
                `qa_mobile_content_head` text NOT NULL,
                `qa_mobile_content_tail` text NOT NULL,
                `qa_1_subj` varchar(255) NOT NULL DEFAULT '',
                `qa_2_subj` varchar(255) NOT NULL DEFAULT '',
                `qa_3_subj` varchar(255) NOT NULL DEFAULT '',
                `qa_4_subj` varchar(255) NOT NULL DEFAULT '',
                `qa_5_subj` varchar(255) NOT NULL DEFAULT '',
                `qa_1` varchar(255) NOT NULL DEFAULT '',
                `qa_2` varchar(255) NOT NULL DEFAULT '',
                `qa_3` varchar(255) NOT NULL DEFAULT '',
                `qa_4` varchar(255) NOT NULL DEFAULT '',
                `qa_5` varchar(255) NOT NULL DEFAULT '',
                PRIMARY KEY (`qa_id`)
              )",
      true
  );
  sql_query(
      " CREATE TABLE IF NOT EXISTS `{$g5['qa_content_table']}` (
                `qa_id` int(11) NOT NULL AUTO_INCREMENT,
                `qa_num` int(11) NOT NULL DEFAULT '0',
                `qa_parent` int(11) NOT NULL DEFAULT '0',
                `qa_related` int(11) NOT NULL DEFAULT '0',
                `mb_id` varchar(20) NOT NULL DEFAULT '',
                `qa_name` varchar(255) NOT NULL DEFAULT '',
                `qa_email` varchar(255) NOT NULL DEFAULT '',
                `qa_hp` varchar(255) NOT NULL DEFAULT '',
                `qa_type` tinyint(4) NOT NULL DEFAULT '0',
                `qa_category` varchar(255) NOT NULL DEFAULT '',
                `qa_email_recv` tinyint(4) NOT NULL DEFAULT '0',
                `qa_sms_recv` tinyint(4) NOT NULL DEFAULT '0',
                `qa_html` tinyint(4) NOT NULL DEFAULT '0',
                `qa_subject` varchar(255) NOT NULL DEFAULT '',
                `qa_content` text NOT NULL,
                `qa_status` tinyint(4) NOT NULL DEFAULT '0',
                `qa_file1` varchar(255) NOT NULL DEFAULT '',
                `qa_source1` varchar(255) NOT NULL DEFAULT '',
                `qa_file2` varchar(255) NOT NULL DEFAULT '',
                `qa_source2` varchar(255) NOT NULL DEFAULT '',
                `qa_ip` varchar(255) NOT NULL DEFAULT '',
                `qa_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                `qa_1` varchar(255) NOT NULL DEFAULT '',
                `qa_2` varchar(255) NOT NULL DEFAULT '',
                `qa_3` varchar(255) NOT NULL DEFAULT '',
                `qa_4` varchar(255) NOT NULL DEFAULT '',
                `qa_5` varchar(255) NOT NULL DEFAULT '',
                PRIMARY KEY (`qa_id`),
                KEY `qa_num_parent` (`qa_num`,`qa_parent`)
              )",
      true
  );
}

$sql = " SHOW COLUMNS FROM `{$g5['qa_content_table']}` LIKE 'qa_content' ";
$row = sql_fetch($sql);
if (strpos($row['Type'], 'text') === false) {
    sql_query(" ALTER TABLE `{$g5['qa_content_table']}` CHANGE `qa_content` `qa_content` text NOT NULL ", true);
}

$qaconfig = get_qa_config();

if (empty($qaconfig)) {
    $sql = " insert into `{$g5['qa_config_table']}`
                ( qa_title, qa_category, qa_skin, qa_mobile_skin, qa_use_email, qa_req_email, qa_use_hp, qa_req_hp, qa_use_editor, qa_subject_len, qa_mobile_subject_len, qa_page_rows, qa_mobile_page_rows, qa_image_width, qa_upload_size, qa_insert_content )
              values
                ( '1:1문의', '회원|포인트', 'basic', 'basic', '1', '0', '1', '0', '1', '60', '30', '15', '15', '600', '1048576', '' ) ";
    sql_query($sql);

    $qaconfig = get_qa_config();
}

// 관리자 이메일필드 추가
if (!isset($qaconfig['qa_admin_email'])) {
  sql_query(
      " ALTER TABLE `{$g5['qa_config_table']}`
                  ADD `qa_admin_email` varchar(255) NOT NULL DEFAULT '' AFTER `qa_admin_hp` ",
      true
  );
}

// 상단 하단 설정 필드 추가
if (!isset($qaconfig['qa_include_head'])) {
  sql_query(
      " ALTER TABLE `{$g5['qa_config_table']}`
                  ADD `qa_include_head` varchar(255) NOT NULL DEFAULT '' AFTER `qa_insert_content`,
                  ADD `qa_include_tail` varchar(255) NOT NULL DEFAULT '' AFTER `qa_include_head`,
                  ADD `qa_content_head` text NOT NULL AFTER `qa_include_tail`,
                  ADD `qa_content_tail` text NOT NULL AFTER `qa_content_head`,
                  ADD `qa_mobile_content_head` text NOT NULL AFTER `qa_content_tail`,
                  ADD `qa_mobile_content_tail` text NOT NULL AFTER `qa_mobile_content_head` ",
      true
  );
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';