<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

// Target Output
if ( $link_target == 'same' || $link_target == '_self' ) { $link_target = ''; }
if ( $link_target != '' ) { $link_target = ' target="'.$link_target.'"'; }

// Highlight
$highlight_to = '';
if ( $highlight==true ) {
	$highlight_to = 'selected ';
}

// Animation Setup
$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = 'animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
} else {
	$animation_effect_class = '';
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}


$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'pricing-table'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $highlight_to, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div'.$class.''.$animation_delay_class.'>';
$output .= '<h5>'.$title.'</h5>';
$output .= '<div class="price">'.$currency.$price.'<span>'.$interval.'</span></div>';
$output .= wpb_js_remove_wpautop($content);
$output .= '<a class="confirm" href="'.$link_url.'"'.$link_target.'>'.$link_text.'</a>';
$output .= '</div>'.$this->endBlockComment('az_pricing_table');

echo $output;

?>