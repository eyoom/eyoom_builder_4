<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/history_view.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
#sms5_sent #con_sms {margin:0 0 20px}
.sms5-sent-info {position:relative;padding:10px;background:#fff;border:1px solid #cc2300;font-size:12px}
.sms5-sent-info .sent-info-li {margin-right:15px}
.sms5-sent-info .sent-info-li .ov_txt {font-weight:bold}
.sms5-sent-info .sent-info-li .ov_num {color:#cc2300;font-weight:bold}
.btn_add01 a {padding:5px 10px;font-size:12px}
.sms5_box textarea.box_txt.is_overview{overflow:visible;min-height:130px}
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

    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">검색어</label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sst" id="sst">
                                            <option value="hs_name" <?php echo get_selected('hs_name', $sst); ?>>이름</option>
                                            <option value="hs_hp" <?php echo get_selected('hs_hp', $sst); ?>>휴대폰번호</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="ssv" value="<?php echo get_sanitize_input($ssv); ?>" id="ssv">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>
    <div class="margin-bottom-30"></div>

    <div id="sms5_sent">
        <div class="sms5-sent-info">
            <span class="sent-info-li"><span class="ov_txt">전송건수 </span><span class="ov_num"> <?php echo number_format($write['wr_total'])?> 건</span></span>
            <span class="sent-info-li"><span class="ov_txt">성공건수 </span><span class="ov_num"><?php echo number_format($write['wr_success'])?> 건</span></span>
            <span class="sent-info-li"><span class="ov_txt">실패건수 </span><span class="ov_num"><?php echo number_format($write['wr_failure'])?> 건</span></span>
            <span class="sent-info-li"><span class="ov_txt">전송일시 </span><span class="ov_num"><?php echo $write['wr_datetime']?></span></span>
            <span class="sent-info-li"><span class="ov_txt">예약일시 </span><span class="ov_num"><?php echo $write['wr_booking']?></span></span>
            <span class="sent-info-li"><span class="ov_txt">회신번호 </span><span class="ov_num"><?php echo $write['wr_reply']?></span></span>
        </div>

        <div class="margin-top-40 margin-bottom-20">
            <h4><strong>전송내용</strong></h4>
        </div>

        <div id="con_sms" class="sms5_box">
            <span class="box_ico"></span>
            <textarea class="box_txt is_overview" readonly><?php echo $write['wr_message'];?></textarea>
        </div>

        <?php if ($write['wr_re_total'] && !$wr_renum) { ?>
        <div class="margin-top-40 margin-bottom-20">
            <h4><strong>전송실패 문자 재전송 내역</strong></h4>
        </div>
        
        <div id="history-view-list1"></div>
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
        <div class="margin-top-40 margin-bottom-20">
            <h4><strong>중복번호 <?php echo $tmp_wr_memo['total'];?>건</strong></h4>
        </div>

        <ul id="sent_overlap">
            <?php
            foreach( $arr_wr_memo as $key=>$v){
            if( empty($v) || $key == '' ) continue;
            ?>
            <li><b><?php echo $key;?></b> 중복 <?php echo $v;?>건</li>
            <?php } ?>
        </ul>
        <?php
            }
        }
        ?>

        <div class="margin-top-40">
            <h4><strong>문자전송 목록 <?php echo $re_text?></strong></h4>
        </div>

        <div class="btn_add01 btn_add">
            <a href="javascript:all_send()">전체 재전송</a>
            <a href="javascript:re_send()">실패내역 재전송</a>
            <?php if (!$wr_renum) {?>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_list&amp;page=<?php echo $page?>&amp;st=<?php echo $st?>&amp;sv=<?php echo $sv?>">목록</a>
            <?php } else { ?>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page?>&amp;st=<?php echo $st?>&amp;sv=<?php echo $sv?>&amp;wr_no=<?php echo $wr_no?>">뒤로가기</a>
            <?php } ?>
        </div>

        <div id="history-view-list2"></div>
    </div>

    <?php echo sms5_sub_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $spage, $total_spage, G5_ADMIN_URL."/?dir=sms&amp;pid=history_view&amp;wr_no=$wr_no&amp;wr_renum=$wr_renum&amp;page=$page&amp;st=$st&amp;sv=$sv&amp;sst=$sst&amp;ssv=$ssv", "", "spage"); ?>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
