<?php
class M_consult extends MY_Model
{
	// テーブル名
	const TBL  = 't_consult';

	function __construct()
	{
		parent::__construct();
	}

	public function get_list_for_admin($conditions, $page, $record_num)
	{
		$where_array = array();
		$where_array[] = 'status = "0"';

		if( $conditions['product'] != '' ) {
			$type = substr($conditions['product'], 0, 1);
			$product = substr($conditions['product'], 1, 2);

			$where_array[] = '( type = "' . $type . '" AND product = "' . $product . '" )';
		}

		if( $conditions['substance'] != '' ) {
			$where_array[] = 'substance = "' . $conditions['substance'] . '"';
		}

		if( $conditions['flg_handle'] != '' ) {
			$where_array[] = 'flg_handle = "' . $conditions['flg_handle'] . '"';
		}

		if( $conditions['juku_name'] != '' ) {
			$where_array[] = 'juku_name LIKE "%' . $conditions['juku_name'] . '%"';
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
}
