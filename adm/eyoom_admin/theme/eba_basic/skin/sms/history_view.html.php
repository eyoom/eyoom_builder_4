<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/history_view.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'history_list';
$g5_title = '전송내역-건별';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.sms5-sent-info {position:relative;padding:15px;border:1px solid var(--tbc-default)}
.sms5-sent-info .sent-info-li {margin-right:15px}
.sms5-sent-info .sent-info-li .ov-txt {margin-right:5px}
.sms5-sent-info .sent-info-li .ov-num {color:#ab0000;font-weight:700}
/* page */
.pg_wrap {clear:both;margin:20px 0 0;padding:0;text-align:center}
.pg {display:inline-block}
.pg_page, .pg_current {font-size:.75rem;color:#fff;background-color:#353535;display:inline-block;float:left;padding:0;width:32px;height:26px;line-height:26px;text-decoration:none;border:0;margin:1px}
.pg a:focus, .pg a:hover {background-color:none}
.pg_current {display:inline-block;background:#3949ab;color:#fff;font-weight:400}
</style>

<script>
function re_send() {
    <?php if (!$write['wr_failure']) { ?>
    alert('실패한 전송이 없습니다.');
    <?php } else { ?>
    if (!confirm('전송에 실패한 SMS 를 재전송 하시겠습니까?'))
        return;

    //act = window.open('<?php echo G5_ADMIN_URL; ?>/sms_admin/sms_ing.php', 'act', 'width=300, height=200');
    //act.focus();

    location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=history_send&w=f&page=<?php echo $page?>&st=<?php echo  $st?>&sv=<?php echo $sv?>&wr_no=<?php echo $wr_no?>&wr_renum=<?php echo $wr_renum?>&smode=1';
    <?php } ?>
}

function all_send() {
    if (!confirm('전체 SMS 를 재전송 하시겠습니까?\n\n예약전송일 경우 예약일시는 다시 설정하셔야 합니다.'))
        return;
    location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=sms_write&wr_no=<?php echo $wr_no?>';
}
</script>

<div class="admin-history-view">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="wr_no" value="<?php echo get_sanitize_input($wr_no); ?>">
    <input type="hidden" name="wr_renum" value="<?php echo get_sanitize_input($wr_renum); ?>">
    <input type="hidden" name="page" value="<?php echo get_sanitize_input($page); ?>">
    <input type="hidden" name="st" value="<?php echo get_sanitize_input($st); ?>">
    <input type="hidden" name="sv" value="<?php echo get_sanitize_input($sv); ?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr tr-l">
            <div class="adm-form-td td-l">
                <label for="stx" class="label">검색어</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="select width-150px">
                            <select name="sst" id="sst">
                                <option value="hs_name" <?php echo get_selected('hs_name', $sst); ?>>이름</option>
                                <option value="hs_hp" <?php echo get_selected('hs_hp', $sst); ?>>휴대폰번호</option>
                            </select><i></i>
                        </label>
                    </span>
                    <span>
                        <label class="input max-width-250px">
                            <input type="text" name="ssv" value="<?php echo get_sanitize_input($ssv); ?>" id="ssv">
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
    <div class="m-b-20"></div>

    <div class="sms5-sent-info m-b-20">
        <span class="sent-info-li"><span class="ov-txt">전송건수 </span><span class="ov-num"> <?php echo number_format($write['wr_total'])?> 건</span></span>
        <span class="sent-info-li"><span class="ov-txt">성공건수 </span><span class="ov-num"><?php echo number_format($write['wr_success'])?> 건</span></span>
        <span class="sent-info-li"><span class="ov-txt">실패건수 </span><span class="ov-num"><?php echo number_format($write['wr_failure'])?> 건</span></span>
        <span class="sent-info-li"><span class="ov-txt">전송일시 </span><span class="ov-num"><?php echo $write['wr_datetime']?></span></span>
        <span class="sent-info-li"><span class="ov-txt">예약일시 </span><span class="ov-num"><?php echo $write['wr_booking']?></span></span>
        <span class="sent-info-li"><span class="ov-txt">회신번호 </span><span class="ov-num"><?php echo $write['wr_reply']?></span></span>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>전송내용</strong></div>
        <div class="adm-form-cont">
            <div id="con_sms" class="eyoom-form">
                <span class="box_ico"></span>
                <label class="textarea">
                    <textarea class="box_txt is_overview" readonly><?php echo html_purifier($write['wr_message']); ?></textarea>
                </label>
            </div>
        </div>
    </div>

    <?php if ($write['wr_re_total'] && !$wr_renum) { ?>
    <div class="adm-headline">
        <h3>전송실패 문자 재전송 내역</h3>
    </div>
    
    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb m-b-20">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th class="width-60px">관리</th>
                        <th>전송일시</th>
                        <th>총건수</th>
                        <th>성공</th>
                        <th>실패</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['re_vnum']; ?></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page?>&amp;st=<?php echo $st?>&amp;sv=<?php echo $sv?>&amp;wr_no=<?php echo $list[$i]['wr_no']?>&amp;wr_renum=<?php echo $list[$i]['wr_renum']?>"><u>수정</u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['wr_datetime']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['wr_total']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['wr_success']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['wr_failure']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($count == 0) { ?>
                    <tr>
                        <td colspan="6" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>

    <?php
    if ($write['wr_memo'] ) {
        $tmp_wr_memo = @unserialize($write['wr_memo']);
        if( count((array)$tmp_wr_memo) && is_array($tmp_wr_memo) ){
            if(function_exists('array_fill_keys')){
                $tmp_wr_hp = array_replace($tmp_wr_memo['hp'],array_fill_keys(array_keys($tmp_wr_memo['hp'], null),''));
            } else {
                $tmp_wr_hp = $tmp_wr_memo['hp'];
            }
            $arr_wr_memo = @array_count_values( $tmp_wr_hp );
    ?>
    <h6 class="m-b-20"><strong>중복번호 <?php echo $tmp_wr_memo['total'];?>건</strong></h6>

    <div id="sent_overlap" class="m-b-20">
        <?php
        foreach( $arr_wr_memo as $key=>$v){
        if( empty($v) || $key == '' ) continue;
        ?>
        <p class="li-p-sq"><b><?php echo $key;?></b> 중복 <?php echo $v;?>건</p>
        <?php } ?>
    </div>
    <?php
        }
    }
    ?>

    <div class="adm-headline">
        <h3>문자전송 목록 <?php echo $re_text?></h3>
    </div>

    <div class="text-end m-b-10">
        <a href="javascript:all_send()" class="btn-e btn-e-dark">전체 재전송</a>
        <a href="javascript:re_send()" class="btn-e btn-e-dark">실패내역 재전송</a>
        <?php if (!$wr_renum) {?>
        <a href="./history_list.php?page=<?php echo $page?>&amp;st=<?php echo $st?>&amp;sv=<?php echo $sv?>" class="btn-e btn-e-dark">목록</a>
        <?php } else { ?>
        <a href="./history_view.php?page=<?php echo $page?>&amp;st=<?php echo $st?>&amp;sv=<?php echo $sv?>&amp;wr_no=<?php echo $wr_no?>" class="btn-e btn-e-dark">뒤로가기</a>
        <?php } ?>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb m-b-20">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th class="width-60px">내역</th>
                        <th>그룹</th>
                        <th>이름</th>
                        <th>회원ID</th>
                        <th>휴대폰번호</th>
                        <th>전송일시</th>
                        <th>결과</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$hs_count; $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $hs_list[$i]['vnum']; ?></th>
                        <td class="text-center">
                            <?php if ($hs_list[$i]['bk_no']) { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_num&amp;wr_id=<?php echo $hs_list[$i]['wr_no']?>&amp;st=bk_no&amp;sv=<?php echo $hs_list[$i]['bk_no']?>"><u>내역</u></a><?php } else { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_num&amp;wr_id=<?php echo $hs_list[$i]['wr_no']?>&amp;st=hs_hp&amp;sv=<?php echo $hs_list[$i]['hs_hp']?>"><u>내역</u></a><?php } ?>
                        </td>
                        <td class="text-center"><?php echo $hs_list[$i]['bg_name']; ?></td>
                        <td class="text-center"><?php echo $hs_list[$i]['hs_name']; ?></td>
                        <td class="text-center"><?php echo $hs_list[$i]['mb_id']; ?></td>
                        <td class="text-center"><?php echo $hs_list[$i]['hs_hp']; ?></td>
                        <td class="text-center"><?php echo $hs_list[$i]['hs_datetime']; ?></td>
                        <td class="text-center">
                            <b>결과코드</b> : <?php echo $hs_list[$i]['hs_code']; ?><br><b>로그</b> : <?php echo $hs_list[$i]['hs_log']; ?><br><b>메모</b> : <?php echo $hs_list[$i]['hs_memo']; ?>
                        </td>
                        <td class="text-center"><?php echo $hs_list[$i]['hs_flag']?'성공':'실패'?></td>
                    </tr>
                    <?php } ?>
                    <?php if($hs_count == 0) { ?>
                    <tr>
                        <td colspan="9" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php /* 페이지 */ ?>
    <div class="m-t-20">
        <?php echo sms5_sub_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $spage, $total_spage, G5_ADMIN_URL."/?dir=sms&amp;pid=history_view&amp;wr_no=$wr_no&amp;wr_renum=$wr_renum&amp;page=$page&amp;st=$st&amp;sv=$sv&amp;sst=$sst&amp;ssv=$ssv", "", "spage"); ?>
    </div>
</div>