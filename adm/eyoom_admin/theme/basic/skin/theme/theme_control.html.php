<?php
/**
 * Eyoom Admin Skin File
 * @file	~/theme/basic/skin/theme/eyoom_theme.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-config-form">
	<form name="feyoomtheme" method="post" class="eyoom-form">

	<div class="adm-table-form-wrap margin-bottom-30">
		<header><strong><i class="fa fa-caret-right"></i> 테마설정</strong></header>

		<div class="table-list-eb">
			<?php if (!G5_IS_MOBILE) { ?>
			<div class="table-responsive">
			<?php } ?>
			<table class="table">
				<tbody>
					<tr>
						<th class="table-form-th">
							<label for="bn_bimg" class="label">적용테마</label>
						</th>
						<td>

						</td>
					</tr>
					<tr>
						<th class="table-form-th">
							<label for="bn_bimg" class="label">작업테마</label>
						</th>
						<td>

						</td>
					</tr>
				</tbody>
			</table>
			<?php if (!G5_IS_MOBILE) { ?>
			</div>
			<?php } ?>
		</div>
	</div>

	<?php echo $frm_submit; ?>
	
	</form>

</div>