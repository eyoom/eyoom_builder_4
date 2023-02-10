<?php
if (!defined('_EYOOM_')) exit;

if($pid!='attendance') alert('잘못된 접근입니다.');

/**
 * 출석부 환경설정파일
 */
$attendance_config = G5_DATA_PATH.'/attendance.config.php';

/**
 * 출석부 설정파일이 없다면 설치
 */
if(file_exists($attendance_config)) {
	include_once($attendance_config);

	// 날짜 정보
	$today	= date('Ymd');
	$now	= date('YmdHi');
	$d = $d ? (int)substr($d,0,8) : $today;

	// 출석가능여부
	if($d == $today) {
		$_stime = $today.str_replace(':','',$attendance['stime']);
		$_etime = $today.str_replace(':','',$attendance['etime']);
		if($now>=$_stime && $now<=$_etime) {
			if($is_member) {
				$atime = true; 
			} else {
				$msg = "출석체크는 로그인하신 후 이용이 가능합니다.";
				$atime = false;
			}
		} else {
			$msg = "출석가능한 시간은 {$attendance['stime']}~{$attendance['etime']} 까지 입니다.";
			$atime = false;
		}
	} else if($d > $today) {
		alert("아직 출석가능한 날짜가 아닙니다.");
		return;
	} else {
		$msg = "출석이 마감된 날짜입니다.";
		$atime = false;
	}
	
	// 날짜 검증
	$date = get_date_array($d);
	if(!check_date($date)) alert('날짜가 옳바르지 않습니다.');
	$date_day = implode('-',$date);

	switch($act) {
		default :
			// 랭킹포인트 설정 배열
			$ranking_use = $is_admin ? 10 : $attendance['ranking_use'];
			$rank_use = array_fill(1,$ranking_use,0);
			$i=1;
			foreach($rank_use as $k => $v) {
				$key = 'ranking'.$i.'_point';
				$rank_point[$i] = $attendance[$key];
				$i++;
			}

			// 날짜 정의
			$tdate = get_date_array($today);
			$date_today = implode('-',$tdate);

			$yesterday = date('Ymd',strtotime('-1day'));
			$ydate = get_date_array($yesterday);
			$ydate_day = implode('-',$ydate);

			// 이번달 나의 출석 정보

			$d_stime = strtotime($d);
			$sdate = date('Y-m-01', $d_stime-3600*24*365);
			$edate = date('Y-m-'.date('t', $d_stime+3600*24*100), $d_stime+3600*24*100);
			$this_day = date('"j-n-Y"', $d_stime);
			
			$sql = "select * from {$g5['eyoom_attendance']} where atd_mb_id='{$member['mb_id']}' and (atd_datetime between  '{$sdate}' and '{$edate}') order by atd_datetime desc";
			$res = sql_query($sql, false);
			for($i=0;$row=sql_fetch_array($res);$i++) {
				$ymd = explode('-',substr($row['atd_datetime'],0,10));
				$adate[$i] = '"'.(int)$ymd[2].'-'.(int)$ymd[1].'-'.(int)$ymd[0].'"';
				if($i==0) {
					$last_day = substr($row['atd_datetime'],0,10);
					if($last_day == $date_today || ($last_day == $ydate_day && $now<$_etime)) {
						$ainfo = $row;
					}
				}
			}
			// 출석체크된 일자 배열
			$atd_date = is_array($adate) ? implode(',',$adate): "''";

			// 오늘 출석체크 했다면
			$is_attended = false;
			if($ainfo['atd_datetime'] && $last_day == $date_today) {
				$msg = "이미 출석체크를 하셨습니다.";
				$atime = false;
				$is_attended = true;
			}

			// 오늘 출석한 사람들
			$sql = "select * from {$g5['eyoom_attendance']} where atd_datetime like '".$date_day."%' order by ranking asc";
			$res = sql_query($sql,false);
			$point_key = array('def','hard','group','lucky','someday','ranking');
			for($i=0;$row=sql_fetch_array($res);$i++) {
				$list[$i] = $row;
				$list[$i]['mb_photo'] = $eb->mb_photo($row['atd_mb_id']);
				foreach($point_key as $key) {
					$pkey = $key.'_point';
					$point[$key] = $row[$pkey]; 
				}
				$list[$i]['point_sum'] = array_sum($point);
			}

			// 이번달 개근일 순위 
			$sql_date = " and atd_datetime between date_format('".date('Y-m-d', $d_stime)."', '%Y-%m-01') and date_format('".date('Y-m-d', $d_stime)."', '%Y-%m-31') ";
			$sql = "select max(atd_count) as count, atd_mb_id, atd_wr_name, atd_datetime, sum(ranking) as rank from {$g5['eyoom_attendance']} where (1) {$sql_date} group by atd_mb_id order by count desc, rank asc limit 5";
			$res = sql_query($sql,false);
			for($i=0;$row=sql_fetch_array($res);$i++) {
				$row['mb_photo'] = $eb->mb_photo($row['atd_mb_id']);
				$rank_day[$i] = $row;
			}
			
			// 이번달 1등 횟수 순위 
			$sql = "select count(*) as count, atd_mb_id, atd_wr_name, sum(ranking) as rank from {$g5['eyoom_attendance']} where ranking=1 {$sql_date} group by atd_mb_id order by count desc, rank asc limit 5";
			$res = sql_query($sql,false);
			for($i=0;$row=sql_fetch_array($res);$i++) {
				$rank_one[$i]['mb_photo'] = $eb->mb_photo($row['atd_mb_id']);
				$rank_one[$i] = $row;
			}
			break;

		case "write":
			unset($ranking,$set,$count,$where);

			// 회원인지 체크
			if($member['mb_id']!=$mb_id) alert('잘못된 접근입니다.');

			// 출석체크가 가능한 시간인지 체크
			if(!$atime) alert('잘못된 접근입니다.');

			// 이미 출석체크를 했는지 체크
			$chk = sql_fetch("select count(*) as cnt from {$g5['eyoom_attendance']} where atd_mb_id='{$member['mb_id']}' and atd_datetime like '".$date_day."%'",false);
			if($chk['cnt']>0) alert('이미 출석체크하셨습니다.');

			// 순위정보 가져오기
			$rank = sql_fetch("select max(ranking) as max from {$g5['eyoom_attendance']} where atd_datetime like '".$date_day."%'",false);
			$ranking = $rank['max']+1;

			// 어제 출석체크를 했는지 체크
			$yesterday = date('Ymd',strtotime('-1day'));
			$ydate = get_date_array($yesterday);
			$ydate_day = implode('-',$ydate);
			$count = sql_fetch("select atd_count from {$g5['eyoom_attendance']} where atd_mb_id='{$member['mb_id']}' and atd_datetime like '".$ydate_day."%'",false);
			$atd_count = $count['atd_count'] + 1;

			// 기본 포인트
			$point = array();
			$point['default'] = attendance_point($attendance['point_default']);
			insert_point($member['mb_id'], $point['default'], "{$date_day} 출석체크", '@attendance', '@default', "{$date_day}");

			// 부지런상 포인트
			if($attendance['hard_use'] == 'y') {
				if($atd_count%$attendance['hard_cond']==0) {
					$point['hard'] = attendance_point($attendance['hard_point']);
					insert_point($member['mb_id'], $point['hard'], "{$date_day} 출석체크 부지런상", '@attendance', '@hard', "{$date_day}");
				}
			}

			// 선착순상 포인트
			if($attendance['group_use'] == 'y' && $ranking == $attendance['group_cond'] && $attendance['group_cond'] > 1) {
				$point['group'] = attendance_point($attendance['group_point']);

				// 출석부에 포인트 등록
				sql_query("update {$g5['eyoom_attendance']} set group_point='{$point['group']}' where ranking<'{$ranking}' and group_point=0 and atd_datetime like '".$date_day."%' ",false);
				$res = sql_query("select atd_mb_id from {$g5['eyoom_attendance']} where ranking<'{$ranking}' and atd_datetime like '".$date_day."%'",false);
				for($i=0;$row=sql_fetch_array($res);$i++) {
					insert_point($member['mb_id'], $point['group'], "{$date_day} 출석체크 선착순상", '@attendance', '@group', "{$date_day}");
				}
			}

			// 어머나상 포인트
			if($attendance['lucky_use'] == 'y') {
				$random = $eb->random_num(9);
				if($random%10 == 0) {
					$point['lucky'] = attendance_point($attendance['lucky_point']);
					insert_point($member['mb_id'], $point['lucky'], "{$date_day} 출석체크 어머나상", '@attendance', '@lucky', "{$date_day}");
				}
			}

			// 어느날상 포인트
			if($attendance['someday_use'] == 'y' && $attendance['someday_date'] == $today) {
				$point['someday'] = attendance_point($attendance['someday_point']);
				insert_point($member['mb_id'], $point['someday'], "{$date_day} 출석체크 어느날상", '@attendance', '@someday', "{$date_day}");
			}

			// 랭킹상 포인트
			if($attendance['ranking_use'] && $ranking <= $attendance['ranking_use'] && $ranking<=10) {
				$rkey = 'ranking'.$ranking.'_point';
				$point['ranking'] = $attendance[$rkey];
				insert_point($member['mb_id'], $point['ranking'], "{$date_day} 출석체크 {$ranking}위 랭킹상", '@attendance', '@ranking', "{$date_day}");
			}

			// 내용글은 텍스트 필터
			$wr_content = conv_content($wr_content);
			$set = "
				atd_mb_id = '{$member['mb_id']}',
				atd_content = '{$wr_content}',
				atd_wr_name = '{$member['mb_nick']}', 
				atd_wr_ip = '{$_SERVER['REMOTE_ADDR']}',
				def_point = '{$point['default']}',
				hard_point = '{$point['hard']}',
				group_point = '{$point['group']}',
				lucky_point = '{$point['lucky']}',
				someday_point = '{$point['someday']}',
				ranking_point = '{$point['ranking']}',
				ranking = '{$ranking}',
				atd_count = '{$atd_count}',
				atd_datetime = '".G5_TIME_YMDHIS."'
			";
			$sql = "insert into {$g5['eyoom_attendance']} set $set";
			sql_query($sql);
			$url = get_eyoom_pretty_url('page', 'attendance');
			alert('정상적으로 출석체크 하였습니다.', $url);

			break;

		case "words":
			$words_file = EYOOM_CORE_PATH.'/page/proc/attendance.words.php';
			if(file_exists($words_file)) {
				@include_once($words_file);
				$count = count($words);
				$key_num1 = $eb->random_num($count-1);
				$key_num2 = $eb->random_num($count-1);
				$output['words']		= $words[$key_num1];
				$output['today_words']	= $words[$key_num2];

				@include_once EYOOM_CLASS_PATH."/json.class.php";
				$json = new Services_JSON();
				$data = $json->encode($output);
				echo $data;
			}
			break;

		case "config":
			$stime = strlen($stime) == 4 ? '0'.$stime:$stime;
			$etime = strlen($etime) == 4 ? '0'.$etime:$etime;
			$someday_date = str_replace('/','',$someday_date);
			unset($_POST['act'],$_POST['mb_id'],$_POST['date']);

			$attendance = array();
			$attendance['target'] = '모든회원';

			foreach($_POST as $key => $val) {
				$attendance[$key] = $$key;
			}
		
			$qfile->save_file('attendance', $attendance_config, $attendance);
			$url = get_eyoom_pretty_url('page', 'attendance');
			alert('정상적으로 설정을 저장하였습니다.', $url);
			break;
	}
	if($act) exit;

} else {
	if($is_admin) {
		// 설정파일이 없다면 기본값
		$attendance['target'] = '모든회원';
		$attendance['stime'] = '06:00'; // 시작시간
		$attendance['etime'] = '18:00';	// 종료시간
		$attendance['point_default'] = '100';	// 기본 그누보드 포인트
		$attendance['point_type'] = '0'; // 0:랜덤, 1:고정
		$attendance['hard_use'] = 'y';	//부지런상 사용
		$attendance['hard_point'] = '200'; // 부지런상 포인트
		$attendance['hard_cond'] = '10';	// 10일동안 매일 출석할 경우 매 10일마다 해당 포인트 지급
		$attendance['group_use'] = 'y';	// 선착순상
		$attendance['group_point'] = '200'; // 선착순상 포인트
		$attendance['group_cond'] = '20';	// 당일 출석인원이 20명을 넘어설 경우, 해당 1~20순위에게 모두 지급
		$attendance['lucky_use'] = 'y';	// 어머나상
		$attendance['lucky_point'] = '100'; // 어머나상 포인트
		$attendance['someday_use'] = 'y';	// 어느날상
		$attendance['someday_point'] = '100';	// 어느날상 포인트
		$attendance['someday_date'] = '20150525';	// 해당일자
		$attendance['ranking_use'] = '5';
		$attendance['ranking1_point'] = '100';
		$attendance['ranking2_point'] = '90';
		$attendance['ranking3_point'] = '80';
		$attendance['ranking4_point'] = '70';
		$attendance['ranking5_point'] = '60';
		$attendance['ranking6_point'] = '50';
		$attendance['ranking7_point'] = '40';
		$attendance['ranking8_point'] = '30';
		$attendance['ranking9_point'] = '20';
		$attendance['ranking10_point'] = '10';

		// 설정파일 생성
		$qfile->save_file('attendance', $attendance_config, $attendance);

		// 출석부 테이블 생성
		$sql = "
			create table if not exists `".G5_TABLE_PREFIX."eyoom_attendance` (
			  `atd_no` int(11) unsigned NOT NULL auto_increment,
			  `atd_mb_id` varchar(30) NOT NULL,
			  `atd_content` text NOT NULL,
			  `atd_wr_name` varchar(50) NOT NULL,
			  `atd_wr_ip` varchar(50) NOT NULL,
			  `atd_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
			  `def_point` int(11) NOT NULL default '0',
			  `hard_point` int(11) NOT NULL default '0',
			  `group_point` int(11) NOT NULL default '0',
			  `lucky_point` int(11) NOT NULL default '0',
			  `someday_point` int(11) NOT NULL default '0',
			  `ranking_point` int(11) NOT NULL default '0',
			  `ranking` int(2) NOT NULL default '0',
			  `atd_count` int(11) NOT NULL default '1',
			  PRIMARY KEY  (`atd_no`)
			) engine=myisam default charset=utf8
		";
		$sql = get_db_create_replace($sql);
		sql_query($sql, false);
		$url = get_eyoom_pretty_url('page', 'attendance');
		alert('출석부를 정상적으로 설치하였습니다.', $url);

	} else {
		alert("출석부가 아직 설치되지 않습니다.");
	}
}

// Ymd 날짜를 받아 date 배열로 리턴
function get_date_array($ymd) {
	$ymd = (int)substr($ymd,0,8);
	$date['year']	= substr($ymd,0,4); 
	$date['month']	= substr($ymd,4,2); 
	$date['day']	= substr($ymd,-2);
	return $date;
}

// 날짜가 올바른지 체크하기
function check_date($date) {
	if(!is_array($date)) return false;
	else return checkdate($date['month'], $date['day'], $date['year']);
}

function attendance_point($point) {
	global $attendance, $eb;
	if(!$attendance['point_type']) {
		$output = $eb->random_num($point-1)+1;
	} else {
		$output = $point;
	}
	return $output;
}

?>