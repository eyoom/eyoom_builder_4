<?php
/**
 * latest class
 */

class latest extends qfile
{
    public $bo_new = 24;
    public $latest_path = '';

    public function __construct($eb, $bbs) {
        global $g5;

        $this->g5 = $g5;
        $this->eb = $eb;
        $this->bbs = $bbs;

        /**
         * EB최신글 캐시파일 저장 경로
         */
        $this->latest_path = G5_DATA_PATH . '/eblatest';

        /**
         * 최신글 디렉토리 체크
         */
        if (!is_dir($this->latest_path)) {
            /**
             * 디렉토리가 없다면 생성
             */
            @mkdir($this->latest_path, G5_DIR_PERMISSION);
            @chmod($this->latest_path, G5_DIR_PERMISSION);
        }
    }

    /**
     * 최신글 cache 파일 저장
     */
    public function save_item($code, $theme) {
        /**
         * 디렉토리가 없다면 생성
         */
        @mkdir($this->latest_path.'/'.$theme, G5_DIR_PERMISSION);
        @chmod($this->latest_path.'/'.$theme, G5_DIR_PERMISSION);

        $item_file  = $this->latest_path.'/'.$theme.'/el_item_'.$code.'.php';
        $el_item    = $this->get_item($code);
        $this->save_file('el_item', $item_file, $el_item, true);

        return $el_item;
    }

    /**
     * 최신글 마스터 설정정보
     */
    public function get_master($code) {
        return sql_fetch("select * from {$this->g5['eyoom_latest']} where (1) and el_code = '{$code}' limit 1 ");
    }

    /**
     * 최신글 아이템 설정정보
     */
    public function get_item($code) {
        $sql = "select * from {$this->g5['eyoom_latest_item']} where (1) and el_code = '{$code}' order by li_sort asc ";
        $result = sql_query($sql);
        $el_item = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $el_item[$i] = $row;
        }

