<?php
/**
 * Plugin Name: Club.Rescue-WP
 * Plugin URI: https://github.com/clubrescue/clubrescue-wp
 * Description: Adds features and shortcodes for integrating Club.Rescue tables in WordPress. Some settings can (i.d.t.) also be configured in the admin dashboard.
 * Version: 0.0.5
 * Requires at least: 5.4.2
 * Requires PHP: 7.3.16
 * Author: Ruud Borghouts
 * Author URI: https://ruudborghouts.nl/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 
 * Text Domain: The gettext text domain of the plugin. More information can be found in the Text Domain section of the How to Internationalize your Plugin page.
 * Domain Path: The domain path lets WordPress know where to find the translations. More information can be found in the Domain Path section of the How to Internationalize your Plugin page.
 */

// Retrieve option value's:
$crwp_settings = get_option( 'crwp_settings' ); // Array of All Options

// Use the Plugin Update Checker add-on to receive automatic update notifications and one-click upgrades from GitHub.
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/clubrescue/clubrescue-wp/',
	__FILE__,
	'clubrescue-wp'
);
	//Optional: Set the branch that contains the stable release.
	$myUpdateChecker->setBranch($crwp_settings["crwp_branch"]);
		//Alternative: If you only want updates from release assets, call the enableReleaseAssets() method instead of the branch check above.
		//$myUpdateChecker->getVcsApi()->enableReleaseAssets();
	//Optional: If you're using a private repository, specify the access token like this:
	//$myUpdateChecker->setAuthentication('cr-private-repo-token-here');
// End of the Plugin Update Checker add-on code.

//if ( is_admin() ) {
//	// we are in admin mode
//	include_once( plugin_dir_path( __FILE__ ) . 'clubrescue-wp-admin.php' );
//}

define( 'CRWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once CRWP_PLUGIN_DIR . '/clubrescue-wp-admin.php';
//register_activation_hook( __FILE__, 'crwp_activate' );

function add_plugin_links( $links ) {
	// Retrieve option value's:
	$crwp_settings = get_option( 'crwp_settings' ); // Array of All Options
	
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=cr-wp' ) .
		'">' . __('Settings') . '</a>';
	
	if($crwp_settings["crwp_links"] === "true" ) {
	$links[] .= '<a href="../' .
		$crwp_settings["crwp_otap"] .
		'" target="_blank">' . __('Your Club.Rescue') . '</a>';	
	}
	
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'add_plugin_links');

// Trigger C.R O365 authentication
function CRWP_O365_HEADERS() {
	// Retrieve option value's:
	$crwp_settings = get_option( 'crwp_settings' ); // Array of All Options
	
	//if(is_page('mijn-trb-nu')) {
	if(is_page(explode(", ",$crwp_settings["crwp_pages"]))) {
		session_start();

		if (!isset($_SESSION['token'])) {
			$_SESSION['O365_REDIRECT'] = $_SERVER['REQUEST_URI'];
			include $_SERVER['DOCUMENT_ROOT'] . '/' . $crwp_settings["crwp_otap"] . '/auth.php';
		}

		require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $crwp_settings["crwp_otap"] . '/util/msgraph/user.class.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $crwp_settings["crwp_otap"] . '/util/utility.class.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $crwp_settings["crwp_otap"] . '/util/database.class.php';

		$user = new MSGraphUser($_SESSION['token']);

		return $headers;
	}
}
add_action( 'template_redirect', 'CRWP_O365_HEADERS' ); // Will trigger the CR-O365 login only for the My CR page when activated.
//add_filter('wp_headers', 'CRWP_O365_HEADERS'); // Will trigger the CR-O365 login for the entire site when activated.

function CRWP_MyCR_data_loader( $atts = '' ){
	// Retrieve option value's:
	$crwp_settings = get_option( 'crwp_settings' ); // Array of All Options
	
    $value = shortcode_atts( array(
        'otap' => $crwp_settings["crwp_otap"],
        'source' => $crwp_settings["crwp_source"],
        'table' => $crwp_settings["crwp_variable"],
    ), $atts );
	
    //$user = wp_get_current_user(); // Disable this line when using the CR-O365 authentication instead of the legacy WP(-O365) authentication.
	include './' . $value['otap'] . '/modules/mycr/' . $value['source'] . '.php';
	$validate = $atts['table'];
	if($validate == $atts['table']){
		return ${$validate};
	}else{
		echo "No data available.";
	}
}

add_shortcode('crwp_mycr', 'CRWP_MyCR_data_loader');

/** Legacy shortcodes
function CRWP_MyCR_hardcoded_data_loader(){
	$user = wp_get_current_user();
	include './clubrescue/modules/mycr/mycr.php';
	return $memberTable;
}

add_shortcode('crwp_mycr_hardcoded_example', 'CRWP_MyCR_hardcoded_data_loader');
 */
?>