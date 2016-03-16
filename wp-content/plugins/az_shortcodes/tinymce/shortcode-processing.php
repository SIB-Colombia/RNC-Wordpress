<?php

/*-----------------------------------------------------------------------------------*/
/*	Elements
/*-----------------------------------------------------------------------------------*/

// Blank Divider
function az_blank_divider_sh($atts, $content = null) {  
    extract(shortcode_atts(array("height_value" => '', "class" => ''), $atts));
	
	if($class)
	$class = ' '.esc_attr($class);
	
	$height_value = ' style="height: '.$height_value.'px;"';
	
	return '<div class="blank_divider'.$class.'"'.$height_value.'></div>';
}
add_shortcode('az_blank_divider_sh', 'az_blank_divider_sh');

// Divider
function az_divider_sh($atts, $content = null) {  
    extract(shortcode_atts(array("div_type" => '', "class" => '', "margin_top_value" => '', "margin_bottom_value" => ''), $atts));
	
	if($class)
	$class = ' '.esc_attr($class);
	
	if ( $div_type=="short") { $div_type = ' short'; }
	
	$margin_top_value = 'margin-top: '.$margin_top_value.'px;';
	$margin_bottom_value = 'margin-bottom: '.$margin_bottom_value.'px;';
	
	return '<div class="divider'.$class.' '.$div_type.'" style="'.$margin_top_value.$margin_bottom_value.'"></div>';
}
add_shortcode('az_divider_sh', 'az_divider_sh');

// Testimonial Slider
function az_testimonials($atts, $content = null){
	$GLOBALS['testimonial_count'] = 0;
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['testimonials'] ) ){
		
		foreach( $GLOBALS['testimonials'] as $testimonial ){
			$testimonials[] = '<li>
									<p class="az-testimonial-quote">'.$testimonial['content'].'</p>
									<span class="az-testimonial-source">'.$testimonial['title'].'</span>
							   </li>';
		}
		
		$return = '<div class="az-testimonials">
					<div class="az-testimonials-container">
						<div class="testimonial">
							<ul class="slides">'.implode( "\n", $testimonials ).'</ul>
						</div>
					</div>
					</div>';
	}
	
	return $return;
}

add_shortcode('az_testimonial_section', 'az_testimonials');

function az_testimonial($atts, $content){
	extract(shortcode_atts(array( 'title' => '%d', 'id' => '%d'), $atts));
	
	$x = $GLOBALS['testimonial_count'];
	$GLOBALS['testimonials'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['testimonial_count'] ),
		'content' =>  do_shortcode($content),
		'id' =>  $id );
	
	$GLOBALS['testimonial_count']++;
}

add_shortcode( 'testimonial', 'az_testimonial' );

// Accordion
function az_accordions($atts, $content = null){
	$GLOBALS['accordion_count'] = 0;
	do_shortcode( $content );
	
	$id = rand();
	$id = $id*rand(0,50);
	
	if( is_array( $GLOBALS['accordions'] ) ){
		
		foreach( $GLOBALS['accordions'] as $accordion ){
			$accordions[] = '<div class="panel panel-default">
							<div class="accordion-heading accordionize">
								<a class="accordion-toggle" href="#'.$accordion['id'].'-'.$id.'" data-parent="#accordionArea-'.$id.'" data-toggle="collapse">'.$accordion['title'].'<span class="font-icon-arrow-down-simple-thin-round"></span></a>
							</div>
							<div id="'.$accordion['id'].'-'.$id.'" class="accordion-body collapse">
								<div class="accordion-inner">'.$accordion['content'].'</div>
							</div>
						</div>';
		}
		
		$return = '<div id="accordionArea-'.$id.'" class="accordion">'.implode( "\n", $accordions ).'</div>';
	}
	
	return $return;
}

add_shortcode('az_accordion_section', 'az_accordions');