!function () {
    var db1 = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1)  )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db1    = db1,
    db1.clients   = [
	    <?php for ($i=0; $i<$count; $i++) { ?>
        {
	        번호: "<?php echo $list[$i]['re_vnum']; ?>",
	        관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page?>&amp;st=<?php echo $st?>&amp;sv=<?php echo $sv?>&amp;wr_no=<?php echo $list[$i]['wr_no']?>&amp;wr_renum=<?php echo $list[$i]['wr_renum']?>'><u>수정</u></a>",
	        전송일시: "<?php echo $list[$i]['wr_datetime']; ?>",
	        총건수: "<?php echo $list[$i]['wr_total']; ?>",
	        성공: "<?php echo $list[$i]['wr_success']; ?>",
	        실패: "<?php echo $list[$i]['wr_failure']; ?>",
        },
        <?php } ?>
    ];


    var db2 = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1)  )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db2    = db2,
    db2.clients   = [
	    <?php for ($i=0; $i<$hs_count; $i++) { ?>
        {
	        번호: "<?php echo $hs_list[$i]['vnum']; ?>",
            내역: "<?php if ($hs_list[$i]['bk_no']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_num&amp;wr_id=<?php echo $hs_list[$i]['wr_no']?>&amp;st=bk_no&amp;sv=<?php echo $hs_list[$i]['bk_no']?>'><u>내역</u></a><?php } else { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_num&amp;wr_id=<?php echo $hs_list[$i]['wr_no']?>&amp;st=hs_hp&amp;sv=<?php echo $hs_list[$i]['hs_hp']?>'><u>내역</u></a><?php } ?>",
	        그룹: "<?php echo $hs_list[$i]['bg_name']; ?>",
	        이름: "<?php echo $hs_list[$i]['hs_name']; ?>",
	        회원ID: "<?php echo $hs_list[$i]['mb_id']; ?>",
	        휴대폰번호: "<?php echo $hs_list[$i]['hs_hp']; ?>",
	        전송일시: "<?php echo $hs_list[$i]['hs_datetime']; ?>",
	        결과: "<u>결과코드</u> : <?php echo $hs_list[$i]['hs_code']; ?><br><u>로그</u> : <?php echo $hs_list[$i]['hs_log']; ?><br><u>메모</u> : <?php echo $hs_list[$i]['hs_memo']; ?>",
	        비고: "<?php echo $hs_list[$i]['hs_flag']?'성공':'실패'?>",
        },
        <?php } ?>
    ];
}();

$(function() {
    $("#history-view-list1").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db1,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : <?php echo $config['cf_page_rows']; ?>,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "번호", type: "text", align: "center", width: 40 },
            { name: "관리", type: "text", align: "center", width: 100, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "전송일시", type: "text", align: "center", width: 200 },
            { name: "총건수", type: "number", width: 80 },
            { name: "성공", type: "number", width: 80 },
            { name: "실패", type: "number", width: 80 },
        ]
    });

    $("#history-view-list2").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db2,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : <?php echo $config['cf_page_rows']; ?>,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "번호", type: "text", align: "center", width: 40 },
            { name: "내역", type: "text", align: "center", width: 60, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "그룹", type: "text", align: "center", width: 60},
            { name: "이름", type: "text", align: "center", width: 80 },
            { name: "회원ID", type: "text",width: 80 },
            { name: "휴대폰번호", type: "text", align: "center", width: 100 },
            { name: "전송일시", type: "text", align: "center", width: 100 },
            { name: "결과", type: "text", width: 300 },
            { name: "비고", type: "text", align: "center", width: 60 },
        ]
    });

    var $chk = $("#ebslider-itemlist .jsgrid-table th:first-child");
	if ($chk.text() == '체크') {
		var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all_img(this.form)"><i></i></label>';
		$chk.html(html);
	}

    var $ytchk = $("#ebslider-ytitemlist .jsgrid-table th:first-child");
	if ($ytchk.text() == '체크') {
		var html = '<label for="ytchkall" class="checkbox"><input type="checkbox" name="chkall" id="ytchkall" value="1" onclick="check_all_yt(this.form)"><i></i></label>';
		$ytchk.html(html);
	}
});
</script>