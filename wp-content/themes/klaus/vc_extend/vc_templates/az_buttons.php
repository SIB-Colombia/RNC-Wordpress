<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

// Target
if ( $target == 'same' || $target == '_self' ) { $target = ''; }
if ( $target != '' ) { $target = ' target="'.$target.'"'; }

// Icon Output
if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<i class="'.$iconClass.'"></i>';
} else {
	$icon_output = '';
}

// Inverted Colors
$inverted_to = '';
$buttonclass = $buttoncolor = null;
if ($inverted==true) {
	$inverted_to = ' inverted';
	if($buttoncolor=="custom") {
		$buttoncolor = ' style="background-color: '.$custombuttoncolor.'; border-color: '.$custombuttoncolor.'; color: '.$custombuttoncolor.';"';
		$buttonclass = ' custom-button-color'; 
	}
} else {
	if($buttoncolor=="custom") {
		$buttoncolor = ' style="background-color: '.$custombuttoncolor.'; border-color: '.$custombuttoncolor.';"';
		$buttonclass = ' custom-button-color'; 
	}
}

$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = 'animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}

$class = setClass(array('button-main', $el_class, $buttonsize, $buttonclass, $inverted_to, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<a'.$class.$buttoncolor.' href="'.$buttonlink.'"'.$target.''.$animation_delay_class.'>'.$icon_output.$buttonlabel.'</a>';

echo $output.$this->endBlockComment('az_buttons');

?>