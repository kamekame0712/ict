<?php
class M_referer extends MY_Model
{
	// テーブル名
	const TBL  = 't_referer';

	function __construct()
	{
		parent::__construct();
	}

	public function get_list_for_dl($limit_from = '', $limit_to = '')
	{
		$where_array = array();
		$where_array[] = 'status = "0"';
		$where_array[] = 'remote_addr <> "' . $this->input->server('REMOTE_ADDR') . '"';

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