        return $el_item;
    }

    /**
     * 해당 조건에 맞는 아이템의 최신글 파일 생성하기
     */
    public function make_cache_data($code, $theme, $li_no) {
        global $is_admin;

        /**
         * EB최신글 마스터 설정정보
         */
        $el_master = $this->get_master($code);

        /**
         * EB최신글 아이템 설정정보
         */
        $item_file  = $this->latest_path.'/'.$theme.'/el_item_'.$code.'.php';
        if (file_exists($item_file) && !is_dir($item_file)) {
            include($item_file);
        } else {
            /**
             * g5_eyoom_latest_item 테이블에서 정보 추출
             */
            $el_item = $this->save_item($code, $theme);
        }

        /**
         * 아이템 설정이 되어 있지 않다면
         */
        if (!$el_item) return false;

        for ($i=0; $i<count((array)$el_item); $i++) {
            if ($el_item[$i]['li_no'] == $li_no) {
                $latest_item = $el_item[$i];
                break;
            }
        }

        /**
         * latest_row_file 파일
         */
        $latest_row_file = $this->latest_path.'/'.$theme.'/latest_'.$code.'_'.$li_no.'.php';

        /**
         * 아이템 상태가 숨기기라면 latest_item 파일 삭제
         */
        if ($latest_item['li_state'] == '2') @unlink($latest_row_file);

        /**
         * 캐시 갱신 시간 체크
         */
        if (!$is_admin && $el_master['el_cache'] > 0) {
            $filectime = filectime($latest_row_file);
            if ((time() - $filectime) < $el_master['el_cache']) return false;
        }

        /**
         * 게시물 추출하기
         */
        $latest_row = $this->get_latest_records($latest_item);

        /**
         * 최신글 캐시 파일로 저장
         */
        $this->save_file("latest_row", $latest_row_file, $latest_row, true);

        /**
         * 캐시파일을 생성했다면 스위치온 파일 삭제
         */
        if ($latest_row) {
            $switch_on_file = $this->latest_path.'/'.$theme.'/switch_'.$code.'_'.$li_no.'.php';
            if (file_exists($switch_on_file) && !is_dir($switch_on_file)) {
                @unlink($switch_on_file);
            }
            return $latest_row;
        }
    }

    /**
     * 최신글 캐시 스위치온
     */
    public function make_switch_on($bo_table, $theme) {
        $sql = "select * from {$this->g5['eyoom_latest_item']} where (1) and find_in_set('{$bo_table}', li_tables) and li_theme = '" . sql_real_escape_string($theme) . "' ";
        $res = sql_query($sql, false);
        for ($i=0; $row=sql_fetch_array($res); $i++) {
            /**
             * 캐시 스위치온 등록
             */
            $this->cache_switch_on($row['el_code'], $row['li_theme'], $row['li_no']);
        }
    }

    /**
     * 캐시 스위치온 파일 생성
     */
    public function cache_switch_on($code, $theme, $li_no) {
        $switch_on_file = $this->latest_path.'/'.$theme.'/switch_'.$code.'_'.$li_no.'.php';

        /**
         * 스위치온 파일이 없다면 생성
         */
        if (!file_exists($switch_on_file)) {
            $this->save_file("switchon", $switch_on_file, array());
        }
    }

    /**
     * 설정 옵션에서 쿼리문 가져오기
     */
    public function get_latest_records($el_item) {
        /**
         * 최신글에 썸네일을 사용한다면 라이브러리 호출
         */
        if ($el_item['li_img_view'] == 'y') {
            @include_once(G5_LIB_PATH.'/thumbnail.lib.php');
        }

        /**
         * 공통 쿼리
         */
        $sql_common = " from {$this->g5['board_new_table']} a, {$this->g5['board_table']} b ";

        /**
         * 추출 조건
         */
        $sql_where = $this->get_where($el_item);

        /**
         * 추출 순서
         */
        $sql_order = $this->get_orderby($el_item);

        /**
         * 출력 게시물 수
         */
        $limit = $el_item['li_count'];

        /**
         * 게시판 이름 출력
         */
        $bo_info = $this->bbs->get_bo_subject();

        /**
         * 최신글 레코드 선언
         */
        $latest_list = array();

        /**
         * 게시물 쿼리
         */
        $sql = "select a.*, b.bo_subject, b.bo_mobile_subject {$sql_common} where {$sql_where} {$sql_order} limit {$limit}";

        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            /**
             * 게시판 테이블
             */
            $write_table = $this->g5['write_prefix'] . $row['bo_table'];

            /**
             * 최신글 추출
             */
            $write = $this->bbs->get_write_except_fields(get_write($write_table, $row['wr_id']));

            /**
             * list 변수로 치환
             */
            $latest_list[$i] = $write;
            $latest_list[$i]['bo_table'] = $row['bo_table'];

            /**
             * 게시판 이름
             */
            $latest_list[$i]['bo_subject'] = $bo_info[$row['bo_table']]['bo_name'];

            /**
             * 게시물 리스트 보기 권한
             */
            $latest_list[$i]['bo_list_level'] = $bo_info[$row['bo_table']]['bo_list_level'];

            /**
             * 썸네일 이미지 생성
             */
            if ($el_item['li_img_view'] == 'y') {
                $thumb = get_list_thumbnail($row['bo_table'], $row['wr_id'], $el_item['li_img_width'], $el_item['li_img_height']);

                if ($thumb['src']) {
                    $latest_list[$i]['wr_image'] = $thumb['src'];
                } else {
                    $thumb = $this->bbs->make_thumb_from_extra_image($row['bo_table'], $row['wr_id'], $write['wr_content'], $el_item['li_img_width'], $el_item['li_img_height']);
                    if ($thumb) {
                        $latest_list[$i]['wr_image'] = $thumb;
                    }
                }
            }

            /**
             * 내용 출력
             */
            if ($el_item['li_content'] == 'y') {
                $latest_list[$i]['wr_content'] = $this->bbs->cut_filter_wr_content($latest_list[$i]['wr_content'], $el_item['li_cut_content']);
            } else {
                unset($latest_list[$i]['wr_content']);
            }

            /**
             * 게시판 제목이 없다면 댓글
             */
            $latest_list[$i]['wr_subject'] = $latest_list[$i]['wr_subject'] ? $latest_list[$i]['wr_subject']: $latest_list[$i]['wr_content'];
        }

        /**
         * 최신글 레코드 리턴
         */
        return $latest_list;
    }

    /**
     * 추출 조건문 가져오기
     */
    public function get_where($el_item) {
        /**
         * 추출 조건
         */
        $sql_where = " a.bo_table = b.bo_table and a.wr_approval = '1' "; //and b.bo_use_search = 1 ";

        /**
         * 추출 대상 게시판
         */
        if ($el_item['li_tables']) {
            $sql_where .= " and find_in_set(a.bo_table, '".$el_item['li_tables']."') ";
        }

        /**
         * 카테고리 분류 추출
         */
        if (!strpos($el_item['li_tables'], ',') && $el_item['li_ca_name']) {
            $sql_where .= " and a.ca_name = '{$el_item['li_ca_name']}' ";
        }

        /**
         * 추출 기간
         */
        if ($el_item['li_period']) {
            $start = date('Y-m-d H:i:s', strtotime('-'.$el_item['li_period'].' day'));
            $end = date("Y-m-d H:i:s");
            $sql_where .= " and a.bn_datetime between '{$start}' and '{$end}'";
        }

        /**
         * 원본, 댓글 추출 여부
         */
        if ($el_item['li_type'] == "w") {
            $sql_where .= " and a.wr_id = a.wr_parent ";
        } else if ($el_item['li_type'] == "c") {
            $sql_where .= " and a.wr_id <> a.wr_parent ";
        }

        return $sql_where;
    }

    /**
     * 추출 순서
     */
    public function get_orderby($el_item) {
        $orderby = '';

        /**
         * 렌덤 추출
         */
        if ($el_item['li_random'] == 'y') {
            $orderby = 'rand()';
        }

        /**
         * 인기글일 경우, 히트수순으로 정렬
         */
        if ($el_item['li_best'] == 'y') {
            $orderby = 'a.wr_hit desc';
        }

        /**
         * 기본 출력순서
         */
        if (!$orderby) {
            $orderby = 'a.bn_datetime desc';
        }

        /**
         * 추출 순서
         */
        $sql_order = " order by {$orderby} ";

        return $sql_order;
    }

    /**
     * 추가된 wr_id에 실제 히트수 업데이트
     * 초기 설치 및 이전할 경우만 사용
     */
    public function update_wr_id() {
        /**
         * 모든 게시판 정보를 가져옴
         */
        $bo_info = $this->eb->get_all_board_info();
        $bo_tables = array();
        for ($i=0; $i<count((array)$bo_info); $i++) {
            $bo_tables[$i] = $bo_info[$i]['bo_table'];
        }
        unset($bo_info);

        /**
         * wr_hit 연동 업데이트
         */
        if (is_array($bo_tables) && count($bo_tables) > 0) {
            foreach ($bo_tables as $bo_table) {
                $write_table = $this->g5['write_prefix'] . $bo_table;
                $sql = "update {$this->g5['board_new_table']} a, (select wr_id, wr_hit, wr_comment from {$write_table}) b set a.wr_hit = b.wr_hit, a.wr_comment = b.wr_comment where a.wr_id = b.wr_id and a.bo_table = '{$bo_table}' ";
                sql_query($sql, false);
            }
        }
    }
}