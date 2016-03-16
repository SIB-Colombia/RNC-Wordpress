<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $content
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'accordion-builder'.$el_class, $this->settings['base']);
$class = setClass(array($css_class));

$output .= '<div'.$class.'>'.wpb_js_remove_wpautop($content).'</div>'.$this->endBlockComment('az_acc_container')."\n";

echo $output;
?>