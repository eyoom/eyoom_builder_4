<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/mail_select_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'mail_list';
$g5_title = '회원메일발송';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="mail-list">
    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <form name="fmailselectlist" id="fmailselectlist" method="post" action="<?php echo $action_url1; ?>" class="eyoom-form">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="ma_id" value="<?php echo get_text($ma_id); ?>">

    <div class="adm-headline">
        <h3>메일발송 대상 리스트</h3>
    </div>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-50px">번호</th>
                        <th>회원아이디</th>
                        <th>이름</th>
                        <th>닉네임</th>
                        <th>이메일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=1; $i<=count((array)$list); $i++) { ?>
                    <tr>
                        <th><?php echo $i; ?></th>
                        <td><?php echo $list[$i]['mb_id']; ?></td>
                        <td><?php echo get_text($list[$i]['mb_name']); ?></td>
                        <td><?php echo $list[$i]['mb_nick']; ?></td>
                        <td><?php echo $list[$i]['mb_email']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="5" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <textarea name="ma_list" style="display:none"><?php echo html_purifier($ma_list); ?></textarea>

    <div class="confirm-bottom-btn m-t-10">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>