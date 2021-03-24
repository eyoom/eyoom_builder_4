<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/board_excode.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/prism/prism.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-exboard-code">
    <form class="eyoom-form">

    <div id="board-extend">
        <div class="adm-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> Write 코드</strong></header>

            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0"><i class="fas fa-info-circle"></i> 작업대상 파일 (/theme/테마명/skin/board/작업스킨/<strong class="color-orange">write.skin.html</strong>)에 아래 소스를 복사하여 원하는 위치에 붙여넣기 하세요.</p>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <div class="col col-12">
                        <strong>단축코드</strong>
<pre class="line-numbers">
<code class="language-markup">&lt;?php echo $ex_write['<?php echo $exinfo['ex_fname']; ?>']; ?&gt;</code>
</pre>
                        <br>
                        <strong>전체코드</strong>
<pre class="line-numbers">
<?php if ($exinfo['ex_form'] == 'text') { ?>
<code class="language-markup">&lt;label for="<?php echo $exinfo['ex_fname']; ?>" class="label"><?php echo $exinfo['ex_subject']; ?>&lt;/label>
&lt;label class="input">
    &lt;input type="text" name="<?php echo $exinfo['ex_fname']; ?>" id="<?php echo $exinfo['ex_fname']; ?>" value="&lt;?php echo $ex_value['<?php echo $exinfo['ex_fname']; ?>']; ?&gt;" &lt;?php echo $exinfo['ex_required'] == 'y' ? 'required': ''; ?&gt;>
&lt;/label></code>
<?php } else if ($exinfo['ex_form'] == 'radio') { ?>
<code class="language-markup">&lt;label class="label"><?php echo $exinfo['ex_subject']; ?>&lt;/label>
&lt;div class="inline-group">
    <?php for ($i=0; $i<count((array)$exitem); $i++) { ?>
    &lt;label for="<?php echo $exinfo['ex_fname']; ?>_<?php echo $i+1; ?>" class="radio">&lt;input type="radio" name="<?php echo $exinfo['ex_fname']; ?>" id="<?php echo $exinfo['ex_fname']; ?>_<?php echo $i+1; ?>" value="<?php echo $exitem[$i]; ?>" &lt;?php echo $ex_value['<?php echo $exinfo['ex_fname']; ?>'] == '<?php echo $exinfo[$i]; ?>'<?php if ($i == 0) { ?> || !$ex_value['<?php echo $exinfo['ex_fname']; ?>']<?php } ?> ? 'checked':''; ?&gt;>&lt;i>&lt;/i><?php echo $exitem[$i]; ?>&lt;/label>
    <?php } ?>
&lt;/div></code>
<?php } else if ($exinfo['ex_form'] == 'checkbox') { ?>
<code class="language-markup">&lt;label class="label"><?php echo $exinfo['ex_subject']; ?>&lt;/label>
&lt;div class="inline-group">
    <?php for ($i=0; $i<count((array)$exitem); $i++) { ?>
    &lt;label for="<?php echo $exinfo['ex_fname']; ?>_<?php echo $i+1; ?>" class="checkbox">&lt;input type="checkbox" name="<?php echo $exinfo['ex_fname']; ?>[<?php echo $i+1; ?>]" id="<?php echo $exinfo['ex_fname']; ?>_<?php echo $i+1; ?>" value="<?php echo $exitem[$i]; ?>" &lt;?php echo $ex_value['<?php echo $exinfo['ex_fname']; ?>_<?php echo $i+1; ?>'] == '<?php echo $exitem[$i]; ?>' ? 'checked':''; ?&gt;>&lt;i>&lt;/i><?php echo $exitem[$i]; ?>&lt;/label>
    <?php } ?>
&lt;/div></code>
<?php } else if ($exinfo['ex_form'] == 'select') { ?>
<code class="language-markup">&lt;label class="label"><?php echo $exinfo['ex_subject']; ?>&lt;/label>
&lt;label class="select">
    &lt;select name="<?php echo $exinfo['ex_fname']; ?>" id="<?php echo $exinfo['ex_fname']; ?>">
        <?php for ($i=0; $i<count((array)$exitem); $i++) { ?>
        &lt;option value="<?php echo $exitem[$i] != '선택' ? $exitem[$i]:'';?>" &lt;?php echo $ex_value['<?php echo $exinfo['ex_fname']; ?>'] == '<?php echo $exitem[$i]; ?>' ? 'selected': ''; ?&gt;><?php echo $exitem[$i]; ?>&lt;/option>
        <?php } ?>
    &lt;/select>&lt;i>&lt;/i>
&lt;/label></code>
<?php } else if ($exinfo['ex_form'] == 'textarea') { ?>
<code class="language-markup">&lt;label class="label"><?php echo $exinfo['ex_subject']; ?>&lt;/label>
&lt;label class="textarea textarea-resizable">
    &lt;!-- 에디터 사용시는 에디터로, 아니면 textarea 로 노출 --&gt;
    &lt?php echo $<?php echo $exinfo['ex_fname']; ?>_editor_html; ?&gt;
&lt;/label></code>
<?php } else if ($exinfo['ex_form'] == 'address') { ?>
<code class="language-markup">&lt;div class="col col-12">
    &lt;label class="label margin-left-5"><?php echo $exinfo['ex_subject']; ?>&lt;/label>
&lt;/div>
&lt;div class="col col-4">
    &lt;label for="<?php echo $exinfo['ex_fname']; ?>_zip" class="sound_only">우편번호&lt;/label>
    &lt;label class="input">
        &lt;i class="icon-append fas fa-question-circle">&lt;/i>
        &lt;input type="text" name="<?php echo $exinfo['ex_fname']; ?>[zip]" value="&lt;?php echo $address_info['<?php echo $exinfo['ex_fname']; ?>'][0]; ?&gt;" id="<?php echo $exinfo['ex_fname']; ?>_zip" <?php echo $exinfo['ex_required'] == 'y' ? 'required':''; ?> size="5" maxlength="6">
        &lt;b class="tooltip tooltip-top-right">우편번호 (주소 검색 버튼을 클릭하여 조회)&lt;/b>
    &lt;/label>
&lt;/div>
&lt;div class="col col-4">
    &lt;button type="button" onclick="win_zip('fwrite', '<?php echo $exinfo['ex_fname']; ?>[zip]', '<?php echo $exinfo['ex_fname']; ?>[addr1]', '<?php echo $exinfo['ex_fname']; ?>[addr2]', '<?php echo $exinfo['ex_fname']; ?>[addr3]', '<?php echo $exinfo['ex_fname']; ?>[addr_jibeon]');" class="btn-e btn-e-indigo rounded address-search-btn">주소 검색&lt;/button>
&lt;/div>
&lt;div class="clearfix margin-bottom-10">&lt;/div>
&lt;div class="col col-12">
    &lt;label class="input">
        &lt;input type="text" name="<?php echo $exinfo['ex_fname']; ?>[addr1]" value="&lt;?php echo $address_info['<?php echo $exinfo['ex_fname']; ?>'][1]; ?&gt;" id="<?php echo $exinfo['ex_fname']; ?>_addr1" <?php echo $exinfo['ex_required'] == 'y' ? 'required': ''; ?> size="50">
    &lt;/label>
    &lt;div class="note margin-bottom-10">&lt;strong>Note:&lt;/strong> 기본주소&lt;/div>
&lt;/div>
&lt;div class="clear">&lt;/div>
&lt;div class="col col-6">
    &lt;label class="input">
        &lt;input type="text" name="<?php echo $exinfo['ex_fname']; ?>[addr2]" value="&lt;?php echo $address_info['<?php echo $exinfo['ex_fname']; ?>'][2]; ?&gt;" id="<?php echo $exinfo['ex_fname']; ?>_addr2" size="50">
    &lt;/label>
    &lt;div class="note margin-bottom-10">&lt;strong>Note:&lt;/strong> 상세주소&lt;/div>
&lt;/div>
&lt;div class="col col-6">
    &lt;label class="input">
        &lt;input type="text" name="<?php echo $exinfo['ex_fname']; ?>[addr3]" value="&lt;?php echo $address_info['<?php echo $exinfo['ex_fname']; ?>'][3]; ?&gt;" id="<?php echo $exinfo['ex_fname']; ?>_addr3" size="50" readonly="readonly">
    &lt;/label>
    &lt;div class="note margin-bottom-10">&lt;strong>Note:&lt;/strong> 참고항목&lt;/div>
&lt;/div>
&lt;input type="hidden" name="<?php echo $exinfo['ex_fname']; ?>[addr_jibeon]" value="&lt;?php echo $address_info['<?php echo $exinfo['ex_fname']; ?>'][4]; ?&gt;"></code>
<?php } ?>
</pre>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="adm-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> View 코드</strong></header>

            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0"><i class="fas fa-info-circle"></i> 아래 코드를 작업대상 파일 (/theme/테마명/skin/board/작업스킨/<strong class="color-orange">view.skin.html</strong>)의 원하는 위치에 입력하시면 됩니다.</p>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <div class="col col-12">