function az_accordion($atts, $content){
	extract(shortcode_atts(array( 'title' => '%d', 'id' => '%d'), $atts));
	
	$x = $GLOBALS['accordion_count'];
	$GLOBALS['accordions'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['accordion_count'] ),
		'content' =>  do_shortcode($content),
		'id' =>  $id );
	
	$GLOBALS['accordion_count']++;
}

add_shortcode( 'accordion', 'az_accordion' );

// Toggle
function az_toggles($atts, $content = null){
	$GLOBALS['toggle_count'] = 0;
	do_shortcode( $content );
	
	$id = rand();
	$id = $id*rand(0,50);
	
	if( is_array( $GLOBALS['toggles'] ) ){
		
		foreach( $GLOBALS['toggles'] as $toggle ){
			$toggles[] = '<div class="panel panel-default">
							<div class="accordion-heading togglize">
								<a class="accordion-toggle" href="#'.$toggle['id'].'-'.$id.'" data-parent="#" data-toggle="collapse">'.$toggle['title'].'<span class="font-icon-plus-3"></span><span class="font-icon-minus-3"></span></a>
							</div>
							<div id="'.$toggle['id'].'-'.$id.'" class="accordion-body collapse">
								<div class="accordion-inner">'.$toggle['content'].'</div>
							</div>
						</div>';
		}
		
		$return = '<div id="toggleArea-'.$id.'" class="accordion">'.implode( "\n", $toggles ).'</div>';
	}
	
	return $return;
}

add_shortcode('az_toggle_section', 'az_toggles');

function az_toggle($atts, $content){
	extract(shortcode_atts(array( 'title' => '%d', 'id' => '%d'), $atts));
	
	$x = $GLOBALS['toggle_count'];
	$GLOBALS['toggles'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['toggle_count'] ),
		'content' =>  do_shortcode($content),
		'id' =>  $id );
	
	$GLOBALS['toggle_count']++;
}

add_shortcode( 'toggle', 'az_toggle' );

// Tabs
function az_tabs($atts, $content = null){
	$GLOBALS['tab_count'] = 0;
	do_shortcode( $content );
	
	$id = rand();
	$id = $id*rand(0,50);
	
	
	if( is_array( $GLOBALS['tabs'] ) ){
		
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[] = '<li><a href="#'.$tab['id'].'-'.$id.'" data-toggle="tab">'.$tab['title'].'</a></li>';
			$panels[] = '<div id="'.$tab['id'].'-'.$id.'" class="tab-pane fade in">'.$tab['content'].'</div>';
			
		}
		
		$return = '<div class="tabbable"><ul id="myTab-'.$id.'" class="nav nav-tabs">'.implode( "\n", $tabs ).'</ul>
						<div class="tab-content">
							'.implode( "\n", $panels ).'
						</div>
					</div>';
	}
	
	return $return;
}

add_shortcode('az_tab_section', 'az_tabs');

function az_tab($atts, $content){
	extract(shortcode_atts(array( 'title' => '%d', 'id' => '%d'), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['tab_count'] ),
		'content' =>  do_shortcode($content),
		'id' =>  $id );
	
	$GLOBALS['tab_count']++;
}

add_shortcode( 'tab', 'az_tab' );


// Alert Box
function az_alert($atts, $content = null) {  
    extract(shortcode_atts(array("mode" => 'standard', "class" => ''), $atts));
	
	if($class)
	$class = ' '.esc_attr($class);
	
	switch ($mode) {
		case 'standard' :
			$alert_mode = '<div class="alert alert-standard fade in'.$class.'"><a class="close" href="#" data-dismiss="alert"><i class="font-icon-cross"></i></a>'. do_shortcode($content) .'</div>';
			break;
		case 'warning' :
			$alert_mode = '<div class="alert fade in'.$class.'"><a class="close" href="#" data-dismiss="alert"><i class="font-icon-cross"></i></a>'. do_shortcode($content) .'</div>';
			break;
		case 'error' :
			$alert_mode = '<div class="alert alert-error fade in'.$class.'"><a class="close" href="#" data-dismiss="alert"><i class="font-icon-cross"></i></a>'. do_shortcode($content) .'</div>';
			break;
		case 'info' :
			$alert_mode = '<div class="alert alert-info fade in'.$class.'"><a class="close" href="#" data-dismiss="alert"><i class="font-icon-cross"></i></a>'. do_shortcode($content) .'</div>';
			break;
		case 'success' :
			$alert_mode = '<div class="alert alert-success fade in'.$class.'"><a class="close" href="#" data-dismiss="alert"><i class="font-icon-cross"></i></a>'. do_shortcode($content) .'</div>';
			break;	
	}
    return $alert_mode;
}
add_shortcode('az_alert_box_sh', 'az_alert');

