<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Narrow by categories
if($portfolio_categories == 'portfolio')
	$portfolio_categories = '';

// Post teasers count
if ( $portfolio_post_number != '' && !is_numeric($portfolio_post_number) ) $portfolio_post_number = -1;
if ( $portfolio_post_number != '' && is_numeric($portfolio_post_number) ) $portfolio_post_number = $portfolio_post_number;

// Add Custom Class For Portfolio
$portfolio_full = null;
if ($portfolio_wall==true) {
	$portfolio_full = ' portfolio-full-width';

if ( $portfolio_columns_count=="2clm") { $portfolio_columns_count = 'col-full-6'; }
	if ( $portfolio_columns_count=="3clm") { $portfolio_columns_count = 'col-full-4'; }
	if ( $portfolio_columns_count=="4clm") { $portfolio_columns_count = 'col-full-3'; }
	if ( $portfolio_columns_count=="5clm") { $portfolio_columns_count = 'col-full-2'; }
	if ( $portfolio_columns_count=="6clm") { $portfolio_columns_count = 'col-full-1'; }
} else {
	if ( $portfolio_columns_count=="2clm") { $portfolio_columns_count = 'col-md-6'; }
	if ( $portfolio_columns_count=="3clm") { $portfolio_columns_count = 'col-md-4'; }
	if ( $portfolio_columns_count=="4clm") { $portfolio_columns_count = 'col-md-3'; }
	if ( $portfolio_columns_count=="5clm") { $portfolio_columns_count = 'col-md-3'; }
	if ( $portfolio_columns_count=="6clm") { $portfolio_columns_count = 'col-md-3'; }
}

$args = array( 
	'posts_per_page' => $portfolio_post_number, 
   	'post_type' => 'portfolio',
	'project-category' => $portfolio_categories,
	'orderby' => $orderby,
	'order' => $order
);

// Run query
$my_query = new WP_Query($args);

if($portfolio_sortable_mode == "yes") {
	
	$output .= '
		  	<div id="portfolio-filter" class="row'.$portfolio_full.' desktop-filter">
				<div class="col-md-12">
					<div class="portfolio-left">
						<p class="selected">'.$portfolio_sortable_name.'</p>
					</div>
					<div class="portfolio-right">
						<ul class="option-set" data-option-key="filter">
								<li><a class="selected drop-selected" href="#filter" data-option-value="*">'. $portfolio_sortable_name . '</a></li>';
								$list_categories = get_categories("taxonomy=project-category");
								foreach ($list_categories as $list_category) :
								if(empty($portfolio_categories)){
									$output .= '<li><a href="#filter" data-option-value=".' . strtolower(str_replace(" ","-", ($list_category->slug))) . '">' . $list_category->name . '</a></li>';
								}
								else{
									if(strstr($portfolio_categories, $list_category->slug))
									{	
										$output .= '<li><a href="#filter" data-option-value=".' . strtolower(str_replace(" ","-", ($list_category->slug))) . '">' . $list_category->name . '</a></li>';
									}
								}
								endforeach;
$output .= '			</ul>	
					</div>
				</div>
			</div>';

// Mobile Version
	$output .= '
		  	<div id="portfolio-filter" class="row'.$portfolio_full.' mobile-filter">
				<div class="col-md-12">
					<div class="dropdown">
						<div class="dropmenu">
							<p class="selected">'.$portfolio_sortable_name.'</p>
							<i class="font-icon-arrow-down-simple-thin-round"></i>
						</div>					
						<div class="dropmenu-active">
							<ul class="option-set" data-option-key="filter">
								<li><a class="selected drop-selected" href="#filter" data-option-value="*">'. $portfolio_sortable_name . '</a></li>';
								$list_categories = get_categories("taxonomy=project-category");
								foreach ($list_categories as $list_category) :
								if(empty($portfolio_categories)){
									$output .= '<li><a href="#filter" data-option-value=".' . strtolower(str_replace(" ","-", ($list_category->slug))) . '">' . $list_category->name . '</a></li>';
								}
								else{
									if(strstr($portfolio_categories, $list_category->slug))
									{	
										$output .= '<li><a href="#filter" data-option-value=".' . strtolower(str_replace(" ","-", ($list_category->slug))) . '">' . $list_category->name . '</a></li>';
									}
								}
								endforeach;       										
$output .= '				</ul>
						</div>
					</div>							
				</div>
			</div>';

	
}

$sortable_class = '';
if ($portfolio_sortable_mode == "no") {
$sortable_class = ' no-sortable';
}

$output .= '<div class="row '.$portfolio_full.' '. $el_class .'">';
$output .= '<div id="portfolio-projects" class="'.$sortable_class.' '.$portfolio_layout .'">';
$output .= '<ul id="projects">';



while($my_query->have_posts()) : $my_query->the_post();

$terms = get_the_terms($post->id,"project-category");
$list_categories = NULL;

	if ( !empty($terms) ){
	 foreach ( $terms as $term ) {
	   $list_categories .= strtolower($term->slug) . ' ';
	 }
}