<?php if ($exinfo['ex_form'] == 'address') { ?>
                        <strong>전체주소</strong>
<pre class="line-numbers">
<code class="language-markup">&lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['title']; ?&gt; : &lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['address']; ?&gt;</code>
</pre>
                        <br>
                        <strong>부분주소</strong>
<pre class="line-numbers">
<code class="language-markup">&lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['title']; &gt; : &lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['zip']; ?&gt; &lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['addr1'] &lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['addr2']; ?&gt; &lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['addr3']; ?&gt;</code>
</pre>
<?php } else { ?>
<pre class="line-numbers">
<code class="language-markup">&lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['title']; ?&gt; : &lt;?php echo $ex_view['<?php echo $exinfo['ex_fname']; ?>']['value']; ?&gt;</code>
</pre>
<?php } ?>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="adm-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> List 코드</strong></header>

            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0"><i class="fas fa-info-circle"></i> 아래 코드를 작업대상 파일 (/theme/테마명/skin/board/작업스킨/<strong class="color-orange">list.skin.html</strong>)의 원하는 위치에 입력하시면 됩니다.</p>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <div class="col col-12">
<pre class="line-numbers">
<code class="language-markup">&lt;?php echo $list[$i]['<?php echo $exinfo['ex_fname']; ?>']; ?&gt;</code>
</pre>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/prism/prism.min.js"></script>