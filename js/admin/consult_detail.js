function change_status(consult_id)
{
	$.ajax({
		url: SITE_URL + 'admin/consult/ajax_change_status',
		type:'post',
		cache:false,
		data: {
			consult_id: consult_id,
			flg_handle: $('#flg_handle').val()
		}
	});
}

