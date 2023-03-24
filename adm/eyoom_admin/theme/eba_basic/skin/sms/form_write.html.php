<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/form_write.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'form_list';
$g5_title = '이모티콘 관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.write_scemo_btn {line-height:1.4}
#write_emo_btn {top:60px}
</style>

<div class="admin-form-write">
    <form name="book_form" method="post" action="<?php echo $action_url; ?>" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w?>">
    <input type="hidden" name="page" value="<?php echo $page?>">
    <input type="hidden" name="fo_no" value="<?php echo $write['fo_no']?>">
    <input type="hidden" name="get_fg_no" value="<?php echo $fg_no?>">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $g5['title']; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fg_no" class="label">그룹<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="fg_no" id="fg_no" required>
                        <option value="0">미분류</option>
                        <?php
                        $qry = sql_query("select * from {$g5['sms5_form_group_table']} order by fg_name");
                        while($res = sql_fetch_array($qry)) {
                        ?>
                        <option value="<?php echo $res['fg_no']?>"<?php echo get_selected($res['fg_no'], $write['fg_no']); ?>><?php echo $res['fg_name']?></option>
                        <?php } ?>
                    </select><i></i>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fo_name" class="label">제목<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="fo_name" id="fo_name" required value="<?php echo get_sanitize_input($write['fo_name']); ?>" size="70">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">메세지</label>
            </div>
            <div class="adm-form-td td-r" id="sms5_emo_add">
                <div class="sms5_box write_wrap">
                    <span class="box_ico"></span>
                    <label for="sms_contents" id="wr_message_lbl">내용</label>
                    <textarea name="fo_content" id="sms_contents" class="box_txt box_square" onkeyup="byte_check('sms_contents', 'sms_bytes');" accesskey="m"><?php echo html_purifier($write['fo_content']); ?></textarea>

                    <div id="sms_byte"><span id="sms_bytes">0</span> / 80 byte</div>

                    <button type="button" id="write_sc_btn" class="write_scemo_btn">특수<br>기호</button>
                    <div id="write_sc" class="write_scemo">
                        <span class="scemo_ico"></span>
                        <div class="scemo_list">
                            <button type="button" class="scemo_add" onclick="javascript:add('■')">■</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('□')">□</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('▣')">▣</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('◈')">◈</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('◆')">◆</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('◇')">◇</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♥')">♥</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♡')">♡</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('●')">●</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('○')">○</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('▲')">▲</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('▼')">▼</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('▶')">▶</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('▷')">▷</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('◀')">◀</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('◁')">◁</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('☎')">☎</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('☏')">☏</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♠')">♠</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♤')">♤</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♣')">♣</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♧')">♧</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('★')">★</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('☆')">☆</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('☞')">☞</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('☜')">☜</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('▒')">▒</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('⊙')">⊙</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('㈜')">㈜</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('№')">№</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('㉿')">㉿</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♨')">♨</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('™')">™</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('℡')">℡</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('∑')">∑</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('∏')">∏</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♬')">♬</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♪')">♪</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♩')">♩</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♭')">♭</button>
                        </div>
                        <div class="scemo_cls"><button type="button" class="scemo_cls_btn">닫기</button></div>
                    </div>
                    <button type="button" id="write_emo_btn" class="write_scemo_btn">이모<br>티콘</button>
                    <div id="write_emo" class="write_scemo">
                        <span class="scemo_ico"></span>
                        <div class="scemo_list">
                            <button type="button" class="scemo_add" onclick="javascript:add('*^^*')">*^^*</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('♡.♡')">♡.♡</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('@_@')">@_@</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('☞_☜')">☞_☜</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('ㅠ ㅠ')">ㅠ ㅠ</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('Θ.Θ')">Θ.Θ</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('^_~♥')">^_~♥</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('~o~')">~o~</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('★.★')">★.★</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('(!.!)')">(!.!)</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('⊙.⊙')">⊙.⊙</button>
                            <button type="button" class="scemo_add" onclick="javascript:add('q.p')">q.p</button>
                            <button type="button" class="scemo_add emo_long" onclick="javascript:add('┏( \'\')┛')">┏( \'\')┛</button>
                            <button type="button" class="scemo_add emo_long" onclick="javascript:add('@)-)--')">@)-)--')</button>
                            <button type="button" class="scemo_add emo_long" onclick="javascript:add('↖(^-^)↗')">↖(^-^)↗</button>
                            <button type="button" class="scemo_add emo_long" onclick="javascript:add('(*^-^*)')">(*^-^*)</button>
                        </div>
                        <div class="scemo_cls"><button type="button" class="scemo_cls_btn">닫기</button></div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($w == 'u') {?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">업데이트</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo $write['fo_datetime']?>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="확인" class="btn_submit btn-e btn-e-lg btn-e-crimson" accesskey="s">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=form_list" class="btn-e btn-e-lg btn-e-dark">목록</a>
    </div>

    </form>
</div>

<script>
function add(str) {
    var conts = document.getElementById('sms_contents');
    var bytes = document.getElementById('sms_bytes');
    conts.focus();
    conts.value+=str;
    byte_check('sms_contents', 'sms_bytes');
    return;
}
function byte_check(sms_contents, sms_bytes)
{
    var conts = document.getElementById(sms_contents);
    var bytes = document.getElementById(sms_bytes);

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++)
    {
        ch = conts.value.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

    bytes.innerHTML = cnt;

    if (cnt > 80)
    {
        exceed = cnt - 80;
        alert('메시지 내용은 80바이트를 넘을수 없습니다.\n\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\n\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++)
        {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > 80) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        conts.value = tmp;
        bytes.innerHTML = xcnt;
        return;
    }
}

byte_check('sms_contents', 'sms_bytes');
document.getElementById('sms_contents').focus();

$(function(){
    $(".box_txt").bind("focus keydown", function(){
        $("#wr_message_lbl").hide();
    });
    $(".write_scemo_btn").click(function(){
        $(".write_scemo").hide();
        $(this).next(".write_scemo").show();
    });
    $(".scemo_cls_btn").click(function(){
        $(".write_scemo").hide();
    });
});
</script>