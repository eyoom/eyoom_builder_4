<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/config.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 탭메뉴 출력
 */
include_once($eyoom_skin_path['mypage'] . '/tabmenu.skin.html.php');
?>

<style>
.my-config .config-box {border:1px solid #d5d5d5}
.my-config .eyoom-form header {position:relative;padding:20px 15px;background:#fafafa}
.my-config .eyoom-form header .btn-e {position:absolute;top:18px;right:15px}
.my-config .eyoom-form footer {padding:15px}
.my-config .eyoom-form fieldset {padding:15px}
.my-config .config-b-t {border-top:1px solid #d5d5d5}
</style>

<div class="my-config">
    <form name="myconfigform" id="myconfigform" method="post" action="<?php echo $action_url; ?>" onsubmit="return check_config_form(this);" role="form" class="eyoom-form">

    <div class="config-box">
        <header>
            <h5><strong>기본설정</strong></h5>
            <input type="submit" class="btn-e btn-e-sm btn-e-navy" value="적용하기">
        </header>
        <fieldset>
            <label class="label">마이홈</label>
            <div class="inline-group">
                <label for="open_page1" class="radio"><input type="radio" name="open_page" id="open_page1" value='y' <?php echo $eyoomer['open_page'] == 'y' ? 'checked': ''; ?>><i class="rounded-x"></i>공개</label>
                <label for="open_page2" class="radio"><input type="radio" name="open_page" id="open_page2" value='n' <?php echo $eyoomer['open_page'] == 'n' ? 'checked': ''; ?>><i class="rounded-x"></i>비공개</label>
            </div>
            <div class="note"><strong>Note:</strong> 마이홈의 공개여부를 설정합니다.</div>
        </fieldset>

        <header class="config-b-t">
            <h5><strong>On-Off 설정</strong></h5>
            <input type="submit" class="btn-e btn-e-sm btn-e-navy" value="적용하기">
        </header>
        <fieldset>
            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_social" value="on" <?php echo $eyoomer['onoff_social'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>소셜기능</label>
            <input type="hidden" name="onoff_social" id="onoff_social" value="<?php echo $eyoomer['onoff_social']; ?>">
            <div class="note"><strong>Note:</strong> 팔로우/팔로윙/친구맺기 기능의 활성화 여부를 설정합니다.</div>

            <div class="margin-hr-15"></div>

            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_push" value="on" <?php echo $eyoomer['onoff_push'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>알람 푸쉬기능</label>
            <input type="hidden" name="onoff_push" id="onoff_push" value="<?php echo $eyoomer['onoff_push']; ?>">
            <div class="note"><strong>Note:</strong> 실시간 푸쉬 메세지를 받을지 설정합니다.</div>

            <div class="margin-hr-15"></div>

            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_push_respond" value="on" <?php echo $eyoomer['onoff_push_respond'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>내글반응 알람</label>
            <input type="hidden" name="onoff_push_respond" id="onoff_push_respond" value="<?php echo $eyoomer['onoff_push_respond']; ?>">

            <div class="margin-hr-15"></div>

            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_push_memo" value="on" <?php echo $eyoomer['onoff_push_memo'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>쪽지 알람</label>
            <input type="hidden" name="onoff_push_memo" id="onoff_push_memo" value="<?php echo $eyoomer['onoff_push_memo']; ?>">

            <div class="margin-hr-15"></div>

            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_push_social" value="on" <?php echo $eyoomer['onoff_push_social'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>소셜 알람</label>
            <input type="hidden" name="onoff_push_social" id="onoff_push_social" value="<?php echo $eyoomer['onoff_push_social']; ?>">

            <div class="margin-hr-15"></div>

            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_push_likes" value="on" <?php echo $eyoomer['onoff_push_likes'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>라이크 알람</label>
            <input type="hidden" name="onoff_push_likes" id="onoff_push_likes" value="<?php echo $eyoomer['onoff_push_likes']; ?>">

            <div class="margin-hr-15"></div>

            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="onoff_push_guest" value="on" <?php echo $eyoomer['onoff_push_guest'] == 'on' ? 'checked': ''; ?>><i class="rounded-4x"></i>방명록 알람</label>
            <input type="hidden" name="onoff_push_guest" id="onoff_push_guest" value="<?php echo $eyoomer['onoff_push_guest']; ?>">
        </fieldset>
        
        <header class="config-b-t">
            <h5><strong>게시글 출력설정</strong></h5>
            <input type="submit" class="btn-e btn-e-sm btn-e-navy" value="적용하기">
        </header>
        <fieldset>
            <label class="label">내타임라인</label>
            <div class="inline-group">
                <label for="view_timeline1" class="radio"><input type="radio" name="view_timeline" id="view_timeline1" value='1' <?php echo $eyoomer['view_timeline'] == '1' ? 'checked': ''; ?>><i class="rounded-x"></i>포스팅+댓글 모두보기</label>
                <label for="view_timeline2" class="radio"><input type="radio" name="view_timeline" id="view_timeline2" value='2' <?php echo $eyoomer['view_timeline'] == '2' ? 'checked': ''; ?>><i class="rounded-x"></i>포스팅글만 보기</label>
                <label for="view_timeline3" class="radio"><input type="radio" name="view_timeline" id="view_timeline3" value='3' <?php echo $eyoomer['view_timeline'] == '3' ? 'checked': ''; ?>><i class="rounded-x"></i>댓글만 보기</label>
            </div>

            <div class="margin-hr-15"></div>

            <label class="label">관심게시판</label>
            <div class="inline-group">
                <label for="view_favorite1" class="radio"><input type="radio" name="view_favorite" id="view_favorite1" value='1' <?php echo $eyoomer['view_favorite'] == '1' ? 'checked': ''; ?>><i class="rounded-x"></i>포스팅+댓글 모두보기</label>
                <label for="view_favorite2" class="radio"><input type="radio" name="view_favorite" id="view_favorite2" value='2' <?php echo $eyoomer['view_favorite'] == '2' ? 'checked': ''; ?>><i class="rounded-x"></i>포스팅글만 보기</label>
                <label for="view_favorite3" class="radio"><input type="radio" name="view_favorite" id="view_favorite3" value='3' <?php echo $eyoomer['view_favorite'] == '3' ? 'checked': ''; ?>><i class="rounded-x"></i>댓글만 보기</label>
            </div>

            <div class="margin-hr-15"></div>

            <label class="label">팔로윙글</label>
            <div class="inline-group">
                <label for="view_followinggul1" class="radio"><input type="radio" name="view_followinggul" id="view_followinggul1" value='1' <?php echo $eyoomer['view_followinggul'] == '1' ? 'checked': ''; ?>><i class="rounded-x"></i>포스팅+댓글 모두보기</label>
                <label for="view_followinggul2" class="radio"><input type="radio" name="view_followinggul" id="view_followinggul2" value='2' <?php echo $eyoomer['view_followinggul'] == '2' ? 'checked': ''; ?>><i class="rounded-x"></i>포스팅글만 보기</label>
                <label for="view_followinggul3" class="radio"><input type="radio" name="view_followinggul" id="view_followinggul3" value='3' <?php echo $eyoomer['view_followinggul'] == '3' ? 'checked': ''; ?>><i class="rounded-x"></i>댓글만 보기</label>
            </div>
        </fieldset>

        <header class="config-b-t">
            <h5><strong>관심게시판 설정</strong></h5>
            <input type="submit" class="btn-e btn-e-sm btn-e-navy" value="적용하기">
        </header>
        <fieldset>
            <?php for($i=0; $i<count((array)$bolist); $i++) { ?>
            <label class="toggle small-toggle green-toggle"><input type="checkbox" class="bo_favorite_<?php echo $i; ?>" value="on" checked><i class="rounded-4x"></i><?php echo $bolist[$i]['gr_subject'];?> &gt; <?php echo $bolist[$i]['bo_subject'];?></label>
            <input type="hidden" name="bo_favorite[<?php echo $bolist[$i]['bo_table']; ?>]" id="bo_favorite_<?php echo $i; ?>" value="on">
            <?php } ?>
            <div class="note"><strong>Note:</strong> 각 게시판 목록 상단에서 관심게시판 적용이 가능하며 적용된 게시판은 여기에 출력됩니다.</div>
        </fieldset>
    </div>

    <div class="text-center m-t-30">
        <input type="submit" class="btn-e btn-e-xl btn-e-navy" value="적용하기">
    </div>

    </form>
</div>

<script>
function check_config_form(f) {
    return true;
}
$(function(){
    $(".toggle input").click(function(){
        var id = $(this).attr('class');

        if ($(this).is(':checked')) {
            $('#'+id).val('on');
        } else {
            $('#'+id).val('off');
        }
    });
});
</script>