// Tootltip
function az_tooltip($atts, $content = null) {  
    extract(shortcode_atts(array("mode" => 'top', "text" => 'Tooltip'), $atts));
	
	switch ($mode) {
		case 'top' :
			$tooltip_mode = '<a href="#" data-toggle="tooltip" data-original-title="'.$text.'" data-placement="top">'. do_shortcode($content) .'</a>';
			break;
		case 'left' :
			$tooltip_mode = '<a href="#" data-toggle="tooltip" data-original-title="'.$text.'" data-placement="left">'. do_shortcode($content) .'</a>';
			break;
		case 'right' :
			$tooltip_mode = '<a href="#" data-toggle="tooltip" data-original-title="'.$text.'" data-placement="right">'. do_shortcode($content) .'</a>';
			break;
		case 'bottom' :
			$tooltip_mode = '<a href="#" data-toggle="tooltip" data-original-title="'.$text.'" data-placement="bottom">'. do_shortcode($content) .'</a>';
			break;
	}
    return $tooltip_mode;
}
add_shortcode('az_tooltip', 'az_tooltip');

// Highlights
function az_highlight($atts, $content = null) {  
    extract(shortcode_atts(array("mode" => 'color-text'), $atts));
	
	switch ($mode) {
		case 'color-text' :
			$highlight_mode = '<span class="color-text">'. do_shortcode($content) .'</span>';
			break;
		case 'highlight-text' :
			$highlight_mode = '<span class="highlight-text">'. do_shortcode($content) .'</span>';
			break;
	}
    return $highlight_mode;
}
add_shortcode('az_highlight', 'az_highlight');

// DropCaps
function az_dropcap($atts, $content = null) {  
    extract(shortcode_atts(array("mode" => 'dropcap-normal'), $atts));
	
	switch ($mode) {
		case 'dropcap-normal' :
			$dropcap_mode = '<p><span class="dropcap">'. do_shortcode($content) .'</span>';
			break;
		case 'dropcap-color' :
			$dropcap_mode = '<p><span class="dropcap-color">'. do_shortcode($content) .'</span>';
			break;
	}
    return $dropcap_mode;
}
add_shortcode('az_dropcap', 'az_dropcap');

// Lightbox Image
function az_lightbox_image_sh($atts, $content = null) {  
    extract(shortcode_atts(array('image_url' => '', 'image_popup_url' => '', 'thumb_width' => '', 'title' => '', 'gallery_name' => '', 'class' => ''), $atts));
		
	if($class)
	$class = ' '.esc_attr($class);
	
	$output = null;
	
	$thumb_widht_to = (!empty($thumb_width) ? ' style="width: '.$thumb_width.'px; display: table-cell;"' : '');
	$thumb_display_to = (!empty($thumb_width) ? ' style="display: inline-block;"' : '');
	$thumb_width_img = (!empty($thumb_width) ? ' width='.$thumb_width.' ' : '');
	
	$fancy_gallery = (!empty($gallery_name) ? ' data-fancybox-group="'.$gallery_name.'" ' : '');

	$customFancyImg = (!empty($image_popup_url)) ? $image_popup_url : $image_url;
	
	$output .= '<div class="lightbox'.$class.'" '.$thumb_display_to.'>';
	$output .= '<a class="fancy-wrap fancybox" title="' . $title . '" href="' . $customFancyImg .'" '.$fancy_gallery.$thumb_widht_to.'>';
	$output .= '<img class="img-responsive" alt="'.$title.'" src="' . $image_url .'" '.$thumb_width_img.' />';
	$output .= '<span class="overlay"><span class="circle"><i class="font-icon-plus-3"></i></span></span>';
	$output .= '</a>';
	$output .= '</div>';

	return $output;
	 
}
add_shortcode('az_lightbox_image_sh', 'az_lightbox_image_sh');

