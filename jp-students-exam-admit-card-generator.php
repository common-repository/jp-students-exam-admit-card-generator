<?php
/*
 * Plugin Name: JP Students Exam Admit Card Generator
 * Version: 1.0.2
 * Plugin URI: https://skjoy.info/shop/jp-students-exam-admit-card-generator-premium
 * Description: Powerful exam admit card generator plugin for your wordpress site. You can generate students exam admit card by just entering student's exam information. Students can download their admit card by entering their details in the download form. Use shortcode [jseacg_dForm] inside post or page to make the download form.
 * Author: Skjoy
 * Author URI: https://skjoy.info/
 * Requires at least: 4.0
 * Tested up to: 6.0
 * Stable Tag: 2.0
 * License: GPL v2
 * Shortname: jseacg or jseacg_
 */

/* ----------------------------------
----------- Add style & script ------
------------------------------------*/

function jseacg_frontend_style_script() {
        wp_register_style( 'jseacg_fstyle', plugin_dir_url(__FILE__).'assets/css/frontend.css', false, '1.0.0' );
        wp_enqueue_style( 'jseacg_fstyle' );
		
		wp_register_script( 'jseacg_fscript', plugin_dir_url(__FILE__).'assets/js/frontend.min.js', array('jquery'), '1.0.0' );

		$jsrms_data = array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'aSmessage' => get_option('jseacgp_ajSMessage'),
			'aEmessage' => get_option('jseacgp_ajEMessage')
		);
		wp_localize_script( 'jseacg_fscript', 'jseacgpData', $jsrms_data );

        wp_enqueue_script( 'jseacg_fscript' );
}
add_action( 'wp_enqueue_scripts', 'jseacg_frontend_style_script' );

function jseacg_add_jquery() {
        wp_enqueue_script('jquery');
}
add_action('init', 'jseacg_add_jquery');

/* ----------------------------------
----------- Load necessary files ----
-----------------------------------*/

require_once( 'includes/lib/custom-post-and-tax.php' );
require_once( 'includes/boxes/functions.php' );
require_once( 'includes/class-pdf-download-form.php' );
require_once( 'includes/shortcodes.php' );
require_once( 'includes/class-pdf-template.php' );
require_once( 'includes/class-query-admit-detail.php' );


/* --------------------------------------
---- Add default options value to db ----
---------------------------------------*/

function jseacg_default_settings(){
	
	require_once('includes/install_db.php');
}
	
register_activation_hook( __FILE__, 'jseacg_default_settings' );
