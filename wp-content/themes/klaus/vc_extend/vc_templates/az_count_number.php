<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

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

$icon_output = null;
if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<div class="count-number-icon textaligncenter"><i class="'.$iconClass.'"></i></div>';
} else {
	$icon_output = '';
}

$class = setClass(array('counter-number', $el_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.'>'.$icon_output.'';
$output .= '<span class="number-value timer" data-from="'.$number_value_from.'" data-to="'.$number_value_to.'" data-speed="'.$number_speed.'"></span>';
$output .= '<span class="number-field">'.$number_field.'</span>';
$output .= '</div>';

echo $output.$this->endBlockComment('az_count_number');

?>