$attrs = get_the_terms( $post->ID, 'project-attribute' );
$attributes_fields = NULL;

if ( !empty($attrs) ){
 foreach ( $attrs as $attr ) {
   $attributes_fields[] = $attr->name;
 }
 
 $on_attributes = join( " - ", $attributes_fields );
}

$post_id = $my_query->post->ID;

$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
$img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-thumb' );
$img_wall_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-wall-thumb' );

$fancy_video = get_post_meta($post->ID, '_az_fancy_video', true);
$fancy_gallery = get_post_meta($post->ID, '_az_fancy_gallery', true);
$fancy_image_popup = get_post_meta($post->ID, '_az_fancy_image_full', true);
$fancy_image_gallery = get_post_meta($post->ID, '_az_fancy_image_gallery', true);

$images = explode(',', $fancy_image_gallery);

$customFancyImg = (!empty($fancy_image_popup)) ? $fancy_image_popup : $img_url[0];

if(!empty($fancy_gallery)) { $fancy_gallery = 'data-fancybox-group="'. strtolower($fancy_gallery) .'"'; }

$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = 'animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
}

$output .= '<li class="item-project '.$portfolio_columns_count. ' ' . $list_categories .'">
			<div class="item-container '. $animation_loading_class .' '. $animation_effect_class .'">';

if($portfolio_post_link == "link_fancybox") {
	
	if( !empty($fancy_video)) {
		$output .= '<div class="hover-wrap">
					<a class="fancybox-media" href="'. $fancy_video .'" title="'. get_the_title() .'" '. $fancy_gallery .'><i class="font-icon-plus-3"></i></a>';

		if ($portfolio_layout == "masonry-portfolio") {
			$output .= '<img src="'. $img_url[0] .'" width="'.$img_url[1].'" height="'.$img_url[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
		} else {
			if ($portfolio_wall==true) {
				$output .= '<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
			} else {
				$output .= '<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
			}
		}
						 
		$output .= '<div class="project-name">
						<div class="va">';
						if ($link_portfolio_item==true) {
							$output .= '<div class="project-title">
											<h3>'. get_the_title() .'</h3>
											<h4>'. $on_attributes .'</h4>
										</div>';
						} else {
							$output .= '<a class="project-title" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'">
											<h3>'. get_the_title() .'</h3>
											<h4>'. $on_attributes .'</h4>
										</a>';
						}
		$output .= '	</div>
					</div>
					</div>';
					
	} else {
		
		$output .= '<div class="hover-wrap">
					<a class="fancybox" href="'. $customFancyImg .'" title="'. get_the_title() .'" '. $fancy_gallery .'><i class="font-icon-plus-3"></i></a>';

		if ($portfolio_layout == "masonry-portfolio") {
			$output .= '<img src="'. $img_url[0] .'" width="'.$img_url[1].'" height="'.$img_url[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
		} else {
			if ($portfolio_wall==true) {
				$output .= '<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
			} else {
				$output .= '<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
			}
		}

		// FancyBox Gallery
		if(!empty($fancy_image_gallery)){
			foreach($images as $image):
				$src = wp_get_attachment_image_src( $image, 'full' );
				$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';
				$output .= '<a class="fancy-wrap fancybox hidden" title="'.$alt.'" href="'.$src[0].'" '.$fancy_gallery.'></a>';
			endforeach;
		}
		
		$output .= '<div class="project-name">
						<div class="va">';
						if ($link_portfolio_item==true) {
							$output .= '<div class="project-title">
											<h3>'. get_the_title() .'</h3>
											<h4>'. $on_attributes .'</h4>
										</div>';
						} else {
							$output .= '<a class="project-title" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'">
											<h3>'. get_the_title() .'</h3>
											<h4>'. $on_attributes .'</h4>
										</a>';
						}
		$output .= '	</div>
					</div>
					</div>';
	}
	
} else {

	$output .= '<div class="hover-wrap">';

	if ($portfolio_layout == "masonry-portfolio") {
		$output .= '<img src="'. $img_url[0] .'" width="'.$img_url[1].'" height="'.$img_url[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
	} else {
		if ($portfolio_wall==true) {
			$output .= '<img src="'. $img_wall_thumb[0] .'" width="'.$img_wall_thumb[1].'" height="'.$img_wall_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
		} else {
			$output .= '<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />';
		}
	}

	$output .= '<div class="project-name">
						<div class="va">';
						if ($link_portfolio_item==true) {
							$output .= '<div class="project-title">
											<h3>'. get_the_title() .'</h3>
											<h4>'. $on_attributes .'</h4>
										</div>';
						} else {
							$output .= '<a class="project-title" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'">
											<h3>'. get_the_title() .'</h3>
											<h4>'. $on_attributes .'</h4>
										</a>';
						}
		$output .= '	</div>
					</div>
					</div>';

}



$output .= '</div>
			</li>';

endwhile;

wp_reset_query();

$output .= '</ul>';
$output .= '</div>';
$output .= '</div>';

echo $output.$this->endBlockComment('az_portfolio_grid');

?>