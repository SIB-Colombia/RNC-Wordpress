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

// Control Size and Line Width of Circle Progress Bar
if( !empty($circular_size)) {
  $size_output = $circular_size;
} else {
  $size_output = 220;
}

if( !empty($circular_line)) {
  $line_output = $circular_line;
} else {
  $line_output = 24;
}

$class = setClass(array('progress-circle', $el_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));
		  	
$output .= '<div'.$class.''.$animation_delay_class.'>';
$output .= '<div class="chart" data-bgcolor="'.$circular_bgcolor.'" data-trackcolor ="'.$circular_trackcolor.'" data-size="'.$size_output.'" data-line="'.$line_output.'" data-percent="'.$circular_percentage.'"><span class="percentage">'.$circular_percentage.'</span><span class="field">'.$circular_field.'</span></div>';
$output .= '</div>';

echo $output.$this->endBlockComment('az_circular_progress_bar');

?>