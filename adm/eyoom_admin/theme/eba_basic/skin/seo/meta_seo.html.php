<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/seo/meta_seo.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'meta_seo';
$g5_title = '매타태그관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">검색엔진최적화</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-metatagform">
    <form name="frmmetatag" action="<?php echo $action_url1; ?>" onsubmit="return frmmetatag_check(this);" method="post" class="eyoom-form">

    <div id="metatag-layer">
        <div class="adm-form-table m-b-20">
            <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>메타태그 설정</strong></div>

            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="mt_verification" class="label">사이트 소유권 확인</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="mb_signature" class="textarea">
                        <textarea name="mt_verification" id="mt_verification" rows="5"><?php echo stripslashes(html_purifier($seocfg['mt_verification'])); ?></textarea>
                    </label>
                    <div class="note"><strong>Note:</strong> 사이트 소유권을 확인하는 메타태그 입력</div>
                    <div class="cont-text-bg m-t-10">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 네이버웹마스터도구 및 구글웹마스터도구인 Google Search Console 에서 도메인의 소유권확인용으로 제시하는 메타태그를 엔터로 구분하여 입력합니다.<br>
                            <i class="fas fa-info-circle"></i> <a href="https://searchadvisor.naver.com" target="_blank">네이버</a> : &lt;meta name="naver-site-verification" content="확인코드"/&gt;<br>
                            <i class="fas fa-info-circle"></i> <a href="https://search.google.com/search-console/welcome?hl=ko" target="_blank">구글</a> : &lt;meta name="google-site-verification" content="확인코드"/&gt;<br>
                            <i class="fas fa-info-circle"></i> <a href="https://www.bing.com/webmasters/about?mkt=ko-kr" target="_blank">Bing</a> : &lt;meta name="msvalidate.01" content="확인코드"/&gt;<br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="mt_title" class="label">메타 타이틀<br>(Title)</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="mt_title" id="mt_title" value="<?php echo get_sanitize_input($seocfg['mt_title']); ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 매타태그 title의 권장 길이는 50~60자입니다.</div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="mt_keywords" class="label">메타 키워드<br>(Keywords)</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="mt_keywords" class="textarea">
                        <textarea name="mt_keywords" id="mt_keywords" rows="5"><?php echo html_purifier($seocfg['mt_keywords']); ?></textarea>
                    </label>
                    <div class="note"><strong>Note:</strong> 사이트를 대표하는 키워드를 입력해 주세요. 키워드는 쉼표(,)로 단어를 구분하여 입력합니다. 예) 이윰, 이윰넷, 이윰빌더, 홈페이지빌더</div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="mt_description" class="label">메타 디스크립션<br>(Description)</label>
                </div>
                <div class="adm-form-td td-r">
                    <label for="mt_description" class="textarea">
                        <textarea name="mt_description" id="mt_description" rows="5"><?php echo html_purifier($seocfg['mt_description']); ?></textarea>
                    </label>
                    <div class="note"><strong>Note:</strong> 사이트를 설명하는 문구를 입력해 주세요. 영어나 기호를 기준으로 약 135~160자 정도가 적합하고, 한글이라면 80~110자 정도가 적당합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="mt_robots" class="label">검색엔진 허용범위<br>(Robots)</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="mt_robots" id="mt_robots">
                            <option value="">:: 선택 ::</option>
                            <option value="index,follow" <?php echo $seocfg['mt_robots'] == 'index,follow' ? 'selected': ''; ?>>index,follow</option>
                            <option value="noindex,follow" <?php echo $seocfg['mt_robots'] == 'noindex,follow' ? 'selected': ''; ?>>noindex,follow</option>
                            <option value="index,nofollow" <?php echo $seocfg['mt_robots'] == 'index,nofollow' ? 'selected': ''; ?>>index,nofollow</option>
                            <option value="noindex,nofollow" <?php echo $seocfg['mt_robots'] == 'noindex,nofollow' ? 'selected': ''; ?>>noindex,nofollow</option>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> 검색 로봇의 접근허용 범위를 설정할 수 있습니다.</div>
                    <div class="cont-text-bg m-t-10">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> index,follow : 이 문서도 긁어가고 링크된 문서도 긁어감.<br>
                            <i class="fas fa-info-circle"></i> noindex,follow : 이 문서는 긁어가지 말고 링크된 문서만 긁어감.<br>
                            <i class="fas fa-info-circle"></i> index,nofollow : 이 문서는 긁어가되, 링크는 무시함.<br>
                            <i class="fas fa-info-circle"></i> noindex,nofollow : 이 문서도 긁지 않고, 링크도 무시함.<br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label for="mt_author" class="label">제작자<br>(Author)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="mt_author" id="mt_author" value="<?php echo $seocfg['mt_author']; ?>">
                        </label>
                        <div class="note"><strong>Note:</strong> 사이트의 문서 작성자로 만든사람의 이름을 입력합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label for="mt_publisher" class="label">퍼블리셔<br>(Publisher)</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="mt_publisher" id="mt_publisher" value="<?php echo $seocfg['mt_publisher']; ?>">
                        </label>
                        <div class="note"><strong>Note:</strong> 사이트 발행 주체로 만든 단체나 회사이름을 입력합니다.</div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="mt_img_url" class="label">오픈그래프 이미지 경로</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <i class="icon-prepend fas fa-link "></i>
                        <input type="text" name="mt_img_url" id="mt_img_url" value="<?php echo $seocfg['mt_img_url']; ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 매타태그 open graph (og:image) 이미지 경로를 입력합니다. (예: <?php echo G5_URL; ?>/image/og_image.jpg)</div>
                    <div class="note"><strong>Note:</strong> 사이즈는 1200 X 630 픽셀 이미지로 제작하여 FTP로 업로드한 이미지 URL를 입력해 주세요.</div>
                    <div class="note"><strong>Note:</strong> 이미지가 존재하지 않으면 사이트 로고를 활용합니다.</div>
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
function frmmetatag_check(f) {
    f.target = 'blank_iframe';
    return true;
}
</script>