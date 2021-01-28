<?php
class M_apply extends MY_Model
{
	// テーブル名
	const TBL  = 't_apply';

	function __construct()
	{
		parent::__construct();
	}

	public function get_list_for_admin($conditions, $page, $record_num)
	{
		$where_array = array();
		$where_array[] = 'status = "0"';

		if( !empty($conditions['type']) ) {
			$type_array = array();
			foreach( $conditions['type'] as $val ) {
				$type_array[] = 'type = "' . $val . '"';
			}
			$where_array[] = '(' . implode(' OR ', $type_array) . ')';
		}

		if( $conditions['flg_processed'] == '1' ) {
			$where_array[] = 'flg_processed = "1"';
		}

		if( $conditions['juku_name'] != '' ) {
			$where_array[] = 'juku_name LIKE "%' . $conditions['juku_name'] . '%"';
		}

		if( $conditions['pref'] != '' ) {
			$where_array[] = 'pref = "' . $conditions['pref'] . '"';
		}

		if( $conditions['address'] != '' ) {
			$where_array[] = '( addr1 LIKE "%' . $conditions['address'] . '%" OR addr2 LIKE "%' . $conditions['address'] . '%" )';
		}

		if( $conditions['regist_from'] != '' && $conditions['regist_to'] != '' ) {
			$where_array[] = '( regist_time >= "' . $conditions['regist_from'] . ' 00:00:00" AND regist_time <= "' . $conditions['regist_to'] . ' 23:59:59" )';
		}
		else if( $conditions['regist_from'] != '' && $conditions['regist_to'] == '' ) {
			$where_array[] = 'regist_time >= "' . $conditions['regist_from'] . ' 00:00:00"';
		}
		else if( $conditions['regist_from'] == '' && $conditions['regist_to'] != '' ) {
			$where_array[] = 'regist_time <= "' . $conditions['regist_to'] . ' 23:59:59"';
		}

		$where = implode(' AND ', $where_array);

		$db_total = $this->db;
		$db_total->distinct()->from(SELF::TBL)->where($where);
		$query_total = $db_total->get();
		$total = $query_total->num_rows();

		$this->db->distinct()->from(SELF::TBL)->where($where)->order_by('regist_time DESC');

		// $pageに0を入れるとページネーションなし（全てのデータを返す）
		if( $page != 0 && $record_num != 0 ) {
			$this->db->limit($record_num, ($page - 1) * intval($record_num));
		}

		$query = $this->db->get();
		$ret_data = ($query->num_rows() > 0) ? $query->result_array() : NULL;

		return array($ret_data, $total);
	}

	public function get_list_for_dl($limit_from = '', $limit_to = '')
	{
		$where_array = array();
		$where_array[] = 'status = "0"';

		if( $limit_from != '' ) {
			$where_array[] = 'regist_time >= "' . $limit_from . ' 00:00:00"';
		}

		if( $limit_to != '' ) {
			$where_array[] = 'regist_time <= "' . $limit_to . ' 23:59:59"';
		}

		$this->db->from(SELF::TBL)->where(implode(' AND ', $where_array))->order_by('regist_time ASC');

		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_array() : NULL;
	}
}
