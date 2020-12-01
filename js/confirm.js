function do_submit(flg)
{
	if( flg == 9 ) {
		$('#frm_confirm').prop('action', SITE_URL + 'complete').submit();
	}
	else {
		$('#frm_confirm').prop('action', SITE_URL + 'form' + flg).submit();
	}
}
