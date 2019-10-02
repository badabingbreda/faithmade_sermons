<?php
/**
 * Plugin Name: Faithmade Sermons
 * Plugin URI: https://faithmade.com
 * Description: Faithmade Sermons adds sermon capability to your Faithmade Website.
 * Version: 1.0
 * Author: Andrew Peters
 * Author URI: https://faithmade.com
 */


define( 'FM_SERMONS_PATH' , dirname( __FILE__ ) . '/' );

include_once( 'sermons_rss.php' );

 //Add Sermon Custom Post Type

 function faithmade_sermon_posts() {

	$args = array (
		'label' => esc_html__( 'Sermons', 'English' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Sermons', 'English' ),
			'name_admin_bar' => esc_html__( 'Sermon', 'English' ),
			'add_new' => esc_html__( 'Add new', 'English' ),
			'add_new_item' => esc_html__( 'Add new Sermon', 'English' ),
			'new_item' => esc_html__( 'New Sermon', 'English' ),
			'edit_item' => esc_html__( 'Edit Sermon', 'English' ),
			'view_item' => esc_html__( 'View Sermon', 'English' ),
			'update_item' => esc_html__( 'Update Sermon', 'English' ),
			'all_items' => esc_html__( 'All Sermons', 'English' ),
			'search_items' => esc_html__( 'Search Sermons', 'English' ),
			'parent_item_colon' => esc_html__( 'Parent Sermon', 'English' ),
			'not_found' => esc_html__( 'No Sermons found', 'English' ),
			'not_found_in_trash' => esc_html__( 'No Sermons found in Trash', 'English' ),
			'name' => esc_html__( 'Sermons', 'English' ),
			'singular_name' => esc_html__( 'Sermon', 'English' ),
		),
		'public' => true,
		'description' => 'Sermons for your church.',
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => true,
		'menu_position' => 80,
		'capability_type' => 'post',
		'hierarchical' => true,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'supports' => array(
			'title',
			'editor',
		),
		'rewrite' => true,
	);

	register_post_type( 'sermons', $args );
}
add_action( 'init', 'faithmade_sermon_posts' );

//Add Sermon Topic Taxonomy

function sermon_topic_taxonomy() {

	$args = array (
		'label' => esc_html__( 'Topics', 'English' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Topics', 'English' ),
			'all_items' => esc_html__( 'All Topics', 'English' ),
			'edit_item' => esc_html__( 'Edit Topic', 'English' ),
			'view_item' => esc_html__( 'View Topic', 'English' ),
			'update_item' => esc_html__( 'Update Topic', 'English' ),
			'add_new_item' => esc_html__( 'Add new Topic', 'English' ),
			'new_item_name' => esc_html__( 'New Topic', 'English' ),
			'parent_item' => esc_html__( 'Parent Topic', 'English' ),
			'parent_item_colon' => esc_html__( 'Parent Topic:', 'English' ),
			'search_items' => esc_html__( 'Search Topics', 'English' ),
			'popular_items' => esc_html__( 'Popular Topics', 'English' ),
			'separate_items_with_commas' => esc_html__( 'Separate Topics with commas', 'English' ),
			'add_or_remove_items' => esc_html__( 'Add or remove Topics', 'English' ),
			'choose_from_most_used' => esc_html__( 'Choose most used Topics', 'English' ),
			'not_found' => esc_html__( 'No Topics found', 'English' ),
			'name' => esc_html__( 'Topics', 'English' ),
			'singular_name' => esc_html__( 'Topic', 'English' ),
		),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
		'hierarchical' => true,
		'query_var' => true,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => true,
	);

	register_taxonomy( 'topics', array( 'sermons' ), $args );
}
add_action( 'init', 'sermon_topic_taxonomy', 0 );

//Add Speaker Taxonomy

