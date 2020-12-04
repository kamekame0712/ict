$('#regist_from, #regist_to').datepicker({
	dateFormat: 'yy-mm-dd'
});

$('#page_list').change( function() {
	$('#record_num').val($(this).val());
	$('#frm_apply').prop('action', SITE_URL + 'admin/apply').submit();
});

$('#all_select').change( function() {
	var set_val = $(this).prop('checked');
	$('[name="ids[]"]').each( function() {
		$(this).prop('checked', set_val);
	});
});

function do_proc()
{
	var exists_checked = false;
	var ids = [];
	$('[name="ids[]"]').each( function() {
		if( $(this).prop('checked') ) {
			ids.push($(this).val());
			exists_checked = true;
		}
	});

	if( !exists_checked ) {
		show_error_notification('チェックが１つもありません。');
	}
	else {
		show_loading();

		$.ajax({
			url: SITE_URL + 'admin/apply/ajax_proc',
			type:'post',
			cache:false,
			data: {
				ids: ids
			}
		})
		.done( function(ret, textStatus, jqXHR) {
			if( ret['status'] ) {
				location.href = ret['file_url'];
				location.reload();
			}
			else {
				show_error_notification(ret['err_msg']);
			}
		})
		.fail( function(data, textStatus, errorThrown) {
			show_error_notification(textStatus);
		})
		.always(function( jqXHR, textStatus ) {
			remove_loading();
		});
	}
}

function search_link($page)
{
	$('#frm_apply').prop('action', SITE_URL + 'admin/apply/index/' + $page).submit();
}

