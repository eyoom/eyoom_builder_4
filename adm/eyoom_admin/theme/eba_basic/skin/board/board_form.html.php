<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'board_list';
$g5_title = '게시판관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-board-form">
    <div class="adm-headline">
        <?php if ($w=='u' && $board) { ?>
        <h3>게시판 설정 [ <span class="text-crimson"><?php echo $board['bo_table'] . ' : ' . $board['bo_subject']; ?></span> ]</h3>
        <?php } else { ?>
        <h3>게시판 추가</h3>
        <?php } ?>
    </div>

    <form name="fboardform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fboardform_submit(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id; ?>">
    <input type="hidden" name="bo_skin" value="<?php echo $board['bo_skin']; ?>">
    <input type="hidden" name="bo_mobile_skin" value="<?php echo $board['bo_mobile_skin']; ?>">
    <input type="hidden" name="bo_ex" value="<?php echo $bo_ex; ?>">
    <input type="hidden" name="bo_cate" value="<?php echo $bo_cate; ?>">
    <input type="hidden" name="bo_sideview" value="<?php echo $bo_sideview; ?>">
    <input type="hidden" name="bo_dhtml" value="<?php echo $bo_dhtml; ?>">
    <input type="hidden" name="bo_secret" value="<?php echo $bo_secret; ?>">
    <input type="hidden" name="bo_good" value="<?php echo $bo_good; ?>">
    <input type="hidden" name="bo_nogood" value="<?php echo $bo_nogood; ?>">
    <input type="hidden" name="bo_file" value="<?php echo $bo_file; ?>">
    <input type="hidden" name="bo_cont" value="<?php echo $bo_cont; ?>">
    <input type="hidden" name="bo_list" value="<?php echo $bo_list; ?>">
    <input type="hidden" name="bo_sns" value="<?php echo $bo_sns; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="pg-anchor">
        <div class="pg-anchor-in">
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ($pg_anchor as $ac_id => $ac_name) { ?>
                <li role="presentation">
                    <a href="javasecipt:void(0);" class="anchor-menu <?php echo $ac_id; ?>" id="<?php echo $ac_id; ?>_tab" data-bs-toggle="tab" data-bs-target="#<?php echo $ac_id; ?>"><?php echo $ac_name; ?></a>
                </li>
                <?php } ?>
                <?php if (!$wmode && $w=='u') { ?>
                <li role="presentation">
                    <a href="<?php echo G5_ADMIN_URL."?dir=board&amp;pid=board_extend&amp;bo_table={$bo_table}"; ?>" class="anchor-menu" id="eyoom_extend_tab">확장필드</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo G5_ADMIN_URL."?dir=board&amp;pid=board_addon&amp;bo_table={$bo_table}"; ?>" class="anchor-menu" id="eyoom_extend_tab">확장기능</a>
                </li>
                <?php } ?>
            </ul>
            <div class="tab-bottom-line"></div>
        </div>
    </div>

    <div class="tab-content">
        <?php /* 게시판 기본 설정 : 시작 */ ?>
        <div class="tab-pane show active" id="anc_bo_basic" role="tabpanel" aria-labelledby="anc_bo_basic_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 기본 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_table" class="label">TABLE<?php echo $sound_only ?></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="input width-250px"><input type="text" name="bo_table" id="bo_table" value="<?php echo $board['bo_table']; ?>" maxlength="20" <?php echo $required; ?> <?php echo $readonly; ?> maxlength="20"></label>
                            </span>
                            <?php if ($w == '') { ?>
                            <span>영문자, 숫자, _ 만 가능 (공백없이 20자 이내)</span>
                            <?php } else if (!$wmode) { ?>
                            <span><a href="<?php echo get_eyoom_pretty_url($board['bo_table']) ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">게시판 바로가기</a></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="gr_id" class="label">그룹<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="select width-250px"><?php echo get_group_select('gr_id', $board['gr_id'], 'required'); ?><i></i></label>
                            </span>
                            <?php if ($w=='u' && !$wmode) { ?>
                            <span>
                                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_list&amp;grid=<?php echo $board['gr_id']; ?>" class="btn-e btn-e-lg btn-e-dark">동일그룹 게시판목록</a>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_subject" class="label">게시판 제목<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="bo_subject" id="bo_subject" value="<?php echo get_text($board['bo_subject']) ?>" required maxlength="120">
                        </label>
                        <div class="note"><strong>Note:</strong> PC에서 사용될 게시판 명칭을 입력해 주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_subject" class="label">모바일 게시판 제목</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="bo_mobile_subject" id="bo_mobile_subject" value="<?php echo get_text($board['bo_mobile_subject']) ?>" maxlength="120">
                        </label>
                        <div class="note"><strong>Note:</strong> 모바일에서 보여지는 게시판 제목이 다른 경우에 입력합니다. 입력이 없으면 기본 게시판 제목이 출력됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="use_gnu_skin" class="label">게시판 스킨</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select width-250px">
                            <select name="use_gnu_skin" id="use_gnu_skin">
                                <option value="y" <?php echo $eyoom_board['use_gnu_skin'] == 'y' ? 'selected': ''; ?>>그누보드스킨</option>
                                <option value="n" <?php echo $eyoom_board['use_gnu_skin'] == 'n' || !$eyoom_board['use_gnu_skin'] ? 'selected': ''; ?>>이윰빌더스킨</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 그누보드 스킨을 사용할지 이윰빌더 스킨을 사용할지 설정해 주세요.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_gnu_skin" class="checkbox"><input type="checkbox" name="chk_grp_use_gnu_skin" value="1" id="chk_grp_use_gnu_skin"><i></i>그룹적용</label>
                                <label for="chk_all_use_gnu_skin" class="checkbox"><input type="checkbox" name="chk_all_use_gnu_skin" value="1" id="chk_all_use_gnu_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                    <script>
                    $(function() {
                        var use_gnu_skin = '<?php echo $eyoom_board['use_gnu_skin']; ?>';
                        showhide_fields(use_gnu_skin);
                        $("#use_gnu_skin").on("change", function() {
                            var use_gnu_skin = $(this).val();
                            showhide_fields(use_gnu_skin);
                        });
                    });
                    
                    function showhide_fields(use_gnu) {
                        if (use_gnu == 'y') {
                            $(".gnu-board").show();
                            $(".eyoom-board").hide();
                        } else if (use_gnu == 'n') {
                            $(".gnu-board").hide();
                            $(".eyoom-board").show();
                        }
                    }
                    </script>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_device" class="label">접속기기</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select id="bo_device" name="bo_device">
                                <option value="both"<?php echo get_selected($board['bo_device'], 'both'); ?>>PC와 모바일에서 모두 사용</option>
                                <option value="pc"<?php echo get_selected($board['bo_device'], 'pc'); ?>>PC 전용</option>
                                <option value="mobile"<?php echo get_selected($board['bo_device'], 'mobile'); ?>>모바일 전용</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> PC 와 모바일 사용을 구분합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_device" class="checkbox"><input type="checkbox" name="chk_grp_device" value="1" id="chk_grp_device"><i></i>그룹적용</label>
                                <label for="chk_all_device" class="checkbox"><input type="checkbox" name="chk_all_device" value="1" id="chk_all_device"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_category_list" class="label">분류</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input"><input type="text" name="bo_category_list" id="bo_category_list" value="<?php echo get_text($board['bo_category_list']); ?>"></label>
                        <label for="bo_use_category" class="checkbox"><input type="checkbox" name="bo_use_category" value="1" id="bo_use_category" <?php echo $board['bo_use_category']?'checked':''; ?>><i></i> 사용</label>
                        <div class="note"><strong>Note:</strong> 분류와 분류 사이는 | 로 구분하세요. (예: 질문|답변) 첫자로 #은 입력하지 마세요. (예: #질문|#답변 [X])<br>분류명에 일부 특수문자 ()/ 는 사용할수 없습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_category_list" class="checkbox"><input type="checkbox" name="chk_grp_category_list" value="1" id="chk_grp_category_list"><i></i>그룹적용</label>
                                <label for="chk_all_category_list" class="checkbox"><input type="checkbox" name="chk_all_category_list" value="1" id="chk_all_category_list"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_goto_url" class="label">글작성 후 이동 URL</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input">
                            <i class="icon-prepend fas fa-link"></i>
                            <input type="text" name="bo_goto_url" id="bo_goto_url" value="<?php echo $eyoom_board['bo_goto_url']; ?>">
                        </label>
                        <div class="note"><strong>Note:</strong> 글작성 후 이동 할 리턴 URL를 입력해 주세요. 예) <?php echo G5_URL; ?>/page/?aboutus</div>
                    </div>
                </div>
                <?php if ($w == 'u') { ?>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="proc_count" class="label">카운트 조정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="checkbox">
                            <input type="checkbox" name="proc_count" value="1" id="proc_count"><i></i> 카운트 조정하기
                        </label>
                        <div class="note"><strong>Note:</strong> 현재 원글수 : <?php echo number_format($board['bo_count_write']); ?>, 현재 댓글수 : <?php echo number_format($board['bo_count_comment']); ?><br>게시판 목록에서 글의 번호가 맞지 않을 경우에 체크하십시오.</div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* 게시판 기본 설정 : 끝 */ ?>

        <?php /* 게시판 권한 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_auth" role="tabpanel" aria-labelledby="anc_bo_auth_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 권한 설정</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_admin" class="label">게시판 관리자</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="bo_admin" id="bo_admin" value="<?php echo $board['bo_admin'] ?>" maxlength="20">
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_admin" class="checkbox"><input type="checkbox" name="chk_grp_admin" value="1" id="chk_grp_admin"><i></i>그룹적용</label>
                                <label for="chk_all_admin" class="checkbox"><input type="checkbox" name="chk_all_admin" value="1" id="chk_all_admin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_list_level" class="label">목록보기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_list_level', 1, 10, $board['bo_list_level']) ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 권한 1은 비회원, 2 이상 회원입니다. 권한은 10 이 가장 높습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_list_level" class="checkbox"><input type="checkbox" name="chk_grp_list_level" value="1" id="chk_grp_list_level"><i></i>그룹적용</label>
                                <label for="chk_all_list_level" class="checkbox"><input type="checkbox" name="chk_all_list_level" value="1" id="chk_all_list_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_read_level" class="label">글읽기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_read_level', 1, 10, $board['bo_read_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_read_level" class="checkbox"><input type="checkbox" name="chk_grp_read_level" value="1" id="chk_grp_read_level"><i></i>그룹적용</label>
                                <label for="chk_all_read_level" class="checkbox"><input type="checkbox" name="chk_all_read_level" value="1" id="chk_all_read_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_write_level" class="label">글쓰기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_write_level', 1, 10, $board['bo_write_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_write_level" class="checkbox"><input type="checkbox" name="chk_grp_write_level" value="1" id="chk_grp_write_level"><i></i>그룹적용</label>
                                <label for="chk_all_write_level" class="checkbox"><input type="checkbox" name="chk_all_write_level" value="1" id="chk_all_write_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_reply_level" class="label">글답변 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_reply_level', 1, 10, $board['bo_reply_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_reply_level" class="checkbox"><input type="checkbox" name="chk_grp_reply_level" value="1" id="chk_grp_reply_level"><i></i>그룹적용</label>
                                <label for="chk_all_reply_level" class="checkbox"><input type="checkbox" name="chk_all_reply_level" value="1" id="chk_all_reply_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_comment_level" class="label">댓글쓰기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_comment_level', 1, 10, $board['bo_comment_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_comment_level" class="checkbox"><input type="checkbox" name="chk_grp_comment_level" value="1" id="chk_grp_comment_level"><i></i>그룹적용</label>
                                <label for="chk_all_comment_level" class="checkbox"><input type="checkbox" name="chk_all_comment_level" value="1" id="chk_all_comment_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_link_level" class="label">링크 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_link_level', 1, 10, $board['bo_link_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_link_level" class="checkbox"><input type="checkbox" name="chk_grp_link_level" value="1" id="chk_grp_link_level"><i></i>그룹적용</label>
                                <label for="chk_all_link_level" class="checkbox"><input type="checkbox" name="chk_all_link_level" value="1" id="chk_all_link_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_upload_level" class="label">업로드 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_upload_level', 1, 10, $board['bo_upload_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_upload_level" class="checkbox"><input type="checkbox" name="chk_grp_upload_level" value="1" id="chk_grp_upload_level"><i></i>그룹적용</label>
                                <label for="chk_all_upload_level" class="checkbox"><input type="checkbox" name="chk_all_upload_level" value="1" id="chk_all_upload_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_download_level" class="label">다운로드 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_download_level', 1, 10, $board['bo_download_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_download_level" class="checkbox"><input type="checkbox" name="chk_grp_download_level" value="1" id="chk_grp_download_level"><i></i>그룹적용</label>
                                <label for="chk_all_download_level" class="checkbox"><input type="checkbox" name="chk_all_download_level" value="1" id="chk_all_download_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_html_level" class="label">HTML 쓰기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_html_level', 1, 10, $board['bo_html_level']) ?><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_html_level" class="checkbox"><input type="checkbox" name="chk_grp_html_level" value="1" id="chk_grp_html_level"><i></i>그룹적용</label>
                                <label for="chk_all_html_level" class="checkbox"><input type="checkbox" name="chk_all_html_level" value="1" id="chk_all_html_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_poll_level" class="label">투표하기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_member_level_select('bo_poll_level', 1, 10, $board['bo_poll_level']) ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 투표하기 기능은 게시판 "확장기능 > 애드온"에서 활성화 하실 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_poll_level" class="checkbox"><input type="checkbox" name="chk_grp_poll_level" value="1" id="chk_grp_poll_level"><i></i>그룹적용</label>
                                <label for="chk_all_poll_level" class="checkbox"><input type="checkbox" name="chk_all_poll_level" value="1" id="chk_all_poll_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 게시판 권한 설정 : 끝 */ ?>

        <?php /* 게시판 기능 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_function" role="tabpanel" aria-labelledby="anc_bo_function_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 기능 설정</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_count_modify" class="label">원글 수정 불가<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="bo_count_modify" id="bo_count_modify" value="<?php echo $board['bo_count_modify'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 댓글의 수가 설정 수 이상이면 원글을 수정할 수 없습니다. 0으로 설정하시면 댓글 수에 관계없이 수정할 수있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_count_modify" class="checkbox"><input type="checkbox" name="chk_grp_count_modify" value="1" id="chk_grp_count_modify"><i></i>그룹적용</label>
                                <label for="chk_all_count_modify" class="checkbox"><input type="checkbox" name="chk_all_count_modify" value="1" id="chk_all_count_modify"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_count_delete" class="label">원글 삭제 불가<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="bo_count_delete" id="bo_count_delete" value="<?php echo $board['bo_count_delete'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 댓글의 수가 설정 수 이상이면 원글을 삭제할 수 없습니다. 원글 삭제 불가 댓글수는 1 이상 입력하셔야 합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_count_delete" class="checkbox"><input type="checkbox" name="chk_grp_count_delete" value="1" id="chk_grp_count_delete"><i></i>그룹적용</label>
                                <label for="chk_all_count_delete" class="checkbox"><input type="checkbox" name="chk_all_count_delete" value="1" id="chk_all_count_delete"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_sideview" class="label">글쓴이 사이드뷰</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_sideview" id="bo_count_delete" value="1" <?php echo $board['bo_use_sideview']?'checked':''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 글쓴이 클릭시 나오는 레이어 메뉴</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_sideview" class="checkbox"><input type="checkbox" name="chk_grp_use_sideview" value="1" id="chk_grp_use_sideview"><i></i>그룹적용</label>
                                <label for="chk_all_use_sideview" class="checkbox"><input type="checkbox" name="chk_all_use_sideview" value="1" id="chk_all_use_sideview"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_secret" class="label">비밀글 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select id="bo_use_secret" name="bo_use_secret">
                                <?php echo option_selected(0, $board['bo_use_secret'], "사용하지 않음"); ?>
                                <?php echo option_selected(1, $board['bo_use_secret'], "체크박스"); ?>
                                <?php echo option_selected(2, $board['bo_use_secret'], "무조건"); ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> "체크박스"는 글작성시 비밀글 체크가 가능합니다. "무조건"은 작성되는 모든글을 비밀글로 작성합니다. (관리자는 체크박스로 출력합니다.) 스킨에 따라 적용되지 않을 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_secret" class="checkbox"><input type="checkbox" name="chk_grp_use_secret" value="1" id="chk_grp_use_secret"><i></i>그룹적용</label>
                                <label for="chk_all_use_secret" class="checkbox"><input type="checkbox" name="chk_all_use_secret" value="1" id="chk_all_use_secret"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_anonymous" class="label">익명글쓰기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="bo_use_anonymous" id="bo_use_anonymous">
                                <option value="" <?php echo $eyoom_board['bo_use_anonymous']=='' ? 'selected': ''; ?>>사용하지 않음</option>
                                <option value="1" <?php echo $eyoom_board['bo_use_anonymous']=='1' ? 'selected': ''; ?>>체크박스</option>
                                <option value="2" <?php echo $eyoom_board['bo_use_anonymous']=='2' ? 'selected': ''; ?>>무조건</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> "체크박스"는 글작성시 익명글 체크가 가능합니다. "무조건"은 작성된 모든글을 익명글로 표시합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_anonymous" class="checkbox"><input type="checkbox" name="chk_grp_anonymous" value="1" id="chk_grp_anonymous"><i></i>그룹적용</label>
                                <label for="chk_all_anonymous" class="checkbox"><input type="checkbox" name="chk_all_anonymous" value="1" id="chk_all_anonymous"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_dhtml_editor" class="label">DHTML 에디터 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_dhtml_editor" value="1" <?php echo $board['bo_use_dhtml_editor']?'checked':''; ?> id="bo_use_dhtml_editor"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 글작성시 내용을 DHTML 에디터 기능으로 사용할 것인지 설정합니다. 스킨에 따라 적용되지 않을 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_dhtml_editor" class="checkbox"><input type="checkbox" name="chk_grp_use_dhtml_editor" value="1" id="chk_grp_use_dhtml_editor"><i></i>그룹적용</label>
                                <label for="chk_all_use_dhtml_editor" class="checkbox"><input type="checkbox" name="chk_all_use_dhtml_editor" value="1" id="chk_all_use_dhtml_editor"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_select_editor" class="label">게시판 에디터 선택</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select id="bo_select_editor" name="bo_select_editor">
                            <?php
                            $arr = get_skin_dir('', G5_EDITOR_PATH);
                            for ($i=0; $i<count((array)$arr); $i++) {
                                if ($i == 0) echo "<option value=\"\">기본환경설정의 에디터 사용</option>";
                                echo "<option value=\"".$arr[$i]."\"".get_selected($board['bo_select_editor'], $arr[$i]).">".$arr[$i]."</option>\n";
                            }
                            ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판에 사용할 에디터를 설정합니다. 스킨에 따라 적용되지 않을 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_select_editor" class="checkbox"><input type="checkbox" name="chk_grp_select_editor" value="1" id="chk_grp_select_editor"><i></i>그룹적용</label>
                                <label for="chk_all_select_editor" class="checkbox"><input type="checkbox" name="chk_all_select_editor" value="1" id="chk_all_select_editor"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_approval" class="label">게시물 승인기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_approval" value="1" <?php echo $board['bo_use_approval']?'checked':''; ?> id="bo_use_approval"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 승인기능을 사용으로 설정하면 승인된 게시물만 출력되는 기능입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_approval" class="checkbox"><input type="checkbox" name="chk_grp_use_approval" value="1" id="chk_grp_use_approval"><i></i>그룹적용</label>
                                <label for="chk_all_use_approval" class="checkbox"><input type="checkbox" name="chk_all_use_approval" value="1" id="chk_all_use_approval"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_rss_view" class="label">RSS 보이기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_rss_view" value="1" <?php echo $board['bo_use_rss_view']?'checked':''; ?> id="bo_use_rss_view"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 비회원 글읽기가 가능하고 RSS 보이기 사용에 체크가 되어야만 RSS 지원을 합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_rss_view" class="checkbox"><input type="checkbox" name="chk_grp_use_rss_view" value="1" id="chk_grp_use_rss_view"><i></i>그룹적용</label>
                                <label for="chk_all_use_rss_view" class="checkbox"><input type="checkbox" name="chk_all_use_rss_view" value="1" id="chk_all_use_rss_view"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_good" class="label">추천 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_good" value="1" <?php echo $board['bo_use_good']?'checked':''; ?> id="bo_use_good"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물의 "추천" 기능을 사용할 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_good" class="checkbox"><input type="checkbox" name="chk_grp_use_good" value="1" id="chk_grp_use_good"><i></i>그룹적용</label>
                                <label for="chk_all_use_good" class="checkbox"><input type="checkbox" name="chk_all_use_good" value="1" id="chk_all_use_good"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_good_member" class="label">추천회원보기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_good_member" value="1" <?php echo $eyoom_board['bo_use_good_member']=='1'?'checked':''; ?> id="bo_use_good_member"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시, 게시글 내용보기 페이지에서 글을 추천한 회원을 확인할 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_good_member" class="checkbox"><input type="checkbox" name="chk_grp_use_good_member" value="1" id="chk_grp_use_good_member"><i></i>그룹적용</label>
                                <label for="chk_all_use_good_member" class="checkbox"><input type="checkbox" name="chk_all_use_good_member" value="1" id="chk_all_use_good_member"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_nogood" class="label">비추천 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_nogood" value="1" <?php echo $board['bo_use_nogood']?'checked':''; ?> id="bo_use_nogood"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물의 "비추천" 기능을 사용할 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_nogood" class="checkbox"><input type="checkbox" name="chk_grp_use_nogood" value="1" id="chk_grp_use_nogood"><i></i>그룹적용</label>
                                <label for="chk_all_use_nogood" class="checkbox"><input type="checkbox" name="chk_all_use_nogood" value="1" id="chk_all_use_nogood"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_nogood_member" class="label">비추천회원보기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_nogood_member" value="1" <?php echo $eyoom_board['bo_use_nogood_member']=='1'?'checked':''; ?> id="bo_use_nogood_member"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시, 게시글 내용보기 페이지에서 글을 비추천한 회원을 확인할 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_nogood_member" class="checkbox"><input type="checkbox" name="chk_grp_use_nogood_member" value="1" id="chk_grp_use_nogood_member"><i></i>그룹적용</label>
                                <label for="chk_all_use_nogood_member" class="checkbox"><input type="checkbox" name="chk_all_use_nogood_member" value="1" id="chk_all_use_nogood_member"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_name" class="label">이름(실명) 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_name" value="1" <?php echo $board['bo_use_name']?'checked':''; ?> id="bo_use_name"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 작성자의 닉네임 대신 실명을 사용합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_name" class="checkbox"><input type="checkbox" name="chk_grp_use_name" value="1" id="chk_grp_use_name"><i></i>그룹적용</label>
                                <label for="chk_all_use_name" class="checkbox"><input type="checkbox" name="chk_all_use_name" value="1" id="chk_all_use_name"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_signature" class="label">서명보이기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_signature" value="1" <?php echo $board['bo_use_signature']?'checked':''; ?> id="bo_use_signature"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 작성자의 서명정보의 노출여부를 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_signature" class="checkbox"><input type="checkbox" name="chk_grp_use_signature" value="1" id="chk_grp_use_signature"><i></i>그룹적용</label>
                                <label for="chk_all_use_signature" class="checkbox"><input type="checkbox" name="chk_all_use_signature" value="1" id="chk_all_use_signature"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_ip_view" class="label">IP 보이기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_ip_view" value="1" <?php echo $board['bo_use_ip_view']?'checked':''; ?> id="bo_use_ip_view"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 글작성 IP의 노출여부를 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_ip_view" class="checkbox"><input type="checkbox" name="chk_grp_use_ip_view" value="1" id="chk_grp_use_ip_view"><i></i>그룹적용</label>
                                <label for="chk_all_use_ip_view" class="checkbox"><input type="checkbox" name="chk_all_use_ip_view" value="1" id="chk_all_use_ip_view"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_list_content" class="label">목록에서 내용 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_list_content" value="1" <?php echo $board['bo_use_list_content']?'checked':''; ?> id="bo_use_list_content"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 목록에서 게시판 제목외에 내용도 읽어와야 할 경우에 설정하는 옵션입니다. 기본은 사용하지 않습니다. (사용시 속도가 느려질 수 있습니다.)</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_list_content" class="checkbox"><input type="checkbox" name="chk_grp_use_list_content" value="1" id="chk_grp_use_list_content"><i></i>그룹적용</label>
                                <label for="chk_all_use_list_content" class="checkbox"><input type="checkbox" name="chk_all_use_list_content" value="1" id="chk_all_use_list_content"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_list_file" class="label">목록에서 파일 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_list_file" value="1" <?php echo $board['bo_use_list_file']?'checked':''; ?> id="bo_use_list_file"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 목록에서 게시판 첨부파일을 읽어와야 할 경우에 설정하는 옵션입니다. 기본은 사용하지 않습니다. (사용시 속도가 느려질 수 있습니다.)</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_list_file" class="checkbox"><input type="checkbox" name="chk_grp_use_list_file" value="1" id="chk_grp_use_list_file"><i></i>그룹적용</label>
                                <label for="chk_all_use_list_file" class="checkbox"><input type="checkbox" name="chk_all_use_list_file" value="1" id="chk_all_use_list_file"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_list_image" class="label">목록에서 이미지 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_list_image" value="1" <?php echo $eyoom_board['bo_use_list_image']=='1'?'checked':''; ?> id="bo_use_list_image"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 목록에서 썸네일 이미지를 출력합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_list_image" class="checkbox"><input type="checkbox" name="chk_grp_use_list_image" value="1" id="chk_grp_use_list_image"><i></i>그룹적용</label>
                                <label for="chk_all_use_list_image" class="checkbox"><input type="checkbox" name="chk_all_use_list_image" value="1" id="chk_all_use_list_image"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_video_photo" class="label">목록에서 동영상이미지 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_video_photo" value="1" <?php echo $eyoom_board['bo_use_video_photo']=='1'?'checked':''; ?> id="bo_use_video_photo"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 목록에서 동영상의 썸네일 이미지를 자동으로 생성하여 출력합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_video_photo" class="checkbox"><input type="checkbox" name="chk_grp_use_video_photo" value="1" id="chk_grp_use_video_photo"><i></i>그룹적용</label>
                                <label for="chk_all_use_video_photo" class="checkbox"><input type="checkbox" name="chk_all_use_video_photo" value="1" id="chk_all_use_video_photo"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_infinite_scroll" class="label">목록에서 무한스크롤 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_infinite_scroll" value="1" <?php echo $eyoom_board['bo_use_infinite_scroll']=='1'?'checked':''; ?> id="bo_use_infinite_scroll"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크하시면 무한스크롤 기능이 활성화 됩니다. (basic 게시판은 제외) 게시판 스킨에 따라 작동하지 않을 수도 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_infinite_scroll" class="checkbox"><input type="checkbox" name="chk_grp_use_infinite_scroll" value="1" id="chk_grp_use_infinite_scroll"><i></i>그룹적용</label>
                                <label for="chk_all_use_infinite_scroll" class="checkbox"><input type="checkbox" name="chk_all_use_infinite_scroll" value="1" id="chk_all_use_infinite_scroll"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_extimg" class="label">외부이미지 썸네일 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_extimg" value="1" <?php echo $eyoom_board['bo_use_extimg']=='1'?'checked':''; ?> id="bo_use_extimg"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 외부 이미지를 게시물에 추가했을 경우, 자동으로 썸네일을 생성하여 목록에 출력합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_extimg" class="checkbox"><input type="checkbox" name="chk_grp_use_extimg" value="1" id="chk_grp_use_extimg"><i></i>그룹적용</label>
                                <label for="chk_all_use_extimg" class="checkbox"><input type="checkbox" name="chk_all_use_extimg" value="1" id="chk_all_use_extimg"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_list_view" class="label">전체목록보이기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_list_view" value="1" <?php echo $board['bo_use_list_view']?'checked':''; ?> id="bo_use_list_view"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물 보기 페이지에서 게시물 전체목록을 보이도록 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_list_view" class="checkbox"><input type="checkbox" name="chk_grp_use_list_view" value="1" id="chk_grp_use_list_view"><i></i>그룹적용</label>
                                <label for="chk_all_use_list_view" class="checkbox"><input type="checkbox" name="chk_all_use_list_view" value="1" id="chk_all_use_list_view"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_email" class="label">메일발송 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_email" value="1" <?php echo $board['bo_use_email']?'checked':''; ?> id="bo_use_email"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용으로 설정할 경우, 글작성시 기본환경설정의 메일 설정에 따라 각 관계자에게 메일을 발송합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_email" class="checkbox"><input type="checkbox" name="chk_grp_use_email" value="1" id="chk_grp_use_email"><i></i>그룹적용</label>
                                <label for="chk_all_use_email" class="checkbox"><input type="checkbox" name="chk_all_use_email" value="1" id="chk_all_use_email"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_cert" class="label">본인확인 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_cert" class="select max-width-250px">
                            <select id="bo_use_cert" name="bo_use_cert">
                                <?php
                                echo option_selected("",  $board['bo_use_cert'], "사용안함");
                                if ($config['cf_cert_use']) {
                                    echo option_selected("cert",  $board['bo_use_cert'], "본인확인된 회원전체");
                                    echo option_selected("adult", $board['bo_use_cert'], "본인확인된 성인회원만");
                                    echo option_selected("hp-cert",  $board['bo_use_cert'], "휴대폰 본인확인된 회원전체");
                                    echo option_selected("hp-adult", $board['bo_use_cert'], "휴대폰 본인확인된 성인회원만");
                                }
                                ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 본인확인 여부에 따라 게시물을 조회 할 수 있도록 합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_cert" class="checkbox"><input type="checkbox" name="chk_grp_use_cert" value="1" id="chk_grp_use_cert"><i></i>그룹적용</label>
                                <label for="chk_all_use_cert" class="checkbox"><input type="checkbox" name="chk_all_use_cert" value="1" id="chk_all_use_cert"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_write_limit" class="label">하루 포스팅수 제한<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">건</i>
                            <input type="text" name="bo_write_limit" id="bo_write_limit" value="<?php echo $eyoom_board['bo_write_limit'] ? $eyoom_board['bo_write_limit']: 0 ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 본 게시판에 한하여 회원당 하루에 글쓰기 가능 회수를 지정합니다. 0일 경우는 제한이 없습니다.</div>
                        <div class="note"><strong>Note:</strong> 회수 제한을 설정하면 비회원은 글을 작성할 수 없습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_write_limit" class="checkbox"><input type="checkbox" name="chk_grp_write_limit" value="1" id="chk_grp_write_limit"><i></i>그룹적용</label>
                                <label for="chk_all_write_limit" class="checkbox"><input type="checkbox" name="chk_all_write_limit" value="1" id="chk_all_write_limit"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_wrlimit" class="label">하루 게시물 작성제한 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_wrlimit" value="1" <?php echo $board['bo_use_wrlimit']?'checked':''; ?> id="bo_use_sns"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용에 체크하시면 '환경설정 > 기본환경설정 > 게시판기본 > 게시물 작성수 제한'의 설정한 숫자만큼 게시물 제한 게시판으로 사용이 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_wrlimit" class="checkbox"><input type="checkbox" name="chk_grp_use_wrlimit" value="1" id="chk_grp_use_wrlimit"><i></i>그룹적용</label>
                                <label for="chk_all_use_wrlimit" class="checkbox"><input type="checkbox" name="chk_all_use_wrlimit" value="1" id="chk_all_use_wrlimit"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_upload_count" class="label">파일 업로드 개수<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="bo_upload_count" id="bo_upload_count" value="<?php echo $board['bo_upload_count'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물 한건당 업로드 할 수 있는 파일의 최대 개수 (0 은 파일첨부 사용하지 않음)</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_upload_count" class="checkbox"><input type="checkbox" name="chk_grp_upload_count" value="1" id="chk_grp_upload_count"><i></i>그룹적용</label>
                                <label for="chk_all_upload_count" class="checkbox"><input type="checkbox" name="chk_all_upload_count" value="1" id="chk_all_upload_count"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_upload_size" class="label">파일 업로드 용량<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">Byte</i>
                            <input type="text" name="bo_upload_size" id="bo_upload_size" value="<?php echo $board['bo_upload_size'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 설정한 용량 이하만 업로드가 가능합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_upload_size" class="checkbox"><input type="checkbox" name="chk_grp_upload_size" value="1" id="chk_grp_upload_size"><i></i>그룹적용</label>
                                <label for="chk_all_upload_size" class="checkbox"><input type="checkbox" name="chk_all_upload_size" value="1" id="chk_all_upload_size"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="download_fee_ratio" class="label">파일 다운로드 수수료율<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">%</i>
                            <input type="text" name="download_fee_ratio" id="download_fee_ratio" value="<?php echo $eyoom_board['download_fee_ratio'] ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물에 포함된 파일의 다운로드 수수료율 지정. 설정한 수수료율만큼 게시자에게 자신의 포인트를 지급합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_download_ratio" class="checkbox"><input type="checkbox" name="chk_grp_download_ratio" value="1" id="chk_grp_download_ratio"><i></i>그룹적용</label>
                                <label for="chk_all_download_ratio" class="checkbox"><input type="checkbox" name="chk_all_download_ratio" value="1" id="chk_all_download_ratio"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_file_content" class="label">파일 설명 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_file_content" value="1" <?php echo $board['bo_use_file_content']?'checked':''; ?> id="bo_use_file_content"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 첨부파일 설명문구를 입력할 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_file_content" class="checkbox"><input type="checkbox" name="chk_grp_use_file_content" value="1" id="chk_grp_use_file_content"><i></i>그룹적용</label>
                                <label for="chk_all_use_file_content" class="checkbox"><input type="checkbox" name="chk_all_use_file_content" value="1" id="chk_all_use_file_content"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_write_min" class="label">최소 글자수 제한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">글자</i>
                            <input type="text" name="bo_write_min" id="bo_write_min" value="<?php echo $board['bo_write_min'] ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 글 입력시 최소 글자수를 설정. 0을 입력하거나 최고관리자, DHTML 에디터 사용시에는 검사하지 않음</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_write_min" class="checkbox"><input type="checkbox" name="chk_grp_write_min" value="1" id="chk_grp_write_min"><i></i>그룹적용</label>
                                <label for="chk_all_write_min" class="checkbox"><input type="checkbox" name="chk_all_write_min" value="1" id="chk_all_write_min"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_write_max" class="label">최대 글자수 제한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">글자</i>
                            <input type="text" name="bo_write_max" id="bo_write_max" value="<?php echo $board['bo_write_max'] ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 글 입력시 최대 글자수를 설정. 0을 입력하거나 최고관리자, DHTML 에디터 사용시에는 검사하지 않음</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_write_max" class="checkbox"><input type="checkbox" name="chk_grp_write_max" value="1" id="chk_grp_write_max"><i></i>그룹적용</label>
                                <label for="chk_all_write_max" class="checkbox"><input type="checkbox" name="chk_all_write_max" value="1" id="chk_all_write_max"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_comment_min" class="label">최소 댓글수 제한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">글자</i>
                            <input type="text" name="bo_comment_min" id="bo_comment_min" value="<?php echo $board['bo_comment_min'] ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 댓글 입력시 최소 글자수를 설정. 0을 입력하면 검사하지 않음</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_comment_min" class="checkbox"><input type="checkbox" name="chk_grp_comment_min" value="1" id="chk_grp_comment_min"><i></i>그룹적용</label>
                                <label for="chk_all_comment_min" class="checkbox"><input type="checkbox" name="chk_all_comment_min" value="1" id="chk_all_comment_min"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_comment_max" class="label">최대 댓글수 제한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">글자</i>
                            <input type="text" name="bo_comment_max" id="bo_comment_max" value="<?php echo $board['bo_comment_max'] ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 댓글 입력시 최대 글자수를 설정. 0을 입력하면 검사하지 않음</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_comment_max" class="checkbox"><input type="checkbox" name="chk_grp_comment_max" value="1" id="chk_grp_comment_max"><i></i>그룹적용</label>
                                <label for="chk_all_comment_max" class="checkbox"><input type="checkbox" name="chk_all_comment_max" value="1" id="chk_all_comment_max"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_sns" class="label">SNS 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_sns" value="1" <?php echo $board['bo_use_sns']?'checked':''; ?> id="bo_use_sns"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용에 체크하시면 소셜네트워크서비스(SNS)에 글을 퍼가거나 댓글을 동시에 등록할수 있습니다.<br>기본환경설정의 SNS 설정을 하셔야 사용이 가능합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_sns" class="checkbox"><input type="checkbox" name="chk_grp_use_sns" value="1" id="chk_grp_use_sns"><i></i>그룹적용</label>
                                <label for="chk_all_use_sns" class="checkbox"><input type="checkbox" name="chk_all_use_sns" value="1" id="chk_all_use_sns"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_search" class="label">전체 검색 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_search" value="1" <?php echo $board['bo_use_search']?'checked':''; ?> id="bo_use_search"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 전체검색에서 본 게시판을 검색대상으로 할지 여부를 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_search" class="checkbox"><input type="checkbox" name="chk_grp_use_search" value="1" id="chk_grp_use_search"><i></i>그룹적용</label>
                                <label for="chk_all_use_search" class="checkbox"><input type="checkbox" name="chk_all_use_search" value="1" id="chk_all_use_search"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_order" class="label">출력 순서</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append fas fa-sort-numeric-down"></i>
                            <input type="text" name="bo_order" id="bo_order" value="<?php echo $board['bo_order'] ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 숫자가 낮은 게시판 부터 메뉴나 검색시 우선 출력합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_order" class="checkbox"><input type="checkbox" name="chk_grp_order" value="1" id="chk_grp_order"><i></i>그룹적용</label>
                                <label for="chk_all_order" class="checkbox"><input type="checkbox" name="chk_all_order" value="1" id="chk_all_order"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_captcha" class="label">캡챠 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="checkbox">
                            <input type="checkbox" name="bo_use_captcha" value="1" <?php echo $board['bo_use_captcha']?'checked':''; ?> id="bo_use_captcha"><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크하면 글 작성시 캡챠를 무조건 사용합니다.( 회원 + 비회원 모두 )<br>미 체크하면 비회원에게만 캡챠를 사용합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_captcha" class="checkbox"><input type="checkbox" name="chk_grp_use_captcha" value="1" id="chk_grp_use_captcha"><i></i>그룹적용</label>
                                <label for="chk_all_use_captcha" class="checkbox"><input type="checkbox" name="chk_all_use_captcha" value="1" id="chk_all_use_captcha"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 게시판 기능 설정 : 끝 */ ?>

        <?php /* 게시판 디자인/양식 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_design" role="tabpanel" aria-labelledby="anc_bo_design_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 디자인/양식</strong></div>
                <div class="adm-form-tr adm-sm-100 gnu-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_skin" class="label">스킨 디렉토리</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_skin_select('board', 'bo_skin', 'bo_skin', $board['bo_skin'], ''); ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판에 적용할 스킨을 선택합니다.<br>테마관리 > 게시판관리에서 그누보드 스킨에 사용 설정이 된 경우, 적용이 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_skin" class="checkbox"><input type="checkbox" name="chk_grp_skin" value="1" id="chk_grp_skin"><i></i>그룹적용</label>
                                <label for="chk_all_skin" class="checkbox"><input type="checkbox" name="chk_all_skin" value="1" id="chk_all_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 gnu-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_skin" class="label">모바일 스킨 디렉토리</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <?php echo get_mobile_skin_select('board', 'bo_mobile_skin', 'bo_mobile_skin', $board['bo_mobile_skin'], ''); ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판에 적용할 스킨을 선택합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_skin" class="checkbox"><input type="checkbox" name="chk_grp_mobile_skin" value="1" id="chk_grp_mobile_skin"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_skin" class="checkbox"><input type="checkbox" name="chk_all_mobile_skin" value="1" id="chk_all_mobile_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="use_shop_skin" class="label">레이아웃 디자인</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="use_shop_skin" id="use_shop_skin">
                                <option value="n" <?php echo $eyoom_board['use_shop_skin'] == 'n' ? 'selected': ''; ?>>커뮤니티 레이아웃</option>
                                <option value="y" <?php echo $eyoom_board['use_shop_skin'] == 'y' ? 'selected': ''; ?>>쇼핑몰 레이아웃</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판의 레이아웃을 설정하실 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_shop_skin" class="checkbox"><input type="checkbox" name="chk_grp_shop_skin" value="1" id="chk_grp_shop_skin"><i></i>그룹적용</label>
                                <label for="chk_all_shop_skin" class="checkbox"><input type="checkbox" name="chk_all_shop_skin" value="1" id="chk_all_shop_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_eyoom_skin" class="label">이윰 게시판 스킨</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="bo_eyoom_skin" id="bo_eyoom_skin">
                                <option value="">선택</option>
                                <?php foreach ($bo_eyoom_skin as $skin) { ?>
                                <option value="<?php echo $skin; ?>" <?php echo $eyoom_board['bo_skin'] == $skin ? 'selected': ''; ?>><?php echo $skin; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 이윰빌더 스킨을 사용할 경우, 선택한 게시판 스킨이 적용됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_eyoom_skin" class="checkbox"><input type="checkbox" name="chk_grp_eyoom_skin" value="1" id="chk_grp_eyoom_skin"><i></i>그룹적용</label>
                                <label for="chk_all_eyoom_skin" class="checkbox"><input type="checkbox" name="chk_all_eyoom_skin" value="1" id="chk_all_eyoom_skin"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($is_admin == 'super') { // 슈퍼관리자인 경우에만 수정 가능 ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_include_head" class="label">상단 파일 경로</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="bo_include_head" id="bo_include_head" value="<?php echo get_sanitize_input($board['bo_include_head']); ?>">
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_include_head" class="checkbox"><input type="checkbox" name="chk_grp_include_head" value="1" id="chk_grp_include_head"><i></i>그룹적용</label>
                                <label for="chk_all_include_head" class="checkbox"><input type="checkbox" name="chk_all_include_head" value="1" id="chk_all_include_head"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_include_tail" class="label">하단 파일 경로</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <input type="text" name="bo_include_tail" id="bo_include_tail" value="<?php echo get_sanitize_input($board['bo_include_tail']); ?>">
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_include_tail" class="checkbox"><input type="checkbox" name="chk_grp_include_tail" value="1" id="chk_grp_include_tail"><i></i>그룹적용</label>
                                <label for="chk_all_include_tail" class="checkbox"><input type="checkbox" name="chk_all_include_tail" value="1" id="chk_all_include_tail"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr" id="admin_captcha_box" style="display:none;">
                    <div class="adm-form-td td-l">
                        <label for="bo_include_tail" class="label">자동등록방지</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php
                        include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
                        $captcha_html = captcha_html();
                        $captcha_js   = chk_captcha_js();
                        echo $captcha_html;
                        ?>
                        <script>
                        jQuery("#captcha_key").removeAttr("required").removeClass("required");
                        </script>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_content_head" class="label">상단 내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html("bo_content_head", get_text(html_purifier($board['bo_content_head']), 0)); ?>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_content_head" class="checkbox"><input type="checkbox" name="chk_grp_content_head" value="1" id="chk_grp_content_head"><i></i>그룹적용</label>
                                <label for="chk_all_content_head" class="checkbox"><input type="checkbox" name="chk_all_content_head" value="1" id="chk_all_content_head"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_content_tail" class="label">하단 내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html("bo_content_tail", get_text(html_purifier($board['bo_content_tail']), 0)); ?>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_content_tail" class="checkbox"><input type="checkbox" name="chk_grp_content_tail" value="1" id="chk_grp_content_tail"><i></i>그룹적용</label>
                                <label for="chk_all_content_tail" class="checkbox"><input type="checkbox" name="chk_all_content_tail" value="1" id="chk_all_content_tail"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_content_head" class="label">모바일 상단 내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html("bo_mobile_content_head", get_text(html_purifier($board['bo_mobile_content_head']), 0)); ?>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_content_head" class="checkbox"><input type="checkbox" name="chk_grp_mobile_content_head" value="1" id="chk_grp_mobile_content_head"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_content_head" class="checkbox"><input type="checkbox" name="chk_all_mobile_content_head" value="1" id="chk_all_mobile_content_head"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_content_tail" class="label">모바일 하단 내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="textarea">
                            <?php echo editor_html("bo_mobile_content_tail", get_text(html_purifier($board['bo_mobile_content_tail']), 0)); ?>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_content_tail" class="checkbox"><input type="checkbox" name="chk_grp_mobile_content_tail" value="1" id="chk_grp_mobile_content_tail"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_content_tail" class="checkbox"><input type="checkbox" name="chk_all_mobile_content_tail" value="1" id="chk_all_mobile_content_tail"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } //end if $is_admin === 'super' ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_insert_content" class="label">글쓰기 기본 내용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="textarea">
                            <textarea id="bo_insert_content" name="bo_insert_content" rows="5"><?php echo html_purifier($board['bo_insert_content']); ?></textarea>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_insert_content" class="checkbox"><input type="checkbox" name="chk_grp_insert_content" value="1" id="chk_grp_insert_content"><i></i>그룹적용</label>
                                <label for="chk_all_insert_content" class="checkbox"><input type="checkbox" name="chk_all_insert_content" value="1" id="chk_all_insert_content"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_subject_len" class="label">제목 길이<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">글자</i>
                            <input type="text" name="bo_subject_len" id="bo_subject_len" value="<?php echo $board['bo_subject_len'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 목록에서의 제목 글자수. 잘리는 글은 … 로 표시</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_subject_len" class="checkbox"><input type="checkbox" name="chk_grp_subject_len" value="1" id="chk_grp_subject_len"><i></i>그룹적용</label>
                                <label for="chk_all_subject_len" class="checkbox"><input type="checkbox" name="chk_all_subject_len" value="1" id="chk_all_subject_len"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_subject_len" class="label">모바일 제목 길이<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">글자</i>
                            <input type="text" name="bo_mobile_subject_len" id="bo_mobile_subject_len" value="<?php echo $board['bo_mobile_subject_len'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 목록에서의 제목 글자수. 잘리는 글은 … 로 표시</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_subject_len" class="checkbox"><input type="checkbox" name="chk_grp_mobile_subject_len" value="1" id="chk_grp_mobile_subject_len"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_subject_len" class="checkbox"><input type="checkbox" name="chk_all_mobile_subject_len" value="1" id="chk_all_mobile_subject_len"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_page_rows" class="label">페이지당 목록 수<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="bo_page_rows" id="bo_page_rows" value="<?php echo $board['bo_page_rows'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 한 페이지에 출력할 게시물 개수</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_page_rows" class="checkbox"><input type="checkbox" name="chk_grp_page_rows" value="1" id="chk_grp_page_rows"><i></i>그룹적용</label>
                                <label for="chk_all_page_rows" class="checkbox"><input type="checkbox" name="chk_all_page_rows" value="1" id="chk_all_page_rows"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_page_rows" class="label">모바일 페이지당 목록 수<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="bo_mobile_page_rows" id="bo_mobile_page_rows" value="<?php echo $board['bo_mobile_page_rows'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 한 페이지에 출력할 게시물 개수</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_page_rows" class="checkbox"><input type="checkbox" name="chk_grp_mobile_page_rows" value="1" id="chk_grp_mobile_page_rows"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_page_rows" class="checkbox"><input type="checkbox" name="chk_all_mobile_page_rows" value="1" id="chk_all_mobile_page_rows"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(0) { // 숨김처리 시작, 불필요 ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_gallery_cols" class="label">갤러리 이미지 수<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">개</i>
                            <input type="text" name="bo_gallery_cols" value="<?php echo $board['bo_gallery_cols'] ?>" id="bo_gallery_cols" required class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 갤러리 형식의 게시판 목록에서 이미지를 한줄에 몇장씩 보여 줄 것인지를 설정하는 값</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_gallery_cols" class="checkbox"><input type="checkbox" name="chk_grp_gallery_cols" value="1" id="chk_grp_gallery_cols"><i></i>그룹적용</label>
                                <label for="chk_all_gallery_cols" class="checkbox"><input type="checkbox" name="chk_all_gallery_cols" value="1" id="chk_all_gallery_cols"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } // 숨김처리 끝 ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_gallery_width" class="label">갤러리 이미지 폭<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">px</i>
                            <input type="text" name="bo_gallery_width" id="bo_gallery_width" value="<?php echo $board['bo_gallery_width'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 갤러리 형식의 게시판 목록에서 썸네일 이미지의 폭을 설정하는 값</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_gallery_width" class="checkbox"><input type="checkbox" name="chk_grp_gallery_width" value="1" id="chk_grp_gallery_width"><i></i>그룹적용</label>
                                <label for="chk_all_gallery_width" class="checkbox"><input type="checkbox" name="chk_all_gallery_width" value="1" id="chk_all_gallery_width"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_gallery_height" class="label">갤러리 이미지 높이<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">px</i>
                            <input type="text" name="bo_gallery_height" id="bo_gallery_height" value="<?php echo $board['bo_gallery_height'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 갤러리 형식의 게시판 목록에서 썸네일 이미지의 높이를 설정하는 값</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_gallery_height" class="checkbox"><input type="checkbox" name="chk_grp_gallery_height" value="1" id="chk_grp_gallery_height"><i></i>그룹적용</label>
                                <label for="chk_all_gallery_height" class="checkbox"><input type="checkbox" name="chk_all_gallery_height" value="1" id="chk_all_gallery_height"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_gallery_width" class="label">모바일 갤러리 이미지 폭<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">px</i>
                            <input type="text" name="bo_mobile_gallery_width" id="bo_mobile_gallery_width" value="<?php echo $board['bo_mobile_gallery_width'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 모바일로 접속시 갤러리 형식의 게시판 목록에서 썸네일 이미지의 폭을 설정하는 값</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_gallery_width" class="checkbox"><input type="checkbox" name="chk_grp_mobile_gallery_width" value="1" id="chk_grp_mobile_gallery_width"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_gallery_width" class="checkbox"><input type="checkbox" name="chk_all_mobile_gallery_width" value="1" id="chk_all_mobile_gallery_width"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_mobile_gallery_height" class="label">모바일 갤러리 이미지 높이<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">px</i>
                            <input type="text" name="bo_mobile_gallery_height" id="bo_mobile_gallery_height" value="<?php echo $board['bo_mobile_gallery_height'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 모바일로 접속시 갤러리 형식의 게시판 목록에서 썸네일 이미지의 높이를 설정하는 값</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_mobile_gallery_height" class="checkbox"><input type="checkbox" name="chk_grp_mobile_gallery_height" value="1" id="chk_grp_mobile_gallery_height"><i></i>그룹적용</label>
                                <label for="chk_all_mobile_gallery_height" class="checkbox"><input type="checkbox" name="chk_all_mobile_gallery_height" value="1" id="chk_all_mobile_gallery_height"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(0) { // 숨김처리 시작, 불필요 ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_table_width" class="label">게시판 폭<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">px</i>
                            <input type="text" name="bo_table_width" id="bo_table_width" value="<?php echo $board['bo_table_width'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 100 이하는 %</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_table_width" class="checkbox"><input type="checkbox" name="chk_grp_table_width" value="1" id="chk_grp_table_width"><i></i>그룹적용</label>
                                <label for="chk_all_table_width" class="checkbox"><input type="checkbox" name="chk_all_table_width" value="1" id="chk_all_table_width"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } // 숨김처리 끝 ?>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_image_width" class="label">이미지 폭 크기<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">px</i>
                            <input type="text" name="bo_image_width" id="bo_image_width" value="<?php echo $board['bo_image_width'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판에서 출력되는 이미지의 폭 크기</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_image_width" class="checkbox"><input type="checkbox" name="chk_grp_image_width" value="1" id="chk_grp_image_width"><i></i>그룹적용</label>
                                <label for="chk_all_image_width" class="checkbox"><input type="checkbox" name="chk_all_image_width" value="1" id="chk_all_image_width"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_new" class="label">새글 아이콘<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">시간</i>
                            <input type="text" name="bo_new" id="bo_new" value="<?php echo $board['bo_new'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 글 입력후 new 이미지를 출력하는 시간. 0을 입력하시면 아이콘을 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_new" class="checkbox"><input type="checkbox" name="chk_grp_new" value="1" id="chk_grp_new"><i></i>그룹적용</label>
                                <label for="chk_all_new" class="checkbox"><input type="checkbox" name="chk_all_new" value="1" id="chk_all_new"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_hot" class="label">인기글 아이콘<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">회</i>
                            <input type="text" name="bo_hot" id="bo_hot" value="<?php echo $board['bo_hot'] ?>" class="text-end" required>
                        </label>
                        <div class="note"><strong>Note:</strong> 조회수가 설정값 이상이면 hot 이미지 출력. 0을 입력하시면 아이콘을 출력하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_hot" class="checkbox"><input type="checkbox" name="chk_grp_hot" value="1" id="chk_grp_hot"><i></i>그룹적용</label>
                                <label for="chk_all_hot" class="checkbox"><input type="checkbox" name="chk_all_hot" value="1" id="chk_all_hot"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_reply_order" class="label">답변 달기</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select id="bo_reply_order" name="bo_reply_order">
                                <option value="1"<?php echo get_selected($board['bo_reply_order'], 1, true); ?>>나중에 쓴 답변 아래로 달기 (기본)
                                <option value="0"<?php echo get_selected($board['bo_reply_order'], 0); ?>>나중에 쓴 답변 위로 달기
                            </select><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_reply_order" class="checkbox"><input type="checkbox" name="chk_grp_reply_order" value="1" id="chk_grp_reply_order"><i></i>그룹적용</label>
                                <label for="chk_all_reply_order" class="checkbox"><input type="checkbox" name="chk_all_reply_order" value="1" id="chk_all_reply_order"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_sel_date_type" class="label">작성일 표기방식</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select id="bo_sel_date_type" name="bo_sel_date_type">
                                <option value="1" <?php echo $eyoom_board['bo_sel_date_type']=='1' ? 'selected': ''; ?>>10초전 or 2분전 or 1시간전</option>
                                <option value="2" <?php echo $eyoom_board['bo_sel_date_type']=='2' ? 'selected': ''; ?>>YYYY-mm-dd HH:ii:ss</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 24시간 이내에 작성된 게시물의 작성일 형식을 설정할 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_date_type" class="checkbox"><input type="checkbox" name="chk_grp_date_type" value="1" id="chk_grp_date_type"><i></i>그룹적용</label>
                                <label for="chk_all_date_type" class="checkbox"><input type="checkbox" name="chk_all_date_type" value="1" id="chk_all_date_type"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_sort_field" class="label">리스트 정렬 필드</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select id="bo_sort_field" name="bo_sort_field">
                                <?php foreach( $bo_sort_fields as $v ){
                                    $option_value = $order_by_str = $v[0];
                                    if( $v[0] === 'wr_num, wr_reply' ){
                                        $selected = (! $board['bo_sort_field']) ? 'selected="selected"' : '';
                                        $option_value = '';
                                    } else {
                                        $selected = ($board['bo_sort_field'] === $v[0]) ? 'selected="selected"' : '';
                                    }
                                    
                                    if( $order_by_str !== 'wr_num, wr_reply' ){
                                        $tmp = explode(',', $v[0]);
                                        $order_by_str = $tmp[0];
                                    }

                                    echo '<option value="'.$option_value.'" '.$selected.' >'.$order_by_str.' : '.$v[1].'</option>';

                                } ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 리스트에서 기본으로 정렬에 사용할 필드를 선택합니다. "기본"으로 사용하지 않으시는 경우 속도가 느려질 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_sort_field" class="checkbox"><input type="checkbox" name="chk_grp_sort_field" value="1" id="chk_grp_sort_field"><i></i>그룹적용</label>
                                <label for="chk_all_sort_field" class="checkbox"><input type="checkbox" name="chk_all_sort_field" value="1" id="chk_all_sort_field"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 게시판 디자인/양식 : 끝 */ ?>

        <?php /* 게시판 포인트 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_point" role="tabpanel" aria-labelledby="anc_bo_point_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 포인트 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="chk_grp_point" class="label">기본값으로 설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="chk_grp_point" class="checkbox">
                            <input type="checkbox" name="chk_grp_point" id="chk_grp_point" onclick="set_point(this.form)"><i></i> 기본값으로 설정
                        </label>
                        <div class="note"><strong>Note:</strong> 환경설정에 입력된 포인트로 설정</div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100 eyoom-board">
                    <div class="adm-form-td td-l">
                        <label for="bo_point_target" class="label">포인트 적용 대상<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="select max-width-250px">
                            <select name="bo_point_target" id="bo_point_target">
                                <option value="gnu" <?php echo $board['bo_point_target']=='' || $board['bo_point_target']=='gnu' ? 'selected': ''; ?>>그누포인트</option>
                                <option value="eyoom" <?php echo $board['bo_point_target']=='eyoom' ? 'selected': ''; ?>>이윰경험치</option>
                                <option value="all" <?php echo $board['bo_point_target']=='all' ? 'selected': ''; ?>>그누포인트 & 이윰경험치</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 이윰경험치를 적용할 경우, 이윰레벨 포인트 설정은 무시되며 아래의 게시판별 포인트 설정이 우선 적용됩니다.</div>
                        <div class="note"><strong>Note:</strong> 다운로드 포인트는 절대값으로 이윰경험치에 적용이 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_point_target" class="checkbox"><input type="checkbox" name="chk_grp_point_target" value="1" id="chk_grp_point_target"><i></i>그룹적용</label>
                                <label for="chk_all_point_target" class="checkbox"><input type="checkbox" name="chk_all_point_target" value="1" id="chk_all_point_target"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_read_point" class="label">글읽기 포인트<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="bo_read_point" id="bo_read_point" value="<?php echo $board['bo_read_point'] ?>" class="text-end" required>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_read_point" class="checkbox"><input type="checkbox" name="chk_grp_read_point" value="1" id="chk_grp_read_point"><i></i>그룹적용</label>
                                <label for="chk_all_read_point" class="checkbox"><input type="checkbox" name="chk_all_read_point" value="1" id="chk_all_read_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_write_point" class="label">글쓰기 포인트<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="bo_write_point" id="bo_write_point" value="<?php echo $board['bo_write_point'] ?>" class="text-end" required>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_write_point" class="checkbox"><input type="checkbox" name="chk_grp_write_point" value="1" id="chk_grp_write_point"><i></i>그룹적용</label>
                                <label for="chk_all_write_point" class="checkbox"><input type="checkbox" name="chk_all_write_point" value="1" id="chk_all_write_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_comment_point" class="label">댓글쓰기 포인트<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="bo_comment_point" id="bo_comment_point" value="<?php echo $board['bo_comment_point'] ?>" class="text-end" required>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_comment_point" class="checkbox"><input type="checkbox" name="chk_grp_comment_point" value="1" id="chk_grp_comment_point"><i></i>그룹적용</label>
                                <label for="chk_all_comment_point" class="checkbox"><input type="checkbox" name="chk_all_comment_point" value="1" id="chk_all_comment_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_download_point" class="label">다운로드 포인트<strong class="sound_only">필수</strong></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="text" name="bo_download_point" id="bo_download_point" value="<?php echo $board['bo_download_point'] ?>" class="text-end" required>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_download_point" class="checkbox"><input type="checkbox" name="chk_grp_download_point" value="1" id="chk_grp_download_point"><i></i>그룹적용</label>
                                <label for="chk_all_download_point" class="checkbox"><input type="checkbox" name="chk_all_download_point" value="1" id="chk_all_download_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 게시판 포인트 설정 : 끝 */ ?>

        <?php /* 게시판 여분필드 설정 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_exfields" role="tabpanel" aria-labelledby="anc_bo_exfields_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 여분필드 설정</strong></div>
                <?php for ($i=1; $i<=10; $i++) { ?>
                <div class="adm-form-tr-wrap">
                    <div class="adm-form-tr tr-l adm-sm-100">
                        <div class="adm-form-td td-l">
                            <label class="label">여분필드 <?php echo $i ?> 제목</label>
                        </div>
                        <div class="adm-form-td td-r">
                            <label for="bo_<?php echo $i ?>_subj" class="input max-width-250px">
                                <input type="text" name="bo_<?php echo $i ?>_subj" id="bo_<?php echo $i ?>_subj" value="<?php echo get_text($board['bo_'.$i.'_subj']); ?>">
                            </label>
                        </div>
                    </div>
                    <div class="adm-form-tr tr-r adm-sm-100">
                        <div class="adm-form-td td-l">
                            <label class="label">여분필드 <?php echo $i ?> 값</label>
                        </div>
                        <div class="adm-form-td td-r td-rs">
                            <label for="bo_<?php echo $i ?>" class="input max-width-250px">
                                <input type="text" name="bo_<?php echo $i ?>" id="bo_<?php echo $i ?>" value="<?php echo get_text($board['bo_'.$i]); ?>">
                            </label>
                            <div class="adm-form-td-rs">
                                <div class="inline-group">
                                    <label for="chk_grp_<?php echo $i ?>" class="checkbox"><input type="checkbox" name="chk_grp_<?php echo $i ?>" value="1" id="chk_grp_<?php echo $i ?>"><i></i>그룹적용</label>
                                    <label for="chk_all_<?php echo $i ?>" class="checkbox"><input type="checkbox" name="chk_all_<?php echo $i ?>" value="1" id="chk_all_<?php echo $i ?>"><i></i>전체적용</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* 게시판 여분필드 설정 : 끝 */ ?>
    </div>
    
    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<div class="modal fade board-coppy-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">게시판 복사</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="board-coppy-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
function eb_modal(href) {
    $('.board-coppy-modal').modal('show').on('hidden.bs.modal', function () {
        $("#board-coppy-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.board-coppy-modal').modal('show').on('shown.bs.modal', function () {
        $("#board-coppy-iframe").attr("src", href);
        $('#board-coppy-iframe').height(450);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

$(function(){
    // 기본설정 탭 우선 active 적용
    var ac_pid = '<?php echo $_POST['ac_pid']; ?>';
    if (!ac_pid) ac_pid = 'anc_bo_basic'; else var ac_id = ac_pid;
    $("."+ac_pid).addClass('active');
    //$(".anc_bo_basic").addClass('active');
    if (ac_id) {
        $(".tab-pane").removeClass('show');
        $(".tab-pane").removeClass('active');
        $("#"+ac_id).addClass('show');
        $("#"+ac_id).addClass('active');
    }

    $(".get_theme_galc").on("click", function() {
        if(!confirm("현재 테마의 게시판 이미지 설정을 적용하시겠습니까?"))
            return false;

        $.ajax({
            type: "POST",
            url: "./theme_config_load.php",
            cache: false,
            async: false,
            data: { type: "board" },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                var field = Array('bo_gallery_cols', 'bo_gallery_width', 'bo_gallery_height', 'bo_mobile_gallery_width', 'bo_mobile_gallery_height', 'bo_image_width');
                var count = field.length;
                var key;

                for(i=0; i<count; i++) {
                    key = field[i];

                    if(data[key] != undefined && data[key] != "")
                        $("input[name="+key+"]").val(data[key]);
                }
            }
        });
    });
});

function set_point(f) {
    if (f.chk_grp_point.checked) {
        f.bo_read_point.value = "<?php echo $config['cf_read_point'] ?>";
        f.bo_write_point.value = "<?php echo $config['cf_write_point'] ?>";
        f.bo_comment_point.value = "<?php echo $config['cf_comment_point'] ?>";
        f.bo_download_point.value = "<?php echo $config['cf_download_point'] ?>";
    } else {
        f.bo_read_point.value     = f.bo_read_point.defaultValue;
        f.bo_write_point.value    = f.bo_write_point.defaultValue;
        f.bo_comment_point.value  = f.bo_comment_point.defaultValue;
        f.bo_download_point.value = f.bo_download_point.defaultValue;
    }
}

var captcha_chk = false;

function use_captcha_check(){
    $.ajax({
        type: "POST",
        url: g5_admin_url+"/ajax.use_captcha.php",
        data: { admin_use_captcha: "1" },
        cache: false,
        async: false,
        dataType: "json",
        success: function(data) {
        }
    });
}

var bo_include_head = jQuery.trim(jQuery("#bo_include_head").val()),
    bo_include_tail = jQuery.trim(jQuery("#bo_include_tail").val());

function frm_check_file(){
    var head = jQuery.trim(jQuery("#bo_include_head").val());
    var tail = jQuery.trim(jQuery("#bo_include_tail").val());

    if(bo_include_head !== head || bo_include_tail !== tail){
        // 캡챠를 사용합니다.
        jQuery("#admin_captcha_box").show();
        captcha_chk = true;

        use_captcha_check();

        return false;
    } else {
        jQuery("#admin_captcha_box").hide();
    }

    return true;
}

jQuery(function($){
    if( window.self !== window.top ){   // frame 또는 iframe을 사용할 경우 체크
        $("#bo_include_head, #bo_include_tail").on("change paste keyup", function(e) {
            frm_check_file();
        });

        use_captcha_check();
    }
});

function fboardform_submit(f)
{
    <?php
    if($w!=''){
    $js_array = get_bo_table_banned_word();
    echo "var banned_array = ". json_encode($js_array) . ";\n";
    }
    ?>

    // 게시판명이 금지된 단어로 되어 있으면
    if( (typeof banned_array != 'undefined') && jQuery.inArray(f.bo_table.value, banned_array) !== -1 ){
        alert("입력한 게시판 TABLE명을 사용할수 없습니다. 다른 이름으로 입력해 주세요.");
        return false;
    }

    // 게시판명 유효성 검사
    var pattern = /^[A-Za-z0-9_]+$/;
    if (!pattern.test(f.bo_table.value)) {
        alert('복사할 테이블명 입력값이 유효하지 않습니다. 영문 대소문자, 숫자, 언더스코어(_)만 입력할 수 있습니다.');
        return false;
    }

    // 게시판명의 길이는 20자 이내로 제한
    if (f.bo_table.value.length > 20) {
        alert('복사할 테이블명의 입력값은 20자 이내로 제한됩니다.');
        return false;
    }

    <?php echo get_editor_js("bo_content_head"); ?>
    <?php echo get_editor_js("bo_content_tail"); ?>
    <?php echo get_editor_js("bo_mobile_content_head"); ?>
    <?php echo get_editor_js("bo_mobile_content_tail"); ?>

    if (parseInt(f.bo_count_modify.value) < 0) {
        alert("원글 수정 불가 댓글수는 0 이상 입력하셔야 합니다.");
        f.bo_count_modify.focus();
        return false;
    }

    if (parseInt(f.bo_count_delete.value) < 1) {
        alert("원글 삭제 불가 댓글수는 1 이상 입력하셔야 합니다.");
        f.bo_count_delete.focus();
        return false;
    }

    if( captcha_chk ) {
        <?php echo isset($captcha_js) ? $captcha_js : ''; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
    }

    <?php if ($w == 'u') { ?>
    f.target = 'blank_iframe';
    <?php } ?>
    return true;
}
</script>