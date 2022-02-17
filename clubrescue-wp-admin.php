<?php

/**
 * The class holding all the logic for the 'Club.Rescue-WP' settings page used to configure the plugin.
 *
 * Partially generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class ClubRescueWP {
	private $club_rescue_wp_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'club_rescue_wp_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'club_rescue_wp_page_init' ) );
	}

	public function club_rescue_wp_add_plugin_page() {
		add_options_page(
			'C.R-WP', // page_title
			'C.R-WP', // menu_title
			'manage_options', // capability
			'cr-wp', // menu_slug
			array( $this, 'club_rescue_wp_create_admin_page' ) // function
		);
	}

	public function club_rescue_wp_create_admin_page() {
		$this->club_rescue_wp_options = get_option( 'crwp_settings', array(
      		'crwp_pages'        => 'my-cr',
     		'crwp_otap'         => 'clubrescue',
      		'crwp_source'       => 'mycr-attributes',
      		'crwp_variable'     => 'lidTable',
      		'crwp_errormessage' => 'My Club.Rescue is down for maintenance.
Please try again later.',
      		'crwp_css'          => 'Load variable placeholder here...',
			'crwp_links'        => 'true',
      		'crwp_branch'       => 'master'
		) ); ?>

		<div class="wrap">
			<h2><?php _e( 'Club.Rescue-WP', 'clubrescue-wp' ); ?></h2>
			<p><?php _e( 'Settings and whitelabel options for My Club.Rescue can be configured here.', 'clubrescue-wp' ); ?></p>
			<?php //settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'club_rescue_wp_option_group' );
					do_settings_sections( 'club-rescue-wp-admin' );
					submit_button();
				?>
			</form>
			
			<h3><?php _e( 'Plugin documentation', 'clubrescue-wp' ); ?></h3>
			<p><?php _e( 'The documentation for this plugin is available at <a href="https://clubrescue.github.io/crdocs-en/clubrescue/modules/mycr-wp/" target="_blank">Club.Rescue docs</a>.', 'clubrescue-wp' ); ?></p>
			 
		</div>
	<?php }

	public function club_rescue_wp_page_init() {
		register_setting(
			'club_rescue_wp_option_group', // option_group
			'crwp_settings', // option_name
			array( $this, 'club_rescue_wp_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'club_rescue_wp_setting_general', // id
			__( 'General', 'clubrescue-wp' ), // title
			array( $this, 'club_rescue_wp_general_info' ), // callback
			'club-rescue-wp-admin' // page
		);

		add_settings_section(
			'club_rescue_wp_setting_advanced', // id
			__( 'Advanced', 'clubrescue-wp' ), // title
			array( $this, 'club_rescue_wp_advanced_info' ), // callback
			'club-rescue-wp-admin' // page
		);

		add_settings_field(
			'crwp_pages', // id
			__( 'My Club.Rescue pages', 'clubrescue-wp' ), // title
			array( $this, 'crwp_pages_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_general' // section
		);

		add_settings_field(
			'crwp_otap', // id
			__( 'Whitelabel (OTAP)', 'clubrescue-wp' ), // title
			array( $this, 'crwp_otap_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_general' // section
		);

		add_settings_field(
			'crwp_source', // id
			__( 'Default source', 'clubrescue-wp' ), // title
			array( $this, 'crwp_source_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_general' // section
		);

		add_settings_field(
			'crwp_variable', // id
			__( 'Default variable', 'clubrescue-wp' ), // title
			array( $this, 'crwp_variable_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_general' // section
		);

		add_settings_field(
			'crwp_errormessage', // id
			__( 'Error message', 'clubrescue-wp' ), // title
			array( $this, 'crwp_errormessage_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_general' // section
		);
		
		add_settings_field(
			'crwp_css', // id
			__( 'Club.Rescue CSS', 'clubrescue-wp' ), // title
			array( $this, 'crwp_css_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_advanced' // section
		);

		add_settings_field(
			'crwp_links', // id
			__( 'Club.Rescue link', 'clubrescue-wp' ), // title
			array( $this, 'crwp_links_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_advanced' // section
		);

		add_settings_field(
			'crwp_branch', // id
			__( 'Branch', 'clubrescue-wp' ), // title
			array( $this, 'crwp_branch_callback' ), // callback
			'club-rescue-wp-admin', // page
			'club_rescue_wp_setting_advanced' // section
		);
	}

	public function club_rescue_wp_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['crwp_pages'] ) ) {
			$sanitary_values['crwp_pages'] = sanitize_text_field( $input['crwp_pages'] );
		}

		if ( isset( $input['crwp_otap'] ) ) {
			$sanitary_values['crwp_otap'] = sanitize_text_field( $input['crwp_otap'] );
		}

		if ( isset( $input['crwp_source'] ) ) {
			$sanitary_values['crwp_source'] = $input['crwp_source'];
		}

		if ( isset( $input['crwp_variable'] ) ) {
			$sanitary_values['crwp_variable'] = $input['crwp_variable'];
		}

		if ( isset( $input['crwp_errormessage'] ) ) {
			$sanitary_values['crwp_errormessage'] = esc_textarea( $input['crwp_errormessage'] );
		}
		
		if ( isset( $input['crwp_css'] ) ) {
			$sanitary_values['crwp_css'] = esc_textarea( $input['crwp_css'] );
		}

		if ( isset( $input['crwp_links'] ) ) {
			$sanitary_values['crwp_links'] = $input['crwp_links'];
		}

		if ( isset( $input['crwp_branch'] ) ) {
			$sanitary_values['crwp_branch'] = $input['crwp_branch'];
		}

		return $sanitary_values;
	}

	public function club_rescue_wp_section_info() {
		
	}

	public function crwp_pages_callback() {
		printf(
			'<input class="regular-text" type="text" name="crwp_settings[crwp_pages]" id="crwp_pages" value="%s">',
			isset( $this->club_rescue_wp_options['crwp_pages'] ) ? esc_attr( $this->club_rescue_wp_options['crwp_pages']) : ''
		);
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the WordPress pages that will contain the shortcodes provided by this plugin.<br>'
			  . 'Only pages listed here will provide working shortcodes cause only these pages will trigger the O365 authentication for Club.Rescue.<br>'
			  . 'Provide pages by using there page slug and seperate multiple slug\'s with , for example my-cr or my-cr, my-extra-personal-page.', 'clubrescue-wp' )
		);
	}

	public function crwp_otap_callback() {
		printf(
			'<input class="regular-text" type="text" name="crwp_settings[crwp_otap]" id="crwp_otap" value="%s">',
			isset( $this->club_rescue_wp_options['crwp_otap'] ) ? esc_attr( $this->club_rescue_wp_options['crwp_otap']) : ''
		);
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the Club.Rescue installation folder. You can change that folder\'s name to whitelabel the tool.<br>'
			  . 'A whitelabel is only usefull for users that will access Club.Rescue directly.<br>'
			  . 'As a alternative you can use the otap attribute in the shortcode to trigger a second (testing) C.R installation as a source.', 'clubrescue-wp' )
		);
	}

	public function crwp_source_callback() {
		?> <select name="crwp_settings[crwp_source]" id="crwp_source">
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-attributes') ? 'selected' : '' ; ?>
			<option value="mycr-attributes" <?php echo $selected; ?>>label attributes</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-activities') ? 'selected' : '' ; ?>
			<option value="mycr-activities" <?php echo $selected; ?>>label activities</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-internalcertifications') ? 'selected' : '' ; ?>
			<option value="mycr-internalcertifications" <?php echo $selected; ?>>label internalcertifications</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-externalcertifications') ? 'selected' : '' ; ?>
			<option value="mycr-externalcertifications" <?php echo $selected; ?>>label externalcertifications</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-externalfunctions') ? 'selected' : '' ; ?>
			<option value="mycr-externalfunctions" <?php echo $selected; ?>>label externalfunctions</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-documents') ? 'selected' : '' ; ?>
			<option value="mycr-documents" <?php echo $selected; ?>>label documents</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-actions') ? 'selected' : '' ; ?>
			<option value="mycr-actions" <?php echo $selected; ?>>label actions</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_source'] ) && $this->club_rescue_wp_options['crwp_source'] === 'mycr-expenses') ? 'selected' : '' ; ?>
			<option value="mycr-expenses" <?php echo $selected; ?>>label expenses</option>
		</select> <?php
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the My Club.Rescue submodule to use by default when not using the source attribute in the shortcode.', 'clubrescue-wp' )
		);
	}

	public function crwp_variable_callback() {
		?> <select name="crwp_settings[crwp_variable]" id="crwp_variable">
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'lidTable') ? 'selected' : '' ; ?>
			<option value="lidTable" <?php echo $selected; ?>>label lidTable</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'activiteitenTable') ? 'selected' : '' ; ?>
			<option value="activiteitenTable" <?php echo $selected; ?>>label activiteitenTable</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'verenigingsDiplomasTable') ? 'selected' : '' ; ?>
			<option value="verenigingsDiplomasTable" <?php echo $selected; ?>>label verenigingsDiplomasTable</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'bondsDiplomasTable') ? 'selected' : '' ; ?>
			<option value="bondsDiplomasTable" <?php echo $selected; ?>>label bondsDiplomasTable</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'bondsFunctiesTable') ? 'selected' : '' ; ?>
			<option value="bondsFunctiesTable" <?php echo $selected; ?>>label bondsFunctiesTable</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'documentlist_Upload OR documentlist_Dynamicname') ? 'selected' : '' ; ?>
			<option value="documentlist_Upload OR documentlist_Dynamicname" <?php echo $selected; ?>>label documentlist_Upload OR documentlist_Dynamicname</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'acties_wijzien OR acties_strandbewaking OR acties_kader') ? 'selected' : '' ; ?>
			<option value="acties_wijzien OR acties_strandbewaking OR acties_kader" <?php echo $selected; ?>>label acties_wijzien OR acties_strandbewaking OR acties_kader</option>
			<?php $selected = (isset( $this->club_rescue_wp_options['crwp_variable'] ) && $this->club_rescue_wp_options['crwp_variable'] === 'InkopenTable OR ReiskostenTable OR OvertochtenTable') ? 'selected' : '' ; ?>
			<option value="InkopenTable OR ReiskostenTable OR OvertochtenTable" <?php echo $selected; ?>>label InkopenTable OR ReiskostenTable OR OvertochtenTable</option>
		</select> <?php
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the default variable to load from the My Club.Rescue submodule used in the source attribute.', 'clubrescue-wp' )
		);
	}

	public function crwp_errormessage_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="crwp_settings[crwp_errormessage]" id="crwp_errormessage">%s</textarea>',
			isset( $this->club_rescue_wp_options['crwp_errormessage'] ) ? esc_attr( $this->club_rescue_wp_options['crwp_errormessage']) : ''
		);
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the error message which will be displayed if the My Club.Rescue pages cannot be loaded/displayed.', 'clubrescue-wp' )
		);
	}
	
	public function crwp_css_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="crwp_settings[crwp_css]" id="crwp_css">%s</textarea>',
			isset( $this->club_rescue_wp_options['crwp_css'] ) ? esc_attr( $this->club_rescue_wp_options['crwp_css']) : ''
		);
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the CSS code which will be used to displaye the My Club.Rescue pages. Change it to match your site layout.', 'clubrescue-wp' )
		);
	}

	public function crwp_links_callback() {
		$crwp_links_labeltranslation = esc_html__( 'Add a link to Club.Rescue in the plugins dashboard.', 'clubrescue-wp' );
		printf(
			'<input type="checkbox" name="crwp_settings[crwp_links]" id="crwp_links" value="true" %s> <label for=crwp_links">'.$crwp_links_labeltranslation.'</</label>',
			( isset( $this->club_rescue_wp_options['crwp_links'] ) && $this->club_rescue_wp_options['crwp_links'] === 'true' ) ? 'checked' : ''
		);
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies if a link to your local Club.Rescue installation will be displayed in the plugins dashboard.', 'clubrescue-wp' )
		);
	}

	public function crwp_branch_callback() {
		?> <fieldset><?php $checked = ( isset( $this->club_rescue_wp_options['crwp_branch'] ) && $this->club_rescue_wp_options['crwp_branch'] === 'master' ) ? 'checked' : '' ; ?>
		<label for="crwp_branch-0"><input type="radio" name="crwp_settings[crwp_branch]" id="crwp_branch-0" value="master" <?php echo $checked; ?>><?php _e( 'Master (default).', 'clubrescue-wp' ); ?></label><br>
		<?php $checked = ( isset( $this->club_rescue_wp_options['crwp_branch'] ) && $this->club_rescue_wp_options['crwp_branch'] === 'dev' ) ? 'checked' : '' ; ?>
		<label for="crwp_branch-1"><input type="radio" name="crwp_settings[crwp_branch]" id="crwp_branch-1" value="dev" <?php echo $checked; ?>><?php _e( 'Development (only for test environments).', 'clubrescue-wp' ); ?></label></fieldset> <?php
		printf(
			'<p class="description">%s</p>',
			__( 'This specifies the branch that will be used to check and deploy for updates.', 'clubrescue-wp' )
		);
	}

}

if ( is_admin() )
	$club_rescue_wp = new ClubRescueWP();
?>