// Lightbox Video
function az_lightbox_video_sh($atts, $content = null) {  
    extract(shortcode_atts(array('image_url' => '', 'thumb_width' => '', 'link_url' => '', 'title' => '', 'gallery_name' => '', 'class' => ''), $atts));
		
	if($class)
	$class = ' '.esc_attr($class);
	
	$output = null;
	
	$thumb_widht_to = (!empty($thumb_width) ? ' style="width: '.$thumb_width.'px; display: table-cell;"' : '');
	$thumb_display_to = (!empty($thumb_width) ? ' style="display: inline-block;"' : '');
	$thumb_width_img = (!empty($thumb_width) ? ' width='.$thumb_width.' ' : '');
	
	$fancy_gallery = (!empty($gallery_name) ? ' data-fancybox-group="'.$gallery_name.'" ' : '');
			
	$output .= '<div class="lightbox'.$class.'" '.$thumb_display_to.'>';
	$output .= '<a class="fancy-wrap fancybox-media" title="' . $title . '" href="' . $link_url .'" '.$fancy_gallery.$thumb_widht_to.'>';
	$output .= '<img class="img-responsive" alt="'.$title.'" src="' . $image_url .'" '.$thumb_width_img.' />';
	$output .= '<span class="overlay"><span class="circle"><i class="font-icon-play"></i></span></span>';
	$output .= '</a>';
	$output .= '</div>';

	return $output;
	 
}
add_shortcode('az_lightbox_video_sh', 'az_lightbox_video_sh');


// Button
function az_button_sh($atts, $content = null) {  
    extract(shortcode_atts(array("buttonlabel" => '', "buttonlink" => '', "target" => '', "buttonsize" => '', "buttoncolor" => '', "inverted" => false, "icons" => '', "class" => ''), $atts));
	
	if($class)
	$class = ' '.esc_attr($class);
	
	$output = null;
	
	if ( $target == 'same' || $target == '_self' ) { $target = ''; }
	if ( $target != '' ) { $target = ' target="'.$target.'"'; }
	
	$icon_to = (!empty($icons) ? '<i class="'.$icons.'"></i>'  : '');
	
	$inverted_to = '';
	$buttonclass = null;
	if ($inverted==true) {
		$inverted_to = ' inverted';
		if( !empty($buttoncolor)) {
			$buttoncolor = ' style="background-color: '.$buttoncolor.'; border-color: '.$buttoncolor.'; color: '.$buttoncolor.';"';
			$buttonclass = ' custom-button-color'; 
		}
	} else {
		if( !empty($buttoncolor)) {
			$buttoncolor = ' style="background-color: '.$buttoncolor.'; border-color: '.$buttoncolor.';"';
			$buttonclass = ' custom-button-color'; 
		}
	}
	
	$output .= '<a class="button-main '.$buttonsize.$inverted_to.$buttonclass.$class.'"'.$buttoncolor.' href="'.$buttonlink.'"'.$target.'>'.$icon_to.$buttonlabel.'</a>';
	
	return $output;
}
add_shortcode('az_button_sh', 'az_button_sh');

