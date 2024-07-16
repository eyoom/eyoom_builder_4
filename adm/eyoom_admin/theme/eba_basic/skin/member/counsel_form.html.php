<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/counsel_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'counsel_list';
$g5_title = '상담신청';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<style>
.sc-goods-box {position:relative;margin-left:-5px;margin-right:-5px}
.sc-goods-box:after {content:"";display:block;clear:both}
.sc-goods-box > li {float:left;width:190px;padding:0 5px}
.sc-goods-box > li .sc-goods {border:1px solid #e5e5e5;padding:10px;margin-bottom:10px}
.sc-goods-box > li .sc-goods-name {margin-top:10px;text-align:center;font-size:.8125rem}
.sc-goods-wrap {display:flex;position:relative;border:1px solid #d5d5d5}
.sc-goods-item {flex-shrink:0;width:200px;text-align:center;border-right:1px solid #d5d5d5;padding:15px}
.sc-goods-img {text-align:center}
.sc-goods-name {font-size:1rem;font-weight:700;margin-top:15px}
.sc-goods-desc {flex-grow:1;position:relative;padding:15px;display:flex;align-items:center}
@media (max-width:767px) {
    .sc-goods-wrap {display:block}
    .sc-goods-item {flex-shrink:0;width:100%;border-right:0;border-bottom:1px solid #d5d5d5}
    .sc-goods-desc {flex-grow:inherit}
}
</style>

<div class="admin-member-form">

    <form name="fcounsel" id="fcounsel" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcounsel_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="cs_id" value="<?php echo $cs['cs_id']; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상담 정보</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="cs_part" class="label">상담 분야<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select width-250px">
                        <select name="cs_part" id="cs_part">
                            <?php foreach ($counsel_part as $k => $part) { ?>
                            <option value="<?php echo trim($part); ?>" <?php echo $cs['cs_part'] == trim($part) ? 'selected': ''; ?>><?php echo $part; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                    <?php if ($config['cf_counsel_view']) { ?>
                    <div class="note">기존 상담 분야 : <strong class="text-crimson"><?php echo $cs['cs_part']; ?></strong><br>관리자 - 환경설정 - 기본환경설정의 상담신청 설정에서 '상담 분야 설정'의 내용 변경 시 기존 상담 분야입니다.</div>
                    <?php } ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="cs_status" class="label">상담 상태<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select width-250px">
                        <select name="cs_status" id="cs_status">
                            <?php foreach ($counsel_status as $k => $status_string) { ?>
                            <option value="<?php echo $status_string; ?>" <?php echo $cs['cs_status'] == trim($status_string) ? 'selected': ''; ?>><?php echo $status_string; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                    <?php if ($config['cf_counsel_view']) { ?>
                    <div class="note">기존 상담 상태 : <strong class="text-crimson"><?php echo $cs['cs_status']; ?></strong><br>관리자 - 환경설정 - 기본환경설정의 상담신청 설정에서 '상담 단계 설정'의 내용 변경 시 기존 상담 상태입니다.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="cs_company" class="label">회사명<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="cs_company" id="cs_company" value="<?php echo $cs['cs_company']; ?>" required maxlength="20" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="cs_name" class="label">담당자<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="cs_name" id="cs_name" value="<?php echo $cs['cs_name']; ?>" required maxlength="20" required>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="cs_tel" class="label">연락처<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="cs_tel" id="cs_tel" value="<?php echo $cs['cs_tel']; ?>" required maxlength="20" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="cs_email" class="label">E-mail<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="cs_email" id="cs_email" value="<?php echo $cs['cs_email']; ?>" maxlength="100">
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="cs_subject" class="label">제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="cs_subject" value="<?php echo $cs['cs_subject']; ?>">
                </label>
            </div>
        </div>
        <?php if ($cs_it_ids) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="cs_product" class="label">문의제품</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="sc-goods-wrap">
                    <div class="sc-goods-item">
                        <div class="sc-goods-img">
                            <?php echo $it['image']; ?>
                        </div>
                        <h5 class="sc-goods-name"><?php echo $it['it_name']; ?></h5>
                    </div>
                    <div class="sc-goods-desc">
                        <div class="sc-goods-desc-in">
                            <?php if ($od_cnt > 0) { ?>
                            <p class="m-b-10"><strong>[ 주문번호 : 수량 : 세부사항 ]</strong></p>
                            <?php foreach ($odlist as $k => $li) { ?>
                            <p class="li-p-sq"><?php echo $li['po_code']; ?> : <?php echo number_format($od_count[$li['po_code']]); ?> : <?php echo $li['po_detail']; ?></p>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="cs_content" class="label">상담 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo $editor_html; ?>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="cs_file1" class="label">첨부파일 #1</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php if ($cs_file1['source']) { ?>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=counsel_download&amp;cs_id=<?php echo $cs_id; ?>&amp;no=1"><?php echo $cs_file1['source']; ?></a>
                    <?php } else { ?>
                    없음
                    <?php } ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="cs_regdt" class="label">첨부파일 #2</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php if ($cs_file2['source']) { ?>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=counsel_download&amp;cs_id=<?php echo $cs_id; ?>&amp;no=2"><?php echo $cs_file2['source']; ?></a>
                    <?php } else { ?>
                    없음
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="cs_tel" class="label">아이피</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $cs['cs_ip']; ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="cs_regdt" class="label">등록일</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $cs['cs_regdt']; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit;?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상담 관리 내역</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="cs_memo" class="label">관리자 메모</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="cs_memo" id="cs_memo" cols="30" rows="10"><?php echo stripslashes($cs['cs_memo']); ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="mb_id" class="label">상담관리자 아이디</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $cs['mb_id']; ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="cs_tel" class="label">최종업데이트</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $cs['cs_update']; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
function fcounsel_submit(f)
{
    if (!f.cs_agree.checked) {
        Swal.fire({
            title: "중요!",
            text: "개인정보처리방침안내의 내용에 동의하셔야 상담 문의가 가능합니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_agree.focus();
        return false;
    }

    if (f.cs_part.value == '') {
        Swal.fire({
            title: "중요!",
            text: "업체명을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_part.focus();
        return false;
    }

    if (f.cs_company.value == '') {
        Swal.fire({
            title: "중요!",
            text: "담당자명을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_company.focus();
        return false;
    }

    if (f.cs_tel.value == '') {
        Swal.fire({
            title: "중요!",
            text: "연락처를 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_tel.focus();
        return false;
    }

    if (f.cs_email.value == '') {
        Swal.fire({
            title: "중요!",
            text: "이메일을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_email.focus();
        return false;
    }

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(f.cs_email.value)) {
        Swal.fire({
            title: "중요!",
            text: "유효하지 않은 이메일 주소입니다.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_email.focus();
        return false;
    }

    if (f.cs_deposit.value == '') {
        Swal.fire({
            title: "중요!",
            text: "예산을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_deposit.focus();
        return false;
    }

    if (f.cs_content.value == '') {
        Swal.fire({
            title: "중요!",
            text: "상담내용을 입력해 주세요.",
            confirmButtonColor: "#ab0000",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.cs_content.focus();
        return false;
    }
    return true;
}

function format_number() {
    const numberInput = document.getElementById('cs_deposit');
    const value = numberInput.value.replace(/\D/g, ''); // 숫자 이외의 문자 제거
    
    // 천단위 쉼표 추가
    numberInput.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}
</script>
