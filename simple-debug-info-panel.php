<?php
/*
Plugin Name: Simple Debug Info Panel
Plugin URI: http://www.senff.com/plugins/simple-debug-info-panel
Description: Simple Debug Info Panel shows a little box on your site with some helpful debugging info for developers: the current post/page ID, which template is being used, etc.
Author: Senff
Author URI: http://www.senff.com
Version: 1.0.3
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: simple-debug-info-panel
*/

defined('ABSPATH') or die('INSERT COIN');


/**
 * === FUNCTIONS ========================================================================================
 */


/**
 * --- IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */
if (!function_exists('simple_debug_default_options')) {
	function simple_debug_default_options() {
		$versionNum = '1.0.2';
		if (get_option('simple_debug_options') === false) {
			$new_options['sd_version'] = $versionNum;
			$new_options['sd_type'] = true;		
			$new_options['sd_pids'] = true;		
			$new_options['sd_themename'] = false;		
			$new_options['sd_themepath'] = false;		
			$new_options['sd_template'] = true;
			$new_options['sd_categories'] = false;
			$new_options['sd_tags'] = false;
			$new_options['sd_viewport'] = true;									
			$new_options['sd_position'] = '4';
			$new_options['sd_loadopen'] = false;
			$new_options['sd_admin'] = true;			
			add_option('simple_debug_options',$new_options);
		} 
	}
}



/**
 * --- CREATE INFO BOX AND LOAD IT WITH INFO -----------------------------------------------------------
 * --- LOAD MAIN .JS FILE AND CALL IT WITH PARAMETERS (BASED ON DATABASE VALUES) -----------------------
 */
if (!function_exists('load_simple_debug')) {
    function load_simple_debug() {

		$options = get_option('simple_debug_options');
		$versionNum = $options['sd_version'];

		// Main CSS file 
		wp_register_style('simpleDebugStyle', plugins_url('/assets/css/simple-debug-info-box.css', __FILE__),'', '1.0.2' );;
	    wp_enqueue_style('simpleDebugStyle');

		// Set defaults for by-default-empty elements (because '' does not work with the JQ plugin) 

		$script_vars = array(
		      'viewport' 	=> $options['sd_viewport']
		);

		add_action( 'wp_footer', 'load_debug_box' );

		wp_enqueue_script('debugThis', plugins_url('/assets/js/simple-debug.js', __FILE__), array( 'jquery' ), $versionNum, true);
		wp_localize_script( 'debugThis', 'simple_debug_engage', $script_vars );

    }
}

function load_debug_box(){
	$options = get_option('simple_debug_options');

	if (($options['sd_admin']) && (!current_user_can("manage_options"))) {
		
		// Admin Only setting is and user has no admin privileges: nothing is shown.

	} else {

		echo '<div class="simple-debug-info-box sdib-position-'.esc_attr($options['sd_position']);
		if ((is_admin_bar_showing()) && (  ($options['sd_position'] == '1') || ($options['sd_position'] =='2')  )){
			echo 'admin';
		}
		if ($options['sd_loadopen']) {
			echo ' box-open">';
		} else {
			echo ' box-closed">';
		}
		echo '<div class="sdib-title sdib-title-top"><h2>PAGE DEBUG INFO</h2><div class="open-close"><span class="sdib-icon-open"></span><span class="sdib-icon-close"></span></div></div><div class="sdib-details"><table width="100%">';

		if ($options['sd_type']) {
			echo '<tr><td>Type:</td><td><strong>';
			echo is_page()?"page":"";
			echo is_single()?"post":"";
			echo is_archive()?"archive":"";
			echo is_home()?"home page":"";
			echo is_search()?"search results":"";
			echo '</strong></td></tr>';
		}

		if ($options['sd_pids']) {
			echo '<tr><td>';
			if (is_page()) { echo esc_html__('Page ID','simple-debug-info-panel').':</td><td><strong>'. esc_html(get_the_id()) . '</strong></td></tr>' ;}
			elseif (is_single()) { echo esc_html__('Post ID','simple-debug-info-panel').':</td><td><strong>'. esc_html(get_the_id()) . '</strong></td></tr>' ;}
			else { echo esc_html__('ID','simple-debug-info-panel').':</td><td><strong><span class="not-applicable">n/a</span></strong></td>'; }
			echo '</tr>';
		}

		if ($options['sd_themename']) {
			echo '<tr><td>'.esc_html__('Theme:','simple-debug-info-panel').'</td>';
			$activeTheme = wp_get_theme();
			$activeThemeName = $activeTheme->Name;
			echo '<td><strong>'.esc_html($activeThemeName).'</strong>';
			if ( is_child_theme() ) {
				$parentThemeName = $activeTheme->parent()->Name;
				echo ' ('.esc_html__('child of','simple-debug-info-panel').' <strong>'.esc_html($parentThemeName).'</strong>)';
			}

			echo '</td></tr>';
		}

		if ($options['sd_template']) {
			echo '<tr><td>'.esc_html__('Template file:','simple-debug-info-panel').'</td>';
			global $template;
	        $fullTemplatePath = $template;
	        $templateFile = basename($template);
	        $templateFullPath = str_replace( ABSPATH . 'wp-content/', '', $template );
			if ($options['sd_themepath']) {
	        	echo '<td><strong>'.esc_html($templateFullPath).'</strong></td>';
	        } else {
	        	echo '<td><strong>'.esc_html($templateFile).'</strong></td>';
	        }
			echo '</tr>';
		}

		if ($options['sd_categories']) {
			echo '<tr><td>'.esc_html__('Categories:','simple-debug-info-panel').'</td><td><strong>';
			if (is_single()) {
				the_category(', ');
			} else {
				echo '<span class="not-applicable">n/a</span>';
			}
			echo '</strong></td></tr>';
		}

		if ($options['sd_tags']) {
			echo '<tr><td>'.esc_html__('Tags:','simple-debug-info-panel').'</td><td><strong>';
			if (is_single()) {
				the_tags('',', ','');
			} else {
				echo '<span class="not-applicable">n/a</span>';
			}
			echo '</strong></td></tr>';
		}

		if ($options['sd_viewport']) {
			echo '<tr><td>'.esc_html__('Screen size:','simple-debug-info-panel').'</td><td><span class="screen-size">';
			echo '</td></tr>';
		}

		echo '</table></div></div>';

	}

}


