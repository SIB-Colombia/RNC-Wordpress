jQuery(document).ready(function($){
	
	$('body').on('click','.az-shortcode-generator',function(){
       		$('#az-shortcodes').val('0');
       		$('.shortcode-options').hide(); 
 
            $.magnificPopup.open({
                mainClass: 'mfp-zoom-in',
 	 		 	items: {
 	  	     		src: '#shortcode-generator'
  	        	},
  	         	type: 'inline',
                removalDelay: 500
	    }, 0);         
 
	}); 


});