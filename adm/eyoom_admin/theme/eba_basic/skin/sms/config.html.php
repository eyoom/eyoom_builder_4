<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/config.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'config';
$g5_title = 'SMS 기본설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.cf_tr_hide {display:none}
</style>

<div class="admin-config-form">
    <?php if (!($config['cf_icode_pw'] || $config['cf_icode_token_key'])) { ?>
    <div class="cont-text-bg m-b-20">
        <p class="bg-warning">
            <i class="fas fa-exclamation-circle m-r-7"></i>SMS 기능을 사용하시려면 먼저 아이코드에 서비스 신청을 하셔야 합니다.<br>
            <a href="http://icodekorea.com/res/join_company_fix_a.php?sellid=sir2" target="_blank" class="btn-e btn-e-md btn-e-dark width-200px m-t-10">아이코드 서비스 신청하기</a>
        </p>
    </div>
    <?php } ?>

    <?php if ($config['cf_sms_use'] == 'icode') { // 아이코드 사용 ?>

    <form name="fconfig" method="post" action="<?php echo $action_url; ?>" enctype="multipart/form-data" class="eyoom-form" >
    <input type="hidden" name="cf_icode_server_ip" value="<?php echo $config['cf_icode_server_ip']?>">
    <input type="hidden" name="cf_sms_use" value="<?php echo $config['cf_sms_use']?>">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>SMS 설정</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="cf_sms_type" class="label">SMS 전송유형</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select id="cf_sms_type" name="cf_sms_type">
                        <option value="" <?php echo get_selected($config['cf_sms_type'], ''); ?>>SMS</option>
                        <option value="LMS" <?php echo get_selected($config['cf_sms_type'], 'LMS'); ?>>LMS</option>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 전송유형을 SMS로 선택하시면 최대 80바이트까지 전송하실 수 있으며<br>LMS로 선택하시면 90바이트 이하는 SMS로, 그 이상은 <?php echo G5_ICODE_LMS_MAX_LENGTH; ?>바이트까지 LMS로 전송됩니다.<br>요금은 건당 SMS는 16원, LMS는 48원입니다.</div>
            </div>
        </div>
        <div class="adm-form-tr icode_old_version">
            <div class="adm-form-td td-l">
                <label for="cf_icode_id" class="label">아이코드 회원아이디<br>(구버전)<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="cf_icode_id" id="cf_icode_id" value="<?php echo $config['cf_icode_id']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 아이코드에서 사용하시는 회원아이디를 입력합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr icode_old_version">
            <div class="adm-form-td td-l">
                <label for="cf_icode_pw" class="label">아이코드 비밀번호<br>(구버전)<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="password" name="cf_icode_pw" id="cf_icode_pw" value="<?php echo $config['cf_icode_pw']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 아이코드에서 사용하시는 비밀번호를 입력합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr icode_old_version <?php if(!(isset($userinfo['payment']) && $userinfo['payment'])){ echo 'cf_tr_hide'; } ?>">
            <div class="adm-form-td td-l">
                <label class="label">요금제<br>(구버전)</label>
            </div>
            <div class="adm-form-td td-r">
                <?php
                    if ($userinfo['payment'] == 'A') {
                        echo '충전제';
                        echo '<input type="hidden" name="cf_icode_server_port" value="7295">';
                    } else if ($userinfo['payment'] == 'C') {
                        echo '정액제';
                        echo '<input type="hidden" name="cf_icode_server_port" value="7296">';
                    } else {
                        echo '<input type="hidden" name="cf_icode_server_port" value="7295">';
                    }
                ?>
            </div>
        </div>
        <?php if ($userinfo['payment'] == 'A') { ?>
        <div class="adm-form-tr icode_old_version">
            <div class="adm-form-td td-l">
                <label class="label">충전 잔액<br>(구버전)</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo number_format($userinfo['coin'])?> 원
                <a href="http://www.icodekorea.com/smsbiz/credit_card_amt.php?icode_id=<?php echo $config['cf_icode_id']; ?>&amp;icode_passwd=<?php echo $config['cf_icode_pw']; ?>" target="_blank" class="btn-e btn-e-md btn-e-indigo m-l-7">충전하기</a>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr icode_json_version">
            <div class="adm-form-td td-l">
                <label class="label">아이코드 토큰키<br>(JSON버전)</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="cf_icode_token_key" value="<?php echo $config['cf_icode_token_key']; ?>" id="cf_icode_token_key">
                </label>
                <div class="note"><strong>Note:</strong> 아이코드 JSON 버전의 경우 아이코드 토큰키를 입력시 실행됩니다.<br>SMS 전송유형을 LMS로 설정시 90바이트 이내는 SMS, 90 ~ 2000 바이트는 LMS 그 이상은 절삭 되어 LMS로 발송됩니다.</div>
                <div class="note m-b-5"><strong>Note:</strong> 아이코드 사이트 -> 토큰키관리 메뉴에서 생성한 토큰키를 입력합니다.</div>
                서버아이피 : <?php echo $_SERVER['SERVER_ADDR']; ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="cf_phone" class="label">회신번호<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="cf_phone" id="cf_phone" value="<?php echo $sms5['cf_phone']; ?>" required>
                </label>
                <div class="note"><strong>Note:</strong> 회신받을 휴대폰 번호를 입력하세요. 회신번호는 발신번호로 사전등록된 번호와 동일해야 합니다.<br>예) 010-123-4567</div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>

    <?php } else { // 아이코드 사용이 아닐때 ?>

    <h5 class="m-b-10"><i class="fas fa-exclamation-circle m-r-7"></i><strong>SMS 문자전송 서비스를 사용할 수 없습니다.</strong></h5>
    <p class="li-p-sq">SMS 를 사용하지 않고 있기 때문에, 문자 전송을 할 수 없습니다.</p>
    <p class="li-p-sq">SMS 사용 설정은 <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=config_form#anc_cf_sms"><u class="text-black">환경설정 &gt; 기본환경설정 &gt; SMS설정</u></a> 에서 SMS 사용을 아이코드로 변경해 주셔야 사용하실수 있습니다.</p>

    <?php } ?>
</div>