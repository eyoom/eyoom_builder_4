<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/config_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal.css">', 11);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal-default-theme.css">', 12);
add_javascript('<script src="'.G5_JS_URL.'/remodal/remodal.js"></script>', 10);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'config_form';
$g5_title = '기본환경설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<style>
.cf_cert_hide {display:none}
.cf_tr_hide {display:none}
.icode_old_version th{background-color:#FFFCED !important}
.icode_json_version th{background-color:#F6F1FF !important}
@media (max-width: 1199px) {
    .pg-anchor-in .nav-tabs li:nth-child(10) a {border-bottom:0}
}
</style>

<div class="admin-board-form">
    <form name="fconfigform" id="fconfigform" method="post" onsubmit="return fconfigform_submit(this);" class="eyoom-form">
    <input type="hidden" name="token" id="token" value="">
    <input type="hidden" name="eba_theme" id="eba_theme" value="<?php echo $config['cf_eyoom_admin_theme']; ?>">

    <div class="pg-anchor">
        <div class="pg-anchor-in">
            <ul class="nav nav-tabs" role="tablist">
            <?php foreach ($pg_anchor as $anc_id => $anc_name) { ?>
                <li role="presentation">
                    <a href="javasecipt:void(0);" class="anchor-menu <?php echo $anc_id; ?>" id="<?php echo $anc_id; ?>_tab" data-bs-toggle="tab" data-bs-target="#<?php echo $anc_id; ?>"><?php echo $anc_name; ?></a>
                </li>
            <?php } ?>
            </ul>
            <div class="tab-bottom-line"></div>
        </div>
    </div>
    
    <div class="tab-content">
        <?php /* 홈페이지 기본환경 설정 : 시작 */ ?>
        <div class="tab-pane show active" id="anc_cf_basic" role="tabpanel" aria-labelledby="anc_cf_basic_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>홈페이지 기본환경 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_title" class="label">홈페이지 제목<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_title" value="<?php echo get_sanitize_input($config['cf_title']); ?>" id="cf_title" required>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_admin" class="label">최고관리자<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <?php echo get_member_id_select('cf_admin', 10, $config['cf_admin'], 'required') ?><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_admin_email" class="label">관리자 메일 주소<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_admin_email" id="cf_admin_email" class="email" value="<?php echo get_sanitize_input($config['cf_admin_email']); ?>" required>
                        </label>
                        <div class="note">
                            <strong>Note:</strong> 관리자가 보내고 받는 용도로 사용하는 메일 주소를 입력합니다. (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)
                            <?php if (function_exists('domain_mail_host') && $config['cf_admin_email'] && stripos($config['cf_admin_email'], domain_mail_host()) === false) { ?>
                            <br><br>외부메일설정이나 기타 설정을 하지 않았다면, 도메인과 다른 헤더로 여겨 스팸이나 차단될 가능성이 있습니다.<br>name<?php echo domain_mail_host(); ?>과 같은 도메인 형식으로 설정할것을 권장합니다.
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_admin_email_name" class="label">관리자 메일 발송이름<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_admin_email_name" id="cf_admin_email_name" value="<?php echo get_sanitize_input($config['cf_admin_email_name']); ?>" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 관리자가 보내고 받는 용도로 사용하는 메일의 발송이름을 입력합니다. (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)</div>
                    </div>
                </div>
                <?php if ($is_admin == 'super' && $member['mb_id'] == $config['cf_admin']) { ?>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_eyoom_admin_theme" class="label">이윰관리자 테마설정<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <select name="cf_eyoom_admin_theme" id="cf_eyoom_admin_theme" required>
                                    <option value="">선택</option>
                                    <?php for ($i=0; $i<count((array)$cf_eyoom_admin_theme); $i++) { ?>
                                    <option value="<?php echo $cf_eyoom_admin_theme[$i]; ?>" <?php echo get_selected($config['cf_eyoom_admin_theme'], $cf_eyoom_admin_theme[$i])?>><?php echo $cf_eyoom_admin_theme[$i]; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 이윰 관리자모드의 테마를 설정하합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_version_alarm" class="label">이윰빌더 배포 버전 알람 사용</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_use_version_alarm" value="1" id="cf_use_version_alarm" <?php echo $config['cf_use_version_alarm']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 사용에 체크하시면 이윰빌더 최신 배포버전이 새로 나올경우 관리자모드 메인 우측 상단에 알람이 활성화 됩니다.</div>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <input type="hidden" name="cf_eyoom_admin_theme" value="<?php echo $config['cf_eyoom_admin_theme']; ?>">
                <?php } ?>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_permit_level" class="label">사이트 접속 최소 레벨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px"><?php echo get_member_level_select('cf_permit_level', 1, 10, $config['cf_permit_level']) ?><i></i></label>
                            <div class="note"><strong>Note:</strong> 회원제 사이트를 운영하고자 할 경우, 홈페이지에 접근 가능한 최소 레벨을 설정합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_mbmemo" class="label">회원메모 사용</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_use_mbmemo" value="1" id="cf_use_mbmemo" <?php echo $config['cf_use_mbmemo']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 사용체크하시면 회원메모기능이 활성화 됩니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_point" class="label">포인트 사용</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_use_point" value="1" id="cf_use_point" <?php echo $config['cf_use_point']?'checked':''; ?>><i></i> 사용
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_point_term" class="label">포인트 유효기간</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">일</i>
                                <input type="text" name="cf_point_term" value="<?php echo (int) $config['cf_point_term']; ?>" id="cf_point_term" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 기간을 0으로 설정시 포인트 유효기간이 적용되지 않습니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_login_point" class="label">로그인시 포인트<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_login_point" value="<?php echo (int) $config['cf_login_point']; ?>" id="cf_login_point" class="text-end" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 회원이 로그인시 하루에 한번만 적립</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_memo_send_point" class="label">쪽지보낼시 차감 포인트<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_memo_send_point" value="<?php echo (int) $config['cf_memo_send_point']; ?>" id="cf_memo_send_point" class="text-end" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 양수로 입력하십시오. 0점은 쪽지 보낼시 포인트를 차감하지 않습니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_cut_name" class="label">이름(닉네임) 표시</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">자리</i>
                                <input type="text" name="cf_cut_name" id="cf_cut_name" value="<?php echo (int) $config['cf_cut_name']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력한 자리수만큼만 표시하게 됩니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_nick_modify" class="label">닉네임 수정</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <span>수정하면</span>
                                <span>
                                    <label class="input"><input type="text" name="cf_nick_modify" id="cf_nick_modify" value="<?php echo (int) $config['cf_nick_modify']; ?>" class="text-end width-80px"></label>
                                </span>
                                <span>일 동안 바꿀 수 없음</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_open_modify" class="label">정보공개 수정</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <span>수정하면</span>
                                <span>
                                    <label class="input"><input type="text" name="cf_open_modify" id="cf_open_modify" value="<?php echo (int) $config['cf_open_modify']; ?>" class="text-end width-80px"></label>
                                </span>
                                <span>일 동안 바꿀 수 없음</span>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_new_del" class="label">최근게시물 삭제</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">일</i>
                                <input type="text" name="cf_new_del" id="cf_new_del" value="<?php echo (int) $config['cf_new_del']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정일이 지난 최근게시물 자동 삭제</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_memo_del" class="label">쪽지 삭제</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">일</i>
                                <input type="text" name="cf_memo_del" id="cf_memo_del" value="<?php echo (int) $config['cf_memo_del']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정일이 지난 쪽지 자동 삭제</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_visit_del" class="label">접속자로그 삭제</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">일</i>
                                <input type="text" name="cf_visit_del" id="cf_visit_del" value="<?php echo (int) $config['cf_visit_del']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정일이 지난 접속자 로그 자동 삭제</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_popular_del" class="label">인기검색어 삭제</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">일</i>
                                <input type="text" name="cf_popular_del" id="cf_popular_del" value="<?php echo (int) $config['cf_popular_del']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정일이 지난 인기검색어 자동 삭제</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_login_minutes" class="label">현재 접속자</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">분</i>
                                <input type="text" name="cf_login_minutes" id="cf_login_minutes" value="<?php echo (int) $config['cf_login_minutes']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정값 이내의 접속자를 현재 접속자로 인정</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_new_rows" class="label">최근게시물 라인수</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">라인</i>
                                <input type="text" name="cf_new_rows" id="cf_new_rows" value="<?php echo (int) $config['cf_new_rows']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 목록 한페이지당 라인수</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_page_rows" class="label">한페이지당 라인수</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">라인</i>
                                <input type="text" name="cf_page_rows" id="cf_page_rows" value="<?php echo (int) $config['cf_page_rows']; ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 목록(리스트) 한페이지당 라인수</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_mobile_page_rows" class="label">모바일 한페이지당 라인수</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <i class="icon-append">라인</i>
                            <input type="text" name="cf_mobile_page_rows" id="cf_mobile_page_rows" value="<?php echo (int) $config['cf_mobile_page_rows']; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 모바일 목록 한페이지당 라인수</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_write_pages" class="label">페이지 표시 수<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">p.</i>
                                <input type="text" name="cf_write_pages" id="cf_write_pages" value="<?php echo (int) $config['cf_write_pages']; ?>" required class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 목록 페이지 블럭당 페이지수</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_mobile_pages" class="label">모바일 페이지 표시 수<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">p.</i>
                                <input type="text" name="cf_mobile_pages" id="cf_mobile_pages" value="<?php echo (int) $config['cf_mobile_pages']; ?>" required class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 모바일 목록 페이지 블럭당 페이지수</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_new_skin" class="label">최근게시물 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_skin_select('new', 'cf_new_skin', 'cf_new_skin', $config['cf_new_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_mobile_new_skin" class="label">모바일 최근게시물 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_mobile_skin_select('new', 'cf_mobile_new_skin', 'cf_mobile_new_skin', $config['cf_mobile_new_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_search_skin" class="label">검색 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_skin_select('search', 'cf_search_skin', 'cf_search_skin', $config['cf_search_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_mobile_search_skin" class="label">모바일 검색 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_mobile_skin_select('search', 'cf_mobile_search_skin', 'cf_mobile_search_skin', $config['cf_mobile_search_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_connect_skin" class="label">접속자 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_skin_select('connect', 'cf_connect_skin', 'cf_connect_skin', $config['cf_connect_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_mobile_connect_skin" class="label">모바일 접속자 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_mobile_skin_select('connect', 'cf_mobile_connect_skin', 'cf_mobile_connect_skin', $config['cf_mobile_connect_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_faq_skin" class="label">FAQ 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_skin_select('faq', 'cf_faq_skin', 'cf_faq_skin', $config['cf_faq_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_mobile_faq_skin" class="label">모바일 FAQ 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_mobile_skin_select('faq', 'cf_mobile_faq_skin', 'cf_mobile_faq_skin', $config['cf_mobile_faq_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_editor" class="label">에디터 선택</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="cf_editor" id="cf_editor">
                                <option value="">사용안함</option>
                                <?php for ($i=0; $i<count((array)$cf_editor); $i++) { ?>
                                <option value="<?php echo $cf_editor[$i]; ?>" <?php echo get_selected($config['cf_editor'], $cf_editor[$i])?>><?php echo $cf_editor[$i]; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> <?php echo G5_EDITOR_URL; ?> 밑의 DHTML 에디터 폴더를 선택합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_captcha" class="label">캡챠 선택<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <select name="cf_captcha" id="cf_captcha" required>
                                    <option value="kcaptcha" <?php echo get_selected($config['cf_captcha'], 'kcaptcha') ; ?>>Kcaptcha</option>
                                    <option value="recaptcha" <?php echo get_selected($config['cf_captcha'], 'recaptcha') ; ?>>reCAPTCHA V2</option>
                                    <option value="recaptcha_inv" <?php echo get_selected($config['cf_captcha'], 'recaptcha_inv') ; ?>>Invisible reCAPTCHA</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 사용할 캡챠를 선택합니다.<br>1) Kcaptcha 는 그누보드5의 기본캡챠입니다. ( 문자입력 )<br>2) reCAPTCHA V2 는 구글에서 서비스하는 원클릭 형식의 간편한 캡챠입니다. ( 모바일 친화적 UI )<br>3) Invisible reCAPTCHA 는 구글에서 서비스하는 안보이는 형식의 캡챠입니다. ( 간혹 퀴즈를 풀어야 합니다. )</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r kcaptcha_mp3">
                        <div class="adm-form-td td-l">
                            <label for="cf_captcha_mp3" class="label">음성캡챠 선택</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <select name="cf_captcha_mp3" id="cf_captcha_mp3" required>
                                    <option value="">선택</option>
                                    <?php for ($i=0; $i<count((array)$cf_captcha_mp3); $i++) { ?>
                                    <option value="<?php echo $cf_captcha_mp3[$i]; ?>" <?php echo get_selected($config['cf_captcha_mp3'], $cf_captcha_mp3[$i])?>><?php echo $cf_captcha_mp3[$i]; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong>kcaptcha 사용시 <?php echo str_replace(array('recaptcha_inv', 'recaptcha'), 'kcaptcha', G5_CAPTCHA_URL); ?>/mp3 밑의 음성 폴더를 선택합니다.'</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_recaptcha_site_key" class="label">구글 reCAPTCHA Site key</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_recaptcha_site_key" id="cf_recaptcha_site_key" value="<?php echo get_sanitize_input($config['cf_recaptcha_site_key']); ?>">
                                <a href="https://www.google.com/recaptcha/admin" target="_blank" class="button"><input type="button">등록하기</a>
                            </div>
                            <div class="note"><strong>Note:</strong> reCAPTCHA V2와 Invisible reCAPTCHA 캡챠의<br>sitekey 와 secret 키는 동일하지 않고, 서로 발급받는 키가 다릅니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_recaptcha_secret_key" class="label">구글 reCAPTCHA Secret key</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_recaptcha_secret_key" id="cf_recaptcha_secret_key" value="<?php echo get_sanitize_input($config['cf_recaptcha_secret_key']); ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 구글 reCAPTCHA Secret key 를 입력해 주세요.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_possible_ip" class="label">접근가능 IP</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="textarea">
                                <textarea name="cf_possible_ip" id="cf_possible_ip" rows="8"><?php echo get_sanitize_input($config['cf_possible_ip']); ?></textarea>
                            </label>
                            <div class="note"><strong>Note:</strong> 입력된 IP의 컴퓨터만 접근할 수 있습니다.<br>123.123.+ 도 입력 가능. (엔터로 구분)</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_intercept_ip" class="label">접근차단 IP</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="textarea">
                                <textarea name="cf_intercept_ip" id="cf_intercept_ip" rows="8"><?php echo get_sanitize_input($config['cf_intercept_ip']); ?></textarea>
                            </label>
                            <div class="note"><strong>Note:</strong> 입력된 IP의 컴퓨터는 접근할 수 없음.<br>123.123.+ 도 입력 가능. (엔터로 구분)</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="cf_analytics" class="label">방문자분석 스크립트</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="cf_analytics" id="cf_analytics" rows="8"><?php echo get_text($config['cf_analytics']); ?></textarea>
                        </label>
                        <div class="note"><strong>Note:</strong> 방문자분석 스크립트 코드를 입력합니다. 예) 구글 애널리틱스<br>관리자 페이지에서는 이 코드를 사용하지 않습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="cf_add_meta" class="label">추가 메타태그</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="cf_add_meta" id="cf_add_meta" rows="8"><?php echo get_text($config['cf_add_meta']); ?></textarea>
                        </label>
                        <div class="note"><strong>Note:</strong> 추가로 사용하실 meta 태그를 입력합니다.<br>관리자 페이지에서는 이 코드를 사용하지 않습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_syndi_token" class="label">네이버 신디케이션 연동키</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_syndi_token" id="cf_syndi_token" value="<?php echo isset($config['cf_syndi_token']) ? get_sanitize_input($config['cf_syndi_token']) : ''; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> <?php if (!function_exists('curl_init')) { ?><b>경고) curl이 지원되지 않아 네이버 신디케이션을 사용할수 없습니다.</b><br><?php } ?>네이버 신디케이션 연동키(token)을 입력하면 네이버 신디케이션을 사용할 수 있습니다.<br>연동키는 <a href="http://webmastertool.naver.com/" target="_blank"><u>네이버 웹마스터도구</u></a> -> 네이버 신디케이션에서 발급할 수 있습니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_syndi_except" class="label">네이버 신디케이션 제외게시판</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_syndi_except" id="cf_syndi_except" value="<?php echo isset($config['cf_syndi_except']) ? get_sanitize_input($config['cf_syndi_except']) : ''; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 네이버 신디케이션 수집에서 제외할 게시판 아이디를 | 로 구분하여 입력하십시오. 예) notice|adult<br>참고로 그룹접근사용 게시판, 글읽기 권한 2 이상 게시판, 비밀글은 신디케이션 수집에서 제외됩니다.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 홈페이지 기본환경 설정 : 끝 */ ?>

        <?php /* 게시판 기본 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_board" role="tabpanel" aria-labelledby="anc_cf_board_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 기본 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 각 게시판 관리에서 개별적으로 설정 가능합니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_delay_sec" class="label">글쓰기 간격<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <input type="text" name="cf_delay_sec" value="<?php echo (int) $config['cf_delay_sec'] ?>" id="cf_delay_sec" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 초단위로 지정한 초가 지난 후 글쓰기가 가능합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_link_target" class="label">새창 링크</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <select name="cf_link_target" id="cf_link_target">
                                    <option value="_blank"<?php echo get_selected($config['cf_link_target'], '_blank'); ?>>_blank</option>
                                    <option value="_self"<?php echo get_selected($$config['cf_link_target'], '_self'); ?>>_self</option>
                                    <option value="_top"<?php echo get_selected($$config['cf_link_target'], '_top'); ?>>_top</option>
                                    <option value="_new"<?php echo get_selected($$config['cf_link_target'], '_new'); ?>>_new</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 초단위로 지정한 초가 지난 후 글쓰기가 가능합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_search_part" class="label">검색 단위</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">건</i>
                                <input type="text" name="cf_search_part" id="cf_search_part" value="<?php echo $config['cf_search_part'] ?>" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 지정한 건수 단위로 검색</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_copy_log" class="label">복사, 이동시 로그</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox width-80px">
                                <input type="checkbox" name="cf_use_copy_log" value="1" id="cf_use_copy_log" <?php echo $config['cf_use_copy_log']?'checked':''; ?>><i></i> 남김
                            </label>
                            <div class="note"><strong>Note:</strong> 게시물 아래에 누구로 부터 복사, 이동됨 표시</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_read_point" class="label">글읽기 포인트<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_read_point" id="cf_read_point" value="<?php echo (int) $config['cf_read_point'] ?>" class="text-end" required>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_write_point" class="label">글쓰기 포인트<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_write_point" id="cf_write_point" value="<?php echo (int) $config['cf_write_point'] ?>" class="text-end" required>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_comment_point" class="label">댓글쓰기 포인트<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_comment_point" id="cf_comment_point" value="<?php echo (int) $config['cf_comment_point'] ?>" class="text-end" required>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_download_point" class="label">다운로드 포인트<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_download_point" id="cf_download_point" value="<?php echo (int) $config['cf_download_point'] ?>" class="text-end" required>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_write_limit" class="label">게시물 작성수 제한<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">건</i>
                                <input type="text" name="cf_write_limit" id="cf_write_limit" value="<?php echo (int) $config['cf_write_limit'] ?>" class="text-end" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 0 은 게시물 작성수 제한을 사용하지 않음</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_write_limit_type" class="label">게시물 작성수 제한방식<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <select name="cf_write_limit_type" id="cf_write_limit_type">
                                    <option value="">선택</option>
                                    <option value="ip" <?php echo $config['cf_write_limit_type'] == 'ip' ? 'selected': ''; ?>>IP</option>
                                    <option value="mb_id" <?php echo $config['cf_write_limit_type'] == 'mb_id' ? 'selected': ''; ?>>회원아이디</option>
                                    <option value="all" <?php echo $config['cf_write_limit_type'] == 'all' ? 'selected': ''; ?>>IP+회원아이디</option>
                                </select><i></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_image_extension" class="label">이미지 업로드 확장자</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_image_extension" value="<?php echo get_sanitize_input($config['cf_image_extension']); ?>" id="cf_image_extension">
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판 글작성시 이미지 파일 업로드 가능 확장자. | 로 구분</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_flash_extension" class="label">플래쉬 업로드 확장자</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_flash_extension" value="<?php echo get_sanitize_input($config['cf_flash_extension']); ?>" id="cf_flash_extension">
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판 글작성시 플래쉬 파일 업로드 가능 확장자. | 로 구분</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_movie_extension" class="label">동영상 업로드 확장자</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_movie_extension" value="<?php echo get_sanitize_input($config['cf_movie_extension']); ?>" id="cf_movie_extension">
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판 글작성시 동영상 파일 업로드 가능 확장자. | 로 구분</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="cf_filter" class="label">단어 필터링</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="cf_filter" id="cf_filter" rows="8"><?php echo get_sanitize_input($config['cf_filter']); ?></textarea>
                        </label>
                        <div class="note"><strong>Note:</strong> 입력된 단어가 포함된 내용은 게시할 수 없습니다. 단어와 단어 사이는 ,로 구분합니다.</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 게시판 기본 설정 : 끝 */ ?>

        <?php /* 회원가입 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_join" role="tabpanel" aria-labelledby="anc_cf_join_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>회원가입 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 회원가입 시 사용할 스킨과 입력 받을 정보 등을 설정할 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_member_skin" class="label">회원 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_skin_select('member', 'cf_member_skin', 'cf_member_skin', $config['cf_member_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_mobile_member_skin" class="label">모바일 회원 스킨</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_mobile_skin_select('member', 'cf_mobile_member_skin', 'cf_mobile_member_skin', $config['cf_mobile_member_skin'], ''); ?><i></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label class="label">홈페이지 입력</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <label for="cf_use_homepage" class="checkbox"><input type="checkbox" name="cf_use_homepage" value="1" id="cf_use_homepage" <?php echo $config['cf_use_homepage']?'checked':''; ?>><i></i> 보이기</label>
                                <label for="cf_req_homepage" class="checkbox"><input type="checkbox" name="cf_req_homepage" value="1" id="cf_req_homepage" <?php echo $config['cf_req_homepage']?'checked':''; ?>><i></i> 필수입력</label>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label class="label">주소 입력</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <label for="cf_use_addr" class="checkbox"><input type="checkbox" name="cf_use_addr" value="1" id="cf_use_addr" <?php echo $config['cf_use_addr']?'checked':''; ?>><i></i> 보이기</label>
                                <label for="cf_req_addr" class="checkbox"><input type="checkbox" name="cf_req_addr" value="1" id="cf_req_addr" <?php echo $config['cf_req_addr']?'checked':''; ?>><i></i> 필수입력</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label class="label">전화번호 입력</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <label for="cf_use_tel" class="checkbox"><input type="checkbox" name="cf_use_tel" value="1" id="cf_use_tel" <?php echo $config['cf_use_tel']?'checked':''; ?>><i></i> 보이기</label>
                                <label for="cf_req_tel" class="checkbox"><input type="checkbox" name="cf_req_tel" value="1" id="cf_req_tel" <?php echo $config['cf_req_tel']?'checked':''; ?>><i></i> 필수입력</label>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label class="label">휴대폰번호 입력</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <label for="cf_use_hp" class="checkbox"><input type="checkbox" name="cf_use_hp" value="1" id="cf_use_hp" <?php echo $config['cf_use_hp']?'checked':''; ?>><i></i> 보이기</label>
                                <label for="cf_req_hp" class="checkbox"><input type="checkbox" name="cf_req_hp" value="1" id="cf_req_hp" <?php echo $config['cf_req_hp']?'checked':''; ?>><i></i> 필수입력</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label class="label">서명 입력</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <label for="cf_use_signature" class="checkbox"><input type="checkbox" name="cf_use_signature" value="1" id="cf_use_signature" <?php echo $config['cf_use_signature']?'checked':''; ?>><i></i> 보이기</label>
                                <label for="cf_req_signature" class="checkbox"><input type="checkbox" name="cf_req_signature" value="1" id="cf_req_signature" <?php echo $config['cf_req_signature']?'checked':''; ?>><i></i> 필수입력</label>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label class="label">자기소개 입력</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <label for="cf_use_profile" class="checkbox"><input type="checkbox" name="cf_use_profile" value="1" id="cf_use_profile" <?php echo $config['cf_use_profile']?'checked':''; ?>><i></i> 보이기</label>
                                <label for="cf_req_profile" class="checkbox"><input type="checkbox" name="cf_req_profile" value="1" id="cf_req_profile" <?php echo $config['cf_req_profile']?'checked':''; ?>><i></i> 필수입력</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_register_level" class="label">회원가입시 권한</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_member_level_select('cf_register_level', 1, 9, $config['cf_register_level']) ?><i></i>
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_register_point" class="label">회원가입시 포인트</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_register_point" id="cf_register_point" value="<?php echo (int) $config['cf_register_point']; ?>" class="text-end">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_leave_day" class="label">회원탈퇴후 삭제일</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <i class="icon-append">일</i>
                            <input type="text" name="cf_leave_day" value="<?php echo (int) $config['cf_leave_day'] ?>" id="cf_leave_day" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 설정일 이후 자동 삭제</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_member_icon" class="label">회원아이콘 사용</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <select name="cf_use_member_icon" id="cf_use_member_icon">
                                    <option value="0"<?php echo get_selected($config['cf_use_member_icon'], '0') ?>>미사용
                                    <option value="1"<?php echo get_selected($config['cf_use_member_icon'], '1') ?>>아이콘만 표시
                                    <option value="2"<?php echo get_selected($config['cf_use_member_icon'], '2') ?>>아이콘+이름 표시
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 게시물에 게시자 닉네임 대신 아이콘 사용</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_icon_level" class="label">회원 아이콘, 이미지 업로드 권한</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="select max-width-250px">
                                <?php echo get_member_level_select('cf_icon_level', 1, 9, $config['cf_icon_level']) ?><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 설정 레벨 이상 권한을 갖습니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_member_icon_size" class="label">회원아이콘 용량</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append text-width">Byte</i>
                                <input type="text" name="cf_member_icon_size" value="<?php echo (int) $config['cf_member_icon_size'] ?>" id="cf_member_icon_size" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정 용량 이하만 허용</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label class="label">회원아이콘 사이즈</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <span>
                                    <label for="cf_member_icon_width" class="input"><i class="icon-prepend">가로</i><i class="icon-append">px</i><input type="text" name="cf_member_icon_width" id="cf_member_icon_width" value="<?php echo (int) $config['cf_member_icon_width']; ?>" class="text-end width-170px"></label>
                                </span>
                                <span>이하</span>
                                <br>
                                <span>
                                    <label for="cf_member_icon_height" class="input"><i class="icon-prepend">세로</i><i class="icon-append">px</i><input type="text" name="cf_member_icon_height" id="cf_member_icon_height" value="<?php echo (int) $config['cf_member_icon_height']; ?>" class="text-end width-170px"></label>
                                </span>
                                <span>이하</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_member_img_size" class="label">회원이미지 용량</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">Byte</i>
                                <input type="text" name="cf_member_img_size" value="<?php echo (int) $config['cf_member_img_size'] ?>" id="cf_member_img_size" class="text-end">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정 용량 이하만 허용</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label class="label">회원이미지 사이즈</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="inline-group">
                                <span>
                                    <label for="cf_member_img_width" class="input"><i class="icon-prepend">가로</i><i class="icon-append">px</i><input type="text" name="cf_member_img_width" id="cf_member_img_width" value="<?php echo (int) $config['cf_member_img_width']; ?>" class="text-end width-170px"></label>
                                </span>
                                <span>이하</span>
                                <br>
                                <span>
                                    <label for="cf_member_img_height" class="input"><i class="icon-prepend">세로</i><i class="icon-append">px</i><input type="text" name="cf_member_img_height" id="cf_member_img_height" value="<?php echo (int) $config['cf_member_img_height']; ?>" class="text-end width-170px"></label>
                                </span>
                                <span>이하</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_recommend" class="label">추천인제도 사용</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox width-80px">
                                <input type="checkbox" name="cf_use_recommend" value="1" id="cf_use_recommend" <?php echo $config['cf_use_recommend']?'checked':''; ?>> <i></i> 사용
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_recommend_point" class="label">추천인 포인트</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="cf_recommend_point" id="cf_recommend_point" value="<?php echo $config['cf_recommend_point']; ?>" class="text-end">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_prohibit_id" class="label">아이디,닉네임 금지단어</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="textarea">
                                <textarea name="cf_prohibit_id" id="cf_prohibit_id" rows="8"><?php echo get_sanitize_input($config['cf_prohibit_id']); ?></textarea>
                            </label>
                            <div class="note"><strong>Note:</strong> 회원아이디, 닉네임으로 사용할 수 없는 단어를 정하여 쉼표 (,)로 구분</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_prohibit_email" class="label">입력 금지 메일</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="textarea">
                                <textarea name="cf_prohibit_email" id="cf_prohibit_email" rows="8"><?php echo get_sanitize_input($config['cf_prohibit_email']); ?></textarea>
                            </label>
                            <div class="note"><strong>Note:</strong> 입력 받지 않을 도메인을 지정합니다. 엔터로 구분 ex) hotmail.com</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="cf_stipulation" class="label">회원가입약관</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="cf_stipulation" id="cf_stipulation" rows="8"><?php echo html_purifier($config['cf_stipulation']); ?></textarea>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="cf_privacy" class="label">개인정보처리방침</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="cf_privacy" id="cf_privacy" rows="8"><?php echo html_purifier($config['cf_privacy']); ?></textarea>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 회원가입 설정 : 끝 */ ?>

        <?php /* 본인확인 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_cert" role="tabpanel" aria-labelledby="anc_cf_cert_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>본인확인 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 회원가입 시 본인확인 수단을 설정합니다.<br>
                            <i class="fas fa-info-circle"></i> 실명과 휴대폰 번호 그리고 본인확인 당시에 성인인지의 여부를 저장합니다.<br>
                            <i class="fas fa-info-circle"></i> 게시판의 경우 본인확인 또는 성인여부를 따져 게시물 조회 및 쓰기 권한을 줄 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_use" class="label">본인확인</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="cf_cert_use" id="cf_cert_use">
                                <?php echo option_selected("0", $config['cf_cert_use'], "사용안함"); ?>
                                <?php echo option_selected("1", $config['cf_cert_use'], "테스트"); ?>
                                <?php echo option_selected("2", $config['cf_cert_use'], "실서비스"); ?>
                            </select><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_find" class="label">회원정보찾기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_cert_find" id="cf_cert_find" value="1" <?php echo isset($config['cf_cert_find']) && $config['cf_cert_find'] == 1 ? 'checked': ''; ?>><i></i>아이디/비밀번호 찾기에 사용하기
                        </label>
                        <div class="note"><strong>Note:</strong> 휴대폰/아이핀 본인확인을 이용하시다가 간편인증을 이용하시는 경우, 기존 회원은 아이디/비밀번호 찾기에 사용할 수 없을 수 있습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_simple" class="label">통합인증(간편인증)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="cf_cert_simple" id="cf_cert_simple">
                                <?php echo option_selected("", $config['cf_cert_simple'], "사용안함"); ?>
                                <?php echo option_selected("inicis", $config['cf_cert_simple'], "KG이니시스 통합인증(간편인증)"); ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> KG이니시스의 통합인증(간편인증+전자서명) 서비스에서 전자서명을 제외한 간편인증 서비스 입니다. <a href="https://www.inicis.com/all-auth-service" target="_blank"><u>KG이니시스 통합인증 안내</u></a></div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_use_seed" class="label">통합인증 암호화 적용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="cf_cert_use_seed" id="cf_cert_use_seed">
                                <?php echo option_selected("0", $config['cf_cert_use_seed'], "사용안함"); ?>
                                <?php echo option_selected("1", $config['cf_cert_use_seed'], "사용함"); ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> KG이니시스 통합인증서비스에 암호화를 적용합니다. 만일 글자가 깨지는 문제가 발생하면 사용안함으로 적용해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_hp" class="label">휴대폰 본인확인</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="cf_cert_hp" id="cf_cert_hp">
                                <?php echo option_selected("", $config['cf_cert_hp'], "사용안함"); ?>
                                <?php echo option_selected("kcb", $config['cf_cert_hp'], "코리아크레딧뷰로(KCB) 휴대폰 본인확인"); ?>
                                <?php echo option_selected("kcp", $config['cf_cert_hp'], "NHN KCP 휴대폰 본인확인"); ?>
                            </select><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_ipin" class="label">아이핀 본인확인</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="cf_cert_ipin" id="cf_cert_ipin">
                                <?php echo option_selected("",    $config['cf_cert_ipin'], "사용안함"); ?>
                                <?php echo option_selected("kcb", $config['cf_cert_ipin'], "코리아크레딧뷰로(KCB) 아이핀"); ?>
                            </select><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_kg_mid" class="label">KG이니시스 간편인증 MID</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="input max-width-250px">
                                    <i class="icon-prepend">SRA</i>
                                    <input type="text" name="cf_cert_kg_mid" value="<?php echo get_sanitize_input($config['cf_cert_kg_mid']); ?>" id="cf_cert_kg_mid" minlength="7" maxlength="7">
                                </label>
                            </span>
                            <span>
                                <a href="http://sir.kr/main/service/inicis_cert_form.php" target="_blank" class="btn-e btn-e-lg btn-e-dark">KG이니시스 간편인증 신청</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_kg_cd" class="label">KG이니시스 간편인증 API KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_cert_kg_cd" value="<?php echo get_sanitize_input($config['cf_cert_kg_cd']); ?>" id="cf_cert_kg_cd" minlength="32" maxlength="32">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_kcb_cd" class="label">코리아크레딧뷰로 KCB 회원사ID</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_cert_kcb_cd" value="<?php echo get_sanitize_input($config['cf_cert_kcb_cd']); ?>" id="cf_cert_kcb_cd">
                        </label>
                        <div class="note"><strong>Note:</strong> KCB 회원사ID를 입력해 주십시오.<br>서비스에 가입되어 있지 않다면, KCB와 계약체결 후 회원사ID를 발급 받으실 수 있습니다. 이용하시려는 서비스에 대한 계약을 아이핀, 휴대폰 본인확인 각각 체결해주셔야 합니다. 아이핀 본인확인 테스트의 경우에는 KCB 회원사ID가 필요 없으나, 휴대폰 본인확인 테스트의 경우 KCB 에서 따로 발급 받으셔야 합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_kcp_cd" class="label">NHN KCP 사이트코드</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="input max-width-250px">
                                    <i class="icon-prepend">SM</i>
                                    <input type="text" name="cf_cert_kcp_cd" value="<?php echo get_sanitize_input($config['cf_cert_kcp_cd']); ?>" id="cf_cert_kcp_cd">
                                </label>
                            </span>
                            <span>
                                <a href="http://sir.kr/main/service/p_cert.php" target="_blank" class="btn-e btn-e-lg btn-e-dark">NHN KCP 휴대폰 본인확인 서비스 신청</a>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> SM으로 시작하는 5자리 사이트 코드중 뒤의 3자리만 입력해 주십시오.<br>서비스에 가입되어 있지 않다면, 본인확인 서비스 신청페이지에서 서비스 신청 후 사이트코드를 발급 받으실 수 있습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_limit" class="label">본인확인 이용제한</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <i class="icon-append">회</i>
                            <input type="text" name="cf_cert_limit" value="<?php echo (int) $config['cf_cert_limit']; ?>" id="cf_cert_limit" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 1일 단위 본인인증을 시도할 수 있는 최대횟수를 지정합니다. (0으로 설정 시 무한으로 인증시도 가능)<br>아이핀/휴대폰/간편인증에서 개별 적용됩니다.)</div>
                    </div>
                </div>
                <div class="adm-form-tr cf_cert_service">
                    <div class="adm-form-td td-l">
                        <label for="cf_cert_req" class="label">본인확인 필수</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox width-80px">
                            <input type="checkbox" name="cf_cert_req" value="1" id="cf_cert_req"<?php echo get_checked($config['cf_cert_req'], 1); ?>><i></i> 예
                        </label>
                        <div class="note"><strong>Note:</strong> 회원가입 때 본인확인을 필수로 할지 설정합니다. 필수로 설정하시면 본인확인을 하지 않은 경우 회원가입이 안됩니다.</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 본인확인 설정 : 끝 */ ?>

        <?php /* 상담신청 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_counsel" role="tabpanel" aria-labelledby="anc_cf_counsel_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상담신청 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg m-b-10">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> <span class="m-r-10">상담 분야 및 상담 단계를 설정해 주세요.</span><br>
                            <i class="fas fa-info-circle"></i> <span class="m-r-10">상담 분야 및 상담 단계를 수정하시면 기존에 접수된 상담신청건에 영향을 미칩니다.</span>
                        </p>
                    </div>
                    <p class="m-b-5"><strong>관리자 - 회원관리 - 상담신청관리에서 '상담 신청 관리'를 할수 있습니다.</strong></p>
                    <p><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=counsel_list"><u class="text-blue">[상담 신청 관리 바로가기]</u></a></p>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">상담 신청 사용여부</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_use_counsel" id="cf_use_counsel" value="1" <?php echo $config['cf_use_counsel']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 상담 신청 기능의 사용 여부를 설정합니다. </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">상담 분야 설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_counsel_part" value="<?php echo get_sanitize_input($config['cf_counsel_part']); ?>" id="cf_counsel_part">
                        </label>
                        <div class="note"><strong>Note:</strong> 상담 분야를 쉼표(,)로 구분하여 입력해 주세요. </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">상담 단계 설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_counsel_status" value="<?php echo get_sanitize_input($config['cf_counsel_status']); ?>" id="cf_counsel_status">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">메일 수신 여부</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_counsel_sendmail" id="cf_counsel_sendmail" value="1" <?php echo $config['cf_counsel_sendmail']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용을 체크하면 상담 신청시, 상담내역이 아래 수신메일 주소로 발송됩니다. </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">수신 메일 주소</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_counsel_email" value="<?php echo $config['cf_counsel_email'] ? get_sanitize_input($config['cf_counsel_email']): $config['cf_admin_email']; ?>" id="cf_counsel_email">
                        </label>
                        <div class="note"><strong>Note:</strong> 여러명의 메일을 설정하시려면 쉼표(,)로 구분하여 메일을 입력해 주세요. 관리자 메일로 발송을 원할 경우, 이곳에 추가해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">설정 변경 내역 보이기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_counsel_view" id="cf_counsel_view" value="1" <?php echo $config['cf_counsel_view']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크시 위 '상담 분야 설정' 및 '상담 단계 설정' 내용을 변경하였을 경우, 변경 전 설정 내역을 '상담 신청 관리'에서 확인할 수 있습니다. </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 상담신청 설정 : 끝 */ ?>

        <?php /* 짧은주소 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_url" role="tabpanel" aria-labelledby="anc_cf_url_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>짧은주소 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> <span class="m-r-10">게시판과 컨텐츠 페이지에 짧은 URL 을 사용합니다.</span><a href="https://sir.kr/manual/g5/286" class="btn-e btn-e-dark btn-e-sm" target="_blank">설정 관련 메뉴얼 보기</a><br>
                            <?php if( $is_use_apache && ! $is_use_nginx ){ ?>
                                <?php if( ! $is_apache_rewrite ){ ?>
                                <i class="fas fa-info-circle"></i> <strong>Apache 서버인 경우 rewrite_module 이 비활성화 되어 있으면 짧은 주소를 사용할수 없습니다.</strong><br>
                                <?php } else if( ! $is_write_file && $is_apache_need_rules ) {   // apache인 경우 ?>
                                <i class="fas fa-info-circle"></i><strong> 짧은 주소 사용시 아래 Apache 설정 코드를 참고하여 설정해 주세요.</strong><br>
                                <?php } ?>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <div class="adm-form-info">
                    <?php if ( $is_use_apache ){ ?>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_apache" class="btn-e btn-e-indigo btn-e-lg">Apache 설정 코드 보기</button>
                    <?php } ?>
                    <?php if ( $is_use_nginx ) { ?>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_nginx" class="btn-e btn-e-indigo btn-e-lg">Nginx 설정 코드 보기</button>
                    <?php } ?>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">짧은주소 타입 설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php foreach($short_url_arrs as $k=>$v) {
                            $checked = ((int) $config['cf_bbs_rewrite'] === (int) $k) ? 'checked' : '';
                        ?>
                        <label for="cf_bbs_rewrite_<?php echo $k; ?>" class="radio"><input name="cf_bbs_rewrite" id="cf_bbs_rewrite_<?php echo $k; ?>" type="radio" value="<?php echo $k; ?>" <?php echo $checked;?>><i></i> 
                            <span class="d-inline-block width-100px"><?php echo $v['label']; ?></span>
                            <span><?php echo $v['url']; ?></span>
                        </label>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div id="modal_apache" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-700">Apache 설정 코드</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="m-b-10">
                                .htaccess 파일에 적용할 코드입니다.
                                <?php if( ! $is_apache_rewrite ) { ?>
                                <br><span class="text-amber">Apache 서버인 경우 rewrite_module 이 비활성화 되어 있으면 짧은 주소를 사용할수 없습니다.</span>
                                <?php } else if ( ! $is_write_file && $is_apache_need_rules ) { ?>
                                <br><span class="text-amber">자동으로 .htaccess 파일을 수정 할수 있는 권한이 없습니다.<br>.htaccess 파일이 없다면 생성 후에, 아래 코드가 없으면 코드를 복사하여 붙여넣기 해 주세요.</span>
                                <?php } else if ( ! $is_apache_need_rules ){ ?>
                                <br><span class="text-teal">정상적으로 적용된 상태입니다.</span>
                                <?php } ?>
                            </p>
                            <div class="eyoom-form">
                                <label class="textarea">
                                    <textarea readonly="readonly" rows="10"><?php echo get_eyoom_mod_rewrite_rules(true); ?></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_nginx" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title f-w-700">Nginx 설정 코드</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="m-b-10">아래 코드를 복사하여 nginx 설정 파일에 적용해 주세요.</p>
                            <div class="eyoom-form">
                                <label class="textarea">
                                    <textarea readonly="readonly" rows="10"><?php echo get_eyoom_nginx_conf_rules(true); ?></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 짧은주소 설정 : 끝 */ ?>

        <?php /* 기본 메일 환경 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_mail" role="tabpanel" aria-labelledby="anc_cf_mail_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>기본 메일 환경 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_email_use" class="label">메일발송 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_email_use" id="cf_email_use" value="1" <?php echo $config['cf_email_use']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크하지 않으면 메일발송을 아예 사용하지 않습니다. 메일 테스트도 불가합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_use_email_certify" class="label">메일인증 사용<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_use_email_certify" id="cf_use_email_certify" value="1" <?php echo $config['cf_use_email_certify']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 메일에 배달된 인증 주소를 클릭하여야 회원으로 인정합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_formmail_is_member" class="label">폼메일 사용 여부<strong class="sound_only">필수</strong></label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_formmail_is_member" id="cf_formmail_is_member" value="1" <?php echo $config['cf_formmail_is_member']?'checked':''; ?>><i></i> 회원만 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 체크하지 않으면 비회원도 사용 할 수 있습니다.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 글 작성 시 메일 설정</strong></div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_email_wr_super_admin" class="label">최고관리자</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_email_wr_super_admin" id="cf_email_wr_super_admin" value="1" <?php echo $config['cf_email_wr_super_admin']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 최고관리자에게 메일을 발송합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_email_wr_group_admin" class="label">그룹관리자</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_email_wr_group_admin" id="cf_email_wr_group_admin" value="1" <?php echo $config['cf_email_wr_group_admin']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 그룹관리자에게 메일을 발송합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_email_wr_board_admin" class="label">게시판관리자</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_email_wr_board_admin" id="cf_email_wr_board_admin" value="1" <?php echo $config['cf_email_wr_board_admin']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판관리자에게 메일을 발송합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_email_wr_write" class="label">원글작성자</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_email_wr_write" id="cf_email_wr_write" value="1" <?php echo $config['cf_email_wr_write']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 게시자님께 메일을 발송합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_email_wr_comment_all" class="label">댓글작성자</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_email_wr_comment_all" id="cf_email_wr_comment_all" value="1" <?php echo $config['cf_email_wr_comment_all']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 원글에 댓글이 올라오는 경우 댓글 쓴 모든 분들께 메일을 발송합니다.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>회원가입 및 기타 메일 설정</strong></div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_email_mb_super_admin" class="label">최고관리자 메일발송</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_email_mb_super_admin" id="cf_email_mb_super_admin" value="1" <?php echo $config['cf_email_mb_super_admin']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 최고관리자에게 메일을 발송합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_email_mb_member" class="label">회원님께 메일발송</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_email_mb_member" id="cf_email_mb_member" value="1" <?php echo $config['cf_email_mb_member']?'checked':''; ?>><i></i> 사용
                            </label>
                            <div class="note"><strong>Note:</strong> 회원가입한 회원님께 메일을 발송합니다.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>투표 기타의견 작성 시 메일 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_email_po_super_admin" class="label">최고관리자 메일발송</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_email_po_super_admin" id="cf_email_po_super_admin" value="1" <?php echo $config['cf_email_po_super_admin']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 최고관리자에게 메일을 발송합니다.</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 기본 메일 환경 설정 : 끝 */ ?>

        <?php /* 소셜네트워크 서비스(SNS) : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_sns" role="tabpanel" aria-labelledby="anc_cf_sns_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>소셜네트워크 서비스(SNS)</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_social_login_use" class="label">소셜로그인설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="cf_social_login_use" id="cf_social_login_use" value="1" <?php echo (!empty($config['cf_social_login_use']))?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 소셜로그인을 사용합니다. <a href="https://sir.kr/manual/g5/276" class="btn-e btn-e-xs btn-e-dark" target="_blank">설정 관련 메뉴얼 보기</a></div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="check_social_naver" class="label">네이버 소셜로그인</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_social_servicelist[]" id="check_social_naver" value="naver" <?php echo option_array_checked('naver', $config['cf_social_servicelist']); ?>><i></i> 네이버 로그인을 사용합니다.
                            </label>
                            <div class="note"><strong>Note:</strong> 네이버 CallbackURL : <?php echo get_social_callbackurl('naver'); ?></div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="check_social_kakao" class="label">카카오 소셜로그인</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_social_servicelist[]" id="check_social_kakao" value="kakao" <?php echo option_array_checked('kakao', $config['cf_social_servicelist']); ?>><i></i> 카카오 로그인을 사용합니다.
                            </label>
                            <div class="note"><strong>Note:</strong> 카카오 로그인 Redirect URI : <?php echo get_social_callbackurl('kakao', true); ?></div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="check_social_facebook" class="label">페이스북 소셜로그인</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_social_servicelist[]" id="check_social_facebook" value="facebook" <?php echo option_array_checked('facebook', $config['cf_social_servicelist']); ?>><i></i> 페이스북 로그인을 사용합니다.
                            </label>
                            <div class="note"><strong>Note:</strong> 페이스북 유효한 OAuth 리디렉션 URI : <?php echo get_social_callbackurl('facebook'); ?></div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="check_social_google" class="label">구글 소셜로그인</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_social_servicelist[]" id="check_social_google" value="google" <?php echo option_array_checked('google', $config['cf_social_servicelist']); ?>><i></i> 구글 로그인을 사용합니다.
                            </label>
                            <div class="note"><strong>Note:</strong> 구글 승인된 리디렉션 URI : <?php echo get_social_callbackurl('google'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="check_social_twitter" class="label">트위터 소셜로그인</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_social_servicelist[]" id="check_social_twitter" value="twitter" <?php echo option_array_checked('twitter', $config['cf_social_servicelist']); ?>><i></i> 트위터 로그인을 사용합니다.
                            </label>
                            <div class="note"><strong>Note:</strong> 트위터 CallbackURL : <?php echo get_social_callbackurl('twitter'); ?></div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="check_social_payco" class="label">페이코 소셜로그인</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="checkbox">
                                <input type="checkbox" name="cf_social_servicelist[]" id="check_social_payco" value="payco" <?php echo option_array_checked('payco', $config['cf_social_servicelist']); ?>><i></i> 페이코 로그인을 사용합니다.
                            </label>
                            <div class="note"><strong>Note:</strong> 페이코 CallbackURL : <?php echo get_social_callbackurl('payco', false, true); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>SNS 앱ID/KEY 설정</strong></div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_naver_clientid" class="label">네이버 Client ID</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_naver_clientid" id="cf_naver_clientid" value="<?php echo get_sanitize_input($config['cf_naver_clientid']); ?>">
                                <a href="https://developers.naver.com/apps/#/register" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_naver_secret" class="label">네이버 Client Secret</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_naver_secret" id="cf_naver_secret" value="<?php echo get_sanitize_input($config['cf_naver_secret']); ?>">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_facebook_appid" class="label">페이스북 앱 ID</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_facebook_appid" id="cf_facebook_appid" value="<?php echo get_sanitize_input($config['cf_facebook_appid']); ?>">
                                <a href="https://developers.facebook.com/apps" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_facebook_secret" class="label">페이스북 앱 Secret</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_facebook_secret" id="cf_facebook_secret" value="<?php echo get_sanitize_input($config['cf_facebook_secret']); ?>">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_twitter_key" class="label">트위터 컨슈머 Key</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_twitter_key" id="cf_twitter_key" value="<?php echo get_sanitize_input($config['cf_twitter_key']); ?>">
                                <a href="https://developer.twitter.com/en/apps" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_twitter_secret" class="label">트위터 컨슈머 Secret</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_twitter_secret" id="cf_twitter_secret" value="<?php echo get_sanitize_input($config['cf_twitter_secret']); ?>">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_google_clientid" class="label">구글 Client ID</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_google_clientid" id="cf_google_clientid" value="<?php echo get_sanitize_input($config['cf_google_clientid']); ?>">
                                <a href="https://console.developers.google.com" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_google_secret" class="label">구글 Client Secret</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_google_secret" id="cf_google_secret" value="<?php echo get_sanitize_input($config['cf_google_secret']); ?>">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_googl_shorturl_apikey" class="label">구글 짧은주소 API Key</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="input input-button">
                            <input type="text" name="cf_googl_shorturl_apikey" id="cf_googl_shorturl_apikey" value="<?php echo get_sanitize_input($config['cf_googl_shorturl_apikey']); ?>">
                            <a href="http://code.google.com/apis/console/" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_kakao_rest_key" class="label">카카오 REST API 키</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_kakao_rest_key" id="cf_kakao_rest_key" value="<?php echo get_sanitize_input($config['cf_kakao_rest_key']); ?>">
                                <a href="https://developers.kakao.com/product/kakaoLogin" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_kakao_client_secret" class="label">카카오 Client Secret</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_kakao_client_secret" id="cf_kakao_client_secret" value="<?php echo get_sanitize_input($config['cf_kakao_client_secret']); ?>">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_kakao_js_apikey" class="label">카카오 JavaScript 키</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <input type="text" name="cf_kakao_js_apikey" id="cf_kakao_js_apikey" value="<?php echo get_sanitize_input($config['cf_kakao_js_apikey']); ?>">
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_payco_clientid" class="label">페이코 Client ID</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <div class="input input-button">
                                <input type="text" name="cf_payco_clientid" id="cf_payco_clientid" value="<?php echo get_sanitize_input($config['cf_payco_clientid']); ?>">
                                <a href="https://developers.payco.com/guide" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_payco_secret" class="label">페이코 Secret</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input">
                                <input type="text" name="cf_payco_secret" id="cf_payco_secret" value="<?php echo get_sanitize_input($config['cf_payco_secret']); ?>">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>지도 API ID 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_map_google_id" class="label">구글지도 API KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="input input-button">
                            <input type="text" name="cf_map_google_id" id="cf_map_google_id" value="<?php echo get_sanitize_input($config['cf_map_google_id']); ?>">
                            <a href="https://mapsplatform.google.com/" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                        </div>
                        <a href="https://eyoom.net/page/eb4_manual_09_4" target="_blank" class="btn-e btn-e-lg btn-e-crimson m-b-5"><span class="text-white">구글지도 API키 발급 가이드</span></a>
                        <div class="note"><strong>Note:</strong> 구글 계정으로 로그인 &gt; 키가져오기 버튼 클릭 후, API KEY를 발급받을 수 있습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_map_naver_id" class="label">네이버지도 CLIENT ID</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input"><input type="text" name="cf_map_naver_id" id="cf_map_naver_id" value="<?php echo get_sanitize_input($config['cf_map_naver_id']); ?>"></label>
                        <a href="https://www.ncloud.com/product/applicationService/maps" target="_blank" class="btn-e btn-e-lg btn-e-teal m-b-5"><span class="text-white">네이버지도 신청 가이드</span></a>
                        <div class="note"><strong>Note:</strong> 신청 후, 내 애플리케이션 메뉴에서 Client ID를 확인하실 수 있습니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_map_daum_id" class="label">카카오지도 APP KEY</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="input input-button">
                            <input type="text" name="cf_map_daum_id" id="cf_map_daum_id" value="<?php echo get_sanitize_input($config['cf_map_daum_id']); ?>">
                            <a href="https://developers.kakao.com" target="_blank" class="button"><input type="button">등록하기<i class="fas fa-external-link-alt m-l-7"></i></a>
                        </div>
                        <a href="http://apis.map.daum.net/web/guide/" target="_blank" class="btn-e btn-e-lg btn-e-orange m-b-5"><span class="text-white">카카오지도 API 개발 가이드</span></a>
                        <div class="note"><strong>Note:</strong> 앱을 만든 후, 내 애플리케이션에서 등록한 앱의 일반 메뉴의 JavaScript키를 입력해 주세요.</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 소셜네트워크 서비스(SNS) : 끝 */ ?>

        <?php /* 레이아웃 추가설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_layout" role="tabpanel" aria-labelledby="anc_cf_layout_tab">
            <div class="adm-form-table">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>레이아웃 추가설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 기본 설정된 파일 경로 및 script, css 를 추가하거나 변경할 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="cf_add_script" class="label">추가 script, css</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="textarea">
                            <textarea name="cf_add_script" id="cf_add_script" rows="8"><?php echo get_text($config['cf_add_script']); ?></textarea>
                        </label>
                        <div class="note"><strong>Note:</strong> HTML의 &lt;/HEAD&gt; 태그위로 추가될 JavaScript와 css 코드를 설정합니다.<br>관리자 페이지에서는 이 코드를 사용하지 않습니다.</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 레이아웃 추가설정 : 끝 */ ?>

        <?php /* SMS 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_sms" role="tabpanel" aria-labelledby="anc_cf_sms_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>SMS 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="cf_sms_use" class="label">SMS 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select id="cf_sms_use" name="cf_sms_use">
                                <option value="" <?php echo get_selected($config['cf_sms_use'], ''); ?>>사용안함</option>
                                <option value="icode" <?php echo get_selected($config['cf_sms_use'], 'icode'); ?>>아이코드</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
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
                        <div class="note"><strong>Note:</strong> 전송유형을 SMS로 선택하시면 최대 80바이트까지 전송하실 수 있으며<br>LMS로 선택하시면 90바이트 이하는 SMS로, 그 이상은 ".G5_ICODE_LMS_MAX_LENGTH."바이트까지 LMS로 전송됩니다.<br>요금은 건당 SMS는 16원, LMS는 48원입니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr-wrap icode_old_version">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_icode_id" class="label">아이코드 회원아이디<br>(구버전)</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <input type="text" name="cf_icode_id" value="<?php echo get_sanitize_input($config['cf_icode_id']); ?>" id="cf_icode_id">
                            </label>
                            <div class="note"><strong>Note:</strong> 아이코드에서 사용하시는 회원아이디를 입력합니다.</div>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_icode_pw" class="label">아이코드 비밀번호<br>(구버전)</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <input type="password" name="cf_icode_pw" value="<?php echo get_sanitize_input($config['cf_icode_pw']); ?>" id="cf_icode_pw">
                            </label>
                            <div class="note"><strong>Note:</strong> 아이코드에서 사용하시는 비밀번호를 입력합니다.</div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr icode_old_version <?php if(!(isset($userinfo['payment']) && $userinfo['payment'])){ echo 'cf_tr_hide'; } ?>">
                    <div class="adm-form-td td-l">
                        <label class="label">요금제<br>(구버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <input type="hidden" name="cf_icode_server_ip" value="<?php echo get_sanitize_input($config['cf_icode_server_ip']); ?>">
                        <label class="input m-t-5">
                            <?php if ($userinfo['payment'] == 'A') { ?>
                            충전제<input type="hidden" name="cf_icode_server_port" value="7295" id="cf_icode_server_port">
                            <?php } else if ($userinfo['payment'] == 'C') { ?>
                            정액제<input type="hidden" name="cf_icode_server_port" value="7296" id="cf_icode_server_port">
                            <?php } else { ?>
                            가입해주세요.<input type="hidden" name="cf_icode_server_port" value="7295" id="cf_icode_server_port">
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <?php if ($userinfo['payment'] == 'A') { ?>
                <div class="adm-form-tr icode_old_version">
                    <div class="adm-form-td td-l">
                        <label class="label">충전 잔액<br>(구버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo number_format($userinfo['coin']); ?> 원.
                        <a href="http://www.icodekorea.com/smsbiz/credit_card_amt.php?icode_id=<?php echo get_text($config['cf_icode_id']); ?>&amp;icode_passwd=<?php echo get_text($config['cf_icode_pw']); ?>" target="_blank" class="btn-e btn-e-sm btn-e-dark text-center">충전하기</a>
                    </div>
                </div>
                <?php } ?>
                <div class="adm-form-tr icode_json_version">
                    <div class="adm-form-td td-l">
                        <label class="label" for="cf_icode_token_key">아이코드 토큰키<br>(JSON버전)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="cf_icode_token_key" value="<?php echo isset($config['cf_icode_token_key']) ? get_sanitize_input($config['cf_icode_token_key']) : ''; ?>" id="cf_icode_token_key">
                        </label>
                        <div class="note"><strong>Note:</strong> 아이코드 JSON 버전의 경우 아이코드 토큰키를 입력시 실행됩니다.<br>SMS 전송유형을 LMS로 설정시 90바이트 이내는 SMS, 90 ~ 2000 바이트는 LMS 그 이상은 절삭 되어 LMS로 발송됩니다.</div>
                        <div class="note"><strong>Note:</strong> 아이코드 사이트 -> 토큰키관리 메뉴에서 생성한 토큰키를 입력합니다.</div>
                        <br>
                        서버아이피 : <?php echo $_SERVER['SERVER_ADDR']; ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">아이코드 SMS 신청<br>회원가입</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo number_format($userinfo['coin']); ?> 원
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">아이코드 충전하기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <a href="http://icodekorea.com/res/join_company_fix_a.php?sellid=sir2" target="_blank" class="btn-e btn-e-lg btn-e-dark">아이코드 회원가입</a>
                    </div>
                </div>
            </div>
        </div>
        <?php /* SMS 설정 : 끝 */ ?>

        <?php /* 여분필드 기본 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_cf_extra" role="tabpanel" aria-labelledby="anc_cf_extra_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>여분필드 기본 설정</strong></div>
                <?php for ($i=1; $i<=10; $i++) { ?>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l">
                        <div class="adm-form-td td-l">
                            <label for="cf_<?php echo $i; ?>_subj" class="label">여분필드 <?php echo $i; ?> 제목</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <input type="text" name="cf_<?php echo $i; ?>_subj" id="cf_<?php echo $i; ?>_subj" value="<?php echo get_text($config['cf_'.$i.'_subj']); ?>">
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r">
                        <div class="adm-form-td td-l">
                            <label for="cf_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?> 값</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label class="input max-width-250px">
                                <input type="text" name="cf_<?php echo $i; ?>" id="cf_<?php echo $i; ?>" value="<?php echo get_sanitize_input($config['cf_'.$i]); ?>">
                            </label>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* 여분필드 기본 설정 : 끝 */ ?>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script>
$(function() {
    // 기본환경 탭 우선 active 적용
    $(".anc_cf_basic").addClass('active');

    <?php if (!$config['cf_cert_use']) { ?>
    $(".cf_cert_service").addClass("cf_cert_hide");
    <?php } ?>

    $("#cf_cert_use").change(function(){
        switch($(this).val()) {
            case "0":
                $(".cf_cert_service").addClass("cf_cert_hide");
                break;
            default:
                $(".cf_cert_service").removeClass("cf_cert_hide");
                break;
        }
    });

    $("#cf_captcha").on("change", function(){
        if ($(this).val() == 'recaptcha' || $(this).val() == 'recaptcha_inv') {
            $("[class^='kcaptcha_']").hide();
        } else {
            $("[class^='kcaptcha_']").show();
        }
    }).trigger("change");
});

function fconfigform_submit(f) {
    var current_user_ip = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
    var cf_intercept_ip_val = f.cf_intercept_ip.value;

    if( cf_intercept_ip_val && current_user_ip ){
        var cf_intercept_ips = cf_intercept_ip_val.split("\n");

        for(var i=0; i < cf_intercept_ips.length; i++){
            if ( cf_intercept_ips[i].trim() ) {
                cf_intercept_ips[i] = cf_intercept_ips[i].replace(".", "\.");
                cf_intercept_ips[i] = cf_intercept_ips[i].replace("+", "[0-9\.]+");
                
                var re = new RegExp(cf_intercept_ips[i]);
                if ( re.test(current_user_ip) ){
                    alert("현재 접속 IP : "+ current_user_ip +" 가 차단될수 있기 때문에, 다른 IP를 입력해 주세요.");
                    return false;
                }
            }
        }
    }

    var eyoom_admin_theme = f.cf_eyoom_admin_theme.value;
    var eba_theme = f.eba_theme.value;
    if (eyoom_admin_theme == eba_theme) {
        f.target = "blank_iframe";
    }

    f.action = "<?php echo $action_url1; ?>";
    return true;
}

<?php if (G5_IS_MOBILE) { ?>
$(function() {
    $(".adm-table-form-wrap td").removeAttr('colspan');
});
<?php } ?>
</script>

<?php
// 본인확인 모듈 실행권한 체크
if($config['cf_cert_use']) {
    // kcb일 때
    if($config['cf_cert_ipin'] == 'kcb' || $config['cf_cert_hp'] == 'kcb') {
        // 실행모듈
        if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_OKNAME_PATH.'/bin/okname';
            else
                $exe = G5_OKNAME_PATH.'/bin/okname_x64';
        } else {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_OKNAME_PATH.'/bin/okname.exe';
            else
                $exe = G5_OKNAME_PATH.'/bin/oknamex64.exe';
        }

        echo module_exec_check($exe, 'okname');

        if(is_dir(G5_OKNAME_PATH.'/log') && is_writable(G5_OKNAME_PATH.'/log') && function_exists('check_log_folder') ) {
            check_log_folder(G5_OKNAME_PATH.'/log');
        }
    }

    // kcp일 때
    if($config['cf_cert_hp'] == 'kcp') {
        if(strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            if(PHP_INT_MAX == 2147483647) // 32-bit
                $exe = G5_KCPCERT_PATH . '/bin/ct_cli';
            else
                $exe = G5_KCPCERT_PATH . '/bin/ct_cli_x64';
        } else {
            $exe = G5_KCPCERT_PATH . '/bin/ct_cli_exe.exe';
        }

        echo module_exec_check($exe, 'ct_cli');
    }

    // LG의 경우 log 디렉토리 체크
    if($config['cf_cert_hp'] == 'lg') {
        $log_path = G5_LGXPAY_PATH.'/lgdacom/log';

        if(!is_dir($log_path)) {
            echo '<script>'.PHP_EOL;
            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_LGXPAY_PATH).'/lgdacom 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
            echo '</script>'.PHP_EOL;
        } else {
            if(!is_writable($log_path)) {
                echo '<script>'.PHP_EOL;
                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
                echo '</script>'.PHP_EOL;
            }
        }
    }
}
?>