function faithmade_speaker_taxonomy() {

	$args = array (
		'label' => esc_html__( 'Speakers', 'English' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Speakers', 'English' ),
			'all_items' => esc_html__( 'All Speakers', 'English' ),
			'edit_item' => esc_html__( 'Edit Speaker', 'English' ),
			'view_item' => esc_html__( 'View Speaker', 'English' ),
			'update_item' => esc_html__( 'Update Speaker', 'English' ),
			'add_new_item' => esc_html__( 'Add new Speaker', 'English' ),
			'new_item_name' => esc_html__( 'New Speaker', 'English' ),
			'parent_item' => esc_html__( 'Parent Speaker', 'English' ),
			'parent_item_colon' => esc_html__( 'Parent Speaker:', 'English' ),
			'search_items' => esc_html__( 'Search Speakers', 'English' ),
			'popular_items' => esc_html__( 'Popular Speakers', 'English' ),
			'separate_items_with_commas' => esc_html__( 'Separate Speakers with commas', 'English' ),
			'add_or_remove_items' => esc_html__( 'Add or remove Speakers', 'English' ),
			'choose_from_most_used' => esc_html__( 'Choose most used Speakers', 'English' ),
			'not_found' => esc_html__( 'No Speakers found', 'English' ),
			'name' => esc_html__( 'Speakers', 'English' ),
			'singular_name' => esc_html__( 'Speaker', 'English' ),
		),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'hierarchical' => true,
		'query_var' => true,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => true,
	);

	register_taxonomy( 'speakers', array( 'sermons' ), $args );
}
add_action( 'init', 'faithmade_speaker_taxonomy', 0 );

// Add Series Taxonomy

function faithmade_series_taxonomy() {

	$args = array (
		'label' => esc_html__( 'Series', 'text-domain' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Series', 'text-domain' ),
			'all_items' => esc_html__( 'All Series', 'text-domain' ),
			'edit_item' => esc_html__( 'Edit Series', 'text-domain' ),
			'view_item' => esc_html__( 'View Series', 'text-domain' ),
			'update_item' => esc_html__( 'Update Series', 'text-domain' ),
			'add_new_item' => esc_html__( 'Add new Series', 'text-domain' ),
			'new_item_name' => esc_html__( 'New Series', 'text-domain' ),
			'parent_item' => esc_html__( 'Parent Series', 'text-domain' ),
			'parent_item_colon' => esc_html__( 'Parent Series:', 'text-domain' ),
			'search_items' => esc_html__( 'Search Series', 'text-domain' ),
			'popular_items' => esc_html__( 'Popular Series', 'text-domain' ),
			'separate_items_with_commas' => esc_html__( 'Separate Series with commas', 'text-domain' ),
			'add_or_remove_items' => esc_html__( 'Add or remove Series', 'text-domain' ),
			'choose_from_most_used' => esc_html__( 'Choose most used Series', 'text-domain' ),
			'not_found' => esc_html__( 'No Series found', 'text-domain' ),
			'name' => esc_html__( 'Series', 'text-domain' ),
			'singular_name' => esc_html__( 'Series', 'text-domain' ),
		),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
		'hierarchical' => false,
		'query_var' => true,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => true,
	);

	register_taxonomy( 'series', array( 'sermons' ), $args );
}
add_action( 'init', 'faithmade_series_taxonomy', 0 );

// Add series image custom field to series taxonomy

add_filter( 'rwmb_meta_boxes', 'faithmade_series_image' );


function faithmade_series_image( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array (
		'title' => esc_html__( 'Sermon Series Image', 'text-domain' ),
		'id' => 'faithmade-sermon-series-image',
		'fields' => array(
			array (
				'id' => $prefix . 'fm_sermon_series_artwork',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Image Advanced', 'text-domain' ),
				'max_file_uploads' => 1,
				'image_size' => 'thumbnail',
				'max_status' => false,
				'label_description' => esc_html__( 'We recommend a 16:9 image, but the key is to always stay consistent with your sizes.', 'text-domain' ),
			),
		),
		'taxonomies' => array(
			0 => 'series',
		),
	);

	return $meta_boxes;
}


//Add Sermon Fields to Sermon Post Type

add_filter( 'rwmb_meta_boxes', 'faithmade_sermon_fields' );

