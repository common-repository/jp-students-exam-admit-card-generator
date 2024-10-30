<?php

/* ----------------------------------------------------------
	Add a submenu and show available shortcodes to users ----
---------------------------------------------------------- */

function jseacg_registerShortcodeMenu(){

	add_submenu_page( 'edit.php?post_type=jseacg_p', __('Necessary Shortcodes','jsrmsp-td'), __('Shortcodes','jsrmsp-td'), 'manage_options', 'jseacgp_shortcode_active_page', 'jseacg_shortcodeActiveAdminPage' );

}

add_action('admin_menu','jseacg_registerShortcodeMenu');

function jseacg_shortcodeActiveAdminPage() { ?>
	
	<div class="wrap">
		<h2><?php _e('Necessary Shortcodes','jseacgp-td'); ?></h2>
			
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="jseacgp-fs"><?php _e('Admit Card Download Form','jseacgp-td'); ?></label></th>
						<td><input id="jseacgp-fs" class="regular-text" type="text" value="[jseacg_dForm]"/>
						<p class="description"><?php _e('This shortcode for anywhere use,such as post,page,sidebar.It will display the admit card download form.','jseacgp-td'); ?></p></td>
					</tr>
				</tbody>
			</table>
		
	</div>
	
<?php }