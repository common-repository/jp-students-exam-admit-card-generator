<?php

/* -----------------------------------------------
-------  Class for download form -----------------
------------------------------------------------ */

class jseacgp_dForm{
	
	public function dForm($type){
		
		if($type==="form1"){ ?>
			<tr>
				<td><label for="jseacgpExam"><?php echo get_option('jseacgp_texam'); ?></td>
				<td>
					<?php
						// Exam Class term
						$terms = get_terms('jseacgExam');
						if(!empty($terms) &&!is_wp_error($terms)) { ?>
							<select name="jseacgpExam" id="jseacgpExam" required>
							<option value=""><?php _e('Select','jsrmsp-td'); ?></option>
							<?php 
								foreach($terms as $term) {
									echo '<option value="'.$term->name.'">'.$term->name.'</option>';
								}
							?>
							</select>
						<?php }
					?>
				</td>
			</tr>
			<tr>
				<td><label for="jseacgpYear"><?php echo get_option('jseacgp_tyear'); ?></td>
				<td>
					<?php
						// Exam Year Term
						$terms = get_terms('jseacgYear');
						if(!empty($terms) &&!is_wp_error($terms)) { ?>
							<select name="jseacgpYear" id="jseacgpYear" required>
							<option value=""><?php _e('Select','jsrmsp-td'); ?></option>
							<?php
								foreach($terms as $term) {
									echo '<option value="'.$term->name.'">'.$term->name.'</option>';
								}
							?>
							</select>
						<?php }
					?>
				</td>
			</tr>
			<tr>
				<td><label for="jseacgpDobrith"><?php echo get_option('jseacgp_f3'); ?></label></td>
				<td>
					<input type="text" id="jseacgpDobrith" name="jseacgpDobrith" placeholder="dd/mm/yyyy" required />
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Download" class="result-submit-btn" name="result_form" /></td>
				<td><p style="display: none;" class="jseacgpLoader"><span class="jseacgpLoaderText"><?php echo get_option('jseacgp_ajPMessage'); ?></span> <img class="jseacgpLoaderImg" src="<?php echo plugin_dir_url(__FILE__).'../assets/img/loader.gif' ?>" alt="" /></p></td>
			</tr>
		<?php }
	}
}

/* -----------------------------------------------
-------  Make shortcode embed download form ------
------------------------------------------------ */

function jseacgp_downloadForm(){
	ob_start(); 

	$formType = get_option('jseacgp_dForm');
	
	?>
	<div class="jseacgpMessage"></div>
	<fieldset>
	    <legend><?php echo get_option('jseacgp_formTitle'); ?></legend>
		<form action="" id="admitDform" method="post">
			
			<table class="jseagp-isf">
				<tbody>
					<?php
			
						// Get the download form
						
						$form = new jseacgp_dForm();
						$form->dForm($formType);
					?>
				</tbody>
			</table>
			
		</form>
	</fieldset>
	<?php

	$downloadForm = ob_get_clean();
	return $downloadForm;
}

add_shortcode( 'jseacg_dForm', 'jseacgp_downloadForm' );

/* --------------------------------------------------
--- Query detail & generate admit card using ajax ---
---------------------------------------------------*/

function jseacgp_ajaxPdfGenerate(){
	$rType = get_option('jseacgp_dForm');
	$generate = $_GET['generate'];
	$exam = isset($_GET['exam']) ? sanitize_text_field($_GET['exam']): '';
	$year = isset($_GET['year']) ? sanitize_text_field($_GET['year']): '';
	$roll = isset($_GET['roll']) ? sanitize_text_field($_GET['roll']): '';
	$reg = isset($_GET['reg']) ? sanitize_text_field($_GET['reg']): '';
	$birthdate = isset($_GET['birthdate']) ? sanitize_text_field($_GET['birthdate']): '';

	// Check the information if correct

	if($generate === 'no'){
		$jseagpQuery = new jseacgp_queryInfo();
		$jseagpQuery->makeQuery($rType,sanitize_text_field($exam),sanitize_text_field($year),sanitize_text_field($roll),sanitize_text_field($reg),sanitize_text_field($birthdate));

		if ( have_posts() ) : while ( have_posts() ) : the_post();
			echo '1';
		endwhile;
		else:
			echo '0';
		endif;

		wp_reset_query();
	}

	// If information is correct then generate pdf

	if($generate === 'yes'){
		
		// Generate PDF
		$jseagpQuery = new jseacgp_queryInfo();
		$jseagpQuery->makeQuery($rType,$exam,$year,$roll,$reg,$birthdate);
		$jseagpPdf = new jseacgp_pdfTemplate();
		
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$jseagpPdf->templateGeneral();

		endwhile;

		else:
			// If post not found
		endif;

		wp_reset_query();
	}


	die();
}

add_action('wp_ajax_jseacgp_pdfdl','jseacgp_ajaxPdfGenerate');
add_action('wp_ajax_nopriv_jseacgp_pdfdl','jseacgp_ajaxPdfGenerate');