// Social Share Buttons
function az_social_share_sh($atts, $content = null) {
	extract(shortcode_atts(array("facebook" => 'false', "twitter" => 'false', "google_plus" => 'false', "pinterest" => 'false'), $atts));  
    
    global $post;
    $buttons = null;

	$buttons .= '<div class="az-social-share">';
	
	if($facebook == 'true'){
    	$buttons .= '<div class="fb-like" data-href="'.get_permalink( $post->ID ).'" data-width="450" data-layout="button_count" data-show-faces="false" data-send="false"></div>';
    }
	
	if($twitter == 'true'){
    	$buttons .= '<a href="https://twitter.com/share" class="twitter-share-button" data-url="'.get_permalink( $post->ID ).'">Tweet</a>';
    }
	
	if($google_plus == 'true'){
    	$buttons .= '<div class="g-plusone" data-size="medium" data-action="share" data-annotation="bubble"></div>';
    }

	if($pinterest == 'true'){
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    	$buttons .= '<a class="pinterest-share" href="//www.pinterest.com/pin/create/button/?url='.get_permalink( $post->ID ).'&media='. esc_attr( $thumbnail[0] ).'&description='.get_the_title().'" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>';
    }
	
	$buttons .= '</div>';
	
    return $buttons;
}
add_shortcode('az_social_share', 'az_social_share_sh');


// Revolution Slider
function az_slider( $atts, $content = null ) {
    extract(shortcode_atts(array("class" => '', "alias" => ''), $atts));
	
	$rev_markup = null;
	
	if($class)
	$class = ' '.esc_attr($class);

	$rev_markup .= '<div class="revolution_slider_container'.$class.'">';
	$rev_markup .= do_shortcode('[rev_slider '.$alias.']');
	$rev_markup .= '</div>';
	
	return $rev_markup;
}
add_shortcode('az_slider', 'az_slider');

// Video Embed
function az_shortcode_video_embed( $atts, $content = null ) {
    extract(shortcode_atts(array("class" => '', "link" => ''), $atts));
	
	$video_embed_markup = null;
	
	if($class)
	$class = ' '.esc_attr($class);
	
	if ( $link == '' ) { return null; }
	
	global $wp_embed;
    $embed = $wp_embed->run_shortcode('[embed]'.$link.'[/embed]');

	$video_embed_markup .= '<div class="videoWrapper'.$class.'">' . $embed . '</div>';
	
	return $video_embed_markup;
}
add_shortcode('az_video_embed', 'az_shortcode_video_embed');


// Video Self Hosted
function az_shortcode_video($atts, $content = null) {
	extract(shortcode_atts(array("class" => '', "title" => 'Title', 'webm_url' => null, 'mp4_url' => null, 'ogv_url' => null, 'image_url' => null), $atts));  
	$video_markup = null;
		
		if($class)
		$class = ' '.esc_attr($class);
	
		$id = rand();
		$id = $id*rand(1,50);
		
		$video_markup .= '<div class="video-container'.$class.'">
						    <video id="video-'.$id.'" class="video-js vjs-default-skin" preload="auto" style="width:100%; height:100%;" poster="'. $image_url .'">';
					 			if(!empty($webm_url)) { $video_markup .= '<source type="video/webm" src="'.$webm_url.'">'; }
                                if(!empty($mp4_url)) { $video_markup .= '<source type="video/mp4" src="'.$mp4_url.'">'; }
                                if(!empty($ogv_url)) { $video_markup .= '<source type="video/ogg" src="'.$ogv_url.'">'; }
		$video_markup .= '  </video>
						  </div>';
	
    return $video_markup;
	
}

add_shortcode('az_video', 'az_shortcode_video');

// Audio Self Hosted
function az_shortcode_audio($atts, $content = null) {
	extract(shortcode_atts(array("class" => '', "title" => 'Title', 'mp3_url' => null), $atts));  
	$audio_markup = null;
	
	$id = rand();
	$id = $id*rand(1,50);
	
	$audio_markup .= 
		'<div class="audio-container'.$class.'">
			<div id="audio-'.$id.'">
				<audio style="width:100%; height:30px;" class="audio-js" controls="control" preload src="'. $mp3_url .'"></audio>
			</div>
		</div>';
	
    return $audio_markup;
}

add_shortcode('az_audio', 'az_shortcode_audio');

?>