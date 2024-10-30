<?php

/* ----------------------------------------------
	Register custom post type 'jseacgp_p' -------
---------------------------------------------- */

function jseacg_studentsAdmitReg() {
  $labels = array(
    'name'               => _x( 'Admit Cards', 'jseacgp-td' ),
    'singular_name'      => _x( 'Admit Card', 'jseacgp-td' ),
    'add_new'            => _x( 'Add New', 'jseacgp-td' ),
    'add_new_item'       => __( 'Add New Card','jseacgp-td'),
    'edit_item'          => __( 'Edit Card','jseacgp-td'),
    'new_item'           => __( 'New Card','jseacgp-td'),
    'all_items'          => __( 'All Admit Card','jseacgp-td'),
    'view_item'          => __( 'View Card','jseacgp-td'),
    'search_items'       => __( 'Search Cards','jseacgp-td'),
    'not_found'          => __( 'No card found','jseacgp-td'),
    'not_found_in_trash' => __( 'No card found in the Trash','jseacgp-td'), 
    'parent_item_colon'  => '',
    'menu_name'          => __('Admit Cards','jseacgp-td')
  );
  $args = array(
	'labels'        => $labels,
	'description'   => 'Add new custom post type Admit card',
	'public'        => true,
	'menu_position' => 5,
	'supports'      => array( 'title' ),
	'taxonomies'    => array(  'jseacgExam','jseacgYear' ),
	'has_archive'   => true,
	'menu_icon'     => 'dashicons-images-alt2',
  );
  register_post_type( 'jseacg_p', $args ); 
}

add_action( 'init', 'jseacg_studentsAdmitReg' );

// Change default placeholder text of custom post title

function jseacg_changeDefaultTitle($title) {
	$screen = get_current_screen();
	if('jseacg_p' == $screen->post_type) {
		$title = 'Enter student\'s name';
	}
	return $title;
}

add_filter('enter_title_here','jseacg_changeDefaultTitle');

// Change default message of post type

function jseacg_studentsAdmitUpdateMessage( $messages ) {
  global $post, $post_ID;
  $messages['jseacg_p'] = array(
	0  => '', 
	1  => sprintf( __('Card updated. <a title="Use download form to see the preview of admit card" href="%s">View card</a>','jseacgp-td'), esc_url( get_permalink($post_ID) ) ),
	2  => __('Custom field updated.','jseacgp-td'),
	3  => __('Custom field deleted.','jseacgp-td'),
	4  => __('Card updated.','jseacgp-td'),
	5  => isset($_GET['revision']) ? sprintf( __('Card restored to revision from %s','jseacgp-td'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6  => sprintf( __('Card published. <a href="%s">View card</a>','jseacgp-td'), esc_url( get_permalink($post_ID) ) ),
	7  => __('Card saved.'),
	8  => sprintf( __('Card submitted. <a target="_blank" href="%s">Preview card</a>','jseacgp-td'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9  => sprintf( __('Card scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview card</a>','jseacgp-td'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('Card draft updated. <a target="_blank" href="%s">Preview card</a>','jseacgp-td'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'jseacg_studentsAdmitUpdateMessage' );

/* ------------------------------
------Register taxonomy exam ----
------------------------------ */

add_action( 'init', 'jseacg_studentsExamReg', 0 );

function jseacg_studentsExamReg() {
	// Exam taxonomy
	$labels = array(
		'name'              => get_option('jseacgp_texam'),
		'singular_name'     => get_option('jseacgp_texam'),
		'search_items'      => 'Search '.get_option('jseacgp_texam'),
		'all_items'         => 'All '.get_option('jseacgp_texam'),
		'parent_item'       => 'Parent '.get_option('jseacgp_texam'),
		'parent_item_colon' => 'Parent '.get_option('jseacgp_texam').':',
		'edit_item'         => 'Edit '.get_option('jseacgp_texam'),
		'update_item'       => 'Update '.get_option('jseacgp_texam'),
		'add_new_item'      => 'Add New '.get_option('jseacgp_texam'),
		'new_item_name'     => 'New '.get_option('jseacgp_texam'),
		'menu_name'         => get_option('jseacgp_texam'),
	);
	
	register_taxonomy( 'jseacgExam', 'jseacg_p', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
	
}

/* ---------------------------------------
------- Register taxonomy year -----------
--------------------------------------- */

add_action( 'init', 'jseacg_studentsYearReg', 0 );

function jseacg_studentsYearReg() {
	// Exam taxonomy
	$labels = array(
		'name'              => get_option('jseacgp_tyear'),
		'singular_name'     => get_option('jseacgp_tyear'),
		'search_items'      => 'Search '.get_option('jseacgp_tyear'),
		'all_items'         => 'All '.get_option('jseacgp_tyear'),
		'parent_item'       => 'Parent '.get_option('jseacgp_tyear'),
		'parent_item_colon' => 'Parent '.get_option('jseacgp_tyear').':',
		'edit_item'         => 'Edit '.get_option('jseacgp_tyear'),
		'update_item'       => 'Update '.get_option('jseacgp_tyear'),
		'add_new_item'      => 'Add New '.get_option('jseacgp_tyear'),
		'new_item_name'     => 'New '.get_option('jseacgp_tyear'),
		'menu_name'         => get_option('jseacgp_tyear'),
	);
	
	register_taxonomy( 'jseacgYear', 'jseacg_p', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
	
}
