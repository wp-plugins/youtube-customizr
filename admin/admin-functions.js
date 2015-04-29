(function($) {

	//RELATED CHECKBOXES
	window.related_checkboxes = function(button, row, value){
		
			
			$(document).ready(function(){
				if (value && value != true ){
					if( $(button).find('option:selected').attr('value') == value ) {
						$(row).hide();
					}
				} else if (value) {
					if ($(button).prop('checked')){
						$(row).hide();
					}
				} else {
					if ($(button).prop('checked') == false){
						$(row).hide();
					}
				}
			});
			
			$(button).change(function() {
				$(row).toggle(400);
			});
	}
	
	//ADMIN SLIDERS
	window.admin_sliders = function(slider, minvalue, maxvalue, value, multiplier, slider2, value2){
		if (!multiplier) { var multiplier = 1 }
		if (slider2) { var type = true } else { var type = 'max' }
		$(slider + "_slider").slider({
			range : type,
			min : minvalue,
			max : maxvalue,
			value : [value * multiplier],
			slide: function( event, ui ) {
		        $(slider).val( ui.value / multiplier );
		    }
		});
	}

})(jQuery);