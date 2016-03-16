<?php

// Enqueue Scripts
function enqueue_generator_scripts(){

	wp_enqueue_style('tinymce', plugin_dir_url( __FILE__ ) . 'shortcode_generator/css/tinymce.css'); 
	wp_enqueue_style('font-entypo', get_template_directory_uri() . '/_include/css/fonts.css'); 
	
	wp_enqueue_style('magnific', plugin_dir_url( __FILE__ ) . 'shortcode_generator/css/magnific-popup.css'); 
	wp_enqueue_script('magnific', plugin_dir_url( __FILE__ ) . 'shortcode_generator/js/magnific-popup.js','jquery','0.9.7 ', TRUE);
	
	wp_enqueue_script('shortcode-generator-popup', plugin_dir_url( __FILE__ ) . 'shortcode_generator/js/popup.js','jquery','0.9.7 ', TRUE);
	wp_enqueue_script('shortcode-generator', plugin_dir_url( __FILE__ ) . 'az.tinymce.js','jquery','0.9.7 ', TRUE);
	
}

add_action('admin_enqueue_scripts','enqueue_generator_scripts');

add_action('admin_footer','content_display');

// Get All Revolution Sliders
function all_rev_sliders_in_array(){
    if (class_exists('RevSlider')) {
        $theslider     = new RevSlider();
        $arrSliders = $theslider->getArrSliders();
        $arrA     = array();
        $arrT     = array();
        foreach($arrSliders as $slider){
            $arrA[]     = $slider->getAlias();
            $arrT[]     = $slider->getTitle();
        }
        if($arrA && $arrT){
            $result = array_combine($arrA, $arrT);
        }
        else
        {
            $result = false;
        }
        return $result;
    }
}

