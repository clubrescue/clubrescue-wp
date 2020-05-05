<?php
/**
 * Plugin Name: Club.Rescue-WP
 * Plugin URI: https://github.com/clubrescue/clubrescue-wp
 * Description: Adds features and shortcodes for integrating Club.Rescue tables in WordPress. Some settings can (i.d.t.) also be configured in the admin dashboard.
 * Version: 0.0.2
 * Requires at least: 5.4.1
 * Requires PHP: 7.3.16
 * Author: Ruud Borghouts
 * Author URI: https://ruudborghouts.nl/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 
 * Text Domain: The gettext text domain of the plugin. More information can be found in the Text Domain section of the How to Internationalize your Plugin page.
 * Domain Path: The domain path lets WordPress know where to find the translations. More information can be found in the Domain Path section of the How to Internationalize your Plugin page.
 */
 
 
// Use the Plugin Update Checker add-on to receive automatic update notifications and one-click upgrades from GitHub.
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/clubrescue/clubrescue-wp/',
	__FILE__,
	'clubrescue-wp'
);
	//Optional: Set the branch that contains the stable release.
	$myUpdateChecker->setBranch('master');
		//Alternative: If you only want updates from release assets, call the enableReleaseAssets() method instead of the branch check above.
		//$myUpdateChecker->getVcsApi()->enableReleaseAssets();
	//Optional: If you're using a private repository, specify the access token like this:
	//$myUpdateChecker->setAuthentication('cr-private-repo-token-here');
// End of the Plugin Update Checker add-on code.

if ( is_admin() ) {
	// we are in admin mode
	include_once( plugin_dir_path( __FILE__ ) . 'clubrescue-wp-admin.php' );
}
/**
function ResQWP_getUserAvatar( $avatar ){
	//if (function_exists('get_avatar')){
	//	echo get_avatar($email);
	//}else{
	////repeating code as alternate gravatar code for < 2.5
	//	$grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower($email)) . "?d=" . urlencode($default) . "&s=" . $size;
	//	echo "<img src='$grav_url'/>";
	
	//alt function code
	//Formaat digitale pasfoto: 148 pixels (breedte) x 184 pixels (hoogte)
	$OTAP = './clubredders/';
	$FOTO_FOLDER = 'pasfotos/';
	//$FOTO_CODERING = '<img src="data:image/jpeg;base64,';
	//$FOTO_STYLE = '" style="display:block;width:100%;height:100%;"/>';
	$avatar = '<img src="<' . $FOTO_FOLDER . $FOTO_FOLDER . wp_get_current_user() . '.jpg" alt="' . wp_get_current_user() . '">';
	return $avatar;
	
	//if (file_exists('./pasfotos/'.$LocPosASC_RelatieNr.'.jpg') || file_exists('././clubredders/pasfotos/'.$LocPosASC_RelatieNr.'.jpg')){
	//	$FOTO_ASC = $FOTO_CODERING.base64_encode(file_get_contents($FOTO_FOLDER . $LocPosASC_RelatieNr . '.jpg')).$FOTO_STYLE;
	//}else{
	//	$FOTO_ASC = $FOTO_CODERING.base64_encode(file_get_contents($FOTO_FOLDER . 'pasfoto.jpg')).$FOTO_STYLE;
	//}
	//}
}
add_filter( 'get_avatar', 'ResQWP_getUserAvatar' );
**/
function CRWP_getUserAttributes(){
	$user = wp_get_current_user();
	if(!is_user_logged_in()){
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=".wp_login_url( get_permalink() )."\">";
		exit;
	}else{
		include './clubredders/mijncr-attributes.php';
		return $lidTable;			
	}	
}

function CRWP_getActiviteiten(){ 
	$user = wp_get_current_user();
	include './clubredders/mijncr-activiteiten.php';
	return $activiteitenTable;
} 

function CRWP_getVerenigingsDiplomas(){
    $user = wp_get_current_user();
	include './clubredders/mijncr-verenigingsdiplomas.php';
	return $verenigingsDiplomasTable;
}

function CRWP_getBondsDiplomas(){
    $user = wp_get_current_user();
	include './clubredders/mijncr-bondsdiplomas.php';
	return $bondsDiplomasTable;
}

function CRWP_getBondsFuncties(){
    $user = wp_get_current_user();
	include './clubredders/mijncr-bondsfuncties.php';
	return $bondsFunctiesTable;
}

function CRWP_getActiesWijzigen(){
	$user = wp_get_current_user();
	include './clubredders/mijncr-acties.php';
	return $acties_wijzien;
}

function CRWP_getActiesStrandbewaking(){
	$user = wp_get_current_user();
	include './clubredders/mijncr-acties.php';
	return $acties_strandbewaking;
}

function CRWP_getActiesKader(){
	$user = wp_get_current_user();
	include './clubredders/mijncr-acties.php';
	return $acties_kader;
}

function CRWP_getDeclaratiesInkopen(){
	$user = wp_get_current_user();
	include './clubredders/mijncr-declaraties.php';
	return $InkopenTable;
}

function CRWP_getDeclaratiesReiskosten(){
	$user = wp_get_current_user();
	include './clubredders/mijncr-declaraties.php';
	return $ReiskostenTable;
}

function CRWP_getDeclaratiesOvertochten(){
	$user = wp_get_current_user();
	include './clubredders/mijncr-declaraties.php';
	return $OvertochtenTable;}

function CRWP_function( $atts = '' ){
    $value = shortcode_atts( array(
        'otap' => 'clubredders',
        'page' => 'mijncr-activiteiten',
        /**'table' => 'activiteitenTable',*/
    ), $atts );
	
    $user = wp_get_current_user();
	include './' . $value['otap'] . '/' . $value['page'] . '.php';
	echo $activiteitenTable;
}

add_shortcode('crwp_test_functie', 'CRWP_function');

add_shortcode('crwp_userattributes', 'CRWP_getUserAttributes');
add_shortcode('crwp_activiteiten', 'CRWP_getActiviteiten');
add_shortcode('crwp_verenigingsdiplomas', 'CRWP_getVerenigingsDiplomas');
add_shortcode('crwp_bondsdiplomas', 'CRWP_getBondsDiplomas');
add_shortcode('crwp_bondsfuncties', 'CRWP_getBondsFuncties');
add_shortcode('crwp_acties_wijzigen', 'CRWP_getActiesWijzigen');
add_shortcode('crwp_acties_strandbewaking', 'CRWP_getActiesStrandbewaking');
add_shortcode('crwp_acties_kader', 'CRWP_getActiesKader');
add_shortcode('crwp_declaraties_inkopen', 'CRWP_getDeclaratiesInkopen');
add_shortcode('crwp_declaraties_reiskosten', 'CRWP_getDeclaratiesReiskosten');
add_shortcode('crwp_declaraties_overtochten', 'CRWP_getDeclaratiesOvertochten');

?>