function faithmade_sermon_fields( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array (
		'title' => esc_html__( 'Sermon Details', 'text-domain' ),
		'id' => 'faithmade-sermon-fields',
		'post_types' => array(
			0 => 'sermons',
		),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array (
				'id' => $prefix . 'heading_cw8zwxszl1v',
				'type' => 'heading',
				'name' => esc_html__( 'Add Sermon Media', 'text-domain' ),
			),
			array (
				'id' => $prefix . 'faithmade_content_types_checkbox',
				'name' => esc_html__( 'What types of media are you adding?', 'text-domain' ),
				'type' => 'checkbox_list',
				'options' => array(
					'Video URL' => esc_html__( 'Video URL', 'text-domain' ),
					'Audio URL' => esc_html__( 'Audio URL', 'text-domain' ),
					'Podcast Embed' => esc_html__( 'Podcast Embed', 'text-domain' ),
				),
				'inline' => 1,
			),
			array (
				'id' => $prefix . 'faithmade-sermon-video-link',
				'type' => 'url',
				'name' => esc_html__( 'Sermon Video Link', 'text-domain' ),
				'desc' => esc_html__( 'Add the full URL of your sermon video.', 'text-domain' ),
				'sanitize_callback' => 'none',
				'visible' => array(
					'when' => array(
						array (
							0 => 'faithmade_content_types_checkbox',
							1 => 'contains',
							2 => 'Video URL',
						),
					),
					'relation' => 'or',
				),
			),
			array (
				'id' => $prefix . 'faithmade_sermon_audio_link',
				'type' => 'file_input',
				'name' => esc_html__( 'Audio Link', 'text-domain' ),
				'desc' => esc_html__( 'Upload your sermon audio or paste in the URL from wherever your audio is stored.', 'text-domain' ),
				'sanitize_callback' => 'none',
				'visible' => array(
					'when' => array(
						array (
							0 => 'faithmade_content_types_checkbox',
							1 => 'contains',
							2 => 'Audio URL',
						),
					),
					'relation' => 'or',
				),
			),
			array(
			    'name' => 'Audio duration in seconds',
			    'id'   => 'faithmade_sermon_audio_duration',
			    'type' => 'number',
			    'placeholder' => 'Audio duration of in seconds',
			    'min'  => 0,
			    // 'max'  => 999,
			    'step' => 1,
				'visible' => array(
					'when' => array(
						array (
							0 => 'faithmade_content_types_checkbox',
							1 => 'contains',
							2 => 'Audio URL',
						),
					),
					'relation' => 'or',
				),
			),
			array (
				'id' => $prefix . 'faithmade_sermon_audio_embed',
				'type' => 'textarea',
				'name' => esc_html__( 'Podcast Audio Embed', 'text-domain' ),
				'visible' => array(
					'when' => array(
						array (
							0 => 'faithmade_content_types_checkbox',
							1 => 'contains',
							2 => 'Podcast Embed',
						),
					),
					'relation' => 'or',
				),
			),
			array(
			    'id'   => 'faithmade_audio_filesize',
			    'type' => 'hidden',
			    // Hidden field must have predefined value
			    'std'  => 0,
			),
			array(
			    'id'   => 'faithmade_audio_mimetype',
			    'type' => 'hidden',
			    // Hidden field must have predefined value
			    'std'  => 0,
			),
			array (
				'id' => $prefix . 'heading_cw8zwxszl1v_1nizqghq412',
				'type' => 'heading',
				'name' => esc_html__( 'Add Sermon Info', 'text-domain' ),
			),
			array (
				'id' => $prefix . 'faithmade_date_preached',
				'type' => 'date',
				'name' => esc_html__( 'Date Preached', 'text-domain' ),
			),
			array (
				'id' => $prefix . 'faithmade_speaker_select',
				'type' => 'taxonomy',
				'name' => esc_html__( 'Select a Speaker', 'text-domain' ),
				'desc' => esc_html__( 'Use the dropdown to select a speaker. You can add a speaker by visiting Sermons > Speaker in your sidebar menu.', 'text-domain' ),
				'taxonomy' => 'speakers',
				'field_type' => 'select',
			),
			array (
				'id' => $prefix . 'faithmade_series_select',
				'type' => 'taxonomy',
				'name' => esc_html__( 'Select a Series', 'text-domain' ),
				'desc' => esc_html__( 'Use the dropdown to select a series. If this is a new series, you\'ll need to add the series first by visiting Sermons > Series in your sidebar menu.', 'text-domain' ),
				'taxonomy' => 'speakers',
				'field_type' => 'select',
			),
		),
		'style' => 'seamless',
	);

	return $meta_boxes;
}