function content_display(){
// Shotcodes Definitions

// Blank Divider
$az_shortcodes['az_blank_divider_sh'] = array( 
	'type'=>'regular', 
	'title'=>__('Blank Divider', 'textdomain' ),
	'attr'=>array(
		'height_value'=>array('type'=>'text', 'title'=>__('Height Value', 'textdomain'), 'desc'=>__('Height Value in pixel. Enter only number value.', 'textdomain')),
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain'))
	)
);

// Divider
$az_shortcodes['az_divider_sh'] = array( 
	'type'=>'regular', 
	'title'=>__('Divider', 'textdomain' ),
	'attr'=>array(
		'div_type'=>array('type'=>'select', 'title'=>__('Divider Style', 'textdomain'), 'values' => array ( "normal" => "normal", "short" => "short"), 'desc'=>__('Choose between the two available divider styles.', 'textdomain')),
		'margin_top_value'=>array('type'=>'text', 'title'=>__('Margin Top Value', 'textdomain'), 'desc'=>__('Margin Top Value in pixel. Enter only number value.', 'textdomain')),
		'margin_bottom_value'=>array('type'=>'text', 'title'=>__('Margin Bottom Value', 'textdomain'), 'desc'=>__('Margin Bottom Value in pixel. Enter only number value.', 'textdomain')),
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain'))
	)
);

// Accordion
$az_shortcodes['az_accordion_section'] = array( 
	'type'=>'dynamic', 
	'title'=>__('Accordion Section', 'textdomain' ), 
	'attr'=>array(
		'accordions'=>array('type'=>'custom')
	)
);

// Toggle
$az_shortcodes['az_toggle_section'] = array( 
	'type'=>'dynamic', 
	'title'=>__('Toggle Section', 'textdomain' ), 
	'attr'=>array(
		'toggles'=>array('type'=>'custom')
	)
);

// Tabs
$az_shortcodes['az_tab_section'] = array( 
	'type'=>'dynamic', 
	'title'=>__('Tab Section', 'textdomain' ), 
	'attr'=>array(
		'tabs'=>array('type'=>'custom')
	)
);

// Testimonials
$az_shortcodes['az_testimonial_section'] = array( 
	'type'=>'dynamic', 
	'title'=>__('Testimonial Section', 'textdomain' ), 
	'attr'=>array(
		'testimonials'=>array('type'=>'custom')
	)
);

// Alert Box
$az_shortcodes['az_alert_box_sh'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Alert Box', 'textdomain'), 
	'attr'=>array(
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain')), 
		'mode'=>array(
			'type'=>'radio', 
			'title'=>__('Type', 'textdomain'), 
			'opt'=>array(
				'standard'=>'Standard',
				'warning'=>'Warning',
				'error'=>'Error',
				'info'=>'Info',
				'success'=>'Success'
			)
		)
	) 
);

// Tooltip
$az_shortcodes['az_tooltip'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Tooltip', 'textdomain'), 
	'attr'=>array(
		'mode'=>array(
			'type'=>'radio', 
			'title'=>__('Position', 'textdomain'),
			'desc'=>__('Select the position of the tooltip.', 'textdomain'), 
			'opt'=>array(
				'top'=>'Top',
				'left'=>'Left',
				'right'=>'Right',
				'bottom'=>'Bottom'
			)
		),
		'text'=>array(
			'type'=>'text', 
			'title'=>__('Text', 'textdomain'),
			'desc'=>__('This text appear inside the tooltip.', 'textdomain')
		)
	) 
);

// Highlight
$az_shortcodes['az_highlight'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Highlight', 'textdomain'), 
	'attr'=>array(
		'mode'=>array(
			'type'=>'radio', 
			'title'=>__('Mode', 'textdomain'), 
			'opt'=>array(
				'color-text'=>'Color Text',
				'highlight-text'=>'Highlight Text'
			)
		)
	) 
);

// Dropcap
$az_shortcodes['az_dropcap'] = array( 
	'type'=>'checkbox', 
	'title'=>__('Dropcap', 'textdomain'), 
	'attr'=>array(
		'mode'=>array(
			'type'=>'radio', 
			'title'=>__('Mode', 'textdomain'), 
			'opt'=>array(
				'dropcap-normal'=>'Dropcap Normal',
				'dropcap-color'=>'Dropcap Color'
			)
		)
	) 
);

// Lightbox Image
$az_shortcodes['az_lightbox_image_sh'] = array( 
	'type'=>'regular', 
	'title'=>__('Lightbox Image', 'textdomain' ), 
	'attr'=>array( 
		'image'=>array('type'=>'custom', 'title'  => __('Image','textdomain'), 'desc'=>__('Select image from media library.', 'textdomain')),
		'image_popup'=>array('type'=>'custom', 'title'  => __('Different Image PopUp','textdomain'), 'desc'=>__('Select image from media library.', 'textdomain')),
		'thumb_width'=>array('type'=>'text', 'title'  => __('Thumbnail Width','textdomain'), 'desc'=>__('Choose a width for your thumbnail. It will be automatically cropped and resized.', 'textdomain')),
		'title'=>array('type'=>'text', 'title'=>__('Title', 'textdomain'), 'desc'=>__('Insert a Title of your Image.', 'textdomain')),
		'gallery_name'=>array('type'=>'text', 'title'=>__('Gallery Name', 'textdomain'), 'desc'=>__('If you want can insert a name of your gallery here.', 'textdomain')),
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain'))
	)
);

// Lightbox Video
$az_shortcodes['az_lightbox_video_sh'] = array( 
	'type'=>'regular', 
	'title'=>__('Lightbox Video', 'textdomain' ), 
	'attr'=>array( 
		'image'=>array('type'=>'custom', 'title'  => __('Image','textdomain'), 'desc'=>__('Select image from media library.', 'textdomain')),
		'thumb_width'=>array('type'=>'text', 'title'  => __('Thumbnail Width','textdomain'), 'desc'=>__('Choose a width for your thumbnail. It will be automatically cropped and resized.', 'textdomain')),
		'link_url'=>array('type'=>'text', 'title'=>__('Link URL', 'textdomain'), 'desc'=>__('Insert the URL for video (https://vimeo.com/18439821).', 'textdomain')),
		'title'=>array('type'=>'text', 'title'=>__('Title', 'textdomain'), 'desc'=>__('Insert a Title of your Image.', 'textdomain')),
		'gallery_name'=>array('type'=>'text', 'title'=>__('Gallery Name', 'textdomain'), 'desc'=>__('If you want can insert a name of your gallery here.', 'textdomain')),
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain'))
	)
);

// Button
$az_shortcodes['az_button_sh'] = array( 
	'type'=>'radios', 
	'title'=>__('Button', 'textdomain'), 
	'attr'=>array(
		'buttonlabel'=>array('type'=>'text', 'title'=>__('Button Label', 'textdomain'), 'desc'=>__('This is the text that appears on your button.', 'textdomain')),
		'buttonlink'=>array('type'=>'text', 'title'=>__('Button Link', 'textdomain'), 'desc'=>__('Where should your button link to?', 'textdomain')),
		'target'=>array(
			'type'=>'select', 
				'title'=>__('Button Link Target', 'textdomain'), 
				'values'=>array(
					'same'=>'_self',
					'new'=>'_blank'
			)
		),
		'buttonsize'=>array(
			'type'=>'select', 
			'title'=>__('Button Size', 'textdomain'), 
			'values'=>array(
				'mini'=>'button-mini',
				'small'=>'button-small',
				'medium'=>'button-medium',
				'large'=>'button-large'
			)
		),
		'buttoncolor'=>array(
			'type'=>'text', 
			'title'=>__('Custom Button Color?', 'textdomain'),
			'desc'=>__('Insert your Custom Color - Example: #CCCCCC', 'textdomain')
		),
		'inverted'=>array(
			'type'=>'checkbox', 
			'title'=>__('Inverted Color?', 'textdomain')
		),
		'icons' => array(
			'type'=>'icons', 
			'title'=>'Icon', 
			'values'=> array(
			  	'font-icon-phone' 		=> 'font-icon-phone',
				'font-icon-mobile' 		=> 'font-icon-mobile',
				'font-icon-mouse'		=> 'font-icon-mouse',
				'font-icon-directions'	=> 'font-icon-directions', 
				'font-icon-mail'		=> 'font-icon-mail', 
				'font-icon-paperplane'	=> 'font-icon-paperplane',
				'font-icon-pencil'		=> 'font-icon-pencil', 
				'font-icon-feather'		=> 'font-icon-feather', 
				'font-icon-paperclip'	=> 'font-icon-paperclip', 
				'font-icon-drawer'		=> 'font-icon-drawer', 
				'font-icon-reply'		=> 'font-icon-reply', 
				'font-icon-reply-all'	=> 'font-icon-reply-all',
				'font-icon-forward'		=> 'font-icon-forward', 
				'font-icon-user'		=> 'font-icon-user', 
				'font-icon-users'		=> 'font-icon-users', 
				'font-icon-user-add'	=> 'font-icon-user-add', 
				'font-icon-vcard'		=> 'font-icon-vcard', 
				'font-icon-export'		=> 'font-icon-export', 
				'font-icon-location'	=> 'font-icon-location', 
				'font-icon-map'			=> 'font-icon-map', 
				'font-icon-compass'		=> 'font-icon-compass', 
				'font-icon-location-2'	=> 'font-icon-location-2', 
				'font-icon-target'		=> 'font-icon-target', 
				'font-icon-share' 		=> 'font-icon-share', 
				'font-icon-sharable'	=> 'font-icon-sharable',
				'font-icon-heart'		=> 'font-icon-heart', 
				'font-icon-heart-2' 	=> 'font-icon-heart-2', 
				'font-icon-star'		=> 'font-icon-star', 
				'font-icon-star-2'		=> 'font-icon-star-2', 
				'font-icon-thumbs-up'	=> 'font-icon-thumbs-up', 
				'font-icon-thumbs-down'	=> 'font-icon-thumbs-down', 
				'font-icon-chat'		=> 'font-icon-chat', 
				'font-icon-comment'		=> 'font-icon-comment', 
				'font-icon-quote'		=> 'font-icon-quote', 
				'font-icon-house' 		=> 'font-icon-house',
				'font-icon-popup'		=> 'font-icon-popup',
				'font-icon-search' 		=> 'font-icon-search',
				'font-icon-signal' 		=> 'font-icon-signal',
				'font-icon-flashlight'	=> 'font-icon-flashlight', 
				'font-icon-printer' 	=> 'font-icon-printer',
				'font-icon-bell' 		=> 'font-icon-bell',
				'font-icon-link' 		=> 'font-icon-link',
				'font-icon-flag'		=> 'font-icon-flag',
				'font-icon-cog'			=> 'font-icon-cog' ,
				'font-icon-tools' 		=> 'font-icon-tools',
				'font-icon-trophy' 		=> 'font-icon-trophy',
				'font-icon-tag' 		=> 'font-icon-tag',
				'font-icon-camera' 		=> 'font-icon-camera',
				'font-icon-megaphone' 	=> 'font-icon-megaphone',
				'font-icon-moon' 		=> 'font-icon-moon',
				'font-icon-palette'		=> 'font-icon-palette',
				'font-icon-leaf' 		=> 'font-icon-leaf',
				'font-icon-music' 		=> 'font-icon-music',
				'font-icon-music-2'		=> 'font-icon-music-2', 
				'font-icon-new' 		=> 'font-icon-new',
				'font-icon-graduation'	=> 'font-icon-graduation',
				'font-icon-book' 		=> 'font-icon-book',
				'font-icon-newspaper'	=> 'font-icon-newspaper', 
				'font-icon-bag' 		=> 'font-icon-bag',
				'font-icon-airplane'	=> 'font-icon-airplane', 
				'font-icon-lifebuoy'	=> 'font-icon-lifebuoy',
				'font-icon-eye' 		=> 'font-icon-eye',
				'font-icon-clock'		=> 'font-icon-clock', 
				'font-icon-microphone' 	=> 'font-icon-microphone',
				'font-icon-calendar' 	=> 'font-icon-calendar',
				'font-icon-bolt'		=> 'font-icon-bolt',
				'font-icon-thunder'		=> 'font-icon-thunder', 
				'font-icon-droplet' 	=> 'font-icon-droplet',
				'font-icon-cd' 			=> 'font-icon-cd',
				'font-icon-briefcase' 	=> 'font-icon-briefcase',
				'font-icon-air'			=> 'font-icon-air', 
				'font-icon-hourglass' 	=> 'font-icon-hourglass',
				'font-icon-gauge'		=> 'font-icon-gauge', 
				'font-icon-language' 	=> 'font-icon-language',
				'font-icon-network' 	=> 'font-icon-network',
				'font-icon-key' 		=> 'font-icon-key',
				'font-icon-battery'		=> 'font-icon-battery',
				'font-icon-bucket'		=> 'font-icon-bucket',
				'font-icon-magnet' 		=> 'font-icon-magnet', 
				'font-icon-drive' 		=> 'font-icon-drive',
				'font-icon-cup' 		=> 'font-icon-cup',
				'font-icon-rocket' 		=> 'font-icon-rocket',
				'font-icon-brush' 		=> 'font-icon-brush',
				'font-icon-suitcase'	=> 'font-icon-suitcase',
				'font-icon-cone' 		=> 'font-icon-cone',
				'font-icon-earth' 		=> 'font-icon-earth',
				'font-icon-keyboard' 	=> 'font-icon-keyboard',
				'font-icon-browser' 	=> 'font-icon-browser',
				'font-icon-publish' 	=> 'font-icon-publish',
				'font-icon-progress-3'	=> 'font-icon-progress-3',
				'font-icon-progress-2' 	=> 'font-icon-progress-2',
				'font-icon-brogress-1' 	=> 'font-icon-brogress-1',
				'font-icon-progress-0' 	=> 'font-icon-progress-0',
				'font-icon-sun'			=> 'font-icon-sun', 
				'font-icon-sun-2' 		=> 'font-icon-sun-2',
				'font-icon-adjust' 		=> 'font-icon-adjust',
				'font-icon-code'		=> 'font-icon-code', 
				'font-icon-screen' 		=> 'font-icon-screen',
				'font-icon-light-bulb' 	=> 'font-icon-light-bulb',
				'font-icon-credit-card'	=> 'font-icon-credit-card', 
				'font-icon-database' 	=> 'font-icon-database',
				'font-icon-voicemail'	=> 'font-icon-voicemail', 
				'font-icon-clipboard' 	=> 'font-icon-clipboard',
				'font-icon-cart' 		=> 'font-icon-cart',
				'font-icon-box' 		=> 'font-icon-box',
				'font-icon-ticket' 		=> 'font-icon-ticket',
				'font-icon-rss'			=> 'font-icon-rss',
				'font-icon-signal'		=> 'font-icon-signal', 
				'font-icon-thermometer' => 'font-icon-thermometer',
				'font-icon-droplets' 	=> 'font-icon-droplets',
				'font-icon-layout-3' 	=> 'font-icon-layout-3',
				'font-icon-statistics' 	=> 'font-icon-statistics',
				'font-icon-pie' 		=> 'font-icon-pie',
				'font-icon-bars' 		=> 'font-icon-bars',
				'font-icon-graph'		=> 'font-icon-graph', 
				'font-icon-lock' 		=> 'font-icon-lock',
				'font-icon-lock-open' 	=> 'font-icon-lock-open',
				'font-icon-logout' 		=> 'font-icon-logout',
				'font-icon-login'		=> 'font-icon-login',
				'font-icon-checkmark' 	=> 'font-icon-checkmark',
				'font-icon-cross'		=> 'font-icon-cross', 
				'font-icon-minus' 		=> 'font-icon-minus',
				'font-icon-plus' 		=> 'font-icon-plus',
				'font-icon-cross-2' 	=> 'font-icon-cross-2',
				'font-icon-minus-2'		=> 'font-icon-minus-2',
				'font-icon-plus-2'		=> 'font-icon-plus-2', 
				'font-icon-cross-3' 	=> 'font-icon-cross-3',
				'font-icon-minus-3' 	=> 'font-icon-minus-3',
				'font-icon-plus-3' 		=> 'font-icon-plus-3',
				'font-icon-erase' 		=> 'font-icon-erase',
				'font-icon-blocked' 	=> 'font-icon-blocked',
				'font-icon-info' 		=> 'font-icon-info',
				'font-icon-info-2' 		=> 'font-icon-info-2',
				'font-icon-question' 	=> 'font-icon-question',
				'font-icon-help' 		=> 'font-icon-help',
				'font-icon-warning'		=> 'font-icon-warning',
				'font-icon-cycle' 		=> 'font-icon-cycle',
				'font-icon-cw' 			=> 'font-icon-cw',
				'font-icon-ccw' 		=> 'font-icon-ccw',
				'font-icon-shuffle' 	=> 'font-icon-shuffle',
				'font-icon-arrow' 		=> 'font-icon-arrow',
				'font-icon-arrow-2'		=> 'font-icon-arrow-2',
				'font-icon-retweet'	 	=> 'font-icon-retweet',
				'font-icon-loop'		=> 'font-icon-loop', 
				'font-icon-history'		=> 'font-icon-history',
				'font-icon-back'		=> 'font-icon-back', 
				'font-icon-switch' 		=> 'font-icon-switch',
				'font-icon-list'		=> 'font-icon-list',
				'font-icon-add-to-list' => 'font-icon-add-to-list',
				'font-icon-layout' 		=> 'font-icon-layout',
				'font-icon-list-2'		=> 'font-icon-list-2',
				'font-icon-text' 		=> 'font-icon-text',
				'font-icon-text-2'	 	=> 'font-icon-text-2', 
				'font-icon-document' 	=> 'font-icon-document',
				'font-icon-docs' 		=> 'font-icon-docs',
				'font-icon-landscape' 	=> 'font-icon-landscape',
				'font-icon-pictures' 	=> 'font-icon-pictures',
				'font-icon-video' 		=> 'font-icon-video',
				'font-icon-music-3' 	=> 'font-icon-music-3',
				'font-icon-folder'	 	=> 'font-icon-folder',
				'font-icon-archive' 	=> 'font-icon-archive',
				'font-icon-trash'	 	=> 'font-icon-trash',
				'font-icon-upload' 		=> 'font-icon-upload', 
				'font-icon-download' 	=> 'font-icon-download',
				'font-icon-disk' 		=> 'font-icon-disk',
				'font-icon-install'		=> 'font-icon-install',
				'font-icon-cloud' 		=> 'font-icon-cloud',
				'font-icon-upload-2' 	=> 'font-icon-upload-2',
				'font-icon-bookmark' 	=> 'font-icon-bookmark',
				'font-icon-bookmarks' 	=> 'font-icon-bookmarks',
				'font-icon-book-2'	 	=> 'font-icon-book-2',
				'font-icon-play'	 	=> 'font-icon-play',
				'font-icon-pause' 		=> 'font-icon-pause',
				'font-icon-record' 		=> 'font-icon-record',
				'font-icon-stop' 		=> 'font-icon-stop',
				'font-icon-next' 		=> 'font-icon-next',
				'font-icon-previous'	=> 'font-icon-previous',
				'font-icon-first'	 	=> 'font-icon-first',
				'font-icon-last' 		=> 'font-icon-last',
				'font-icon-resize-enlarge' 	=> 'font-icon-resize-enlarge',
				'font-icon-resize-shrink'	=> 'font-icon-resize-shrink',
				'font-icon-volume' 		=> 'font-icon-volume',
				'font-icon-sound'		=> 'font-icon-sound',
				'font-icon-mute'	 	=> 'font-icon-mute',
				'font-icon-flow-cascade'=> 'font-icon-flow-cascade',
				'font-icon-flow-branch' => 'font-icon-flow-branch',
				'font-icon-flow-tree'	=> 'font-icon-flow-tree',
				'font-icon-flow-line' 	=> 'font-icon-flow-line',
				'font-icon-flow-parallel'	=> 'font-icon-flow-parallel',	
				'font-icon-arrow-left-big-flat' 	=> 'font-icon-arrow-left-big-flat' , 
				'font-icon-arrow-down-big-flat'		=> 'font-icon-arrow-down-big-flat',
				'font-icon-arrow-up-big-flat' 		=> 'font-icon-arrow-up-big-flat',
				'font-icon-arrow-right-big-flat'	=> 'font-icon-arrow-right-big-flat', 
				'font-icon-arrow-left-small-flat'	=> 'font-icon-arrow-left-small-flat',
				'font-icon-arrow-down-small-flat' 	=> 'font-icon-arrow-down-small-flat',
				'font-icon-arrow-up-small-flat' 	=> 'font-icon-arrow-up-small-flat',
				'font-icon-arrow-right-small-flat' 	=> 'font-icon-arrow-right-small-flat', 
				'font-icon-arrow-left-circle'	=> 'font-icon-arrow-left-circle',
				'font-icon-arrow-down-circle' 	=> 'font-icon-arrow-down-circle', 
				'font-icon-arrow-up-circle' 	=> 'font-icon-arrow-up-circle',
				'font-icon-arrow-right-circle' 	=> 'font-icon-arrow-right-circle', 
				'font-icon-arrow-left-triangle'		=> 'font-icon-arrow-left-triangle',
				'font-icon-arrow-down-triangle' 	=> 'font-icon-arrow-down-triangle', 
				'font-icon-arrow-up-triangle' 		=> 'font-icon-arrow-up-triangle',
				'font-icon-arrow-right-triangle' 	=> 'font-icon-arrow-right-triangle', 
				'font-icon-arrow-left-simple-round'		=> 'font-icon-arrow-left-simple-round',
				'font-icon-arrow-down-simple-round' 	=> 'font-icon-arrow-down-simple-round', 
				'font-icon-arrow-up-simple-round' 		=> 'font-icon-arrow-up-simple-round', 
				'font-icon-arrow-right-simple-round' 	=> 'font-icon-arrow-right-simple-round',
				'font-icon-arrow-left-simple-thin-round' 	=> 'font-icon-arrow-left-simple-thin-round', 
				'font-icon-arrow-down-simple-thin-round'	=> 'font-icon-arrow-down-simple-thin-round',
				'font-icon-arrow-up-simple-thin-round' 		=> 'font-icon-arrow-up-simple-thin-round', 
				'font-icon-arrow-right-simple-thin-round' 	=> 'font-icon-arrow-right-simple-thin-round',
				'font-icon-arrow-left-simple-thin' 	=> 'font-icon-arrow-left-simple-thin',
				'font-icon-arrow-down-simple-thin' 	=> 'font-icon-arrow-down-simple-thin',
				'font-icon-arrow-up-simple-thin' 	=> 'font-icon-arrow-up-simple-thin',
				'font-icon-arrow-right-simple-thin' => 'font-icon-arrow-right-simple-thin',
				'font-icon-arrow-left-big' 	=> 'font-icon-arrow-left-big',
				'font-icon-arrow-down-big' 	=> 'font-icon-arrow-down-big',
				'font-icon-arrow-up-big' 	=> 'font-icon-arrow-up-big',
				'font-icon-arrow-right-big' => 'font-icon-arrow-right-big',
				'font-icon-arrow-menu' 		=> 'font-icon-arrow-menu',
				'font-icon-ellipsis' 		=> 'font-icon-ellipsis',
				'font-icon-dots' 			=> 'font-icon-dots',
				'font-icon-dot' 			=> 'font-icon-dot',
				'font-icon-align-right' 	=> 'font-icon-align-right',
				'font-icon-align-left' 		=> 'font-icon-align-left',
				'font-icon-align-justify' 	=> 'font-icon-align-justify',
				'font-icon-align-center' 	=> 'font-icon-align-center',
				'font-icon-group' 			=> 'font-icon-group',
				'font-icon-grid' 			=> 'font-icon-grid',
				'font-icon-grid-large' 		=> 'font-icon-grid-large',
				'font-icon-social-zerply' 			=> 'font-icon-social-zerply', 
				'font-icon-social-youtube'  		=> 'font-icon-social-youtube',
				'font-icon-social-yelp' 			=> 'font-icon-social-yelp',
				'font-icon-social-yahoo'			=> 'font-icon-social-yahoo',
				'font-icon-social-wordpress' 		=> 'font-icon-social-wordpress',
				'font-icon-social-virb' 			=> 'font-icon-social-virb',
				'font-icon-social-vimeo' 			=> 'font-icon-social-vimeo',
				'font-icon-social-viddler' 			=> 'font-icon-social-viddler',
				'font-icon-social-twitter' 			=> 'font-icon-social-twitter',
				'font-icon-social-tumblr' 			=> 'font-icon-social-tumblr',
				'font-icon-social-stumbleupon'		=> 'font-icon-social-stumbleupon',
				'font-icon-social-soundcloud' 		=> 'font-icon-social-soundcloud',
				'font-icon-social-skype' 			=> 'font-icon-social-skype',
				'font-icon-social-share-this'		=> 'font-icon-social-share-this',
				'font-icon-social-quora' 			=> 'font-icon-social-quora',
				'font-icon-social-pinterest'		=> 'font-icon-social-pinterest',
				'font-icon-social-photobucket'		=> 'font-icon-social-photobucket',
				'font-icon-social-paypal' 			=> 'font-icon-social-paypal',
				'font-icon-social-myspace' 			=> 'font-icon-social-myspace',
				'font-icon-social-linkedin' 		=> 'font-icon-social-linkedin',
				'font-icon-social-last-fm' 			=> 'font-icon-social-last-fm',
				'font-icon-social-instagram'		=> 'font-icon-social-instagram',
				'font-icon-social-grooveshark' 		=> 'font-icon-social-grooveshark',
				'font-icon-social-google-plus' 		=> 'font-icon-social-google-plus',
				'font-icon-social-github' 			=> 'font-icon-social-github',
				'font-icon-social-forrst' 			=> 'font-icon-social-forrst',
				'font-icon-social-flickr' 			=> 'font-icon-social-flickr',
				'font-icon-social-facebook' 		=> 'font-icon-social-facebook',
				'font-icon-social-evernote' 		=> 'font-icon-social-evernote',
				'font-icon-social-envato' 			=> 'font-icon-social-envato',
				'font-icon-social-email' 			=> 'font-icon-social-email', 
				'font-icon-social-dribbble'			=> 'font-icon-social-dribbble',
				'font-icon-social-digg' 			=> 'font-icon-social-digg',
				'font-icon-social-deviant-art' 		=> 'font-icon-social-deviant-art',
				'font-icon-social-blogger' 			=> 'font-icon-social-blogger',
				'font-icon-social-behance'			=> 'font-icon-social-behance',
				'font-icon-social-bebo' 			=> 'font-icon-social-bebo',
				'font-icon-social-addthis'			=> 'font-icon-social-addthis',
				'font-icon-social-500px' 			=> 'font-icon-social-500px'
			)
		),
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain'))
	) 
);

// Social Share Buttons
$az_shortcodes['az_social_share'] = array( 
	'type'=>'regular', 
	'title'=>__('Social Buttons Sharing', 'textdomain'), 
	'attr'=>array(
		'facebook'=>array(
			'type'=>'checkbox', 
			'title'=>__('Facebook', 'textdomain'),
			'desc' => __('Check to enable', 'textdomain')
		),
		'twitter'=>array(
			'type'=>'checkbox', 
			'title'=>__('Twitter', 'textdomain'),
			'desc' => __('Check to enable', 'textdomain')
		),
		'google_plus'=>array(
			'type'=>'checkbox', 
			'title'=>__('Google Plus', 'textdomain'),
			'desc' => __('Check to enable', 'textdomain')
		),
		'pinterest'=>array(
			'type'=>'checkbox', 
			'title'=>__('Pinterest', 'textdomain'),
			'desc' => __('Check to enable', 'textdomain')
		)
	)
);

// Revolution Slider
global $wpdb;
$rs = $wpdb->get_results( 
	"
	SELECT id, title, alias
	FROM ".$wpdb->prefix."revslider_sliders
	ORDER BY id ASC LIMIT 100
	"
);
$revsliders = array();
if ($rs) {
foreach ( $rs as $slider ) {
  $revsliders[$slider->alias] = $slider->alias;
}
} else {
$revsliders[0] = 'No Slider Found';
}
  
$az_shortcodes['az_slider'] = array(  
	'type'=>'regular', 
	'title'=>__('Revolution Slider', 'textdomain' ),
	'attr'=>array(
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain')),
		'alias'=>array('type'=>'select_slider', 'title'=>__('Revolution Slider Alias', 'textdomain'), 'options' => $revsliders, 'desc'=>__('Select your Revolution Slider.', 'textdomain')) 
	)
);

// Video Embed Code
$az_shortcodes['az_video_embed'] = array(  
	'type'=>'regular', 
	'title'=>__('Video Embed', 'textdomain' ),
	'attr'=>array(
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain')),
		'link' => array('type'=>'text', 'title'=>__('URL', 'textdomain'),
										'desc'=>__('Working examples, in case you want to use an external service (Video Embed Shortcode):<br/><br/>https://vimeo.com/charlex/shapeshifter <br/>http://www.youtube.com/watch?v=CZIt20emgLY', 'textdomain'))
	)
);

// Video
$az_shortcodes['az_video'] = array( 
	'type'=>'regular', 
	'title'=>__('Video Self Hosted', 'textdomain' ), 
	'attr'=>array( 
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain')),
		'webm_url'=>array('type'=>'text', 'title'=>__('WEBM File URL', 'textdomain'), 'desc'=>__('Upload a WEBM File.', 'textdomain')),
		'mp4_url'=>array('type'=>'text', 'title'=>__('MP4 File URL', 'textdomain'), 'desc'=>__('Upload a MP4 File.', 'textdomain')),
		'ogv_url'=>array('type'=>'text', 'title'=>__('OGV File URL', 'textdomain'), 'desc'=>__('Upload a OGV File.', 'textdomain')),
		'image'=>array('type'=>'custom', 'title'=> __('Preview Image','textdomain'), 'desc'=>__('If you wish can upload a poster image.', 'textdomain'))
	)
);

// Audio
$az_shortcodes['az_audio'] = array( 
	'type'=>'regular', 
	'title'=>__('Audio Self Hosted', 'textdomain' ), 
	'attr'=>array( 
		'class'=>array('type'=>'text', 'title'=>__('Class', 'textdomain'), 'desc'=>__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'textdomain')),
		'mp3_url'=>array('type'=>'text', 'title'=>__('MP3 File URL', 'textdomain'), 'desc'=>__('Upload a MP3 File.', 'textdomain'))
	)
);

