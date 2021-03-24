<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/skin_manager.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.active {border:5px solid #f30;}
</style>

<div class="admin-config-form">
    <div class="adm-headline">
        <h3>스킨설정</h3>
    </div>

    <form name="fskinmanager" method="post" action="<?php echo $action_url1; ?>" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">

    <div id="anc_tcf_skin">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_tcf_skin'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 스킨설정</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <?php if ($skins['outlogin']) { ?>
                        <tr class="<?php echo $st == 'outlogin' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="outlogin_skin" class="label">아웃로그인 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="outlogin_skin" id="outlogin_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['outlogin']); $i++) { ?>
                                            <option value="<?php echo $skins['outlogin'][$i]; ?>" <?php echo get_selected($eyoom_config['outlogin_skin'], $skins['outlogin'][$i]); ?>><?php echo $skins['outlogin'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if ($skins['popular']) { ?>
                        <tr class="<?php echo $st == 'popular' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="popular_skin" class="label">인기검색어 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="popular_skin" id="popular_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['popular']); $i++) { ?>
                                            <option value="<?php echo $skins['popular'][$i]; ?>" <?php echo get_selected($eyoom_config['popular_skin'], $skins['popular'][$i]); ?>><?php echo $skins['popular'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if ($skins['poll']) { ?>
                        <tr class="<?php echo $st == 'poll' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="poll_skin" class="label">설문조사 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="poll_skin" id="poll_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['poll']); $i++) { ?>
                                            <option value="<?php echo $skins['poll'][$i]; ?>" <?php echo get_selected($eyoom_config['poll_skin'], $skins['poll'][$i]); ?>><?php echo $skins['poll'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if ($skins['visit']) { ?>
                        <tr class="<?php echo $st == 'visit' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="visit_skin" class="label">방문자통계 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="visit_skin" id="visit_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['visit']); $i++) { ?>
                                            <option value="<?php echo $skins['visit'][$i]; ?>" <?php echo get_selected($eyoom_config['visit_skin'], $skins['visit'][$i]); ?>><?php echo $skins['visit'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if ($skins['search']) { ?>
                        <tr class="<?php echo $st == 'search' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="search_skin" class="label">검색 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="search_skin" id="search_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['search']); $i++) { ?>
                                            <option value="<?php echo $skins['search'][$i]; ?>" <?php echo get_selected($eyoom_config['search_skin'], $skins['search'][$i]); ?>><?php echo $skins['search'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if ($skins['newwin']) { ?>
                        <tr class="<?php echo $st == 'newwin' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="newwin_skin" class="label">팝업 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="newwin_skin" id="newwin_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['newwin']); $i++) { ?>
                                            <option value="<?php echo $skins['newwin'][$i]; ?>" <?php echo get_selected($eyoom_config['newwin_skin'], $skins['newwin'][$i]); ?>><?php echo $skins['newwin'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if ($skins['tag']) { ?>
                        <tr class="<?php echo $st == 'tag' ? 'active': 'inactive'; ?>">
                            <th class="table-form-th">
                                <label for="tag_skin" class="label">태그 스킨</label>
                            </th>
                            <td>
                                <div class="inline-mix">
                                    <label class="select form-width-250px">
                                        <select name="tag_skin" id="tag_skin" required="required">
                                            <option value="">선택</option>
                                            <?php for($i=0; $i<count((array)$skins['tag']); $i++) { ?>
                                            <option value="<?php echo $skins['tag'][$i]; ?>" <?php echo get_selected($eyoom_config['tag_skin'], $skins['tag'][$i]); ?>><?php echo $skins['tag'][$i]; ?></option>
                                            <?php } ?>
                                        </select><i></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>

</div>