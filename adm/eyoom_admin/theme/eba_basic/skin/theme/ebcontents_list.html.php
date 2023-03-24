<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebcontents_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.checkbox {border:0}
.admin-ebcontents-list .ebcontents-list-image {width:80px;margin:0 auto}
.admin-ebcontents-list .ebcontents-list-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-ebcontents-list">
    <div class="adm-headline">
        <h3>EB콘텐츠 - 마스터관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebcontents_form&amp;thema=<?php echo $_theme; ?><?php echo $meinfo ? '&amp;me_id='.$meinfo['me_id']: '';?>&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB콘텐츠 마스터추가</span></a>
    </div>

    <div class="cont-text-bg m-b-20">
        <p class="bg-info"><strong>메뉴위치</strong> : 홈페이지<?php echo $me_title ? ' &gt; ': '';?><?php echo $me_title; ?></p>
    </div>
    
    <input type="hidden" name="theme" value="<?php echo $_theme; ?>">
    <input type="hidden" name="me_id" id="me_id" value="<?php echo $meinfo['me_id'] ? $meinfo['me_id']: ''; ?>">
    <input type="hidden" name="token" value="">

    <div class="f-s-13r m-b-5">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>EB콘텐츠 마스터 <?php echo number_format($total_count); ?>개
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th class="width-160px">관리</th>
                        <th>스킨</th>
                        <th>콘텐츠마스터명</th>
                        <th>치환코드</th>
                        <?php if ($meinfo) { ?>
                        <th>출력순서</th>
                        <?php } ?>
                        <th>상태</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="ec_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['ec_no']; ?>">
                            <input type="hidden" name="ec_code[<?php echo $i; ?>]" value="<?php echo $list[$i]['ec_code']; ?>">
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_form&amp;ec_code=<?php echo $list[$i]['ec_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_modal(this.href); return false;"><u>수정</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents_itemlist&amp;ec_code=<?php echo $list[$i]['ec_code']; ?>&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="m-l-10"><u>아이템관리</u></a>
                        </td>
                        <td>
                            <div class="ebcontents-list-image"><?php if ($list[$i]['ec_skin_img']) { ?><img src="<?php echo $list[$i]['ec_skin_img']; ?>" class="img-fluid"><?php } ?><?php echo get_text($list[$i]['ec_skin']); ?></div>
                        </td>
                        <td><?php echo get_text($list[$i]['ec_name']); ?></td>
                        <td>
                            <div class="eb-clipboard"><div id="subs_code_<?php echo $i; ?>" class="eb-clipboard-cont"><?php echo $list[$i]['ec_chg_code']; ?></div><div class="eb-clipboard-btn" data-clipboard-target="#subs_code_<?php echo $i; ?>">코드복사</div></div>
                        </td>
                        <?php if ($meinfo) { ?>
                        <td>
                            <label class="input width-100px"><input type="text" name="ec_sort[<?php echo $i; ?>]" id="ec_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['ec_sort']; ?>"><input type="hidden" name="ec_sort_old[<?php echo $i; ?>]" value="<?php echo $list[$i]['ec_sort']; ?>"></label>
                        </td>
                        <?php } ?>
                        <td>
                            <label class="select width-150px"><select name="ec_state[<?php echo $i; ?>]" id="ec_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo  $list[$i]['ec_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo  $list[$i]['ec_state'] == '2' ? 'selected':''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td class="text-center"><?php echo substr($list[$i]['ec_regdt'], 0, 10); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="7" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script>
new Clipboard('.eb-clipboard-btn');
</script>