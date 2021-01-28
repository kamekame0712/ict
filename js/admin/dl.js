$('#limit_from, #limit_to').datepicker({
	dateFormat: 'yy-mm-dd'
});

function do_submit(url)
{
	$('#frm_dl').prop('action', SITE_URL + 'admin/dl/' + url).submit();
}