/**
 * --- ADD LINK TO SETTINGS PAGE TO SIDEBAR ------------------------------------------------------------
 */
if (!function_exists('simple_debug_menu')) {
    function simple_debug_menu() {
		add_options_page( 'Simple Debug Info Panel Configuration', 'Simple Debug Info Panel', 'manage_options', 'simpledebugmenu', 'simple_debug_config_page' );
    }
}


/**
 * --- ADD LINK TO SETTINGS PAGE TO PLUGIN ------------------------------------------------------------
 */
if (!function_exists('simple_debug_settings_link')) {
function simple_debug_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=simpledebugmenu">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
	}
}


/**
 * --- THE WHOLE ADMIN SETTINGS PAGE -------------------------------------------------------------------
 */
if (!function_exists('simple_debug_config_page')) {
	function simple_debug_config_page() {
	// Retrieve plugin configuration options from database
	$simple_debug_options = get_option( 'simple_debug_options' );
	?>

	<div id="simple-debug-settings-general" class="wrap">
		<h2><?php esc_html_e('Simple Debug Info Panel Settings','simple-debug-info-panel'); ?></h2>

		<p><?php esc_html_e('With Simple Debug Info Panel, you will be able to instantly see a page\'s underlying WordPress information, such as the current post/page ID, which template file is being used, categories/tags, etc., all in a small info box on the front end of the site.','simple-debug-info-panel'); ?></p>

		<div class="main-content">

			<h2 class="nav-tab-wrapper">	
				<a class="nav-tab" href="#main"><?php esc_html_e('Settings','simple-debug-info-panel'); ?></a>
				<a class="nav-tab" href="#faq"><?php esc_html_e('FAQ/Troubleshooting','simple-debug-info-panel'); ?></a>
				<a class="nav-tab" href="#info"><?php esc_html_e('About','simple-debug-info-panel'); ?></a>
			</h2>

			<br>

			<?php 

				$warnings = false;

				if ( isset( $_GET['message'] )) { 
					if ($_GET['message'] == '1') {
						echo '<div id="message" class="fade updated"><p><strong>'.esc_html__('Settings Updated.','simple-debug-info-panel').'</strong></p></div>';
					}
				} 
				
				if ( isset( $_GET['message'] )) { 
					if ( ($simple_debug_options['sd_type'] == false) && ($simple_debug_options['sd_pids'] == false) && ($simple_debug_options['sd_themename'] == false) && ($simple_debug_options['sd_template'] == false) && ($simple_debug_options['sd_categories'] == false) && ($simple_debug_options['sd_tags'] == false) && ($simple_debug_options['sd_viewport'] == false) ) {
						// No options have been selected at all
						$warnings = true;  
					}
				}

				// IF THERE ARE ERRORS, SHOW THEM
				if ( $warnings == true ) { 
					echo '<div id="message" class="error"><p><strong>'.esc_html__('WARNING','simple-debug-info-panel').'</strong></p>';
					echo '<ul style="list-style-type:disc; margin:0 0 20px 24px;">';

					if ( ($simple_debug_options['sd_type'] == false) && ($simple_debug_options['sd_pids'] == false) && ($simple_debug_options['sd_themename'] == false) && ($simple_debug_options['sd_template'] == false) && ($simple_debug_options['sd_categories'] == false) && ($simple_debug_options['sd_tags'] == false) && ($simple_debug_options['sd_viewport'] == false) ) {
						echo '<li>'.esc_html__('You have all options disabled, so the info panel will not show anything. You may want to consider disabling the plugin.','simple-debug-info-panel').'</li>';
					} 

					echo '</ul></div>';
				} 			

			?>
		
			<div class="tabs-content">

				<div id="simple-debug-main">

					<form method="post" action="admin-post.php">

						<input type="hidden" name="action" value="save_simple_debug_options" />
						<!-- Adding security through hidden referrer field -->
						<?php wp_nonce_field( 'simple_debug' ); ?>

						<table class="form-table">

							<tr><th scope="row" colspan="2">Check the boxes for the items you would like to see in the info box:</th></tr>

							<tr>
								<th scope="row"><?php esc_html_e('Type:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_type" name="sd_type" <?php if ($simple_debug_options['sd_type']  ) echo ' checked="checked" ';?> />
										<label for="sd_type"><strong><?php esc_html_e('Shows the current page\'s type (Post, Page, Archive, Home Page or Search Results)','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Post/Page IDs:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_pids" name="sd_pids" <?php if ($simple_debug_options['sd_pids']  ) echo ' checked="checked" ';?> />
										<label for="sd_pids"><strong><?php esc_html_e('Shows the current page\'s ID','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">Only POSTS and PAGES have an ID - this will not be shown if page is an Archive page or the Home Page.</p>
								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Theme name:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_themename" name="sd_themename" <?php if ($simple_debug_options['sd_themename']  ) echo ' checked="checked" ';?> />
										<label for="sd_themename"><strong><?php esc_html_e('Shows the name of the theme','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">If the current theme is a child theme, the parent theme's name will also be shown.</p>	
								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Template info:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_template" name="sd_template" <?php if ($simple_debug_options['sd_template']  ) echo ' checked="checked" ';?> />
										<label for="sd_template"><strong><?php esc_html_e('Shows which template file is being used','simple-debug-info-panel'); ?></strong></label>
									</fieldset>

									<fieldset class="theme-path">
										<input type="checkbox" id="sd_themepath" name="sd_themepath" <?php if ($simple_debug_options['sd_themepath']  ) echo ' checked="checked" ';?> />
										<label for="sd_themepath"><strong><?php esc_html_e('Include full path (e.g. "themes/twentyfifteen/single.php")','simple-debug-info-panel'); ?></strong></label>
									</fieldset>

								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Categories:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_categories" name="sd_categories" <?php if ($simple_debug_options['sd_categories']  ) echo ' checked="checked" ';?> />
										<label for="sd_categories"><strong><?php esc_html_e('List all categories a Post is assigned to','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">Only POSTS have categories - this will not be shown if page is a Page, Archive page, Home Page or Search Results page.</p>
								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Tags:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_tags" name="sd_tags" <?php if ($simple_debug_options['sd_tags']  ) echo ' checked="checked" ';?> />
										<label for="sd_tags"><strong><?php esc_html_e('List all tags assigned to a Post','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">Only POSTS have tags - this will not be shown if page is a Page, Archive page, Home Page or Search Results page.</p>
								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Viewport:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_viewport" name="sd_viewport" <?php if ($simple_debug_options['sd_viewport']  ) echo ' checked="checked" ';?> />
										<label for="sd_viewport"><strong><?php esc_html_e('Shows the size of the browser window viewport','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">Size (in pixels) is displayed &amp; updated in real time.</p>	
								</td>
							</tr>

							<tr><th scope="row" colspan="2"><hr /></th></tr>

							<tr>
								<th scope="row"><?php esc_html_e('Box Position:','simple-debug-info-panel'); ?> <a href="#" title="<?php esc_html_e('Choose where you want your info panel to be positioned.','simple-debug-info-panel'); ?>" class="help">?</a></th>
								<td class="positioning-buttons">
									<fieldset><input type="radio" id="sd_position_1" name="sd_position" value="1" <?php if ($simple_debug_options['sd_position'] == 1) {echo 'checked';} ?>><label id="pos-1" for="sd_position_1">Top left</label></fieldset>
									<fieldset><input type="radio" id="sd_position_2" name="sd_position" value="2" <?php if ($simple_debug_options['sd_position'] == 2) {echo 'checked';} ?>><label id="pos-2" for="sd_position_2">Top right</label></fieldset>
									<fieldset><input type="radio" id="sd_position_3" name="sd_position" value="3" <?php if ($simple_debug_options['sd_position'] == 3) {echo 'checked';} ?>><label id="pos-3" for="sd_position_3">Bottom left</label></fieldset>
									<fieldset><input type="radio" id="sd_position_4" name="sd_position" value="4" <?php if ($simple_debug_options['sd_position'] == 4) {echo 'checked';} ?>><label id="pos-4" for="sd_position_4">Bottom right</label></fieldset>
								</td>
							</tr>							

							<tr>
								<th scope="row"><?php esc_html_e('Default state on load:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_admin" name="sd_loadopen" <?php if ($simple_debug_options['sd_loadopen']  ) echo ' checked="checked" ';?> />
										<label for="sd_loadopen"><strong><?php esc_html_e('Info panel is open op page load','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">When this is not checked, the debug infobox will be minimized on any page (re)load.</p>	
								</td>
							</tr>

							<tr>
								<th scope="row"><?php esc_html_e('Admin only:','simple-debug-info-panel'); ?> </th>
								<td>
									<fieldset>
										<input type="checkbox" id="sd_admin" name="sd_admin" <?php if ($simple_debug_options['sd_admin']  ) echo ' checked="checked" ';?> />
										<label for="sd_admin"><strong><?php esc_html_e('Info panel will only show on front-end to Administrators','simple-debug-info-panel'); ?></strong></label>
									</fieldset>
									<p class="description">When this is not checked, EVERY SINGLE SITE VISITOR will see the debug infobox.</p>	
								</td>
							</tr>


						</table>

						<input type="submit" value="<?php esc_html_e('SAVE SETTINGS','simple-debug-info-panel'); ?>" class="button-primary"/>

						<p>&nbsp;</p>
					</form>


				</div>

				<div id="simple-debug-faq">
					<?php include 'assets/faq.php'; ?>
				</div>

				<div id="simple-debug-info">
					<?php include 'assets/plugin-info.php'; ?>
				</div>				

			</div>

		</div>

	</div>

	<?php
	}
}


if (!function_exists('simple_debug_admin_init')) {
	function simple_debug_admin_init() {
		add_action( 'admin_post_save_simple_debug_options', 'process_simple_debug_options' );
	}
}

/**
 * --- PROCESS THE SETTINGS FORM AFTER SUBMITTING ------------------------------------------------------
 */
if (!function_exists('process_simple_debug_options')) {
	function process_simple_debug_options() {

		if ( !current_user_can( 'manage_options' ))
			wp_die( 'Not allowed');

		check_admin_referer('simple_debug');
		$options = get_option('simple_debug_options');

		$xxx = wp_nonce_field( 'simple_debug' );

		foreach ( array('sd_type') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}
		foreach ( array('sd_pids') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sd_themename') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}


		foreach ( array('sd_themepath') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sd_template') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sd_categories') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sd_tags') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}				

		foreach ( array('sd_viewport') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sd_position') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field(wp_unslash($_POST[$option_name] ));
			} 
		}

		foreach ( array('sd_loadopen') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sd_admin') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		update_option( 'simple_debug_options', $options );	
 		wp_redirect( add_query_arg(
 			array('page' => 'simpledebugmenu', 'message' => '1'),
 			admin_url( 'options-general.php' ) 
 			)
 		);	

		exit;
	}
}


/**
 * --- ADD THE .CSS AND .JS TO ADMIN MENU --------------------------------------------------------------
 */
if (!function_exists('simple_debug_styles')) {
	function simple_debug_styles($hook) {
		if ($hook != 'settings_page_simpledebugmenu') {
			return;
		}

		wp_register_script('simpleDebugAdminScript', plugins_url('/assets/js/simple-debug-admin.js', __FILE__), array( 'jquery' ),  '1.0.2', array( 'in_footer' => true ));
		wp_enqueue_script('simpleDebugAdminScript');

		wp_register_style('simpleDebugAdminStyle', plugins_url('/assets/css/simple-debug-admin.css', __FILE__),'', '1.0.2' );
	    wp_enqueue_style('simpleDebugAdminStyle');		
	}
}


/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

$plugin = plugin_basename(__FILE__); 

register_activation_hook( __FILE__, 'simple_debug_default_options' );
add_action('wp_enqueue_scripts', 'load_simple_debug');
add_action('admin_menu', 'simple_debug_menu');
add_action('admin_init', 'simple_debug_admin_init' );
add_action('admin_enqueue_scripts', 'simple_debug_styles' );
add_filter("plugin_action_links_$plugin", 'simple_debug_settings_link' );
