<?php

/* ----------------------------------
--- Information query class ---------
---------------------------------- */

class jseacgp_queryInfo {

	// Query for user search form

	public function makeQuery($queryType,$exam,$year,$roll,$reg,$birthdate){
		
		if($queryType === 'form1'){
			query_posts( 
				array( 
					'post_type'   => 'jseacg_p',
					'post_status' => 'publish',
					'jseacgpExam'     => $exam,
					'jseacgpYear'       => $year,
					'meta_key'    => '_jseacgp_f3',
					'meta_query'  => array(
					   array(
							'key'   => '_jseacgp_f3',
							'value' => $birthdate,
					   )),
					'posts_per_page' => 1
				) 
			);
		}
	}
}