//Sermon Settings Pages

//Register Settings and Podcast Settings Pages

add_filter( 'mb_settings_pages', 'fm_settings_pages' );
function fm_settings_pages( $settings_pages ) {
    $settings_pages[] = array(
        'id'          => 'fm-sermon-styles',
        'option_name' => 'fm-sermons',
        'menu_title'  => 'Settings',
        'parent'      => 'edit.php?post_type=sermons',
        'style'       => 'no-boxes',
    );
     $settings_pages[] = array(
        'id'          => 'fm-sermon-podcast',
        'option_name' => 'fm-sermons',
        'menu_title'  => 'Podcast',
        'parent'      => 'edit.php?post_type=sermons',
        'style'       => 'no-boxes',
    );
    return $settings_pages;
}

//Sermon Settings Page Fields

add_filter( 'rwmb_meta_boxes', 'faithmade_sermons_settings_fields' );

function faithmade_sermons_settings_fields( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array (
		'title' => esc_html__( 'Sermon Settings', 'text-domain' ),
		'id' => 'fm-sermon-settings',
		'fields' => array(
			array (
				'id' => $prefix . 'fm_sermon_page_hero',
				'type' => 'single_image',
				'name' => esc_html__( 'Sermon Background Image', 'text-domain' ),
				'desc' => esc_html__( 'This image shows on yourchurch.com/sermons and also serves as the default background for individual sermons when there is no sermon image set. This image shows on yourchurch.com/sermons and also serves as the default background for individual sermons when there is no sermon image set. Recommended size is 1920px wide by 1080px height which is 16:9 ratio.', 'text-domain' ),
				'label_description' => esc_html__( 'We recommend a 16:9 ratio for your image.', 'text-domain' ),
			),
			array (
				'id' => $prefix . 'fm_sermon_page_grid',
				'type' => 'single_image',
				'name' => esc_html__( 'Sermon Grid Image', 'text-domain' ),
				'desc' => esc_html__( 'If you don\'t upload an image for your sermon, this will serve as the default image in your sermon grid. Usually, this is a simple image of your pastor preaching, or logo type picture. This image shows on yourchurch.com/sermons and also serves as the default background for individual sermons when there is no sermon image set. Recommended size is 1920px wide by 1080px height which is 16:9 ratio.', 'text-domain' ),
				'label_description' => esc_html__( 'We recommend a 16:9 ratio for your image.', 'text-domain' ),
			),
		),
		'settings_pages' => array(
			0 => 'fm-sermon-styles',
		),
	);

	return $meta_boxes;
}

// Podcast Settings Fields

add_filter( 'rwmb_meta_boxes', 'faithmade_podcast_fields' );

function faithmade_podcast_fields( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array (
		'title' => esc_html__( 'Podcast Details', 'text-domain' ),
		'id' => 'fm-podcast-details',
		'fields' => array(
			array (
				'id' => $prefix . 'fm_podcast_title',
				'type' => 'text',
				'name' => esc_html__( 'Podcast Title', 'text-domain' ),
			),
			array (
				'id' => $prefix . 'fm_podcast_description',
				'type' => 'textarea',
				'name' => esc_html__( 'Podcast Description', 'text-domain' ),
				'rows' => 3,
			),
			array (
				'id' => $prefix . 'fm_podcast_artwork',
				'type' => 'image_upload',
				'name' => esc_html__( 'Podcast Artwork', 'text-domain' ),
				'max_file_uploads' => 1,
				'label_description' => esc_html__( 'At least 1600x1600 pixels.', 'text-domain' ),
			),
			array (
				'id' => $prefix . 'heading_p9l28rw97p',
				'type' => 'heading',
				'name' => esc_html__( 'Need to display podcast feed here that they would copy to iTunes, etc.', 'text-domain' ),
			),
		),
		'settings_pages' => array(
			0 => 'fm-sermon-podcast',
		),
	);

	return $meta_boxes;
}
?>
