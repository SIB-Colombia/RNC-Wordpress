jQuery(document).ready(function($){
	
  	//initUpload();
			
			function initUpload(clone){
				
				var itemToInit = null;
				itemToInit = typeof clone !== 'undefined' ? clone : $('.shortcode-dynamic-item');
	
	            itemToInit.find('.redux-opts-upload').on('click',function( event ) {
					
	                var activeFileUploadContext = jQuery(this).parent();
	                var relid = jQuery(this).attr('rel-id');
	
	                event.preventDefault();
	
	                custom_file_frame = null;
	
	                custom_file_frame = wp.media.frames.customHeader = wp.media({
	                    title: jQuery(this).data("choose"),
	
	                    library: {
	                        type: 'image'
	                    },
	                    button: {
	                        text: jQuery(this).data("update")
	                    }
	                });
	
	                custom_file_frame.on( "select", function() {
	                    // Grab the selected attachment.
	                    var attachment = custom_file_frame.state().get("selection").first();
	
	                    // Update value of the targetfield input with the attachment url.
	                    jQuery('.redux-opts-screenshot',activeFileUploadContext).attr('src', attachment.attributes.url);
	                    jQuery('#' + relid ).val(attachment.attributes.url).trigger('change');
	
	                    jQuery('.redux-opts-upload',activeFileUploadContext).hide();
	                    jQuery('.redux-opts-screenshot',activeFileUploadContext).show();
	                    jQuery('.redux-opts-upload-remove',activeFileUploadContext).show();
	            });
	
	            custom_file_frame.open();
	        });
	
	   	itemToInit.find('.redux-opts-upload-remove').on('click', function( event ) {
	        var activeFileUploadContext = jQuery(this).parent();
	        var relid = jQuery(this).attr('rel-id');
	
	        event.preventDefault();
	
	        jQuery('#' + relid).val('');
	        jQuery(this).prev().fadeIn('slow');
	        jQuery('.redux-opts-screenshot',activeFileUploadContext).fadeOut('slow');
	        jQuery(this).fadeOut('slow');
	    });
	}
	
    // var ed = tinyMCE.activeEditor;
    // var content = ed.selection.getContent();
    
    $('#shortcode-content textarea').val('');
    
    function dynamic_items(){
   	
		var code = '';
		var accID = '1', tglID = '1', tabID = '1', testimonialID = '1';
		var accordionContent, toggleContent, tabContent, testimonialContent;
		
		//accordion
		if( $('.shortcode-options[data-name=az_accordion_section]').is(':visible') ){
			$('.shortcode-options[data-name=az_accordion_section] .shortcode-dynamic-item-input').each(function(){
			   if( $(this).val() != '' ) {
					accordionContent = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();
					code += ' [accordion title="'+$(this).val()+'" id="acc-'+accID+'"]'+accordionContent+'[/accordion] '; 
					accID++;
				}
			});
		}
		
		//toggle
		if( $('.shortcode-options[data-name=az_toggle_section]').is(':visible') ){
			$('.shortcode-options[data-name=az_toggle_section] .shortcode-dynamic-item-input').each(function(){
			   if( $(this).val() != '' ) {
					toggleContent = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();
					code += ' [toggle title="'+$(this).val()+'" id="tgl-'+tglID+'"]'+toggleContent+'[/toggle] '; 
					tglID++;
				}
			});
		}
		
		//tabs
		if( $('.shortcode-options[data-name=az_tab_section]').is(':visible') ){
			$('.shortcode-options[data-name=az_tab_section] .shortcode-dynamic-item-input').each(function(){
			   if( $(this).val() != '' ) {
					tabContent = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();
					code += ' [tab title="'+$(this).val()+'" id="tab-'+tabID+'"]'+tabContent+'[/tab] '; 
					tabID++;
				}
			});
		}

		//testimonials
		if( $('.shortcode-options[data-name=az_testimonial_section]').is(':visible') ){
			$('.shortcode-options[data-name=az_testimonial_section] .shortcode-dynamic-item-input').each(function(){
			   if( $(this).val() != '' ) {
					testimonialContent = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();
					code += ' [testimonial title="'+$(this).val()+'" id="testimonial-'+testimonialID+'"]'+testimonialContent+'[/testimonial] '; 
					testimonialID++;
				}
			});
		}
		
		$('#shortcode-storage-d').html(code);
    }
	
	function directToEditor() {
    	var name = $('#az-shortcodes').val();
    	var content = '';
    	
    	//ed.selection.setContent( $('#shortcode-storage-o').text() + content);
    	window.wp.media.editor.insert( $('#shortcode-storage-o').text() + content);

    	$.magnificPopup.close();

    	//wipe out storage 
		$('#shortcode-storage-o, #shortcode-storage-d, #shortcode-storage-c').text('');
		resetFileds();

		return false;	
    }
    
    function update_shortcode(ending){
		
		var name = $('#az-shortcodes').val();
		var dataType = $('#options-'+name).attr('data-type');
		var extra_attrs = '', extra_attrs2 = '', extra_attrs3 = '', extra_attrs4 = '', extra_attrs5 = '';
		
		ending = ending || '';
		
		dynamic_items();
		
		var code = ' ['+name;
		if( $('#options-'+name).attr('data-type')=='checkbox' ){
		    if($('#options-'+name+' input.last').attr('checked') == 'checked') ending = '_last';
		}
		code += ending;
		
		$('#options-'+name+' input[type=checkbox]').each(function(){
			 if($(this).attr('checked') == 'checked' && $(this).attr('class') != 'last') extra_attrs += ' ' + $(this).attr('class')+'="true"';	
		});
		
		code += extra_attrs;
		
		$('#options-'+name+' textarea:not("#content")').each(function(){
			 extra_attrs2 += ' ' + $(this).attr('data-attrname')+'="'+ $(this).val() +'"';	
		});
		
		if(dataType != 'dynamic') code += extra_attrs2;
		
		$('#options-'+name+' select').each(function(){
			 extra_attrs3 += ' ' + $(this).attr('id')+'="' + $(this).attr('value') + '"';	
		});
		
		code += extra_attrs3;
		
		$('#options-'+name+' [data-name=image-upload] img.redux-opts-screenshot').each(function(){
			 extra_attrs4 += ' ' + $(this).attr('id')+'="' + $(this).attr('src') + '"';	
		});
		
		code += extra_attrs4;
		
		$('#options-'+name+' [data-name=file-upload] img.redux-opts-screenshot').each(function(){
			 extra_attrs5 += ' ' + $(this).attr('id')+'="' + $(this).attr('src') + '"';	
		});
		
		code += extra_attrs5;
		
		$('#options-'+name+' input.attr').each(function(){
			if( $(this).attr('type') == 'text' ){ code += ' '+ $(this).attr('data-attrname')+'="'+ $(this).val()+'"'; }
			else { if($(this).attr('checked') == 'checked') code += ' '+ $(this).attr('data-attrname')+'="'+ $(this).val()+'"'; }
		});
		
		if(name == 'az_button_sh' && $('.icon-option i.selected').length > 0 ) code += ' icons="'+ $('.icon-option i.selected').attr('class').split(' ')[0] +'"'; 
		
		code += ']';

		$('#shortcode-storage-o').html(code);
		if( dataType!= 'dynamic') $('#shortcode-storage-d').text($('#shortcode-content textarea').val());
	    if( dataType != 'regular' && dataType != 'radios' && dataType != 'direct_to_editor') $('#shortcode-storage-c').html('[/'+name+ending+']');
		if( dataType == 'direct_to_editor') directToEditor();
		
	 }
     
    $('#add-shortcode').click(function(){
    	var name = $('#az-shortcodes').val();
    	var dataType = $('#options-'+name).attr('data-type');
    	
    	update_shortcode();
		if( dataType != 'direct_to_editor') {
			
			var $shortcodeData = $('#shortcode-storage-o').text() + $('#shortcode-storage-d').text() + $('#shortcode-storage-c').text() ;
			
			window.wp.media.editor.insert( $('#shortcode-storage-o').text() + $('#shortcode-storage-d').text() + $('#shortcode-storage-c').text() );
			$.magnificPopup.close();
			
			//wipe out storage 
			$('#shortcode-storage-o, #shortcode-storage-d, #shortcode-storage-c').text('');
			
			resetFileds();
			
		}
		return false;
    });

    $('#az-shortcodes').change(function(){
		$('.shortcode-options').hide();
		$('#options-'+$(this).val()).show();

		var dataType = $('#options-'+$(this).val()).attr('data-type');
		
		if( dataType == 'checkbox' || dataType == 'simple' ){
    		$('#shortcode-content').show().find('textarea').val('');
		}
		
		else {
    		$('#shortcode-content textarea').val('').parent().parent().hide();
		}

    });

    $('#options-box input[type="radio"]').click(function(){

		if($(this).val() == 'custom'){
		    $('#custom-box-name').attr('data-attrname','style').addClass('attr');
		    $('#options-box input[type="radio"]').attr('data-attrname','temp').removeClass('attr');
		}
		else{
		    $('#options-box input[type="radio"]').attr('data-attrname','style').addClass('attr');
		    $('#custom-box-name').attr('data-attrname','temp').removeClass('attr');
		}
    });
 	
    $('.add-list-item').click(function(){
    	
    	if(!$(this).parent().find('.remove-list-item').is(':visible')) $(this).parent().find('.remove-list-item').show();
    	
    	var $clone = $(this).parent().find('.shortcode-dynamic-item:first').clone();
    	$clone.find('input[type=text],textarea').attr('value','');
    	
    	if( $clone.find('.redux-opts-upload').length > 0 ) {
    		$clone.find('.redux-opts-screenshot').attr('src','');
    		$clone.find('.redux-opts-upload-remove').hide();
    		$clone.find('.redux-opts-upload').css('display','inline-block');
    		setTimeout(function(){ initUpload($clone) },200);
    	}
    	
		$(this).prevAll('div').append($clone);
	
		return false;
    });
	
    $('.remove-list-item').live('click', function(){
    	if($(this).parent().find('.shortcode-dynamic-item').length > 1){
    		$(this).parent().find('#options-item .shortcode-dynamic-item:last').remove();
			dynamic_items();	
    	}
    	if($(this).parent().find('.shortcode-dynamic-item').length == 1) $(this).hide();
    	
    	
		return false;
    });
    
    $('.remove-list-item').hide();
	
    $('.shortcode-dynamic-item-input, .shortcode-dynamic-item-text').live('keyup', function(){ dynamic_items(); });
	$(".shortcode-dynamic-item textarea").live("input propertychange", function(){ dynamic_items(); });
	
	$('.icon-option i').click(function(){
		$('.icon-option i').removeClass('selected');
		$(this).addClass('selected');
	});

	function resetFileds(){
		//reset data
		$('#shortcode-generator').find('input:text, input:password, input:file, textarea').val('');
		$('#shortcode-generator').find('select:not(#az-shortcodes) option:first-child').attr("selected", "selected");
		$('#shortcode-generator').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
		$('#shortcode-generator').find('.shortcode-options').each(function(){
			$(this).find('.shortcode-dynamic-item').addClass('marked-for-removal');
			$(this).find('.shortcode-dynamic-item:first').removeClass('marked-for-removal');
			$(this).find('.shortcode-dynamic-item.marked-for-removal').remove();
		});
		$('#shortcode-generator').find('.redux-opts-screenshot').attr('src','');
		$('#shortcode-generator').find('.redux-opts-upload-remove').hide();
		$('#shortcode-generator').find('.redux-opts-upload').show();

		$('#shortcode-generator').find('.wp-color-result').attr('style','');
	}
});