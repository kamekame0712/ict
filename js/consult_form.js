jQuery( function($) {
	if( $('#product').val() == '99' ) {
		$('#product_box').show();
	}

	if( $('#hope_date3').prop('checked') ) {
		$('#hope_date_box').show();
	}

});

$(document).on('keypress', 'input', function(e) {
	if( e.which == 13 ) {
		return false;
	}
});

$('#product').change( function() {
	if( $(this).val() == '99' ) {
		$('#product_box').slideDown();
	}
	else {
		$('#product_box').slideUp();
	}
});

$('[name="hope_date"]').change( function() {
	if( $(this).val() == '3' ) {
		$('#hope_date_box').slideDown();
	}
	else {
		$('#hope_date_box').slideUp();
	}
});

$('#other_hope_date').datepicker({
	dateFormat: 'm月d日'
});

$('#btn_cancel').click( function() {
	swal('同意していただかないと次へは進めません。');
});