// Shortcode Output HTML
		$html_options = null;
		
		$shortcode_html = '
		
		<div id="az-sh-heading">
		
		<div id="shortcode-generator" class="mfp-hide mfp-with-anim">
		    					
			<div class="shortcode-content">
				<div id="az-sc-header">
					<div class="label"><strong>AZ Shortcodes</strong></div>			
					<div class="content">
					<select id="az-shortcodes">
				    <option value="0" selected="selected">'. __("Choose your Shortcode...", 'textdomain') .'</option>';
					
					foreach( $az_shortcodes as $shortcode => $options ){
						
						if(strpos($shortcode,'header') !== false) {
							$shortcode_html .= '<optgroup label="'.$options['title'].'">';
						}
						else {
							$shortcode_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
							$html_options .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'" data-type="'.$options['type'].'">';
							
							if( !empty($options['attr']) ){
								 foreach( $options['attr'] as $name => $attr_option ){
									$html_options .= az_option_element( $name, $attr_option, $options['type'], $shortcode );
								 }
							}
			
							$html_options .= '</div>'; 
						}
						
					} 
			
			$shortcode_html .= '</select></div></div></div>'; 	
		
	
		 echo $shortcode_html . '<div class="sh-container">' . $html_options; ?>
			
			<div id="shortcode-content">
				
				<div class="label"><label id="option-label" for="shortcode-content"><?php echo __( 'Content: ', 'textdomain' ); ?> </label></div>
				<div class="content"><textarea id="shortcode_content"></textarea></div>
			
			    <div class="hr"></div>
			    
			</div>
		
			<code class="shortcode_storage"><span id="shortcode-storage-o" style=""></span><span id="shortcode-storage-d"></span><span id="shortcode-storage-c" style=""></span></code>
			<a class="btn" id="add-shortcode"><?php echo __( 'Add Shortcode', 'textdomain' ); ?></a>
			</div><!--sh-container-->
		</div>

	</div>

	<?php	

}

