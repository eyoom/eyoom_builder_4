<?php
/**
 * skin file : /theme/THEME_NAME/skin/bbspoll/basic/bbspoll.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.poll-box-wrap {position:relative;padding:15px;border:1px solid #000;margin-bottom:30px}
.poll-box-title {text-align:center;margin-bottom:20px}
.poll-box-title h5 {font-size:1.25rem;font-weight:500}
.poll-box-title .poll-box-info {margin-top:5px}
.poll-item {position:relative;margin-bottom:20px}
.poll-item .radio {cursor:pointer}
.poll-item .radio strong {font-size:1.125rem}
.poll-item .poll-item-img {position:relative;overflow:hidden;display:flex;width:120px;height:120px;border:4px solid #fff;box-shadow:0 0 0 1px rgba(0,0,0,0.3);margin:0 auto 15px}
.poll-item .poll-item-img-in {display:flex;align-items:center}
.video-box-wrap {margin-bottom:30px}
.video-box-wrap .responsive-video {margin:0}
.image-box-wrap {text-align:center;margin-bottom:30px}
</style>

<div class="poll-box-wrap">
    <div class="poll-box-title">
        <h5><?php echo date("Y.m.d", strtotime($view['wr_datetime'])) ?> ~ <?php echo date("Y.m.d", strtotime($view['wr_poll_limit'])) ?></h5>
        <div class="poll-box-info">
        <?php
        if($is_admin || $view['wr_poll_limit'] <= G5_TIME_YMD || $row['cnt'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}") {
            echo "(".number_format($poll_total)."명 참여)";
        } else if ($mypoll['mb_id']) {
            echo "이미 [{$mypoll['po_datetime']}]에 투표에 참여하셨습니다.";
        } else {
            echo "투표하시면 결과가 보입니다.";
        }
        ?>
        <?php if ($eyoom_board['bo_addon_poll_point'] > 0) { ?>
        <div class="text-gray f-s-13r m-t-5">
            <?php if ($mypoll['mb_id'] && $mypoll['po_point'] > 0) { // 투표에 참여함 ?>
            투표 참여<?php echo $levelset['gnu_name']; ?>로 <strong class="text-crimson"><?php echo number_format($mypoll['po_point']); ?><?php echo $levelset['gnu_name']; ?></strong>를 지급해 드렸습니다.
            <?php } else { // 투표에 참여하지 않음 ?>
            <?php if ($eyoom_board['bo_addon_poll_type'] == '1') { ?>
            투표에 참여하시면 <strong class="text-crimson"><?php echo number_format($eyoom_board['bo_addon_poll_point']); ?><?php echo $levelset['gnu_name']; ?></strong>내에서 랜덤하게 <?php echo $levelset['gnu_name']; ?>를 지급해 드립니다.
            <?php } else if ($eyoom_board['bo_addon_poll_type'] == '2') { ?>
            투표에 참여하시면 <strong class="text-crimson"><?php echo number_format($eyoom_board['bo_addon_poll_point']); ?><?php echo $levelset['gnu_name']; ?></strong>를 참여<?php echo $levelset['gnu_name']; ?>로 지급해 드립니다.
            <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
        </div>
    </div>

    <?php if($view['wr_poll_limit'] <= G5_TIME_YMD || $mypoll['mb_id'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}") { ?>
    <?php } else { ?>
    <form name="fpollskin" method="post" action="<?php echo $poll_action_url; ?>" onsubmit="return fpollskin_check(this.form);" target="hiddenframe">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <?php } ?>

    <?php if($view['wr_poll_text']) { // wr_poll_text 이미지없는 투표시작 ?>
    <div class="poll">
        <?php
        $ans = explode(",", $view['wr_poll_text']);
        for ($i=0; $i<count($ans); $i++) {
        ?>
        <div class="poll-item poll_te" onclick="tab_img_change(<?php echo $i+1; ?>);">
            <label for="ans<?php echo $i; ?>" class="radio width-100">
                <?php if($view['wr_poll_limit'] <= G5_TIME_YMD || $mypoll['mb_id'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}"){ // 종료,참여했으면 라디오 버튼 없음 ?>
                <?php } else { ?>
                <?php // 라디오 버튼 출력
                    echo "<input type='radio' name='ans' id='ans".$i."' value='".$i."'><i></i>";
                ?>
                <?php } ?>
                <strong><?php echo $ans[$i]; // 투표제목 ?></strong>
            </label>
            <?php
            if($is_admin || $view['wr_poll_limit'] <= G5_TIME_YMD || $mypoll['mb_id'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}") {
            ?>
                <?php
                if($view['wr_poll_result']) {
                    if ($poll_total > 0) {
                        $rate = ((int)$poll_tmp[$i] / $poll_total) * 100;
                        $bar = ((int)$poll_tmp[$i] / $poll_total) * 100;
                    } 
                ?>
                <div class="progress-info-wrap">
                    <span class="progress-info-left f-s-15r"><?php echo number_format($poll_tmp[$i]); ?>표</span>
                    <span class="progress-info-right f-s-15r"><?php echo number_format($rate); ?>%</span>
                </div>
                <div class="progress" style="height:8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?php echo $bar; ?>%" aria-valuenow="<?php echo $bar; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php } // for ?>
    </div>
    <?php } else { // wr_poll_text 이미지없는 투표끝 ?>
    <div class="poll row">
        <?php
        $v_img_count = count($view['file']);
        if($v_img_count) { // 이미지
            for ($i=0; $i<=count($view['file']); $i++) { // for 시작
                if ($view['file'][$i]['view']) { // 이미지 파일
                    $imgURL = $view['file'][$i]['path']."/".$view['file'][$i]['file'];
        ?>
        <div class="col-lg-6">
            <div class="poll-item poll_te" onclick="tab_img_change(<?php echo $i+1; ?>);">
                <label for="ans<?php echo $i; ?>" class="radio width-100 m-b-10">
                    <div class="poll-item-img">
                        <div class="poll-item-img-in">
                            <img src="<?php echo $imgURL; ?>" class="img-fluid" alt="image">
                        </div>
                    </div>
                    <?php if($view['wr_poll_limit'] <= G5_TIME_YMD || $mypoll['mb_id'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}"){ // 종료,참여했으면 라디오 버튼 없음 ?>
                    <?php } else { ?>
                    <?php // 라디오 버튼 출력
                        echo "<input type='radio' name='ans' id='ans".$i."' value='".$i."'><i></i>";
                    ?>
                    <?php } ?>
                    <strong><?php echo $view['file'][$i]['content']; // 투표제목 ?></strong>
                </label>
                <?php
                if($is_admin || $view['wr_poll_limit'] <= G5_TIME_YMD || $mypoll['mb_id'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}") {
                    if($view['wr_poll_result']) {
                        if ($poll_total > 0) {
                            $rate = ((int)$poll_tmp[$i] / $poll_total) * 100;
                            $bar = ((int)$poll_tmp[$i] / $poll_total) * 100;
                        }
                    ?>
                <div class="progress-info-wrap">
                    <span class="progress-info-left f-s-15r"><?php echo number_format($poll_tmp[$i]); ?>표</span>
                    <span class="progress-info-right f-s-15r"><?php echo number_format($rate); ?>%</span>
                </div>
                <div class="progress" style="height:8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?php echo $bar; ?>%" aria-valuenow="<?php echo $bar; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
                <?php } // 이미지 ?>
            <?php } // for ?>
        <?php } // 이미지 ?>
    </div>
    <?php } // wr_poll_text 끝 ?>
    <?php
    if($view['wr_poll_limit'] <= G5_TIME_YMD) {
        echo "<div class='text-center text-gray f-s-13r m-t-20'>";
        echo "<i class='fas fa-exclamation-circle m-r-5'></i>종료된 투표 입니다.";
        echo "</div>";
    } else {
        if($mypoll['mb_id'] || get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}") {
            echo "<div class='text-center text-gray f-s-13r m-t-20'>";
            echo "<i class='fas fa-exclamation-circle m-r-5'></i>투표에 참여하셨습니다.";
            echo "</div>";
        } else if($member['mb_level'] >= $board['bo_poll_level']) {
            echo "<input type='hidden' name='max_ans' value='".$i."'>";
            echo "<div class='text-center m-t-20'>";
            echo "<input type='submit' value='투표하기' class='btn-e btn-e-navy btn-e-xl width-150px'>";
            echo "</div>";
            echo "</form>";
        } else {
            echo "<div class='text-center text-indigo f-s-13r m-t-20'>";
            echo "<i class='fas fa-exclamation-circle m-r-5'></i>투표하기 권한이 없습니다.";
            echo "</div>";
            echo "</form>";
        }
    }
    ?>
</div>

<script>
$(function() {
    tab_img_change(0);
});

function tab_img_change(t) {
    for (var i = 1; i <= 100; i++) {
        var element = document.getElementById('tab_view' + i);
        if (element) {  // element가 존재하는지 확인
            element.style.display = "none";
            if (t == i) {
                element.style.display = "";
            }
        }
    }
}

function fpollskin_check(f) {
    var ans = document.getElementsByName('ans');
    var chk = false;
    for (i=0;i<ans.length;i++) {
        if (ans[i].checked) {
            chk = true;
            break;
        }
    }
    if (!chk) {
        alert("투표하실 항목을 선택하십시오.");
        return false;
    }
    return true;
}
</script>

<?php if ($view['wr_poll_video']) { ?>
<div class="video-box-wrap">
    <?php
    $strTok =explode("|", $view['wr_poll_video']);
    $cnt_ck = count($strTok);
    $view_dd = array();
    for($i = 0 ; $i < $cnt_ck ; $i++){
        unset($video_url, $video);
        $jj = $i + 1;
        $video_url[1] = $strTok[$i];
        $video = $bbs->video_content($video_url);
        $view_dd[] = '<div id="tab_view'.$jj.'" style="display:none"><div class="responsive-video">'.$video.'</div></div>';
    }
    $view_dd = implode($view_dd);

    $view_content = $view_dd;
    $ab_get = ' style="display:none"';
    $ch_get = '';

    if (($pkc=strpos($view_content,$ab_get))!==false) {
        $view_content = substr_replace($view_content,$ch_get,$pkc,strlen($ab_get));
    }
    echo $view_content;
    ?>
</div>
<?php } else if ($view['file']['0']['view']) { ?>
<div class="image-box-wrap">
    <?php for ($i=0; $i<=count($view['file']); $i++) { // for 시작
        if ($view['file'][$i]['view']) { // 파일 체크 시작
            $jj = $i + 1;
            $view_dd[] = '<div id="tab_view'.$jj.'" style="display:none"><a href="'.$view['file'][$i]['path']."/".$view['file'][$i]['file'].'" class="poll-image-zoom"><img src="'.$view['file'][$i]['path']."/".$view['file'][$i]['file'].'" class="img-fluid"></a></div>';
        }
    }

    $view_dd = implode($view_dd);

    $view_content = $view_dd;
    $ab_get = ' style="display:none"';
    $ch_get = '';
    if (($pkc=strpos($view_content,$ab_get))!==false) {
        $view_content = substr_replace($view_content,$ch_get,$pkc,strlen($ab_get));
    }
    echo $view_content;
    ?>
</div>
<?php } ?>
<iframe width='0' height='0' name='hiddenframe' id='hiddenframe' style='display:none;'></iframe>