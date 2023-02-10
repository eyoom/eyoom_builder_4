<?php
/**
 * page file : /theme/THEME_NAME/page/attendance.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 출석회원 목록 타입 : 'basic' || 'zigzag'
 */
$atd_list_type = 'basic';
?>

<style>
.eb-attendance .panel-footer {margin-top:10px}
.eb-attendance .attendance-btn {text-align:center;margin-top:20px}
.eb-attendance .attendance-btn .btn-e {position:relative;width:322px;height:60px;line-height:60px;padding:0 10px;font-size:1rem !important;font-weight:700;border:0;border-bottom:4px solid #2E3340;border-radius:0}
.eb-attendance .attendance-btn i {position:absolute;top:0;right:0;width:56px;height:56px;line-height:56px;text-align:center;font-size:1.625rem;color:#eaefff;background:#4052b5}
.eb-attendance #inline span.ui-state-default {color:#000 !important;position:relative;}
.eb-attendance #inline .ui-state-enabled a {color:#000 !important;position:relative; border:1px solid #ab0000 !important}
.eb-attendance #inline a.ui-state-active {color:#000 !important;position:relative; border:1px solid #ab0000}
.eb-attendance #inline td.ui-state-this a {border: 2px solid #f80 !important;}
.eb-attendance #inline {min-height:226px}
.eb-attendance .ui-datepicker {box-shadow:#000 0px 0px 0px 1px !important}
.eb-attendance .guest-ranking .ranking-list .ranking-num {display:inline-block;width:26px;height:18px;line-height:18px;margin-right:10px;font-size:11px;text-align:center;color:#fff;background:#454545}
.eb-attendance .guest-ranking .ranking-list:first-child .ranking-num {background:#cc2300}
.eb-attendance .guest-ranking .ranking-list:nth-child(2) .ranking-num {background:#FF9500}
.eb-attendance .guest-ranking .ranking-list:nth-child(3) .ranking-num {background:#FF9500}
.eb-attendance .guest-ranking .ranking-list .ranking-days {display:inline-block;width:70px;margin-right:5px}
.eb-attendance .attendance-sub-title {border-bottom:2px solid #757575;padding-bottom:10px;margin-bottom:25px}
.guest-book .guest-clear-line {clear:both;margin-top:10px;margin-bottom:10px;border-top:1px dotted #e5e5e5}
.guest-book .chats {padding:0}
.guest-book .chats {padding-right:15px}
.guest-book .chats {list-style-type:none;margin:0;padding:0}
.guest-book .chats > .right, .guest-book .chats > .left {margin-top:20px}
.guest-book .chats>.right:after,.guest-book .chats > .right:before,.guest-book .chats>.left:after,.guest-book .chats > .left:before {content:"";display:table;clear:both}
.guest-book .chats .name {display:block;margin-bottom:5px;font-weight:700;text-decoration:none}
.guest-book .chats .name .badge {width:60px;border-radius:2px}
.guest-book .chats .date-time {font-size:.8125rem;display:block;float:right;color:#959595}
.guest-book .chats .image img {max-width:100%;float:left;width:60px;height:60px;border-radius:50%;overflow:hidden}
.guest-book .chats .image i {max-width:100%;float:left;width:50px;height:50px;border-radius:50%;background:#e5e5e5;color:#858585;text-align:center;line-height:50px;font-size:32px}
.guest-book .chats .image+.message {margin-left:78px}
.guest-book .chats .message {border:1px solid #c5c5c5;padding:15px;position:relative;border-radius:3px}
.guest-book .chats .message:after,.guest-book .chats .message:before {content:"";position:absolute;top:22px;left:-14px;border:7px solid transparent;border-right-color:#c5c5c5}
.guest-book .chats .message:after {left:-13px;border-right-color:#fff}
.guest-book .chats .message .message-info {list-style:none;margin:0}
.guest-book .chats .message ul li {float:left;margin-right:10px}
.guest-book .chats .message ul li:last-child {margin-right:0}
.guest-book .chats .message ul li.guest-point > span:after {content:"|";color:#d5d5d5;font-weight:400;padding:0 0 0 7px}
.guest-book .chats .message ul li.guest-point > span:nth-last-child(2) {margin-right:10px}
.guest-book .chats .message ul li.guest-point > span:nth-last-child(2):after {display:none}
.guest-book .chats .message ul li.guest-point > .mobile-block:after {display:none}
.guest-book .chats .message ul li.guest-point span.badge:after {display:none}
.guest-book .chats .message ul li.guest-point span.badge {border-radius:0}
.eyoom-form .guest-book .chats .message ul li i {display:inline;margin:0;width:inherit;height:inherit;border:0;border-radius:0;font-size:inherit;line-height:inherit}
.eyoom-form .guest-book .chats .message {display:block;color:inherit}
.guest-book .chats .right .name {text-align:right}
.guest-book .chats .right .date-time {float:left}
.guest-book .chats .right .image {float:right}
.guest-book .chats .right .image+.message {margin-right:78px;margin-left:0}
.guest-book .chats .right .message:after,.guest-book .chats .right .message:before {left:auto;right:-14px;border-right-color:transparent;border-left-color:#c5c5c5}
.guest-book .chats .right .message:after {right:-13px;border-left-color:#fff}
@media (max-width:767px) {
	.guest-book .chats .message ul li {float:inherit;margin-bottom:5px}
	.guest-book .chats .message ul li:last-child {margin-bottom:0}
	.guest-book .chats .message .mobile-block {display:block;margin-top:5px}
}

</style>

<div class="eb-attendance">
	<form name="attendanceform" method="post" id="attendanceform" class="eyoom-form" action="<?php echo get_pretty_url('page', 'attendance'); ?>" onsubmit="return check_attendance(this);">
	<input type="hidden" name="act" id="act" value="write">
	<input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
	<input type="hidden" name="smode" id="smode" value="">
	
	<?php if (!$is_attended) { ?>
	<div class="panel">
		<div class="panel-heading">
			<h4 class="f-w-700 float-start">출석 한마디!</h4>
			<div class="float-end">
				<button type="button" class="btn-e btn-e-md btn-e-gray" data-bs-toggle="modal" data-bs-target="#attendance_modal"><i class="far fa-file-alt m-r-7"></i>출석정책</button>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="panel-body">
			<label class="textarea m-b-0">
				<textarea name="wr_content" id="wr_content" rows="2"></textarea>
			</label>
			<?php if ($is_member) { //회원일 경우 ?>
			<div class="float-start m-t-10">
				<button type="button" id="random_words" class="btn-e btn-e-sm btn-e-dark"><i class="fas fa-random m-r-7"></i>랜덤 한마디</button>
			</div>
			<?php } ?>
			<?php if (!$atime) { ?>
			<div class="float-end f-s-13r text-gray m-t-15">
				<i class="fas fa-exclamation-circle m-r-7"></i><?php echo $msg; ?>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
		</div>
    </div>
    
	<?php if ($is_member) { //회원일 경우 ?>
	<div class="attendance-btn">
		<?php if (!$atime) { ?>
		<button type="button" class="btn-e btn-e-xxlg btn-e-indigo disabled" disabled>출석체크 하기<i class="far fa-calendar-check"></i></button>
		<?php } else { ?>
		<button type="submit" class="btn-e btn-e-xxlg btn-e-indigo">출석체크 하기<i class="far fa-calendar-check"></i></button>
		<?php } ?>
	</div>
	<?php } ?>
	<?php } ?>

	<div class="panel panel-dark m-t-30 m-b-30">
		<div class="panel-heading">
			<div class="row">
				<div class="col-lg-6 lg-m-b-10">
					<h5><strong><?php echo $date['year']; ?>년 <?php echo $date['month']; ?>월 <?php echo $date['day']; ?>일</strong></h5>
				</div>
				<div class="col-lg-6 m-0">
					<p class="m-0 text-end"><i class="far fa-clock"></i> 출석 적용시간 : <span class="text-light-green"><?php echo $attendance['stime']; ?> ~ <?php echo $attendance['etime']; ?></span></p>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<p class="text-gray m-b-10"><i class="far fa-smile text-teal m-r-7"></i><span>오늘의 명언</span></p>
			<p id="today_words"></p>
		</div>
	</div>

    <?php if ($is_member) { //회원일 경우 ?>
	<p class="f-s-17r m-b-15">
		<strong><?php echo $eyoomer['mb_nick'] ? $eyoomer['mb_nick']: $eyoomer['mb_name']; ?></strong> 님의 출석부 - 개근 <strong class="text-crimson"><?php echo number_format($ainfo['atd_count']); ?></strong>일째
	</p>
	<?php } ?>

	<div id="inline" class="m-b-30"></div>
    
    <div class="row m-b-30">
		<div class="col-lg-4 lg-m-b-20">
			<label class="label">출석일자</label>
			<label class="input m-b-5">
				<i class="icon-append far fa-calendar-alt"></i>
				<input type="text" name="date" id="date" onchange="gotodate(this.value);" value="<?php echo $date['year']; ?>-<?php echo $date['month']; ?>-<?php echo $date['day']; ?>">
			</label>
			<div class="note m-b-10"><strong>Note:</strong> 날짜를 선택하여 주세요.</div>
		</div>
		<div class="col-lg-4 lg-m-b-30">
			<label class="label">[<?php echo date('Ym') == date('Ym', $d_stime) ? '이번달': date('Y년 m월', $d_stime); ?>] 개근일 순위</label>
			<div class="guest-ranking">
				<?php if (count($rank_day) > 0) { foreach ($rank_day as $k => $rank) { ?>
				<div class="ranking-list ellipsis">
					<span class="ranking-num"><?php echo $k+1; ?></span><span class="ranking-days"><?php echo number_format($rank['count']); ?>일</span><span><?php echo $rank['atd_wr_name']; ?></span>
				</div>
				<?php }} else { ?>
				<p class="text-light-gray m-t-10"><i class="fas fa-exclamation-circle m-r-7"></i>출석회원이 없습니다.</p>
				<?php } ?>
			</div>
		</div>
		<div class="col-lg-4">
			<label class="label">[<?php echo date('Ym') == date('Ym', $d_stime) ? '이번달': date('Y년 m월', $d_stime); ?>] 1등 횟수 순위</label>
			<div class="guest-ranking">
				<?php if (count($rank_one) > 0) { foreach ($rank_one as $k => $rank) { ?>
				<div class="ranking-list ellipsis">
					<span class="ranking-num"><?php echo $k+1; ?></span><span class="ranking-days"><?php echo number_format($rank['count']); ?>회</span><span><?php echo $rank['atd_wr_name']; ?></span>
				</div>
				<?php }} else { ?>
				<p class="text-light-gray m-t-10"><i class="fas fa-exclamation-circle m-r-7"></i>출석회원이 없습니다.</p>
				<?php } ?>
			</div>
		</div>
    </div>
    
	<div class="attendance-sub-title"><h5><strong>출석회원 목록</strong></h5></div>
	<div class="guest-book">
		<div class="chats">
		<?php if (count($list) > 0) { foreach ($list as $i => $ranking) { ?>
			<?php if ($atd_list_type == 'zigzag') { ?>
			<div class="guest <?php echo $i%2==0 ? 'left': 'right'; ?>">
			<?php } else if ($atd_list_type == 'basic') { ?>
			<div class="guest left">
			<?php } ?>
				<span class="date-time"><i class="far fa-clock margin-left-5"></i> <?php echo $eb->date_format('Y-m-d H:i:s', $ranking['atd_datetime']); ?></span>
				<span class="name">
					<?php if ($atd_list_type == 'zigzag') { ?>
					<?php if ($i%2 == 0) { ?>
					<span class="badge badge-dark"><?php echo $ranking['ranking']; ?> 등</span> - <?php echo $ranking['atd_wr_name']; ?>
					<?php } else { ?>
					<?php echo $ranking['atd_wr_name']; ?> - <span class="badge badge-dark"><?php echo $ranking['ranking']; ?> 등</span>
					<?php } ?>
					<?php } else if ($atd_list_type == 'basic') { ?>
					<span class="badge badge-dark"><?php echo $ranking['ranking']; ?> 등</span> - <?php echo $ranking['atd_wr_name']; ?>
					<?php } ?>
				</span>
				<div class="m-b-10"></div>
				<a class="image">
					<?php echo $ranking['mb_photo'] ? $ranking['mb_photo']: '<i class="fas fa-user"></i>'; ?>
				</a>
				<div class="message">
					<span><?php echo stripslashes($ranking['atd_content']); ?></span>
					<div class="guest-clear-line"></div>
					<ul class="message-info">
						<li><strong>개근</strong> <strong class="text-crimson"><?php echo number_format($ranking['atd_count']); ?></strong>일째</li>
						<li class="guest-point">
							<span class="badge badge-gray">출석<?php echo $levelset['gnu_name']; ?></span>
							<span>기본<?php echo !$attendance['point_type'] ? '랜덤': ''; ?> <strong class="text-orange"><?php echo number_format($ranking['def_point']); ?></strong>점</span>
							<?php if ($attendance['ranking_use'] > 0 && $ranking['ranking_point']) { ?>
							<span><?php echo $ranking['ranking']; ?>등 <strong class="text-orange"><?php echo number_format($ranking['ranking_point']); ?></strong>점</span>
							<?php } ?>
							<?php if ($attendance['lucky_use'] == 'y' && $ranking['lucky_point']) { ?>
							<span>어머나 <strong class="text-orange"><?php echo number_format($ranking['lucky_point']); ?></strong>점</span>
							<?php } ?>
							<?php if ($attendance['hard_use'] == 'y' && $ranking['hard_point']) { ?>
							<span>부지런 <strong class="text-orange"><?php echo number_format($ranking['hard_point']); ?></strong>점</span>
							<?php } ?>
							<?php if ($attendance['group_use'] == 'y' && $ranking['group_point']) { ?>
							<span>선착순 <strong class="text-orange"><?php echo number_format($ranking['group_point']); ?></strong>점</span>
							<?php } ?>
							<?php if ($attendance['someday_use'] == 'y' && $ranking['someday_point']) { ?>
							<span>어느날 <strong class="text-orange"><?php echo number_format($ranking['someday_point']); ?></strong>점</span>
							<?php } ?>
							<span class="mobile-block">
								<span class="badge badge-gray">포인트합계</span> <strong class="text-crimson"><?php echo number_format($ranking['point_sum']); ?>점</strong>
							</span>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php }} else { ?>
			<div class="text-center text-gray m-t-50 m-b-50">
				<i class="fas fa-exclamation-circle m-r-7"></i><?php echo $atime ? '출석체크한 회원이 없습니다.': '출석 가능한 시간이 아닙니다.'; ?>
			</div>
		<?php } ?>
		</div>
	</div>

	<div id="attendance_modal" class="modal fade attendance-modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<div id="attendance-config">
						<div class="table-list-eb">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="width-150px">항목</th>
										<th>내용</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>출석대상</td>
										<td>모든회원</td>
									</tr>
									<tr>
										<td>출석시간</td>
										<?php if (!$is_admin) { ?>
										<td><?php echo $eb->date_format('H시 i분',$attendance['stime']); ?> ~ <?php echo $eb->date_format('H시 i분',$attendance['etime']); ?></td>
										<?php } else { ?>
										<td>
											<select name="stime">
												<?php for ($i=0; $i<24; $i++) { ?>
												<option value="<?php echo $i.':00'; ?>" <?php echo $i == substr($attendance['stime'],0,2)*1 ? 'selected': ''; ?>><?php echo $i<10 ? '0'.$i: $i; ?>:00</option>
												<?php } ?>
											</select> ~
											<select name="etime">
												<?php for ($i=0; $i<24; $i++) { ?>
												<option value="<?php echo $i+1; ?>:00" <?php echo $i+1 == substr($attendance['etime'],0,2)*1 ? 'selected': ''; ?>><?php echo $i<10 ? '0'.$i: $i; ?>:00</option>
												<?php } ?>
											</select>
										</td>
										<?php } ?>
									</tr>
									<tr>
										<td>적용방식</td>
										<?php if (!$is_admin) { ?>
										<td><?php echo $attendance['point_type'] ? '고정점수':'랜덤점수'; ?></td>
										<?php } else { ?>
										<td>
											<select name="point_type" onchange="apply_point_type(this.value);">
												<option value="0" <?php echo $attendance['point_type'] == 0 ? 'selected': ''; ?>>랜덤<?php echo $levelset['gnu_name']; ?></option>
												<option value="1" <?php echo $attendance['point_type'] == 1 ? 'selected': ''; ?>>고정<?php echo $levelset['gnu_name']; ?></option>
											</select>
										</td>
										<?php } ?>
									</tr>
									<tr>
										<td>기본<?php echo $levelset['gnu_name']; ?></td>
										<?php if (!$is_admin) { ?>
										<td><?php echo number_format($attendance['point_default']); ?><?php echo $levelset['gnu_name']; ?> <span class="random_text"><?php echo !$attendance['point_type'] ? '이내 랜덤': ''; ?></td>
										<?php } else { ?>
										<td><input type="text" name="point_default" style="width:58px;margin:2px;" value="<?php echo $attendance['point_default']; ?>"> <?php echo $levelset['gnu_name']; ?></td>
										<?php } ?>
									</tr>
									<?php if ($attendance['hard_use'] == 'y' || $is_admin) { ?>
									<tr>
										<td>부지런_상<br>
											<?php if ($is_admin) { ?>
											<input type="checkbox" name="hard_use" id="hard_use" value="y" <?php echo $attendance['hard_use'] == 'y' ? 'checked': ''; ?>><span> 사용</span>
											<?php } ?>
										</td>
										<?php if (!$is_admin) { ?>
										<td>개근일 <?php echo number_format($attendance['hard_cond']); ?>일 간격으로<br>기본 + <?php echo number_format($attendance['hard_point']); ?>점 <?php echo !$attendance['point_type'] ? '이내 랜덤': ''; ?></td>
										<?php } else { ?>
										<td><span>개근일</span> <input type="text" name="hard_cond" style="width:30px;margin:2px;" value="<?php echo $attendance['hard_cond']; ?>"><span>일 간격으로</span><br><span>기본 + </span><input type="text" name="hard_point" style="width:58px;margin:2px;" value="<?php echo $attendance['hard_point']; ?>"><span>점 </span><span class="random_text"><?php echo !$attendance['point_type'] ? '이내 랜덤': ''; ?></span></td>
										<?php } ?>
									</tr>
									<?php } ?>
									<?php if ($attendance['group_use'] == 'y' || $is_admin) { ?>
									<tr>
										<td>선착순_상<br>
											<?php if ($is_admin) { ?>
											<input type="checkbox" name="group_use" value="y" <?php echo $attendance['group_use'] == 'y' ? 'checked': ''; ?>><span> 사용</span>
											<?php } ?>
										</td>
										<?php if (!$is_admin) { ?>
										<td><?php echo number_format($attendance['group_cond']); ?>명이상 출석 시,<br>선착순 <?php echo number_format($attendance['group_cond']); ?>명에게 + <?php echo number_format($attendance['group_point']); ?>점 <?php echo !$attendance['point_type'] ? '이내 랜덤': ''; ?></td>
										<?php } else { ?>
										<td><input type="text" name="group_cond" style="width:30px;margin:2px;" value="<?php echo $attendance['group_cond']; ?>"><span>명이상 출석 시 선착순 내 <br>회원에게 + </span><input type="text" name="group_point" style="width:58px;margin:2px;" value="<?php echo $attendance['group_point']; ?>"><span>점 </span><span class="random_text"><?php echo !$attendance['point_type'] ? '이내 랜덤': ''; ?></span></td>
										<?php } ?>
									</tr>
									<?php } ?>
									<?php if ($attendance['lucky_use'] == 'y' || $is_admin) { ?>
									<tr>
										<td>행운_상<br>
											<?php if ($is_admin) { ?>
											<input type="checkbox" name="lucky_use" value="y" <?php echo $attendance['lucky_use'] == 'y' ? 'checked': ''; ?>><span> 사용</span>
											<?php } ?>
										</td>
										<?php if (!$is_admin) { ?>
										<td>기본 + 10%확율의 행운<?php echo $levelset['gnu_name']; ?><br><?php echo number_format($attendance['lucky_point']); ?>점 <?php echo !$attendance['point_type'] ? '이내 랜덤': '';?></td>
										<?php } else { ?>
										<td>기본 + 10%확율의 행운<?php echo $levelset['gnu_name']; ?><br><input type="text" name="lucky_point" style="width:58px;margin:2px;" value="<?php echo $attendance['lucky_point']; ?>"><span>점 </span><span class="random_text"><?php echo $attendance['point_type'] ? '이내 랜덤': ''; ?></span></td>
										<?php } ?>
									</tr>
									<?php } ?>
									<?php if ($attendance['someday_use'] == 'y' || $is_admin) { ?>
									<tr>
										<td>어느날_상<br>
											<?php if ($is_admin) { ?>
											<input type="checkbox" name="someday_use" value="y" <?php echo $attendance['someday_use'] == 'y' ? 'checked': ''; ?>><span> 사용</span>
											<?php } ?>
										</td>
										<?php if (!$is_admin) { ?>
										<td><?php echo $eb->date_format("Y년 m월 d일",$attendance['someday_date']); ?> 해당일에<br>기본 + <?php echo number_format($attendance['someday_point']); ?>점 <?php echo $attendance['point_type'] ? '이내 랜덤': ''; ?></td>
										<?php } else { ?>
										<td><input type="text" name="someday_date" style="width:80px;margin:2px;" value="<?php echo $eb->date_format('Y/m/d',$attendance['someday_date']); ?>"><span> 해당일에</span><br><span>기본 + </span><input type="text" name="someday_point" style="width:58px;margin:2px;" value="<?php echo $attendance['someday_point']; ?>"><span>점 </span><span class="random_text"><?php echo $attendance['point_type'] ? '이내 랜덤': ''; ?></span></td>
										<?php } ?>
									</tr>
									<?php } ?>
								<?php if (!$is_admin) { ?>
									<?php foreach ($rank_point as $k => $rpoint) { ?>
									<tr>
										<td class="td-border-right"><?php echo $k; ?>등 보너스</td>
										<td>기본<?php echo $levelset['gnu_name']; ?> + <?php echo number_format($rpoint); ?>점</td>
									</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td>적용랭킹</td>
										<td>
											<span>랭킹 보너스는 </span>
											<select name="ranking_use">
												<?php for ($i=0; $i<10; $i++) { ?>
												<option value="<?php echo $i+1; ?>" <?php echo $attendance['ranking_use'] == $i+1 ? 'selected': ''; ?>><?php echo $i+1; ?></option>
												<?php } ?>
											</select>
											<span>위까지 지급</span>
										</td>
									</tr>
									<?php foreach ($rank_point as $k => $rpoint) { ?>
									<tr>
										<td><?php echo $k; ?>등 보너스</td>
										<td><span>기본<?php echo $levelset['gnu_name']; ?> + </span><input type="text" name="ranking<?php echo $k; ?>_point" style="width:58px;margin:2px;" value="<?php echo $rpoint; ?>"><span>점</span></td>
									</tr>
									<?php } ?>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<?php if ($is_admin) { ?>
						<div class="text-center m-t-10">
							<button type="button" class="config_save btn-e btn-e-lg btn-e-red"><i class="fas fa-check"></i> 설정저장</button>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
				</div>
			</div>
		</div>
	</div>
    </form>
</div>

<form name="gotodateform" action="<?php echo get_pretty_url('page', 'attendance'); ?>" method="post">
<input type="hidden" name="d" value="">
</form>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
function gotodate(day) {
	if(!day) {
		alert('날짜를 선택해 주세요.');
		return;
	} else {
		var form = document.gotodateform;
		var date = day.split("-");
		var d = date[0]+''+date[1]+''+date[2];
		form.d.value = d;
		form.submit();
	}
}

$(function() {
	if(!$("#wr_content").val()) {
		set_words();
	}

	$("#random_words").on('click', function() { 
		set_words();
	});
	
	$("#wr_content").on('click', function(){
		$("#wr_content").select();
	});
	
	$(".attendance-ranking img").addClass('img-fluid');

    $('#date').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토']
    });

	var enableDay = [<?php echo $atd_date; ?>];
	var this_day = [<?php echo $this_day; ?>];
	var y = parseInt('<?php echo date('Y', strtotime($d)); ?>');
	var m = parseInt('<?php echo date('n', strtotime($d));?>')-1;
	var d = parseInt('<?php echo date('j', strtotime($d)); ?>');
	var x = new Date(y, m, d, 0, 0, 0, 0);

    $("#inline").datepicker({
        dateFormat: 'yy-mm-dd',
        beforeShowDay: selectableDays,
		prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
		onSelect: function (date) {
			gotodate(date);
		},
    });

	$("#inline").datepicker('setDate', x);

	function selectableDays(date) {
		var dummy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();

		if ($.inArray(dummy, this_day) > -1) {
			return [true, "ui-state-this"];
		} else if ($.inArray(dummy, enableDay) > -1) {
			return [true, "ui-state-enabled"];
		} else {
			return [true, "ui-state-disabled"];
		}
	}

	$(".ui-datepicker-calendar a").on("click", function() {
		var date = '<?php echo substr($d ? $d: $today, 0, 6); ?>';
		var day = parseInt($(this).text());
		if (day < 10) date = date + '0'+day;
		if (day >= 10) date = date + day;
		gotodate(date);
	});

	<?php if ($is_member) { ?>
	// 관리자일경우
	$(".config_save").click(function(){
		$("#act").val("config");
		$("#smode").val("1");
		var form = $("#attendanceform");
		form.submit();
	});

	$(".dropdown-attendance").click(function(){
		$("#attendance-config").toggle('show');
	});
	<?php } ?>
});

function set_words() {
	var obj = $("#wr_content");
	var url = '<?php echo get_pretty_url('page', 'attendance'); ?>';
	obj.val('');

    $.post(url, { act: "words", smode: 1 }, function(data) {
		obj.val(data.words);
		if(!$("#today_words").text()) {
			$("#today_words").text(data.today_words);
		}
	}, "json");
}

function check_attendance(form) {
	if(form.act == 'write') {
		if(form.mb_id.value=='') {
			alert('비회원은 출석체크를 하실 수 없습니다.');
			return false;
		}
		if(form.wr_content.value=='') {
			alert('출석글을 입력해 주세요.');
			form.wr_content.focus();
			return false;
		}
	}
}

function apply_point_type(val) {
	switch(val) {
		case '1': $(".random_text").text(""); break;
		case '0': $(".random_text").text("이내 랜덤"); break;
	}
}
</script>