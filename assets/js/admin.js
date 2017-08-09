jQuery(document).ready(function( $ ) {


//$( '.add_row' ).click(function(){
		//var dataRow = $(this).closest('table').find('tbody').find('tr').last().data('row');
		//alert( dataRow);
		//$(this).closest('table').find('tbody').find('tr').data("row", dataRow + 1 );

	//	$(this).closest('table').find('tbody').append( $( this ).data( 'row' ) );

	//	$('body').trigger('row_added');
	//	return false;
	//});


	if ($('input#woocommerce_rp_table_rate_international').is(':checked')) {
		$('#int_display').show();


	}


	$("#woocommerce_rp_table_rate_international").change(function() {
	    if(this.checked) {
	       $('#int_display').show();
	    } else {
	    	$('#int_display').hide();
	    }
	});


	$('body').on('click', 'td.remove', function(){
		$(this).closest('tr').remove();
		return false;
	});

	$('#table_rates, #int_table_rates').sortable({
		items:'tr',
		cursor:'move',
		axis:'y',
		handle: '.sort',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wc-metabox-sortable-placeholder',
		start:function(event,ui){
			ui.item.css('background-color','#f6f6f6');
		},
		stop:function(event,ui){
			ui.item.removeAttr('style');
		}
	});


	
});