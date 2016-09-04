jQuery(document).ready(function($) {
	
	var pmsc_div_show = '';
	
	$( ".pmsc_tabs " ).each( function( index, element ){
		
		pmsc_div_show = jQuery(this).find('li.selected').attr('data-step');
	
	});
		
	jQuery('#pmsc_'+pmsc_div_show).show();
	
	jQuery('.phoen_checkout_butt_next').click(function(){
		
		var pmsc_next_div = '';
		
		jQuery( ".pmsc_tabs " ).each( function( index, element ){
		
			pmsc_div_show = jQuery(this).find('li.selected').attr('data-step');
			
			jQuery(this).find('li.selected').removeClass();
			
			pmsc_next_div = parseInt(pmsc_div_show) + parseInt(1);
			
			jQuery('li').each(function(){
				
				if(jQuery(this).attr('data-step') == pmsc_next_div){
					
					jQuery(this).addClass('selected'); 
				
				}
				
			});
			
		});
		
		if(pmsc_div_show == 2){
				
			jQuery('.pmsc_coupan_form').show();  
			
		}else{
			jQuery('.pmsc_coupan_form').hide();  
		}
			
		if(jQuery(".pmsc_tabs li").length-2 > pmsc_div_show){
		
			jQuery('#pmsc_'+pmsc_div_show).hide();
			
			jQuery('#pmsc_'+pmsc_next_div).show();

			jQuery('.phoen_checkout_button_prev').show();
			
		}else{
			
			jQuery(this).hide();
			
			jQuery('#pmsc_'+pmsc_div_show).hide();
			
			jQuery('#pmsc_'+pmsc_next_div).show();	
		}
		
	});
	
	jQuery('.phoen_checkout_button_prev').click(function(){
	
		var pmsc_prev_div = '';
		
		jQuery( ".pmsc_tabs " ).each( function( index, element ){
		
			pmsc_div_show = jQuery(this).find('li.selected').attr('data-step');
			
			jQuery(this).find('li.selected').removeClass();
			
			pmsc_prev_div = parseInt(pmsc_div_show) - parseInt(1);
			
			jQuery('li').each(function(){
				
				if(jQuery(this).attr('data-step') == pmsc_prev_div){
					
					jQuery(this).addClass('selected'); 
				
				}
				
			});
			
			
			
		});	
		console.log(pmsc_div_show);
		if(pmsc_div_show == 4){
				
			jQuery('.pmsc_coupan_form').show();  
			
		}else{
			jQuery('.pmsc_coupan_form').hide();  
		}
		
		if(pmsc_user_login == 'user_login'){
			
			if(pmsc_div_show > 2){
			
				jQuery('#pmsc_'+pmsc_div_show).hide();
				
				jQuery('#pmsc_'+pmsc_prev_div).show();
				
				jQuery('.phoen_checkout_butt_next').show();
				
			}else{
				
				jQuery(this).hide();
				
				jQuery('#pmsc_'+pmsc_div_show).hide();
				
				jQuery('#pmsc_'+pmsc_prev_div).show();	
			}
			
			
		}else{
			if(pmsc_div_show > 1){
			
				jQuery('#pmsc_'+pmsc_div_show).hide();
				
				jQuery('#pmsc_'+pmsc_prev_div).show();
				
				jQuery('.phoen_checkout_butt_next').show();
				
			}else{
				
				jQuery(this).hide();
				
				jQuery('#pmsc_'+pmsc_div_show).hide();
				
				jQuery('#pmsc_'+pmsc_prev_div).show();	
			}
		}
		
		
		
	});
	

});