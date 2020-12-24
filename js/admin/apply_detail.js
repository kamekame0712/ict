function change_status(apply_id)
{
	$.ajax({
		url: SITE_URL + 'admin/apply/ajax_change_status',
		type:'post',
		cache:false,
		data: {
			apply_id: apply_id,
			flg_processed: $('#flg_processed').val()
		}
	});
}

