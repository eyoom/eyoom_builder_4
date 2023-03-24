<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'board_list';
$g5_title = '게시판관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-board-list">
    <div class="adm-headline">
        <h3>게시판 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=board_form" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>게시판 추가</span></a>
        <?php } ?>
    </div>

    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="sfl" id="sfl">
                                    <option value="bo_table"<?php echo get_selected($sfl, "bo_table"); ?>>테이블아이디</option>
                                    <option value="bo_subject"<?php echo get_selected($sfl, "bo_subject"); ?>>게시판명</option>
                                    <option value="bo_category_list"<?php echo get_selected($sfl, "bo_category_list"); ?>>카테고리명</option>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="input max-width-250px">
                                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                            </label>
                        </span>
                    </div>
                </div>
            </div>
            <?php if (!$wmode) { ?>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">그룹</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_group_select("grid", $grid); ?><i></i>
                    </label>
                </div>
            </div>
            <?php } ?>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">확장필드 사용</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="bo_ex_all" class="radio"><input type="radio" name="bo_ex" id="bo_ex_all" value="0" <?php echo $bo_ex_all; ?>><i></i> 전체</label>
                        <label for="bo_ex_yes" class="radio"><input type="radio" name="bo_ex" id="bo_ex_yes" value="2" <?php echo $bo_ex_yes; ?>><i></i> 예</label>
                        <label for="bo_ex_no" class="radio"><input type="radio" name="bo_ex" id="bo_ex_no" value="1" <?php echo $bo_ex_no; ?>><i></i> 아니오</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">분류사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_cate_all" class="radio"><input type="radio" name="bo_cate" id="bo_cate_all" value="0" <?php echo $bo_cate_all; ?>><i></i> 전체</label>
                            <label for="bo_cate_yes" class="radio"><input type="radio" name="bo_cate" id="bo_cate_yes" value="2" <?php echo $bo_cate_yes; ?>><i></i> 예</label>
                            <label for="bo_cate_no" class="radio"><input type="radio" name="bo_cate" id="bo_cate_no" value="1" <?php echo $bo_cate_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">글쓴이 사이드뷰 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_sideview_all" class="radio"><input type="radio" name="bo_sideview" id="bo_sideview_all" value="0" <?php echo $bo_sideview_all; ?>><i></i> 전체</label>
                            <label for="bo_sideview_yes" class="radio"><input type="radio" name="bo_sideview" id="bo_sideview_yes" value="2" <?php echo $bo_sideview_yes; ?>><i></i> 예</label>
                            <label for="bo_sideview_no" class="radio"><input type="radio" name="bo_sideview" id="bo_sideview_no" value="1" <?php echo $bo_sideview_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">DHTML 에디터 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_dhtml_all" class="radio"><input type="radio" name="bo_dhtml" id="bo_dhtml_all" value="0" <?php echo $bo_dhtml_all; ?>><i></i> 전체</label>
                            <label for="bo_dhtml_yes" class="radio"><input type="radio" name="bo_dhtml" id="bo_dhtml_yes" value="2" <?php echo $bo_dhtml_yes; ?>><i></i> 예</label>
                            <label for="bo_dhtml_no" class="radio"><input type="radio" name="bo_dhtml" id="bo_dhtml_no" value="1" <?php echo $bo_dhtml_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">비밀글 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_secret_all" class="radio"><input type="radio" name="bo_secret" id="bo_secret_all" value="0" <?php echo $bo_secret_all; ?>><i></i> 전체</label>
                            <label for="bo_secret_no" class="radio"><input type="radio" name="bo_secret" id="bo_secret_no" value="1" <?php echo $bo_secret_no; ?>><i></i> 사용안함</label>
                            <label for="bo_secret_chk" class="radio"><input type="radio" name="bo_secret" id="bo_secret_chk" value="2" <?php echo $bo_secret_chk; ?>><i></i> 체크박스</label>
                            <label for="bo_secret_yes" class="radio"><input type="radio" name="bo_secret" id="bo_secret_yes" value="3" <?php echo $bo_secret_yes; ?>><i></i> 무조건사용</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">추천 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_good_all" class="radio"><input type="radio" name="bo_good" id="bo_good_all" value="0" <?php echo $bo_good_all; ?>><i></i> 전체</label>
                            <label for="bo_good_yes" class="radio"><input type="radio" name="bo_good" id="bo_good_yes" value="2" <?php echo $bo_good_yes; ?>><i></i> 예</label>
                            <label for="bo_good_no" class="radio"><input type="radio" name="bo_good" id="bo_good_no" value="1" <?php echo $bo_good_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">비추천 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_nogood_all" class="radio"><input type="radio" name="bo_nogood" id="bo_nogood_all" value="0" <?php echo $bo_nogood_all; ?>><i></i> 전체</label>
                            <label for="bo_nogood_yes" class="radio"><input type="radio" name="bo_nogood" id="bo_nogood_yes" value="2" <?php echo $bo_nogood_yes; ?>><i></i> 예</label>
                            <label for="bo_nogood_no" class="radio"><input type="radio" name="bo_nogood" id="bo_nogood_no" value="1" <?php echo $bo_nogood_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">목록에서 파일 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_file_all" class="radio"><input type="radio" name="bo_file" id="bo_file_all" value="0" <?php echo $bo_file_all; ?>><i></i> 전체</label>
                            <label for="bo_file_yes" class="radio"><input type="radio" name="bo_file" id="bo_file_yes" value="2" <?php echo $bo_file_yes; ?>><i></i> 예</label>
                            <label for="bo_file_no" class="radio"><input type="radio" name="bo_file" id="bo_file_no" value="1" <?php echo $bo_file_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">목록에서 내용 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_cont_all" class="radio"><input type="radio" name="bo_cont" id="bo_cont_all" value="0" <?php echo $bo_cont_all; ?>><i></i> 전체</label>
                            <label for="bo_cont_yes" class="radio"><input type="radio" name="bo_cont" id="bo_cont_yes" value="2" <?php echo $bo_cont_yes; ?>><i></i> 예</label>
                            <label for="bo_cont_no" class="radio"><input type="radio" name="bo_cont" id="bo_cont_no" value="1" <?php echo $bo_cont_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">전체목록보이기 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_list_all" class="radio"><input type="radio" name="bo_list" id="bo_list_all" value="0" <?php echo $bo_list_all; ?>><i></i> 전체</label>
                            <label for="bo_list_yes" class="radio"><input type="radio" name="bo_list" id="bo_list_yes" value="2" <?php echo $bo_list_yes; ?>><i></i> 예</label>
                            <label for="bo_list_no" class="radio"><input type="radio" name="bo_list" id="bo_list_no" value="1" <?php echo $bo_list_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">SNS 사용</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="bo_sns_all" class="radio"><input type="radio" name="bo_sns" id="bo_sns_all" value="0" <?php echo $bo_sns_all; ?>><i></i> 전체</label>
                            <label for="bo_sns_yes" class="radio"><input type="radio" name="bo_sns" id="bo_sns_yes" value="2" <?php echo $bo_sns_yes; ?>><i></i> 예</label>
                            <label for="bo_sns_no" class="radio"><input type="radio" name="bo_sns" id="bo_sns_no" value="1" <?php echo $bo_sns_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>생성된 게시판수 <?php echo number_format($total_count); ?>건
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="a.gr_id|asc" <?php echo $sst=='a.gr_id' && $sod == 'asc' ? 'selected':''; ?>>그룹 정방향 (↓)</option>
                    <option value="a.gr_id|desc" <?php echo $sst=='a.gr_id' && $sod == 'desc' ? 'selected':''; ?>>그룹 역방향 (↑) </option>
                    <option value="bo_table|asc" <?php echo $sst=='bo_table' && $sod == 'asc' ? 'selected':''; ?>>TABLE 정방향 (↓)</option>
                    <option value="bo_table|desc" <?php echo $sst=='bo_table' && $sod == 'desc' ? 'selected':''; ?>>TABLE 역방향 (↑) </option>
                    <option value="bo_skin|asc" <?php echo $sst=='bo_skin' && $sod == 'asc' ? 'selected':''; ?>>스킨 정방향 (↓)</option>
                    <option value="bo_skin|desc" <?php echo $sst=='bo_skin' && $sod == 'desc' ? 'selected':''; ?>>스킨 역방향 (↑) </option>
                    <option value="bo_mobile_skin|asc" <?php echo $sst=='bo_mobile_skin' && $sod == 'asc' ? 'selected':''; ?>>모바일스킨 정방향 (↓)</option>
                    <option value="bo_mobile_skin|desc" <?php echo $sst=='bo_mobile_skin' && $sod == 'desc' ? 'selected':''; ?>>모바일스킨 역방향 (↑) </option>
                    <option value="bo_subject|asc" <?php echo $sst=='bo_subject' && $sod == 'asc' ? 'selected':''; ?>>제목 정방향 (↓)</option>
                    <option value="bo_subject|desc" <?php echo $sst=='bo_subject' && $sod == 'desc' ? 'selected':''; ?>>제목 역방향 (↑) </option>
                    <option value="bo_use_sns|asc" <?php echo $sst=='bo_use_sns' && $sod == 'asc' ? 'selected':''; ?>>SNS사용 정방향 (↓)</option>
                    <option value="bo_use_sns|desc" <?php echo $sst=='bo_use_sns' && $sod == 'desc' ? 'selected':''; ?>>SNS사용 역방향 (↑) </option>
                    <option value="bo_use_search|asc" <?php echo $sst=='bo_use_search' && $sod == 'asc' ? 'selected':''; ?>>검색사용 정방향 (↓)</option>
                    <option value="bo_use_search|desc" <?php echo $sst=='bo_use_search' && $sod == 'desc' ? 'selected':''; ?>>검색사용 역방향 (↑) </option>
                    <option value="bo_order|asc" <?php echo $sst=='bo_order' && $sod == 'asc' ? 'selected':''; ?>>출력순서 정방향 (↓)</option>
                    <option value="bo_order|desc" <?php echo $sst=='bo_order' && $sod == 'desc' ? 'selected':''; ?>>출력순서 역방향 (↑) </option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>

    <form name="fboardlist" id="fboardlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="grid" value="<?php echo $grid; ?>">
    <input type="hidden" name="boskin" value="<?php echo $boskin; ?>">
    <input type="hidden" name="bomobileskin" value="<?php echo $bomobileskin; ?>">
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
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <p class="text-end f-s-13r m-b-5 text-gray">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th class="width-100px">관리</th>
                        <th class="width-180px">이윰확장기능</th>
                        <th class="width-180px">게시판</th>
                        <th>테이블아이디</th>
                        <th>그룹</th>
                        <th>사용스킨</th>
                        <th>제목</th>
                        <th>읽기P</th>
                        <th>쓰기P</th>
                        <th>댓글P</th>
                        <th>다운P</th>
                        <th>SNS사용</th>
                        <th>검색사용</th>
                        <th>출력순서</th>
                        <th>접속기기</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$bo_cnt; $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;<?php echo $qstr; ?>"><u>수정</u></a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&wmode=1" onclick="eb_modal(this.href, 'copy'); return false;" class="m-l-10"><u>복사</u></a>
                        </td>
                        <td class="text-center">
                            <?php if ($list[$i]['use_gnu_skin'] == 'n') { ?>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;<?php echo $qstr; ?>"><u>확장필드(<strong class="text-<?php echo $list[$i]['bo_ex_cnt']>0 ? 'crimson':'gray'; ?>"><?php echo number_format($list[$i]['bo_ex_cnt']); ?></strong>)</u></a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_addon&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&amp;<?php echo $qstr; ?>" class="m-l-10"><u>확장기능</u></a>
                            <?php } else { ?>
                            -
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo short_url_clean(G5_BBS_URL.'/write.php?bo_table='.$list[$i]['bo_table']); ?>" target="_blank" class="m-l-10"><u>글쓰기</u></a><a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>" target="_blank" class="m-l-10"><u>바로가기</u></a>
                        </td>
                        <td>
                            <input type="hidden" name="board_table[<?php echo $i; ?>]" value="<?php echo $list[$i]['bo_table']; ?>"><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;bo_table=<?php echo $list[$i]['bo_table']; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href, 'config'); return false;"<?php } else { ?>href="javascript:void(0);"<?php } ?>><i class="fas fa-external-link-alt text-light-gray m-r-7 hidden-xs"></i><strong><?php echo $list[$i]['bo_table']; ?></strong></a>
                        </td>
                        <td>
                            <label class="select width-150px"><?php echo $list[$i]['gr_select']; ?><i></i></label>
                        </td>
                        <td>
                            <label class="select width-150px">
                                <select name="use_gnu_skin[<?php echo $i; ?>]" id="use_gnu_skin_<?php echo $i; ?>">
                                    <option value="y" <?php echo $list[$i]['use_gnu_skin'] == 'y' ? 'selected': ''; ?>>그누보드스킨</option>
                                    <option value="n" <?php echo $list[$i]['use_gnu_skin'] == 'n' || !$list[$i]['use_gnu_skin'] ? 'selected': ''; ?>>이윰빌더스킨</option>
                                </select><i></i>
                            </label>
                        </td>
                        <td>
                            <label class="input width-250px"><input type="text" name="bo_subject[<?php echo $i; ?>]" id="bo_subject_<?php echo $i; ?>" value="<?php echo get_text($list[$i]['bo_subject']); ?>" required></label>
                        </td>
                        <td>
                            <label class="input width-60px"><input type="text" name="bo_read_point[<?php echo $i; ?>]" id="bo_read_point_<?php echo $i; ?>" value="<?php echo $list[$i]['bo_read_point']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-60px"><input type="text" name="bo_write_point[<?php echo $i; ?>]" id="bo_write_point_<?php echo $i; ?>" value="<?php echo $list[$i]['bo_write_point']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-60px"><input type="text" name="bo_comment_point[<?php echo $i; ?>]" id="bo_comment_point_<?php echo $i; ?>" value="<?php echo $list[$i]['bo_comment_point']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-60px"><input type="text" name="bo_download_point[<?php echo $i; ?>]" id="bo_download_point_<?php echo $i; ?>" value="<?php echo $list[$i]['bo_download_point']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="bo_use_sns[<?php echo $i; ?>]" id="bo_use_sns_<?php echo $i; ?>" value="1" <?php echo $list[$i]['bo_use_sns'] ? 'checked':''; ?>><i></i></label>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="bo_use_search[<?php echo $i; ?>]" id="bo_use_search_<?php echo $i; ?>" value="1" <?php echo $list[$i]['bo_use_search'] ? 'checked':''; ?>><i></i></label>
                        </td>
                        <td>
                            <label class="input width-60px"><input type="text" name="bo_order[<?php echo $i; ?>]" id="bo_order_<?php echo $i; ?>" value="<?php echo $list[$i]['bo_order']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="select width-100px"><select name="bo_device[<?php echo $i; ?>]" id="bo_device_<?php echo $i; ?>"><option value="both" <?php echo $list[$i]['bo_device'] == 'both' ? 'selected':''; ?>>모두</option><option value="pc" <?php echo $list[$i]['bo_device'] == 'pc' ? 'selected':''; ?>>PC</option><option value="mobile" <?php echo $list[$i]['bo_device'] == 'mobile' ? 'selected':''; ?>>모바일</option></select><i></i></label>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($bo_cnt == 0) { ?>
                    <tr>
                        <td colspan="16" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-start">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title f-w-700"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
<?php if (!$wmode) { ?>
function eb_modal(href, mode) {
    var title = '';
    var md_height = 450;
    if (mode == 'copy') {
        title = '게시판 복사';
        md_height = 450;
    } else if (mode == 'config') {
        title = '게시판 관리';
        md_height = parseInt($(window).height() * 0.8);
    }

    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-title").text("");
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-title").text(title);
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(md_height);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.submit();
    }
}

function fboardlist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>