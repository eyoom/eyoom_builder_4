<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/member_cert_refresh.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

if ($config['cf_cert_use'] && ($config['cf_cert_simple'] || $config['cf_cert_ipin'] || $config['cf_cert_hp']))
    add_javascript('<script src="'.G5_JS_URL.'/certify.js?v='.G5_JS_VER.'"></script>', 0);
?>

<style>
.member-cert-refresh .member-cert-refresh-box {border:1px solid #ddd}
.member-cert-refresh .member-cert-refresh-box-in {padding:15px}
.member-cert-refresh .eyoom-form header {padding:20px 15px;background:#fafafa}
.member-cert-refresh .eyoom-form header h5 {line-height:1;font-size:1.125rem}
.member-cert-refresh .eyoom-form footer {padding:15px;text-align:right}
.member-cert-refresh .eyoom-form fieldset {padding:0}
.member-cert-refresh .member-cert-refresh-agree label {display:inline-block;margin-right:5px}
.member-cert-refresh .btn-e-cert {padding:7px 12px}
</style>

<div class="member-cert-refresh">
    <form name="fcertrefreshform" id="member_cert_refresh" action="<?php echo $action_url ?>" onsubmit="return fcertrefreshform_submit(this);" method="POST" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
    <input type="hidden" name="mb_hp" value="<?php echo $member['mb_hp']; ?>">
    <input type="hidden" name="mb_name" value="<?php echo $member['mb_name']; ?>">
    <input type="hidden" name="cert_no" value="">
    
    <div class="member-cert-refresh-box">
        <header><h5><strong>(필수) 추가 개인정보처리방침 안내</strong></h5></header>
        <div class="member-cert-refresh-box-in">
            <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="fas fa-arrows-alt-h"></i>)</p>
            <div class="table-list-eb">
                <div class="table-responsive">
                    <table class="table table-bordered m-b-0">
                        <thead>
                            <tr>
                                <th colspan="2">목적</th>
                            </tr>
                            <tr>
                                <th>항목</th>
                                <th>보유기간</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">이용자 식별 및 본인여부 확인</td>
                            </tr>
                            <tr>
                                <td>생년월일<?php echo (empty($member['mb_dupinfo']))? ", 휴대폰 번호(아이핀 제외)" : ""; ?>, 암호화된 개인식별부호(CI)</td>
                                <td>회원 탈퇴 시까지</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            <fieldset class="member-cert-refresh-agree">
                <label class="checkbox" for="agree21">
                    <input type="checkbox" name="agree2" value="1" id="agree21"><i></i>추가 개인정보처리방침에 동의합니다.
                </label>
            </fieldset>
        </footer>
    </div>
    
    <div class="member-cert-refresh-box m-t-30">
        <header><h5><strong>인증수단 선택하기</strong></h5></header>
        <div class="member-cert-refresh-box-in">
            <div class="find_btn">
            <?php
            if ($config['cf_cert_use']) {
                echo '<div class="cert_btn">';
                if ($config['cf_cert_simple']) {
                    echo '<button type="button" id="win_sa_kakao_cert" class="btn-e btn-e-dark btn-e-cert win_sa_cert" data-type="">간편인증</button>' . PHP_EOL;
                }
                if ($config['cf_cert_hp'])
                    echo '<button type="button" id="win_hp_cert" class="btn-e btn-e-dark btn-e-cert">휴대폰 본인확인</button>' . PHP_EOL;
                if ($config['cf_cert_ipin'])
                    echo '<button type="button" id="win_ipin_cert" class="btn-e btn-e-dark btn-e-cert">아이핀 본인확인</button>' . PHP_EOL;
                echo '</div>';
                echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>' . PHP_EOL;
            }
            ?>
            </div>
        </div>
    </div>
        
    </form>
</div>

<script>
$(function() {
    var pageTypeParam = "pageType=register";
    var f = document.fcertrefreshform;

    <?php if ($config['cf_cert_use'] && $config['cf_cert_simple']) { ?>
        // 이니시스 간편인증
        var url = "<?php echo G5_INICERT_URL; ?>/ini_request.php";
        var type = "";
        var params = "";
        var request_url = "";

        $(".win_sa_cert").click(function() {
            if (!fcertrefreshform_submit(f)) return false;
            type = $(this).data("type");
            params = "?directAgency=" + type + "&" + pageTypeParam;
            request_url = url + params;
            call_sa(request_url);
        });
    <?php } ?>

    <?php if ($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        var params = "";
        $("#win_ipin_cert").click(function() {
            if (!fcertrefreshform_submit(f)) return false;
            params = "?" + pageTypeParam;
            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php" + params;
            certify_win_open('kcb-ipin', url);
            return;
        });
    <?php } ?>

    <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        var params = "";
        $("#win_hp_cert").click(function() {
            if (!fcertrefreshform_submit(f)) return false;
            params = "?" + pageTypeParam;
            <?php
            switch ($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>" + params);
            return;
        });
    <?php } ?>
});

function fcertrefreshform_submit(f) {
    if (!f.agree2.checked) {
        alert("추가 개인정보처리방침에 동의하셔야 인증을 진행하실 수 있습니다.");
        f.agree2.focus();
        return false;
    }

    return true;
}
</script>