<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/member_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'member_list';
$g5_title = '회원관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-member-list">
    <div class="adm-headline">
        <h3>회원 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form" class="btn-e btn-e-md btn-e-crimson adm-headline-btn m-l-5"><i class="las la-plus m-r-7"></i><span>회원 추가</span></a>
        <?php } ?>
        <?php if ($config['cf_admin'] == $member['mb_id'] && !$wmode) { ?>
        <div class="excel-download">
            <a href="javascript:void(0);" onclick="member_excel_download();" class="btn-e btn-e-md btn-e-indigo adm-headline-btn">엑셀다운로드</a>
        </div>
        <?php } ?>
    </div>

    <form id="fsearch" name="fsearch" method="get" class="eyoom-form" onsubmit="fsearch_submit(this);">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="smode" value="">
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">검색어</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="select width-100px">
                                    <select name="sfl" id="sfl">
                                        <option value="a.mb_name"<?php echo get_selected($sfl, "a.mb_name"); ?>>이름</option>
                                        <option value="a.mb_id"<?php echo get_selected($sfl, "a.mb_id"); ?>>아이디</option>
                                        <option value="a.mb_nick"<?php echo get_selected($sfl, "a.mb_nick"); ?>>닉네임</option>
                                        <option value="a.mb_email"<?php echo get_selected($sfl, "a.mb_email"); ?>>E-MAIL</option>
                                        <option value="a.mb_tel"<?php echo get_selected($sfl, "a.mb_tel"); ?>>전화번호</option>
                                        <option value="a.mb_hp"<?php echo get_selected($sfl, "a.mb_hp"); ?>>휴대폰번호</option>
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
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">회원레벨</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-150px">
                            <select name="lev" id="lev">
                                <option value="">전체</option>
                                <?php for ($i=1; $i<=10; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php echo get_selected($lev, $i); ?>><?php echo $i; ?> 레벨</option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">본인확인</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="mb_certify_all" class="radio"><input type="radio" name="cert" value="0" id="mb_certify_all" <?php echo $mb_certify_all; ?>><i></i> 전체</label>
                            <label for="mb_certify_yes" class="radio"><input type="radio" name="cert" value="2" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>><i></i> 예</label>
                            <label for="mb_certify_no" class="radio"><input type="radio" name="cert" value="1" id="mb_certify_no" <?php echo $mb_certify_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <?php if (!$wmode) { ?>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">정보공개</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="mb_open_all" class="radio"><input type="radio" name="open" id="mb_open_all" value="0" <?php echo $mb_open_all; ?>><i></i> 전체</label>
                            <label for="mb_open_yes" class="radio"><input type="radio" name="open" id="mb_open_yes" value="2" <?php echo $mb_open_yes; ?>><i></i> 예</label>
                            <label for="mb_open_no" class="radio"><input type="radio" name="open" id="mb_open_no" value="1" <?php echo $mb_open_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">성인인증</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="mb_adult_all" class="radio"><input type="radio" name="adt" value="0" id="mb_adult_all" <?php echo $mb_adult_all; ?>><i></i> 전체</label>
                            <label for="mb_adult_yes" class="radio"><input type="radio" name="adt" value="2" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>><i></i> 예</label>
                            <label for="mb_adult_no" class="radio"><input type="radio" name="adt" value="1" id="mb_adult_no" <?php echo $mb_adult_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">메일수신</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="mb_mailling_all" class="radio"><input type="radio" name="mail" id="mb_mailling_all" value="0" <?php echo $mb_mailling_all; ?>><i></i> 전체</label>
                            <label for="mb_mailling_yes" class="radio"><input type="radio" name="mail" id="mb_mailling_yes" value="2" <?php echo $mb_mailling_yes; ?>><i></i> 예</label>
                            <label for="mb_mailling_no" class="radio"><input type="radio" name="mail" id="mb_mailling_no" value="1" <?php echo $mb_mailling_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">SMS 수신</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="mb_sms_all" class="radio"><input type="radio" name="sms" id="mb_sms_all" value="0" <?php echo $mb_sms_all; ?>><i></i> 전체</label>
                            <label for="mb_sms_yes" class="radio"><input type="radio" name="sms" id="mb_sms_yes" value="2" <?php echo $mb_sms_yes; ?>><i></i> 예</label>
                            <label for="mb_sms_no" class="radio"><input type="radio" name="sms" id="mb_sms_no" value="1" <?php echo $mb_sms_no; ?>><i></i> 아니오</label>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">날짜검색</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <div class="m-b-5">
                                <label class="select max-width-150px">
                                    <select name="sdt" id="sdt">
                                        <option value="mb_datetime" <?php echo get_selected($sdt, 'mb_datetime'); ?>>가입일</option>
                                        <option value="mb_today_login" <?php echo get_selected($sdt, 'mb_today_login'); ?>>최신로그인</option>
                                    </select><i></i>
                                </label>
                            </div>
                            <span>
                                <label class="input max-width-150px">
                                    <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10" autocomplete="off">
                                </label>
                            </span>
                            <span> - </span>
                            <span>
                                <label class="input max-width-150px">
                                    <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10" autocomplete="off">
                                </label>
                            </span>
                            <span class="search-btns">
                                <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-xs btn-e-gray">오늘</button>
                                <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-xs btn-e-gray">어제</button>
                                <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-xs btn-e-gray">이번주</button>
                                <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-xs btn-e-gray">이번달</button>
                                <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-xs btn-e-gray">지난주</button>
                                <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-xs btn-e-gray">지난달</button>
                                <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-xs btn-e-gray">전체</button>
                            </span>
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
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>총회원수 <?php echo number_format($total_count); ?>명<?php if (!$wmode) { ?> 중, <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl; ?>&amp;stx=<?php echo $stx; ?>"><u>차단 <?php echo number_format($intercept_count); ?></u></a>명, <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl; ?>&amp;stx=<?php echo $stx; ?>"><u>탈퇴 <?php echo number_format($leave_count); ?></u></a>명<?php } ?>
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="mb_id|asc" <?php if ($sst=='mb_id' && $sod=='asc') { ?>selected<?php } ?>>회원아이디 정방향 (↓)</option>
                    <option value="mb_id|desc" <?php if ($sst=='mb_id' && $sod=='desc') { ?>selected<?php } ?>>회원아이디 역방향 (↑)</option>
                    <option value="mb_name|asc" <?php if ($sst=='mb_name' && $sod=='asc') { ?>selected<?php } ?>>이름 정방향 (↓)</option>
                    <option value="mb_name|desc" <?php if ($sst=='mb_name' && $sod=='desc') { ?>selected<?php } ?>>이름 역방향 (↑)</option>
                    <option value="mb_nick|asc" <?php if ($sst=='mb_nick' && $sod=='asc') { ?>selected<?php } ?>>닉네임 정방향 (↓)</option>
                    <option value="mb_nick|desc" <?php if ($sst=='mb_nick' && $sod=='desc') { ?>selected<?php } ?>>닉네임 역방향 (↑)</option>
                    <option value="mb_certify|asc" <?php if ($sst=='mb_certify' && $sod=='asc') { ?>selected<?php } ?>>본인확인 정방향 (↓)</option>
                    <option value="mb_certify|desc" <?php if ($sst=='mb_certify' && $sod=='desc') { ?>selected<?php } ?>>본인확인 역방향 (↑)</option>
                    <option value="mb_email_certify|asc" <?php if ($sst=='mb_email_certify' && $sod=='asc') { ?>selected<?php } ?>>메일인증 정방향 (↓)</option>
                    <option value="mb_email_certify|desc" <?php if ($sst=='mb_email_certify' && $sod=='desc') { ?>selected<?php } ?>>메일인증 역방향 (↑)</option>
                    <option value="mb_open|asc" <?php if ($sst=='mb_open' && $sod=='asc') { ?>selected<?php } ?>>정보공개 정방향 (↓)</option>
                    <option value="mb_open|desc" <?php if ($sst=='mb_open' && $sod=='desc') { ?>selected<?php } ?>>정보공개 역방향 (↑)</option>
                    <option value="mb_mailling|asc" <?php if ($sst=='mb_mailling' && $sod=='asc') { ?>selected<?php } ?>>메일수신 정방향 (↓)</option>
                    <option value="mb_mailling|desc" <?php if ($sst=='mb_mailling' && $sod=='desc') { ?>selected<?php } ?>>메일수신 역방향 (↑)</option>
                    <option value="mb_sms|asc" <?php if ($sst=='mb_sms' && $sod=='asc') { ?>selected<?php } ?>>SMS수신 정방향 (↓)</option>
                    <option value="mb_sms|desc" <?php if ($sst=='mb_sms' && $sod=='desc') { ?>selected<?php } ?>>SMS수신 역방향 (↑)</option>
                    <option value="mb_level|asc" <?php if ($sst=='mb_level' && $sod=='asc') { ?>selected<?php } ?>>권한 정방향 (↓)</option>
                    <option value="mb_level|desc" <?php if ($sst=='mb_level' && $sod=='desc') { ?>selected<?php } ?>>권한 역방향 (↑)</option>
                    <option value="mb_adult|asc" <?php if ($sst=='mb_adult' && $sod=='asc') { ?>selected<?php } ?>>성인인증 정방향 (↓)</option>
                    <option value="mb_adult|desc" <?php if ($sst=='mb_adult' && $sod=='desc') { ?>selected<?php } ?>>성인인증 역방향 (↑)</option>
                    <option value="mb_intercept_date|asc" <?php if ($sst=='mb_intercept_date' && $sod=='asc') { ?>selected<?php } ?>>접근차단 정방향 (↓)</option>
                    <option value="mb_intercept_date|desc" <?php if ($sst=='mb_intercept_date' && $sod=='desc') { ?>selected<?php } ?>>접근차단 역방향 (↑)</option>
                    <option value="mb_today_login|asc" <?php if ($sst=='mb_today_login' && $sod=='asc') { ?>selected<?php } ?>>최종접속 정방향 (↓)</option>
                    <option value="mb_today_login|desc" <?php if ($sst=='mb_today_login' && $sod=='desc') { ?>selected<?php } ?>>최종접속 역방향 (↑)</option>
                    <option value="mb_point|asc" <?php if ($sst=='mb_point' && $sod=='asc') { ?>selected<?php } ?>>포인트 정방향 (↓)</option>
                    <option value="mb_point|desc" <?php if ($sst=='mb_point' && $sod=='desc') { ?>selected<?php } ?>>포인트 역방향 (↑)</option>
                    <option value="mb_datetime|asc" <?php if ($sst=='mb_datetime' && $sod=='asc') { ?>selected<?php } ?>>가입일 정방향 (↓)</option>
                    <option value="mb_datetime|desc" <?php if ($sst=='mb_datetime' && $sod=='desc') { ?>selected<?php } ?>>가입일 역방향 (↑)</option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    </form>

    <form name="fmemberlist" id="fmemberlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fmemberlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="lev" value="<?php echo $lev; ?>">
    <input type="hidden" name="cert" value="<?php echo $cert; ?>">
    <input type="hidden" name="open" value="<?php echo $open; ?>">
    <input type="hidden" name="adt" value="<?php echo $adt; ?>">
    <input type="hidden" name="mail" value="<?php echo $mail; ?>">
    <input type="hidden" name="sms" value="<?php echo $sms; ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
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
                        <?php if (!$wmode) { ?>
                        <th>관리</th>
                        <?php } else { ?>
                        <th>선택하기</th>
                        <?php } ?>
                        <th>포토</th>
                        <th>아이디</th>
                        <th>이름</th>
                        <th>닉네임</th>
                        <?php if (!$wmode) { ?>
                        <th class="width-80px">권한</th>
                        <th>이윰레벨</th>
                        <th>그누<?php echo $levelset['gnu_name']; ?></th>
                        <th>이윰<?php echo $levelset['eyoom_name']; ?></th>
                        <th>본인확인</th>
                        <th>메일인증</th>
                        <th>정보공개</th>
                        <th>메일수신</th>
                        <th>SMS수신</th>
                        <th>성인인증</th>
                        <th>접근차단</th>
                        <th>상태</th>
                        <th>가입일</th>
                        <th>최신로그인</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="mb_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_id']; ?>" id="mb_id_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <?php if (!$wmode) { ?>
                        <td class="text-center">
                            <?php if ($is_admin!='group') { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_form&amp;mb_id=<?php echo $list[$i]['mb_id']; ?>&amp;w=u<?php if ($qstr) { ?>&amp;<?php echo $qstr; ?><?php } ?>"><u>수정</u></a><?php } ?><?php if ($config['cf_admin'] != $list[$i]['mb_id']) { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id=<?php echo $list[$i]['mb_id']; ?>" class="m-l-10"><u>그룹</u></a><?php } ?>
                        </td>
                        <?php } else { ?>
                        <td class="text-center">
                            <button type="button" data-mb-id="<?php echo $list[$i]['mb_id']; ?>" data-dismiss="modal" class="set_mbid btn-e btn-e-xxs btn-e-indigo">선택하기</button>
                        </td>
                        <?php } ?>
                        <td>
                            <div class="member-photo"><?php if (!$list[$i]['photo_url']) { ?><i class="fas fa-user-circle"></i><?php } else { ?><img src="<?php echo $list[$i]['photo_url']; ?>" class="img-fluid"><?php } ?></div>
                        </td>
                        <td>
                            <a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id']; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"<?php } else { ?>href="javascript:void(0);"<?php } ?> ><i class="fas fa-external-link-alt text-light-gray m-r-7 hidden-xs"></i><strong><?php echo $list[$i]['mb_id']; ?></strong></a>
                        </td>
                        <td>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"><?php echo get_text($list[$i]['mb_name']); ?></a>
                        </td>
                        <td>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"><?php echo get_text($list[$i]['mb_nick']); ?></a>
                        </td>
                        <?php if (!$wmode) { ?>
                        <td>
                            <label class="select width-60px"><?php echo $list[$i]['mb_level_select']; ?><i></i></label><input type="hidden" name="mb_prev_level[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_level']; ?>">
                        </td>
                        <td>
                            <?php echo $list[$i]['level']; ?> 레벨<input type="hidden" name="level[<?php echo $i; ?>]" value="<?php echo $list[$i]['level']; ?>">
                        </td>
                        <td>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=point_list&amp;sfl=mb_id&amp;stx=<?php echo $list[$i]['mb_id']; ?>"><?php echo number_format($list[$i]['mb_point']); ?></a>
                        </td>
                        <td>
                            <?php echo number_format($list[$i]['level_point']); ?><input type="hidden" name="level_point[<?php echo $i; ?>]" value="<?php echo $list[$i]['level_point']; ?>">
                        </td>
                        <td class="text-center"><?php echo $list[$i]['mb_certify_case']; ?></td>
                        <td class="text-center">
                            <span class="<?php if ($list[$i]['email_certify'] == 'Yes') { ?>text-teal<?php } else if ($list[$i]['email_certify'] == 'No') { ?>text-gray<?php } ?>"><?php echo $list[$i]['email_certify']; ?></span>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="mb_open[<?php echo $i; ?>]" <?php if ($list[$i]['mb_open']) { ?>checked<?php } ?> value="1"><i></i></label>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="mb_mailling[<?php echo $i; ?>]" <?php if ($list[$i]['mb_mailling']) { ?>checked<?php } ?> value="1"><i></i></label>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="mb_sms[<?php echo $i; ?>]" <?php if ($list[$i]['mb_sms']) { ?>checked<?php } ?> value="1"><i></i></label>
                        </td>
                        <td>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="mb_adult[<?php echo $i; ?>]" <?php if ($list[$i]['mb_adult']) { ?>checked<?php } ?> value="1"><i></i></label><input type="hidden" name="mb_certify[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_certify']; ?>">
                        </td>
                        <td>
                            <?php if (empty($list[$i]['mb_leave_date'])) { ?><label class="checkbox adm-table-check"><input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php if ($list[$i]['mb_intercept_date']) { ?>checked<?php } ?> value="<?php echo $list[$i]['intercept_date']; ?>"><i></i></label><?php } ?>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['mb_status']; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['mb_datetime'],0,-9); ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['mb_today_login'],0,-9); ?></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="<?php if (!$wmode) { ?>20<?php } else { ?>6<?php } ?>" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!$wmode) { ?>
    <div class="text-start">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <?php if (!$wmode) { ?>
    <div class="m-t-20">
        <div class="cont-text-bg">
            <p class="bg-info"><i class="fas fa-info-circle"></i> 회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>
        </div>
    </div>
    <?php } ?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">회원 정보 수정</h5>
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
function eb_modal(href) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

$(document).ready(function(){
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });

    <?php if ($wmode) { ?>
    $(".set_mbid").click(function() {
        var mb_id = $(this).attr('data-mb-id');
        $('#mb_id', parent.document).val(mb_id);
        window.parent.closeModal();
    });
    <?php } ?>
});

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function set_date(today) {
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "어제") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
    } else if (today == "이번주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.($date_term + 6).' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "이번달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "지난주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
    } else if (today == "지난달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
    } else if (today == "전체") {
        document.getElementById("fr_date").value = "";
        document.getElementById("to_date").value = "";
    }
}

function fsearch_submit (f) {
    f.dir.value = '<?php echo $dir; ?>';
    f.pid.value = '<?php echo $pid; ?>';
    f.smode.value = '';
    f.submit();
}

<?php if ($config['cf_admin'] == $member['mb_id']) { ?>
function member_excel_download() {
    f = document.fsearch;
    f.dir.value = 'member';
    f.pid.value = 'member_excel_download';
    f.smode.value = 1;
    f.submit();
}
<?php } ?>
</script>