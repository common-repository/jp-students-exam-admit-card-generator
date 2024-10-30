<?php

/* Metaboxes */

add_filter( 'Jseacgp_meta_boxes', 'Jseacgp_admit_cards_informations' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function Jseacgp_admit_cards_informations( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_jseacgp_';

	$meta_boxes['studentinformation'] = array(
		'id'         => 'studentinformation',
		'title'      => get_option( 'jseacgp_g1' ),
		'pages'      => array( 'jseacg_p', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => get_option('jseacgp_f1'),
				'desc' => 'Add '.get_option('jseacgp_f1').' here',
				'id'   => $prefix . 'f1',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => get_option('jseacgp_f2'),
				'desc' => 'Add '.get_option('jseacgp_f2').' here',
				'id'   => $prefix . 'f2',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => get_option('jseacgp_f3'),
				'desc' => 'Add '.get_option('jseacgp_f3').' here',
				'id'   => $prefix . 'f3',
				'type' => 'text_date',
			),
			array(
				'name'    => get_option('jseacgp_f4'),
				'desc'    => 'Add '.get_option('jseacgp_f4').' here',
				'id'      => $prefix . 'f4',
				'type'    => 'select',
				'options' => array(
					'' => 'Select',
					'Male' => 'Male',
					'Female'   => 'Female',
					'Other'   => 'Other',
				),
			),
			array(
				'name'    => get_option('jseacgp_f5'),
				'desc'    => 'Add '.get_option('jseacgp_f4').' here',
				'id'      => $prefix . 'f5',
				'type'    => 'select',
				'options' => array(
					'' => 'Select',
					'Regular' => 'Regular',
					'Irregular'   => 'Irregular',
					'Corresponding'   => 'Corresponding',
					'Non-Corresponding'   => 'Non-Corresponding',
				),
			),
			array(
				'name' => get_option('jseacgp_f6'),
				'desc' => 'Add '.get_option('jseacgp_f6').' here',
				'id'   => $prefix . 'f6',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => get_option('jseacgp_f7'),
				'desc' => 'Add '.get_option('jseacgp_f7').' here',
				'id'   => $prefix . 'f7',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => get_option('jseacgp_f8'),
				'desc' => 'Add '.get_option('jseacgp_f8').' here',
				'id'   => $prefix . 'f8',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => get_option('jseacgp_f9'),
				'desc' => 'Add '.get_option('jseacgp_f9').' here',
				'id'   => $prefix . 'f9',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			
			array(
				'name' => get_option('jseacgp_f10'),
				'desc' => 'Add '.get_option('jseacgp_f10').' here',
				'id'   => $prefix . 'f10',
				'type' => 'text_medium',
			),
			array(
				'name' => get_option('jseacgp_f11'),
				'desc' => 'Add '.get_option('jseacgp_f11').' here',
				'id'   => $prefix . 'f11',
				'type' => 'text_date',
				// 'repeatable' => true,
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'Jseacgp_admit_info_initialize', 9999 );
/**
 * Initialize the metabox class.
 */
function Jseacgp_admit_info_initialize() {

	if ( ! class_exists( 'Jseacgp_Meta_Box' ) )
		require_once 'init.php';

}
