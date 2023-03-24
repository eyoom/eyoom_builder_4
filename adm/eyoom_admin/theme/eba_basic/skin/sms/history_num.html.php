<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/history_num.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'history_num';
$g5_title = '전송내역-번호별';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
/* page */
.pg_wrap {clear:both;margin:20px 0 0;padding:0;text-align:center}
.pg {display:inline-block}
.pg_page, .pg_current {font-size:.75rem;color:#fff;background-color:#353535;display:inline-block;float:left;padding:0;width:32px;height:26px;line-height:26px;text-decoration:none;border:0;margin:1px}
.pg a:focus, .pg a:hover {background-color:none}
.pg_current {display:inline-block;background:#3949ab;color:#fff;font-weight:400}
</style>

<div class="admin-history-num">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

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
                                <select name="st" id="st">
                                    <option value="hs_name"<?php echo get_selected('hs_name', $st); ?>>이름</option>
                                    <option value="hs_hp"<?php echo get_selected('hs_hp', $st); ?>>휴대폰번호</option>
                                    <option value="bk_no"<?php echo get_selected('bk_no', $st); ?>>고유번호</option>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="input max-width-250px">
                                <input type="text" name="sv" value="<?php echo get_sanitize_input($sv); ?>" id="ssv">
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit; ?>
        </div>
    </div>

    </form>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-60px">번호</th>
                        <th class="width-60px">관리</th>
                        <th>그룹</th>
                        <th>이름</th>
                        <th>회원ID</th>
                        <th>전화번호</th>
                        <th>전송일시</th>
                        <th>예약</th>
                        <th>전송</th>
                        <th>메세지</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo number_format($list[$i]['vnum']); ?></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_view&amp;page=<?php echo $page; ?>&amp;st=<?php echo $st; ?>&amp;sv=<?php echo $sv; ?>&amp;wr_no=<?php echo $list[$i]['wr_no']; ?>"><u>수정</u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['bg_name']; ?></td>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book_write&amp;w=u&amp;bk_no=<?php echo $list[$i]['bk_no']; ?>"><u><?php echo $list[$i]['hs_name']; ?></u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['mb_id']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['hs_hp']; ?></td>
                        <td class="text-center"><?php echo date('Y-m-d H:i', strtotime($write['wr_datetime']))?></td>
                        <td class="text-center"><?php echo $write['wr_booking']!='0000-00-00 00:00:00'?"<span title='{$write['wr_booking']}'>예약</span>":'-';?></td>
                        <td class="text-center"><?php echo $list[$i]['hs_flag']?'성공':'실패'?></td>
                        <td class="text-center"><span title='<?php echo $write['wr_message']?>'><?php echo $write['wr_message']?></span></td>
                    </tr>
                    <?php } ?>
                    <?php if($count == 0) { ?>
                    <tr>
                        <td colspan="10" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <div class="m-t-20">
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME']."?st=$st&amp;sv=$sv&amp;page="); ?>
    </div>
</div>