function az_option_element( $name, $attr_option, $type, $shortcode ){
	
	$option_element = null;
	
	(isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';
		
	switch( $attr_option['type'] ){
		
	case 'radio':
	    
		$option_element .= '<div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content">';
	    foreach( $attr_option['opt'] as $val => $title ){
	    
		(isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';
		
		 $option_element .= '
			<label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>
		    <input class="attr" type="radio" data-attrname="'.$name.'" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'>';
	    }
		
		$option_element .= $desc . '</div>';
		
	    break;
		
	case 'checkbox':
		
		$option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div><div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />'. $desc. '</div> ';
		
		break;	
	
	case 'select':
		
		$option_element .= '
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$name.'" class="az-select">';
			$values = $attr_option['values'];
			foreach( $values as $value ){
		    	$option_element .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$option_element .= '</select>' . $desc . '</div>';
		
		break;
	
	case 'select_slider':
		
		$option_element .= '
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$name.'" class="az-select">';
			$values = $attr_option['options'];
			foreach( $values as $value ){
		    	$option_element .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$option_element .= '</select>' . $desc . '</div>';
		
		break;
		
	case 'icons':
		
		$option_element .= '

		<div class="icon-option">';
			$values = $attr_option['values'];
			foreach( $values as $value ){
		    	$option_element .= '<i class="'.$value.'"></i>';
			}
		$option_element .= $desc . '</div>';
		
		break;
		
	case 'custom':
 
		if( $name == 'accordions' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="label"><label><strong>'.__('Accordion Title: ', 'textdomain').'</strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" value="" /></div>
					<div class="label"><label><strong>'.__('Accordion Content: ', 'textdomain').'</strong></label></div>
					<div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
				</div>
			</div>
			<a href="#" class="btn orange remove-list-item">'.__('Remove Accordion', 'textdomain' ). '</a> <a href="#" class="btn orange add-list-item">'.__('Add Accordion', 'textdomain' ).'</a>';
			
		}
		
		if( $name == 'toggles' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="label"><label><strong>'.__('Toggle Title: ', 'textdomain').'</strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" value="" /></div>
					<div class="label"><label><strong>'.__('Toggle Content: ', 'textdomain').'</strong></label></div>
					<div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
				</div>
			</div>
			<a href="#" class="btn orange remove-list-item">'.__('Remove Toggle', 'textdomain' ). '</a> <a href="#" class="btn orange add-list-item">'.__('Add Toggle', 'textdomain' ).'</a>';
			
		}
		
		if( $name == 'tabs' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="label"><label><strong>'.__('Tab Title: ', 'textdomain').'</strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" value="" /></div>
					<div class="label"><label><strong>'.__('Tab Content: ', 'textdomain').'</strong></label></div>
					<div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
				</div>
			</div>
			<a href="#" class="btn orange remove-list-item">'.__('Remove Tab', 'textdomain' ). '</a> <a href="#" class="btn orange add-list-item">'.__('Add Tab', 'textdomain' ).'</a>';
			
		}

		if( $name == 'testimonials' ){
			$option_element .= '
			<div class="shortcode-dynamic-items" id="options-item" data-name="item">
				<div class="shortcode-dynamic-item">
					<div class="label"><label><strong>'.__('Testimonial Title: ', 'textdomain').'</strong></label></div>
					<div class="content"><input class="shortcode-dynamic-item-input" type="text" name="" value="" /></div>
					<div class="label"><label><strong>'.__('Testimonial Content: ', 'textdomain').'</strong></label></div>
					<div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
				</div>
			</div>
			<a href="#" class="btn orange remove-list-item">'.__('Remove Testimonial', 'textdomain' ). '</a> <a href="#" class="btn orange add-list-item">'.__('Add Testimonial', 'textdomain' ).'</a>';
			
		}
		
		elseif( $name == 'image'){
			$option_element .= '
				<div class="shortcode-dynamic-item-pop" id="options-item" data-name="image-upload">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="image_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'textdomain') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'textdomain') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
				</div>';
		}

		elseif( $name == 'image_popup'){
			$option_element .= '
				<div class="shortcode-dynamic-item-pop" id="options-item" data-name="image-upload">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="image_popup_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'textdomain') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'textdomain') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
				</div>';
		}
		
		/*
		elseif( $name == 'webm_url'){
			$option_element .= '
				<div class="shortcode-dynamic-item" id="options-item" data-name="file-upload">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="webm_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'textdomain') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'textdomain') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
				</div>';
		}

		elseif( $name == 'mp4_url'){
			$option_element .= '
				<div class="shortcode-dynamic-item" id="options-item" data-name="file-upload">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="mp4_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'textdomain') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'textdomain') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
				</div>';
		}
		
		elseif( $name == 'ogv_url'){
			$option_element .= '
				<div class="shortcode-dynamic-item" id="options-item" data-name="file-upload">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="ogv_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'textdomain') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'textdomain') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
				</div>';
		}
		
		elseif( $name == 'mp3_url'){
			$option_element .= '
				<div class="shortcode-dynamic-item" id="options-item" data-name="file-upload">
					<div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
					<div class="content">
					
					 <input type="hidden" id="options-item"  />
			         <img class="redux-opts-screenshot" id="mp3_url" src="" />
			         <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);" class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'textdomain') . '</a>
			         <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'textdomain') . '</a>';
					
					if(!empty($desc)) $option_element .= $desc;
					
					$option_element .='
					</div>
				</div>';
		}*/
		
		elseif( $type == 'checkbox' ){
			$option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />' . $desc . '</div> ';
		} 
		
		
		break;

	case 'textarea':
		$option_element .= '
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><textarea data-attrname="'.$name.'"></textarea> ' . $desc . '</div>';
		break;
			
	case 'text':
	default:
	    $option_element .= '
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><input class="attr" type="text" data-attrname="'.$name.'" value="" />' . $desc . '</div>';
	    break;

    }
	
	
	$option_element .= '<div class="clear"></div>';
    
    return $option_element;
}

?>