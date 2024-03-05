<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/orderlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'orderlist';
$g5_title = '주문내역';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-orderlist .orderlist-img {width:80px;margin:0 auto}
.admin-shop-orderlist .orderlist-img img {display:block;max-width:100%;height:auto}
.admin-shop-orderlist .order-status-label .label-red {background-color:#ab0000}
.admin-shop-orderlist .order-status-label .label-blue {background-color:#3949ab}
.admin-shop-orderlist .order-status-label .label-yellow {background-color:#f4511e}
.admin-shop-orderlist .order-status-label .label-green {background-color:#00897b}
.admin-shop-orderlist .order-status-label .label-default {background-color:#4b4b4d}
.admin-shop-orderlist .state-change-btn .btn-e {padding:7px 50px}
</style>

<div class="admin-shop-orderlist">
    <form id="frmorderlist" name="frmorderlist" class="eyoom-form" method="get">
    <input type="hidden" name="doc" value="<?php echo $doc; ?>">
    <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
    <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="save_search" value="<?php echo $search; ?>">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
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
                                <label class="select width-150px">
                                    <select name="sel_field" id="sel_field">
                                        <option value="od_id" <?php echo get_selected($sel_field, 'od_id'); ?>>주문번호</option>
                                        <option value="mb_id" <?php echo get_selected($sel_field, 'mb_id'); ?>>회원 아이디</option>
                                        <option value="it_name" <?php echo get_selected($sel_field, 'it_name'); ?>>상품명</option>
                                        <option value="od_name" <?php echo get_selected($sel_field, 'od_name'); ?>>주문자이름</option>
                                        <option value="mb_nick" <?php echo get_selected($sel_field, 'mb_nick'); ?>>주문자닉네임</option>
                                        <option value="od_tel" <?php echo get_selected($sel_field, 'od_tel'); ?>>주문자전화</option>
                                        <option value="od_hp" <?php echo get_selected($sel_field, 'od_hp'); ?>>주문자핸드폰</option>
                                        <option value="od_b_name" <?php echo get_selected($sel_field, 'od_b_name'); ?>>받는분</option>
                                        <option value="od_b_tel" <?php echo get_selected($sel_field, 'od_b_tel'); ?>>받는분전화</option>
                                        <option value="od_b_hp" <?php echo get_selected($sel_field, 'od_b_hp'); ?>>받는분핸드폰</option>
                                        <option value="od_deposit_name" <?php echo get_selected($sel_field, 'od_deposit_name'); ?>>입금자</option>
                                        <option value="od_invoice" <?php echo get_selected($sel_field, 'od_invoice'); ?>>운송장번호</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label class="input max-width-250px">
                                    <input type="text" name="search" value="<?php echo $search; ?>" id="search"  autocomplete="off">
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label for="od_status" class="label">주문상태</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-150px">
                            <select name="od_status" id="od_status">
                                <option value="" <?php echo get_selected($od_settle_case, ''); ?>>전체</option>
                                <option value="주문" <?php echo get_selected($od_status, '주문'); ?>>주문</option>
                                <option value="입금" <?php echo get_selected($od_status, '입금'); ?>>입금</option>
                                <option value="준비" <?php echo get_selected($od_status, '준비'); ?>>준비</option>
                                <option value="배송" <?php echo get_selected($od_status, '배송'); ?>>배송</option>
                                <option value="완료" <?php echo get_selected($od_status, '완료'); ?>>완료</option>
                                <option value="전체취소" <?php echo get_selected($od_status, '전체취소'); ?>>전체취소</option>
                                <option value="부분취소" <?php echo get_selected($od_status, '부분취소'); ?>>부분취소</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="od_settle_case" class="label">결제수단</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-150px">
                        <select name="od_settle_case" id="od_settle_case">
                            <option value="" <?php echo get_selected($od_settle_case, ''); ?>>전체</option>
                            <option value="무통장" <?php echo get_selected($od_settle_case, '무통장'); ?>>무통장</option>
                            <option value="가상계좌" <?php echo get_selected($od_settle_case, '가상계좌'); ?>>가상계좌</option>
                            <option value="계좌이체" <?php echo get_selected($od_settle_case, '계좌이체'); ?>>계좌이체</option>
                            <option value="휴대폰" <?php echo get_selected($od_settle_case, '휴대폰'); ?>>휴대폰</option>
                            <option value="신용카드" <?php echo get_selected($od_settle_case, '신용카드'); ?>>신용카드</option>
                            <option value="간편결제" <?php echo get_selected($od_settle_case, '간편결제'); ?>>PG간편결제</option>
                            <option value="KAKAOPAY" <?php echo get_selected($od_settle_case, 'KAKAOPAY'); ?>>KAKAOPAY</option>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> PG간편결제 종류 - NHN_KCP 간편결제 : PAYCO, 네이버페이, 카카오페이(NHN_KCP), 애플페이(NHN_KCP) &#xa;LG유플러스 간편결제 : PAYNOW &#xa;KG 이니시스 간편결제 : KPAY, 삼성페이, LPAY, 카카오페이(KG이니시스)</div>
                </div>
            </div>
            <?php if (!$wmode) { ?>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">기타상태</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="od_misu01" class="checkbox">
                            <input type="checkbox" name="od_misu" id="od_misu01" value="Y" <?php echo get_checked($od_misu, 'Y'); ?>><i></i>미수금
                        </label>
                        <label for="od_misu02" class="checkbox">
                            <input type="checkbox" name="od_cancel_price" id="od_misu02" value="Y" <?php echo get_checked($od_cancel_price, 'Y'); ?>><i></i>반품,품절
                        </label>
                        <label for="od_misu03" class="checkbox">
                            <input type="checkbox" name="od_refund_price" id="od_misu03" value="Y" <?php echo get_checked($od_refund_price, 'Y'); ?>><i></i>환불
                        </label>
                        <label for="od_misu04" class="checkbox">
                            <input type="checkbox" name="od_receipt_point" id="od_misu04" value="Y" <?php echo get_checked($od_receipt_point, 'Y'); ?>><i></i>포인트주문
                        </label>
                        <label for="od_misu05" class="checkbox">
                            <input type="checkbox" name="od_coupon" id="od_misu05" value="Y" <?php echo get_checked($od_coupon, 'Y'); ?>><i></i>쿠폰
                        </label>
                        <?php if ($default['de_escrow_use']) {?>
                        <label for="od_misu06" class="checkbox">
                            <input type="checkbox" name="od_escrow" id="od_misu06" value="Y" <?php echo get_checked($od_escrow, 'v'); ?>><i></i>에스크로
                        </label>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">기간검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <div class="m-b-5">
                            <label class="select max-width-150px">
                                <select name="sdt" id="sdt">
                                    <option value="od_time" <?php echo get_selected($sdt, 'od_time'); ?>>주문일</option>
                                    <option value="od_receipt_time" <?php echo get_selected($sdt, 'od_receipt_time'); ?>>결제확인일</option>
                                    <option value="od_invoice_time" <?php echo get_selected($sfl, 'od_invoice_time'); ?>>송장입력일</option>
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

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    <?php if ($_GET['fr_date'] && $_GET['to_date'] && $_GET['sdt'] == 'od_time') { ?>
    <div class="excel-download text-end">
        <a href="javascript:void(0);" onclick="order_excel_download();" class="btn-e btn-e-md btn-e-indigo adm-headline-btn">엑셀다운로드</a>
    </div>
    <?php } ?>

    </form>

    <form name="forderlist" id="forderlist" onsubmit="return forderlist_submit(this);" method="post" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="search_od_status" value="<?php echo $od_status; ?>">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 주문내역 <?php echo number_format($total_count); ?>건
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
                        <th class="width-60px">관리</th>
                        <th>이미지</th>
                        <th>주문번호_상품명_상태</th>
                        <th>주문자정보</th>
                        <th>결재수단_주문금액</th>
                        <th>입금정보</th>
                        <th>쿠폰_포인트결제</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="od_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['od_id']; ?>" id="od_id_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href='<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderform&od_id=<?php echo $list[$i]['od_id'].'&'.$qstr; ?>'><u>보기</u></a>
                        </td>
                        <td>
                            <div class="orderlist-img"><a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a></div>
                        </td>
                        <td>
                            <div class="m-b-5">
                                <a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderform&od_id=<?php echo $list[$i]['od_id'].'&'.$qstr; ?>&wmode=1" onclick="eb_modal(this.href); return false;"<?php } else { ?>href="javascript:void(0);"<?php } ?>><i class="fas fa-external-link-alt text-light-gray m-r-7 hidden-xs"></i><span class="text-indigo"><?php echo $list[$i]['disp_od_id']; ?></span></a>
                            </div>
                            <div class="m-b-5">
                                <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo get_text($list[$i]['it_name']); ?></a>
                            </div>
                            <div class="order-status-label">
                                <input type="hidden" name="current_status[<?php echo $i; ?>]" value="<?php echo $list[$i]['od_status']; ?>">
                                <span class="label label-<?php echo $list[$i]['od_color']; ?> width-100px text-center f-s-13r f-w-400"><span class="text-white"><?php echo $list[$i]['od_status']; ?></span></span>
                            </div>
                            <?php if ($od_status == '준비') { ?>
                            <div class="inline-group m-t-5">
                                <span class="d-inline-block">
                                    <label class="input width-200px">
                                        <input type="text" name="od_invoice[<?php echo $i; ?>]" value="<?php echo $list[$i]['od_invoice']; ?>" placeholder='운송장번호'>
                                    </label>
                                </span>
                                <span class="d-inline-block">
                                    <label class="select width-200px">
                                        <select name='od_delivery_company[<?php echo $i; ?>]'>
                                            <option value=''>없음</option>
                                            <option value='자체배송' <?php echo $list[$i]['dlcomp']=='자체배송'?'selected':''; ?>>자체배송</option>
                                            <?php foreach ($delivery_comp as $value) {?>
                                            <option value='<?php echo $value; ?>' <?php echo $list[$i]['dlcomp']==$value?'selected':''; ?>><?php echo $value; ?></option><?php }?>
                                        </select><i></i>
                                    </label>
                                </span>
                                <span class="d-inline-block">
                                    <label class="input width-200px">
                                        <input type="text" name="od_invoice_time[<?php echo $i; ?>]" value="<?php echo $list[$i]['invoice_time']; ?>">
                                    </label>
                                </span>
                            </div>
                            <?php } ?>
                        </td>
                        <td>
                            <p class="li-p-sq"><?php if ($list[$i]['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/profile.php?mb_id=<?php echo $list[$i]['mb_id']; ?>" onclick="win_profile(this.href); return false;"><?php echo $list[$i]['od_name']; ?>[<?php echo $list[$i]['mb_id']; ?>]</a><?php } else { ?><?php echo $list[$i]['od_name']; ?><?php } ?></p>
                            <p class="li-p-sq"><?php if ($list[$i]['mb_id']) { ?><a href="<?php echo G5_BBS_URL; ?>/profile.php?mb_id=<?php echo $list[$i]['mb_id']; ?>" onclick="win_profile(this.href); return false;"><span class="text-gray"><?php echo $list[$i]['mbinfo']['mb_nick']; ?></span></a><?php } ?></p>
                            <p class="li-p-sq"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlist&sort1=<?php echo $sort1; ?>&sort2=<?php echo $sort2; ?>&sel_field=mb_id&search=<?php echo $list[$i]['mb_id']; ?>"><u class="text-gray">누적 <?php echo number_format($list[$i]['od_cnt']); ?> 건</u></a></p>
                        </td>
                        <td class="text-end">
                            <input type="hidden" name="current_settle_case[<?php echo $i; ?>]" value="<?php echo $list[$i]['od_settle_case']; ?>">
                            <span class="text-gray"><?php echo $list[$i]['s_receipt_way']; ?></span><br>
                            <?php echo number_format($list[$i]['od_cart_price'] + $list[$i]['od_send_cost'] + $list[$i]['od_send_cost2']); ?>원
                        </td>
                        <td>
                            미수금 : <span <?php if ($list[$i]['od_misu > 0']) { ?>class="text-crimson"<?php } ?>><?php echo number_format($list[$i]['od_misu']); ?></span>원<br>
                            입금액 : <span class="text-blue"><?php echo number_format($list[$i]['od_receipt_price']); ?></span>원
                        </td>
                        <td>
                            쿠폰 : <?php echo number_format($list[$i]['od_cart_coupon']+$list[$i]['od_coupon']+$list[$i]['od_send_coupon']); ?>원<br>
                            포인트: <?php echo number_format($list[$i]['od_receipt_point']); ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (($od_status == '' || $od_status == '완료' || $od_status == '전체취소' || $od_status == '부분취소') == false) {?>
    <h6 class="m-b-10">[ <strong>주문상태변경</strong> ]</h6>
    <div class="m-b-10">
        <div class="inline-group m-b-5">
            <label class="checkbox">
                <input type="checkbox" name="od_status" value="<?php echo $change_status; ?>"><i></i><?php echo $od_status; ?> 상태에서 <strong class="text-blue"><?php echo $change_status; ?></strong> 상태로 변경합니다.
            </label>
            <?php if ($od_status == '주문' || $od_status == '준비') {?>
            <label class="checkbox">
                <input type="checkbox" name="od_send_mail" value="1" id="od_send_mail" checked="checked"><i></i>안내 메일
            </label>
            <label class="checkbox">
                <input type="checkbox" name="send_sms" value="1" id="od_send_sms" checked="checked"><i></i>안내 SMS
            </label>
            <?php } ?>
            <?php if ($od_status == '준비') {?>
            <label class="checkbox">
                <input type="checkbox" name="send_escrow" value="1" id="od_send_escrow"><i></i>에스크로배송등록
            </label>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <div class="m-b-20">
            <div class="state-change-btn">
                <input type="submit" value="선택수정" class="btn-e btn-e-lg btn-e-crimson" onclick="document.pressed=this.value">
            </div>
            <?php if ($od_status == '주문') {?>
            <div class="state-change-btn m-t-10">
                <input type="submit" value="선택삭제" class="btn-e btn-e-lg btn-e-dark" onclick="document.pressed=this.value">
            </div>
            <?php } ?>
            <div class="note m-t-10"><strong>Note:</strong> 주문상태에서만 삭제가 가능합니다.</div>
        </div>
    </div>
    <?php } ?>

    <div class="cont-text-bg">
        <p class="bg-info">
            &lt;무통장&gt;인 경우에만 &lt;주문&gt;에서 &lt;입금&gt;으로 변경됩니다. 가상계좌는 입금시 자동으로 &lt;입금&gt;처리됩니다.<br>
            &lt;준비&gt;에서 &lt;배송&gt;으로 변경시 &lt;에스크로배송등록&gt;을 체크하시면 에스크로 주문에 한해 PG사에 배송정보가 자동 등록됩니다.<br><br>
            <strong>주의!</strong> 주문번호를 클릭하여 나오는 주문상세내역의 주소를 외부에서 조회가 가능한곳에 올리지 마십시오.
        </p>
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">주문상세내역</h5>
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

<div class="modal fade admin-excel-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">엑셀 일괄배송처리</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-excel-iframe" width="100%" frameborder="0"></iframe>
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

function eb_modal_excel(href) {
    $('.admin-excel-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-excel-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-excel-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-excel-iframe").attr("src", href);
        $('#modal-excel-iframe').height(parseInt($(window).height() * 0.65));
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
});

$(function(){
    // 주문상품보기
    $(".orderitem").on("click", function() {
        var $this = $(this);
        var od_id = $this.text().replace(/[^0-9]/g, "");

        if($this.next("#orderitemlist").size())
            return false;

        $("#orderitemlist").remove();

        $.post(
            "<?php echo G5_ADMIN_URL; ?>/shop_admin/ajax.orderitem.php",
            { od_id: od_id },
            function(data) {
                $this.after("<div id=\"orderitemlist\"><div class=\"itemlist\"></div></div>");
                $("#orderitemlist .itemlist")
                    .html(data)
                    .append("<div id=\"orderitemlist_close\" class=\"text-right\"><button type=\"button\" id=\"orderitemlist-x\" class=\"btn-e btn-e-sm btn-e-dark\">닫기</button></div>");
            }
        );

        return false;
    });

    // 상품리스트 닫기
    $("#sodr_list").on("click", "#orderitemlist-x", function(e) {
        $("#orderitemlist").remove();
    });

    $("body").on("click", function(e) {
        if ($(e.target).closest("#orderitemlist").length === 0){
            $("#orderitemlist").remove();
        }
    });

    // 엑셀배송처리창
    $("#order_delivery").on("click", function() {
        var opt = "width=600,height=450,left=10,top=10";
        window.open(this.href, "win_excel", opt);
        return false;
    });
});

function forderlist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    /*
    switch (f.od_status.value) {
        case "" :
            alert("변경하실 주문상태를 선택하세요.");
            return false;
        case '주문' :

        default :

    }
    */

    if(document.pressed == "선택삭제") {
        if(confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlistdelete&smode=1";
            return true;
        }
        return false;
    }

    var change_status = f.od_status.value;

    if (f.od_status.checked == false) {
        alert("주문상태 변경에 체크하세요.");
        return false;
    }

    var chk = document.getElementsByName("chk[]");

    for (var i=0; i<chk.length; i++)
    {
        if (chk[i].checked)
        {
            var k = chk[i].value;
            var current_settle_case = f.elements['current_settle_case['+k+']'].value;
            var current_status = f.elements['current_status['+k+']'].value;

            switch (change_status)
            {
                case "입금" :
                    if (!(current_status == "주문" && current_settle_case == "무통장")) {
                        alert("'주문' 상태의 '무통장'(결제수단)인 경우에만 '입금' 처리 가능합니다.");
                        return false;
                    }
                    break;

                case "준비" :
                    if (current_status != "입금") {
                        alert("'입금' 상태의 주문만 '준비'로 변경이 가능합니다.");
                        return false;
                    }
                    break;

                case "배송" :
                    if (current_status != "준비") {
                        alert("'준비' 상태의 주문만 '배송'으로 변경이 가능합니다.");
                        return false;
                    }

                    var invoice      = f.elements['od_invoice['+k+']'];
                    var invoice_time = f.elements['od_invoice_time['+k+']'];
                    var delivery_company = f.elements['od_delivery_company['+k+']'];

                    if ($.trim(invoice_time.value) == '') {
                        alert("배송일시를 입력하시기 바랍니다.");
                        invoice_time.focus();
                        return false;
                    }

                    if ($.trim(delivery_company.value) == '') {
                        alert("배송업체를 입력하시기 바랍니다.");
                        delivery_company.focus();
                        return false;
                    }

                    if ($.trim(invoice.value) == '') {
                        alert("운송장번호를 입력하시기 바랍니다.");
                        invoice.focus();
                        return false;
                    }

                    break;
            }
        }
    }

    if (!confirm("선택하신 주문서의 주문상태를 '"+change_status+"'상태로 변경하시겠습니까?"))
        return false;

    f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlistupdate&smode=1";
    return true;
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

function order_excel_download() {
    f = document.frmorderlist;
    f.dir.value = 'shop';
    f.pid.value = 'orderexceldownload';
    f.smode.value = 1;
    f.submit();
}
</script>