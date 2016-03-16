<?php
/*
Plugin Name: AZ Custom Post Type
Plugin URI: http://www.alessioatzeni.com/
Description: Custom Post Type for Portfolio and Team for <strong>Klaus Theme</strong> Only.
Author: Alessio Atzeni
Author URI: http://www.alessioatzeni.com
Version: 1.1
*/


// TRANSLATION
load_plugin_textdomain( 'textdomain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/*-----------------------------------------------------------------------------------*/
/*	Team Taxanomy
/*-----------------------------------------------------------------------------------*/

// Taxanomy Register

function team_register() {  
    	 
	 $team_labels = array(
	 	'name' => __( 'Team', 'taxonomy general name', 'textdomain'),
		'singular_name' => __( 'People Item', 'textdomain'),
		'search_items' =>  __( 'Search People Item', 'textdomain'),
		'all_items' => __( 'Team', 'textdomain'),
		'parent_item' => __( 'Parent People Item', 'textdomain'),
		'edit_item' => __( 'Edit People Item', 'textdomain'),
		'update_item' => __( 'Update People Item', 'textdomain'),
		'add_new_item' => __( 'Add New People Item', 'textdomain')
	 );
	 
	 $options = get_option('klaus');
	 $custom_slug = null;		
	 
	 if(!empty($options['team_rewrite_slug'])) $custom_slug = $options['team_rewrite_slug'];
	
	 $args = array(
			'labels' => $team_labels,
			'rewrite' => array('slug' => $custom_slug,'with_front' => false),
			'singular_label' => __('Person', 'textdomain'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 9,
			'menu_icon' => plugins_url( 'img/icons/portfolio.png', __FILE__ ),
			'supports' => array('title', 'editor', 'thumbnail', 'comments')  
       );  
  
    register_post_type( 'team' , $args );
	
	$category_labels = array(
		'name' => __( 'Disciplines', 'textdomain'),
		'singular_name' => __( 'Discipline', 'textdomain'),
		'search_items' =>  __( 'Search Discipline', 'textdomain'),
		'all_items' => __( 'All Discipline', 'textdomain'),
		'parent_item' => __( 'Parent Discipline', 'textdomain'),
		'edit_item' => __( 'Edit Discipline', 'textdomain'),
		'update_item' => __( 'Update Discipline', 'textdomain'),
		'add_new_item' => __( 'Add New Discipline', 'textdomain'),
    	'menu_name' => __( 'Disciplines', 'textdomain')
	); 	

	register_taxonomy("disciplines", 
			array("team"), 
			array("hierarchical" => true, 
				'labels' => $category_labels,
				'show_ui' => true,
    			'query_var' => true,
				'rewrite' => array( 'slug' => 'disciplines' )
	));
	
	$attributes_labels = array(
		'name' => __( 'Attributes', 'textdomain'),
		'singular_name' => __( 'Attribute', 'textdomain'),
		'search_items' =>  __( 'Search Attributes', 'textdomain'),
		'all_items' => __( 'All Attributes', 'textdomain'),
		'parent_item' => __( 'Parent Attribute', 'textdomain'),
		'edit_item' => __( 'Edit Attribute', 'textdomain'),
		'update_item' => __( 'Update Attribute', 'textdomain'),
		'add_new_item' => __( 'Add New Attribute', 'textdomain'),
		'new_item_name' => __( 'New Attribute', 'textdomain'),
		'menu_name' => __( 'Attributes', 'textdomain')
	); 	
	
	register_taxonomy('attributes',
		array('team'),
		array('hierarchical' => true,
		'labels' => $attributes_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'attributes' )
	));
}  
add_action('init', 'team_register');

// Include Single Team
function include_template_team_function( $template_path ) {
if ( get_post_type() == 'team' ) {
	if ( is_single() ) {
		if ( $theme_file = locate_template( array ( 'single-team.php' ) ) ) {
			$template_path = $theme_file;
		} else {
			$template_path = plugin_dir_path( __FILE__ ) . '/single-team.php';
		}
	}
}
return $template_path;
}

add_filter( 'template_include', 'include_template_team_function', 1 );

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Taxanomy
/*-----------------------------------------------------------------------------------*/

// Taxanomy Register
function portfolio_register() {  
    	 
	 $portfolio_labels = array(
	 	'name' => __( 'Portfolio', 'taxonomy general name', 'textdomain'),
		'singular_name' => __( 'Portfolio Item', 'textdomain'),
		'search_items' =>  __( 'Search Portfolio Item', 'textdomain'),
		'all_items' => __( 'Portfolio', 'textdomain'),
		'parent_item' => __( 'Parent Portfolio Item', 'textdomain'),
		'edit_item' => __( 'Edit Portfolio Item', 'textdomain'),
		'update_item' => __( 'Update Portfolio Item', 'textdomain'),
		'add_new_item' => __( 'Add New Portfolio Item', 'textdomain')
	 );
	 
	 $options = get_option('klaus');
	 $custom_slug = null;		
	 
	 if(!empty($options['portfolio_rewrite_slug'])) $custom_slug = $options['portfolio_rewrite_slug'];
	
	 $args = array(
			'labels' => $portfolio_labels,
			'rewrite' => array('slug' => $custom_slug,'with_front' => false),
			'singular_label' => __('Project', 'textdomain'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 8,
			'menu_icon' => plugins_url( 'img/icons/portfolio.png', __FILE__ ),
			'supports' => array('title', 'editor', 'thumbnail', 'comments')  
       );  
  
    register_post_type( 'portfolio' , $args );
	
	$categories_portfolio_labels = array(
		'name' => __( 'Project Categories', 'textdomain'),
		'singular_name' => __( 'Project Category', 'textdomain'),
		'search_items' =>  __( 'Search Project Categories', 'textdomain'),
		'all_items' => __( 'All Project Categories', 'textdomain'),
		'parent_item' => __( 'Parent Project Category', 'textdomain'),
		'edit_item' => __( 'Edit Project Category', 'textdomain'),
		'update_item' => __( 'Update Project Category', 'textdomain'),
		'add_new_item' => __( 'Add New Project Category', 'textdomain'),
		'menu_name' => __( 'Project Categories', 'textdomain')
	); 	
	
	register_taxonomy("project-category", 
			array("portfolio"), 
			array("hierarchical" => true, 
					'labels' => $categories_portfolio_labels,
					'show_ui' => true,
					'query_var' => true,
					'rewrite' => array( 'slug' => 'project-category' )
	));
	
	$attributes_portfolio_labels = array(
		'name' => __( 'Project Attributes', 'textdomain'),
		'singular_name' => __( 'Project Attribute', 'textdomain'),
		'search_items' =>  __( 'Search Project Attributes', 'textdomain'),
		'all_items' => __( 'All Project Attributes', 'textdomain'),
		'parent_item' => __( 'Parent Project Attribute', 'textdomain'),
		'edit_item' => __( 'Edit Project Attribute', 'textdomain'),
		'update_item' => __( 'Update Project Attribute', 'textdomain'),
		'add_new_item' => __( 'Add New Project Attribute', 'textdomain'),
		'new_item_name' => __( 'New Project Attribute', 'textdomain'),
		'menu_name' => __( 'Project Attributes', 'textdomain')
	); 	
	
	register_taxonomy('project-attribute',
		array('portfolio'),
		array('hierarchical' => true,
		'labels' => $attributes_portfolio_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'project-attribute' )
	));  
}  
add_action('init', 'portfolio_register');

// Include Single Team

function include_template_portfolio_function( $template_path ) {
if ( get_post_type() == 'portfolio' ) {
	if ( is_single() ) {
		if ( $theme_file = locate_template( array
			( 'single-portfolio.php' ) ) ) {
			$template_path = $theme_file;
		} else {
			$template_path = plugin_dir_path( __FILE__ ) . '/single-portfolio.php';
		}
	}
}
return $template_path;
}

add_filter( 'template_include', 'include_template_portfolio_function', 1 );

?>