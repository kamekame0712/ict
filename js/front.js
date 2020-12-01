jQuery( function($) {
	if( $('#know9').prop('checked') ) {
		$('#other_box').show();
	}
});

$(document).on('keyup', '#zip', function() {
	AjaxZip3.zip2addr('zip', '', 'pref', 'addr1');
});

$(document).on('keypress', 'input', function(e) {
	if( e.which == 13 ) {
		return false;
	}
});

$('[name="know"]').change( function() {
	if( $(this).val() == '9' ) {
		$('#other_box').slideDown();
	}
	else {
		$('#other_box').slideUp();
	}
});

$('#btn_cancel').click( function() {
	swal('同意していただかないと次へは進めません。');
});
