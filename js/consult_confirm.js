function do_submit(flg, param)
{
	if( flg == 1 ) {
		$('#frm_consult_confirm').prop('action', SITE_URL + 'consult/form/' + param).submit();
	}
	else {
		$('#frm_consult_confirm').prop('action', SITE_URL + 'consult/complete').submit();
	}
}
