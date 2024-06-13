<?php
/**
 * lib file : /eyoom/lib/nameview.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원 레이어
 */
function eb_nameview($mb_id, $name='', $email='', $homepage='', $mb_id2='') {
    global $config;
    global $g5, $eb, $eyoom, $board;
    global $bo_table, $sca, $is_admin, $member, $eyoomer, $wmode, $levelset;

    /**
     * 사이드뷰 사용 체크
     */
    if ($mb_id == 'anonymous' || $eyoom['use_sideview'] == 'n' || (isset($board['bo_use_sideview']) && !$board['bo_use_sideview'])) {
        $is_anonymous = $mb_id == 'anonymous' ? true: false;

        if ($config['cf_use_member_icon'] && $member['mb_id'] == $mb_id2) {
            $mb_photo = $eb->mb_photo($mb_id, 'icon');
        } else {
            $mb_photo = '';
        }
        
        if ($mb_photo) {
            if (G5_IS_MOBILE) {
                $tmp_name .= '<span class="bl-photo" style="margin-left:-7px">'.$mb_photo.'</span>';
            } else {
                $tmp_name .= '<span class="bl-photo">'.$mb_photo.'</span>';
            }

            if ($config['cf_use_member_icon'] == 2) // 회원아이콘+이름
                $tmp_name = $tmp_name.' '.get_text($name);
            else
                $tmp_name = get_text($name);
        } else {
            $tmp_name = get_text($name);
        }
        return $tmp_name;
    } else {
        $email_enc = new str_encrypt();
        $email = $email_enc->encrypt($email);
        $homepage = set_http(clean_xss_tags($homepage));

        $name     = get_text($name, 0, true);
        $email    = get_text($email);
        $homepage = get_text($homepage);

        $tmp_name = '';
        if ($mb_id) {
            $tmp_name = '<a href="'.G5_BBS_URL.'/profile.php?mb_id='.$mb_id.'" data-toggle="dropdown" data-bs-toggle="dropdown" title="'.$name.' 자기소개" target="_blank" rel="nofollow" onclick="return false;">';

            if ($config['cf_use_member_icon']) {
                $mb_photo = $eb->mb_photo($mb_id, 'icon');

                if ($mb_photo) {
                    $tmp_name .= '<span class="bl-photo">'.$mb_photo.'</span>';

                    if ($config['cf_use_member_icon'] == 2) // 회원아이콘+이름
                        $tmp_name = $tmp_name.' '.$name;
                } else {
                    $tmp_name = $tmp_name." ".$name;
                }
            } else {
                $tmp_name = $tmp_name.' '.$name;
            }
            $tmp_name .= '</a>';

            $title_mb_id = '['.$mb_id.']';
        } else {
            if (!$bo_table)
                return $name;

            $tmp_name = '<a href="'.get_eyoom_pretty_url($bo_table,'','&amp;sca='.$sca.'&amp;sfl=wr_name,1&amp;stx='.$name).'" data-toggle="dropdown" data-bs-toggle="dropdown" title="'.$name.' 이름으로 검색" class="sv_guest" rel="nofollow" onclick="return false;">'.$name.'</a>';
            $title_mb_id = '[비회원]';
        }

        $str = "<span class=\"sv_wrap\">\n";
        $str .= $tmp_name."\n";

        $str2 = "<ul class=\"sv dropdown-menu\" role=\"menu\">\n";
        if ($mb_id) {
            /**
             * 마이홈 링크
             */
            if (!$wmode) {
                $str2 .= "<li><a href=\"".G5_URL."/?".$mb_id."\"><strong>".$name."</strong>님의 홈</a></li>\n";
            }

            /**
             * 로그인한 회원
             */
            if ($member['mb_id']) {
                /**
                 * 친구맺기 기능
                 */
                if ($mb_id != $member['mb_id'] && $eyoomer['onoff_social'] == 'on' && $eyoom['is_community_theme'] == 'y') {
                    $follow = $eb->follow_check($mb_id);
                    $str2 .= "<li><span id=\"follow\">";
                    if (!$follow) {
                        $str2 .= "<button type=\"button\" class=\"btn-e btn-e-xs btn-e-indigo btn-e-block follow_".$mb_id."\" name=\"".$mb_id."\" value=\"follow\" title=\"친구맺기를 신청합니다.\">팔로우</button>\n";
                    } else {
                        $str2 .= "<button type=\"button\" class=\"btn-e btn-e-xs btn-e-dark btn-e-block follow_".$mb_id."\" name=\"".$mb_id."\" value=\"unfollow\" title=\"친구관계를 해제합니다.\">언팔로우 <i class=\"fas fa-times color-white\"></i></button>\n";
                    }
                    $str2 .= "</span></li>\n";
                }

                /**
                 * 구독하기
                 */
                if ($mb_id != $member['mb_id']) {
                    $subscribe = $eb->subscribe_check($mb_id);
                    $str2 .= "<li><span id=\"subscribe\">";
                    if (!$subscribe) {
                        $str2 .= "<button type=\"button\" class=\"btn-e btn-e-xs btn-e-teal btn-e-block subscribe_".$mb_id."\" name=\"".$mb_id."\" value=\"subscribe\" title=\"구독을 신청합니다.\">구독하기</button>\n";
                    } else {
                        $str2 .= "<button type=\"button\" class=\"btn-e btn-e-xs btn-e-dark btn-e-block subscribe_".$mb_id."\" name=\"".$mb_id."\" value=\"unsubscribe\" title=\"구독을 해제합니다.\">구독해제 <i class=\"fas fa-times color-white\"></i></button>\n";
                    }
                    $str2 .= "</span></li>\n";
                }

                /**
                 * 쪽지보내기
                 */
                $str2 .= "<li><a href=\"".G5_BBS_URL."/memo_form.php?me_recv_mb_id=".$mb_id."\" onclick=\"memo_send_modal(this.href); return false;\">쪽지보내기</a></li>\n";

                /**
                 * 자기소개정보
                 */
                $str2 .= "<li><a href=\"".G5_BBS_URL."/profile.php?mb_id=".$mb_id."\" onclick=\"member_profile_modal(this.href); return false;\">자기소개</a></li>\n";

                /**
                 * 메일보내기
                 */
                if ($email) {
                    if (!G5_IS_MOBILE) {
                        $str2 .= "<li><a href=\"".G5_BBS_URL."/formmail.php?mb_id=".$mb_id."&amp;name=".urlencode($name)."&amp;email=".$email."\" onclick=\"formmail_modal(this.href); return false;\">메일보내기</a></li>\n";
                    } else {
                        $str2 .= "<li><a href=\"".G5_BBS_URL."/formmail.php?mb_id=".$mb_id."&amp;name=".urlencode($name)."&amp;email=".$email."\" target=\"_blank\">메일보내기</a></li>\n";
                    }
                }

                /**
                 * 회원메모
                 */
                if ($config['cf_use_mbmemo'] && $member['mb_id'] && $mb_id != $member['mb_id']) {
                    $str2 .= "<li><a href=\"".G5_URL."/page/?pid=mbmemo&amp;mb_id=".$mb_id."&amp;wmode=1\" onclick=\"mbmemo_modal(this.href);return false;\">회원메모</a></li>\n";
                }
            }

            /**
             * 전체게시물
             */
            if (!$wmode) {
                $str2 .= "<li><a href=\"".G5_BBS_URL."/new.php?mb_id=".$mb_id."\">전체게시물</a></li>\n";
            }
        }

        /**
         * 홈페이지
         */
        if ($homepage) {
            $str2 .= "<li><a href=\"".$homepage."\" target=\"_blank\">홈페이지</a></li>\n";
        }

        /**
         * 게시물 검색
         */
        if ($bo_table && !$wmode) {
            if ($mb_id) {
                $str2 .= "<li><a href=\"".get_eyoom_pretty_url($bo_table,'','&amp;sca='.$sca.'&amp;sfl=mb_id,1&amp;stx='.$mb_id)."\">아이디로 검색</a></li>\n";
            } else {
                $str2 .= "<li><a href=\"".get_eyoom_pretty_url($bo_table,'','&amp;sca='.$sca.'&amp;sfl=wr_name,1&amp;stx='.$name)."\">이름으로 검색</a></li>\n";
            }
        }

        /**
         * 관리자 회원정보
         */
        if ($is_admin == 'super' && $mb_id) {
            /**
             * 회원정보변경
             */
            $str2 .= "<li><a href=\"".G5_ADMIN_URL."/?dir=member&amp;pid=member_form&amp;w=u&amp;mb_id=".$mb_id."\" target=\"_blank\">회원정보변경</a></li>\n";

            /**
             * 포인트내역
             */
            $str2 .= "<li><a href=\"".G5_ADMIN_URL."/?dir=member&amp;pid=point_list&amp;sfl=mb_id&amp;stx=".$mb_id."\" target=\"_blank\">".$levelset['gnu_name']."내역</a></li>\n";

            /**
             * 회원게시물 일괄삭제
             */
            $str2 .= "<li><a href=\"".G5_ADMIN_URL."/?dir=member&amp;pid=delete_spam_posts&amp;mb_id=".$mb_id."&amp;smode=1\" onclick=\"return confirm('해당 회원이 최근 2일전에 작성한 모든 글을 삭제하고 회원을 탈퇴처리합니다.\\n삭제한 글들은 복구할 수 없습니다.\\n정말로 삭제를 진행하시겠습니까?');\">스팸글 일괄삭제</a></li>\n";
        }
    }

    $str2 .= "</ul>\n";
    $str .= $str2;
    $str .= "\n<noscript class=\"sv_nojs\">".$str2."</noscript>";
    $str .= "</span>";

    return $str;
}