$('#regist_from, #regist_to').datepicker({
	dateFormat: 'yy-mm-dd'
});

$('#page_list').change( function() {
	$('#record_num').val($(this).val());
	$('#frm_consult').prop('action', SITE_URL + 'admin/consult').submit();
});

function search_link($page)
{
	$('#frm_consult').prop('action', SITE_URL + 'admin/consult/index/' + $page).submit();
}

