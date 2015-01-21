<?php
	/*
	Plugin Name: WS Theme Options
	Plugin URI:	https://github.com/ajtroxell/ws-theme-options
	Description: Universal theme options providing advanced geolocation, app icons, custom dashboard and login logos, analytics, remarketing, and web font fields sitewide and post/page specific. For use in addition to a full featured SEO plugin such as Wordpress SEO by Yoast.
	Version: 3.1.0
	Author: LRS Web Solutions/AJ Troxell
	License: GNU General Public License v2
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: ws-theme-options
	GitHub Plugin URI: https://bitbucket.org/lrswebsolutions/ws-theme-options
	GitHub Branch: master
	*/

	/* ===========================================================================
	Post/Page Custom Fields
	============================================================================== */
	function add_wsthemeoptions_post_meta() {

		$builtin = array(
		    'post',
		    'page'
		);
		$cpts = get_post_types( array(
		    'public'   => true,
		    '_builtin' => false
		) );
		$post_types = array_merge($builtin, $cpts);

		$screens = $post_types;
		foreach ( $screens as $screen ) {
	    	add_meta_box(
	    		'wsthemeoptions-meta',
	    		__( 'SEO Extras', 'ws-theme-options' ),
	    		'wsthemeoptions_post_meta_callback',
	    		$screen,
	    		'advanced',
	    		'low'
	    	);

	    }
	}
	add_action('add_meta_boxes', 'add_wsthemeoptions_post_meta');

	function wsthemeoptions_post_meta_callback( $post ) {
		// Nonce to verify intention later
	    wp_nonce_field( 'wsthemeoptions_post_meta', 'wsthemeoptions_post_meta_nonce' );

		/*
		* Use get_post_meta() to retrieve an existing value
		* from the database and use the value for the form.
		*/
	    $wsthemeoptions_post_meta_email = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_email', true );
	    $wsthemeoptions_post_meta_phone = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_phone', true );
	    $wsthemeoptions_post_meta_fax = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_fax', true );
	    $wsthemeoptions_post_meta_latitude = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_latitude', true );
	    $wsthemeoptions_post_meta_longitude = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_longitude', true );
	    $wsthemeoptions_post_meta_address = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_address', true );
	    $wsthemeoptions_post_meta_locality = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_locality', true );
	    $wsthemeoptions_post_meta_region = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_region', true );
	    $wsthemeoptions_post_meta_postal_code = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_postal_code', true );
	    $wsthemeoptions_post_meta_country = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_country', true );
	    $wsthemeoptions_post_meta_google_author = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_google_author', true );
	    $wsthemeoptions_post_meta_google_remarketing = get_post_meta( $post->ID, 'wsthemeoptions_post_meta_google_remarketing', true );

			echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_email">';
			_e( 'Email', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_email" name="wsthemeoptions_post_meta_email" value="' . esc_attr( $wsthemeoptions_post_meta_email ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_phone">';
			_e( 'Phone Number', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_phone" name="wsthemeoptions_post_meta_phone" value="' . esc_attr( $wsthemeoptions_post_meta_phone ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_fax">';
			_e( 'Fax Number', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_fax" name="wsthemeoptions_post_meta_fax" value="' . esc_attr( $wsthemeoptions_post_meta_fax ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_latitude">';
			_e( 'Latitude', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_latitude" name="wsthemeoptions_post_meta_latitude" value="' . esc_attr( $wsthemeoptions_post_meta_latitude ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_longitude">';
			_e( 'Longitude', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_longitude" name="wsthemeoptions_post_meta_longitude" value="' . esc_attr( $wsthemeoptions_post_meta_longitude ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_address">';
			_e( 'Address', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_address" name="wsthemeoptions_post_meta_address" value="' . esc_attr( $wsthemeoptions_post_meta_address ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_locality">';
			_e( 'Locality', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_locality" name="wsthemeoptions_post_meta_locality" value="' . esc_attr( $wsthemeoptions_post_meta_locality ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_region">';
			_e( 'Region', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_region" name="wsthemeoptions_post_meta_region" value="' . esc_attr( $wsthemeoptions_post_meta_region ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_postal_code">';
			_e( 'Postal Code', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_postal_code" name="wsthemeoptions_post_meta_postal_code" value="' . esc_attr( $wsthemeoptions_post_meta_postal_code ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_country">';
			_e( 'Country', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_country" name="wsthemeoptions_post_meta_country" value="' . esc_attr( $wsthemeoptions_post_meta_country ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_google_author">';
			_e( 'Google Author', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_google_author" name="wsthemeoptions_post_meta_google_author" value="' . esc_attr( $wsthemeoptions_post_meta_google_author ) . '" size="25" />';
			echo '</p>';

		    echo '<p>';
			echo '<label for="wsthemeoptions_post_meta_google_remarketing">';
			_e( 'Google Remarketing', 'ws-theme-options' );
			echo '</label>';
			echo '<input class="widefat" type="text" id="wsthemeoptions_post_meta_google_remarketing" name="wsthemeoptions_post_meta_google_remarketing" value="' . esc_attr( $wsthemeoptions_post_meta_google_remarketing ) . '" size="25" />';
			echo '</p>';
	}

	function wsthemeoptions_post_meta_data( $post_id ) {
		// Check if our nonce is set.
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_nonce'] ) ) {
			return;
		}
		// Verify that the nonce is valid.
	    if ( ! wp_verify_nonce( $_POST['wsthemeoptions_post_meta_nonce'], 'wsthemeoptions_post_meta' ) ) {
			return;
		}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		// Make sure that it is set.
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_email'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_phone'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_fax'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_latitude'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_longitude'] ) ) {
	        return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_address'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_locality'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_region'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_postal_code'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_country'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_google_author'] ) ) {
	    	return;
	    }
	    if ( ! isset( $_POST['wsthemeoptions_post_meta_google_remarketing'] ) ) {
	    	return;
	    }

	    // Sanitize user input.
		$wsthemeoptions_post_meta_email_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_email'] );
	    $wsthemeoptions_post_meta_phone_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_phone'] );
	    $wsthemeoptions_post_meta_fax_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_fax'] );
	    $wsthemeoptions_post_meta_latitude_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_latitude'] );
	    $wsthemeoptions_post_meta_longitude_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_longitude'] );
	    $wsthemeoptions_post_meta_address_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_address'] );
	    $wsthemeoptions_post_meta_locality_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_locality'] );
	    $wsthemeoptions_post_meta_region_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_region'] );
	    $wsthemeoptions_post_meta_postal_code_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_postal_code'] );
	    $wsthemeoptions_post_meta_country_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_country'] );
	    $wsthemeoptions_post_meta_google_author_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_google_author'] );
	    $wsthemeoptions_post_meta_google_remarketing_data  = sanitize_text_field( $_POST['wsthemeoptions_post_meta_google_remarketing'] );

	    // Update the meta field in the database.
		update_post_meta( $post_id, 'wsthemeoptions_post_meta_email', $wsthemeoptions_post_meta_email_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_phone', $wsthemeoptions_post_meta_phone_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_fax', $wsthemeoptions_post_meta_fax_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_latitude', $wsthemeoptions_post_meta_latitude_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_longitude', $wsthemeoptions_post_meta_longitude_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_address', $wsthemeoptions_post_meta_address_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_locality', $wsthemeoptions_post_meta_locality_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_region', $wsthemeoptions_post_meta_region_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_postal_code', $wsthemeoptions_post_meta_postal_code_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_country', $wsthemeoptions_post_meta_country_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_google_author', $wsthemeoptions_post_meta_google_author_data );
	    update_post_meta( $post_id, 'wsthemeoptions_post_meta_google_remarketing', $wsthemeoptions_post_meta_google_remarketing_data );
	}
	add_action( 'save_post', 'wsthemeoptions_post_meta_data' );

	/* ===========================================================================
	Theme Options
	============================================================================== */
		add_action( 'admin_init', 'wsthemeoptions_init' );
		add_action( 'admin_menu', 'wsthemeoptions_add_page' );

		function theme_options_admin_scripts() {
			if ( is_admin() ){ // for Admin Dashboard Only
				// Embed the Script on our Plugin's Option Page Only
				if ( isset($_GET['page']) && $_GET['page'] == 'wsthemeoptions' ) {
					wp_enqueue_script('jquery');
					wp_enqueue_media();
					wp_enqueue_script('thickbox');
				}
			}
		}

		function theme_options_admin_styles() {
			wp_enqueue_style('thickbox');
		}
		add_action( 'admin_init', 'theme_options_admin_scripts' );
		add_action('admin_init', 'theme_options_admin_styles');

	/* ===========================================================================
	Init plugin options to white list our options
	============================================================================== */
		function wsthemeoptions_init(){
			register_setting( 'wsthemeoptions_options', 'wsthemeoptions', 'wsthemeoptions_validate' );
		}

		function admin_register_head() {
		    echo '<link rel="stylesheet" type="text/css" href="' . plugins_url( 'assets/css/options.css' , __FILE__ ) . '" />';

		    $enquire = '//cdnjs.cloudflare.com/ajax/libs/enquire.js/2.0.0/enquire.min.js';
		    echo "<script type='text/javascript' src='$enquire'></script>\n";

			echo '<script type="text/javascript" src="' . plugins_url( 'assets/js/options.min.js' , __FILE__ ) . '"></script>';
		}

		add_action('admin_head', 'admin_register_head');

		// $current_theme = wp_get_theme();
		// $theme_slug = $current_theme->get( 'TextDomain' );


	/* ===========================================================================
	Load up the menu page
	============================================================================== */
		function wsthemeoptions_add_page() {
			add_menu_page( __( 'WS Theme Options', 'wsthemeoptions' ), __( 'WS Theme Options', 'wsthemeoptions' ), 'edit_theme_options', 'wsthemeoptions', 'theme_options_do_page' );
		}

	/* ===========================================================================
	Create the options page
	============================================================================== */
		function theme_options_do_page() {
			// global $select_options, $search_options, $tagline_options, $logo_options;

			if ( ! isset( $_REQUEST['settings-updated'] ) )
				$_REQUEST['settings-updated'] = false;
			?>

			<!-- wrap -->
			<div class="wrap-options">
				<?php screen_icon(); echo "<div class='header'><h2><i class='dashicons dashicons-hammer'></i>" . __( ' WS Theme Options', 'wsthemeoptions' ) . "</h2></div>"; ?>

				<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
					<div class="updated fade"><p><strong><?php _e( 'Options saved', 'wsthemeoptions' ); ?></strong></p></div>
				<?php endif; ?>

				<div class="sidebar">
					<!-- options sidebar -->
					<div id="theme-options-panel-nav">
						<a class="mobile-select"><i class="dashicons dashicons-menu"></i></a>
						<ul>
							<li>
								<a href="#theme-options-panel-section-general">General <i class="dashicons dashicons-arrow-right-alt2"></i></a>
							</li><li>
								<a href="#theme-options-panel-section-icons">Icons <i class="dashicons dashicons-arrow-right-alt2"></i></a>
							</li><li>
								<a href="#theme-options-panel-section-analytics">Analytics <i class="dashicons dashicons-arrow-right-alt2"></i></a>
							</li><li>
								<a href="#theme-options-panel-section-misc">Misc <i class="dashicons dashicons-arrow-right-alt2"></i></a>
							</li>
						</ul>
			    	</div>
			    	<!-- /options sidebar -->
			    </div>

			    <div class="content">
					<form method="post" action="options.php" id="myOptionsForm" class="form-options">
						<!-- options panel content -->
				    	<div id="theme-options-panel-content">
							<?php settings_fields( 'wsthemeoptions_options' ); ?>
							<?php $options = get_option( 'wsthemeoptions' ); ?>

							<!-- options panel general -->
							<div class="theme-options-panel-section" id="theme-options-panel-section-general">
								<p>These replace default meta information added in by Wordpress, most importantly for the homepage. Meta fields on individual pages will override these values.</p>
								<table class="form-table table-options">
									<tbody>
										<?php
											$general = array(
												array(
													"Input" => "wsthemeoptions_email",
													"Label" => "Email",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_phone",
													"Label" => "Phone",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_fax",
													"Label" => "Fax",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_latitude",
													"Label" => "Latitude",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_longitude",
													"Label" => "Longitude",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_address",
													"Label" => "Address",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_locality",
													"Label" => "Locality",
													"Description" => "City, area, etc."
												),
												array(
													"Input" => "wsthemeoptions_region",
													"Label" => "Region",
													"Description" => "State, district, etc."
												),
												array(
													"Input" => "wsthemeoptions_postal_code",
													"Label" => "Postal Code",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_country",
													"Label" => "Country",
													"Description" => ""
												)
											);
											foreach ( $general as $input ) {
										        echo "<tr valign='top'><th scope='row'><label for='wsthemeoptions[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='wsthemeoptions[".$input['Input']."]' class='regular-text' type='text' name='wsthemeoptions[".$input['Input']."]' value='";
												if (!empty($options[$input['Input']])) {
													echo esc_attr_e( $options[$input['Input']] );
												}
												echo "' class='regular-text' />";
												if (!empty($input['Description'])) {
													echo "<p class='description'>".$input['Description']."</p>";
												}
												echo "</td></tr>";
											}
										?>
									</tbody>
								</table>
							</div>
							<!-- /options panel general -->

							<!-- options panel icons -->
							<div class="theme-options-panel-section" id="theme-options-panel-section-icons">
								<p>Upload new, insert existing, or type a custom URL.</p>
								<table class="form-table table-options">
									<tbody>
										<?php
											$images = array(
												array(
													"Input" => "wsthemeoptions_favicon",
													"Label" => "Favicon",
													"Description" => "Dimensions: 16x16 pixels | Filename: favicon.ico"
												),
												array(
													"Input" => "wsthemeoptions_icon144retina",
													"Label" => "iPad retina",
													"Description" => "Dimensions: 144x144 pixels | Filename: apple-touch-icon-144x144.png"
												),
												array(
													"Input" => "wsthemeoptions_icon114retina",
													"Label" => "iPhone retina",
													"Description" => "Dimensions: 114x114 pixels | Filename: apple-touch-icon-114x114.png"
												),
												array(
													"Input" => "wsthemeoptions_icon72",
													"Label" => "iPad 2, iPhone 3",
													"Description" => "Dimensions: 72x72 pixels | Filename: apple-touch-icon--72x72.png"
												),
												array(
													"Input" => "wsthemeoptions_icon57",
													"Label" => "iPhone 3Gs / iPod Touch",
													"Description" => "Dimensions: 57x57 pixels | Filename: apple-touch-icon-57x57.png"
												),
												array(
													"Input" => "wsthemeoptions_metro",
													"Label" => "Win 8 Start Icon",
													"Description" => "Dimensions: 144x144 pixels | Filename: metro-icon.png (preferably single color)"
												),
												array(
													"Input" => "wsthemeoptions_metrobg",
													"Label" => "Win 8 Start Icon Background",
													"Description" => "HEX value, e.g., #cc2127"
												),
												array(
													"Input" => "wsthemeoptions_wordpress_login_logo",
													"Label" => "Wordpress Login Logo",
													"Description" => "Dimensions: 168x168 pixels (336x336 for hi-dpi) | Replaces the default login logo."
												),
												array(
													"Input" => "wsthemeoptions_wordpress_admin_logo",
													"Label" => "Wordpress Admin Logo",
													"Description" => "Dimensions: 20x20 pixels (40x40 for hi-dpi) | Replaces the default admin logo."
												)
											);
											foreach ( $images as $input ) {
												echo "<tr valign='top'><th scope='row'><label for='wsthemeoptions[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='wsthemeoptions[".$input['Input']."]' class='regular-text ".$input['Input']."' type='text' name='wsthemeoptions[".$input['Input']."]' value='";
												if (!empty($options[$input['Input']])) {
													echo esc_attr_e( $options[$input['Input']] );
												}
												echo "' class='regular-text' /><button type='submit' id='upload_image_button' class='upload_image_button_".$input['Input']." button-primary upload alignright'>Upload <i class='dashicons dashicons-upload'></i></button>";
												if (!empty($input['Description'])) {
													echo "<p class='description'>".$input['Description']."</p>";
												}
												echo "</td></tr>";
											}
										?>
									</tbody>
								</table>
							</div>
							<!-- /options panel icons -->

							<!-- options panel analytics -->
							<div class="theme-options-panel-section" id="theme-options-panel-section-analytics">
								<p>Google Authorship &amp; Analytics</p>
								<table class="form-table table-options">
									<tbody>
										<?php
											$google = array(
												array(
													"Input" => "wsthemeoptions_google_author",
													"Label" => "Google Author URL",
													"Description" => ""
												),
												array(
													"Input" => "wsthemeoptions_google_analytics",
													"Label" => "Google Analytics",
													"Description" => "Include opening and closing script tags."
												),
												array(
													"Input" => "wsthemeoptions_google_remarketing",
													"Label" => "Google Remarketing",
													"Description" => "Include opening and closing script tags."
												)

											);
											$first = true;
											foreach ( $google as $input ) {
												if ( $first ) {
													echo "<tr valign='top'><th scope='row'><label for='wsthemeoptions[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='wsthemeoptions[".$input['Input']."]' class='regular-text' type='text' name='wsthemeoptions[".$input['Input']."]' value='";
													if (!empty($options[$input['Input']])) {
														echo esc_attr_e( $options[$input['Input']] );
													}
													echo "' class='regular-text' />";
													if (!empty($input['Description'])) {
														echo "<p class='description'>".$input['Description']."</p>";
													}
													echo "</td></tr>";
													$first = false;
												} else {
													echo "<tr valign='top'><th scope='row'><label for='wsthemeoptions[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><textarea id='wsthemeoptions[".$input['Input']."]'  name='wsthemeoptions[".$input['Input']."]' rows='5' cols='50' class='large-text code'>";
													if (!empty($options[$input['Input']])) {
														echo esc_attr_e( $options[$input['Input']] );
													}
													echo "</textarea>";
													if (!empty($input['Description'])) {
														echo "<p class='description'>".$input['Description']."</p>";
													}
													echo "</td></tr>";
												}
											}
										?>
									</tbody>
								</table>
							</div>
							<!-- /options panel analytics -->

							<!-- options panel misc -->
							<div class="theme-options-panel-section" id="theme-options-panel-section-misc">
								<table class="form-table table-options">
									<tbody>
										<?php
											$misc = array(
												array(
													"Input" => "wsthemeoptions_typekit_id",
													"Label" => "TypeKit Kit ID"
												),
												array(
													"Input" => "wsthemeoptions_google_fonts",
													"Label" => "Google Fonts",
													"Description" => "Full code: &lt;link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'&gt;"
												)
											);
											foreach ( $misc as $input ) {
										        echo "<tr valign='top'><th scope='row'><label for='wsthemeoptions[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='wsthemeoptions[".$input['Input']."]' class='regular-text' type='text' name='wsthemeoptions[".$input['Input']."]' value='";
												if (!empty($options[$input['Input']])) {
													echo esc_attr_e( $options[$input['Input']] );
												}
												echo "' class='regular-text' />";
												if (!empty($input['Description'])) {
													echo "<p class='description'>".$input['Description']."</p>";
												}
												echo "</td></tr>";
											}
										?>
									</tbody>
								</table>
							</div>
							<!-- /options panel misc -->

						</div>
						<!-- /options panel content -->

						<p class="submit">
							<input type="submit" class="button-primary" value="<?php _e( 'Update Options', 'wsthemeoptions' ); ?>"  id="theme_options_save" />
						</p>
					</form>
				</div>
			</div>
			<!-- /wrap -->


		<?php }

		/*	Sanitize and validate input. Accepts an array, return a sanitized array.
		============================================================================== */
			function wsthemeoptions_validate( $input ) {

				// Say our text option must be safe text with no HTML tags
				$inputValidateArray;
				$inputValidateArray["wsthemeoptions_favicon"] = "wsthemeoptions_favicon";
				$inputValidateArray["wsthemeoptions_icon144retina"] = "wsthemeoptions_icon144retina";
				$inputValidateArray["wsthemeoptions_icon114retina"] = "wsthemeoptions_icon114retina";
				$inputValidateArray["wsthemeoptions_icon72"] = "wsthemeoptions_icon72";
				$inputValidateArray["wsthemeoptions_icon57"] = "wsthemeoptions_icon57";
				$inputValidateArray["wsthemeoptions_metro"] = "wsthemeoptions_metro";
				$inputValidateArray["wsthemeoptions_metrobg"] = "wsthemeoptions_metrobg";
				$inputValidateArray["wsthemeoptions_wordpress_login_logo"] = "wsthemeoptions_wordpress_login_logo";
				$inputValidateArray["wsthemeoptions_wordpress_admin_logo"] = "wsthemeoptions_wordpress_admin_logo";
				foreach( $inputValidateArray as $key => $value) {
					$input[$value] = wp_filter_nohtml_kses( $input[$value] );
				}

				$inputValidateArray;
				$inputValidateArray["wsthemeoptions_email"] = "wsthemeoptions_email";
				$inputValidateArray["wsthemeoptions_phone"] = "wsthemeoptions_phone";
				$inputValidateArray["wsthemeoptions_fax"] = "wsthemeoptions_fax";
				$inputValidateArray["wsthemeoptions_latitude"] = "wsthemeoptions_latitude";
				$inputValidateArray["wsthemeoptions_longitude"] = "wsthemeoptions_longitude";
				$inputValidateArray["wsthemeoptions_address"] = "wsthemeoptions_address";
				$inputValidateArray["wsthemeoptions_locality"] = "wsthemeoptions_locality";
				$inputValidateArray["wsthemeoptions_region"] = "wsthemeoptions_region";
				$inputValidateArray["wsthemeoptions_postal_code"] = "wsthemeoptions_postal_code";
				$inputValidateArray["wsthemeoptions_country"] = "wsthemeoptions_country";
				$inputValidateArray["wsthemeoptions_google_author"] = "wsthemeoptions_google_author";
				$inputValidateArray["wsthemeoptions_google_remarketing"] = "wsthemeoptions_google_remarketing";
				$inputValidateArray["wsthemeoptions_typekit_id"] = "wsthemeoptions_typekit_id";
				$inputValidateArray["wsthemeoptions_google_fonts"] = "wsthemeoptions_google_fonts";
				foreach( $inputValidateArray as $key => $value) {
					$input[$value] = $input[$value];
				}

				return $input;
			}

	/* ===========================================================================
	Insert Values into Header
	============================================================================== */
		function wsthemeoptions_header() {
			// get global post & ID
			global $post;
			if (is_single() || is_singular() || is_page()) {
				$id = $post->ID;
			}

			// get global theme options
			$options = get_option('wsthemeoptions');

			// get post and page option variables
			if (is_single() || is_singular() || is_page()) {
				$wsthemeoptions_email = get_post_meta( $id, 'wsthemeoptions_post_meta_email', true );
				$wsthemeoptions_phone = get_post_meta( $id, 'wsthemeoptions_post_meta_phone', true );
				$wsthemeoptions_fax = get_post_meta( $id, 'wsthemeoptions_post_meta_fax', true );
				$wsthemeoptions_latitude = get_post_meta( $id, 'wsthemeoptions_post_meta_latitude', true );
				$wsthemeoptions_longitude = get_post_meta( $id, 'wsthemeoptions_post_meta_longitude', true );
				$wsthemeoptions_address = get_post_meta( $id, 'wsthemeoptions_post_meta_address', true );
				$wsthemeoptions_locality = get_post_meta( $id, 'wsthemeoptions_post_meta_locality', true );
				$wsthemeoptions_region = get_post_meta( $id, 'wsthemeoptions_post_meta_region', true );
				$wsthemeoptions_postal_code = get_post_meta( $id, 'wsthemeoptions_post_meta_postal_code', true );
				$wsthemeoptions_country = get_post_meta( $id, 'wsthemeoptions_post_meta_country', true );
				$wsthemeoptions_google_author = get_post_meta( $id, 'wsthemeoptions_post_meta_google_author', true );
				$wsthemeoptions_google_remarketing = get_post_meta( $id, 'wsthemeoptions_post_meta_google_remarketing', true );
			}

			// og:email
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_email'])) {
					echo "<meta property='og:email' content='".$options['wsthemeoptions_email']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_email)) {
					echo "<meta property='og:email' content='".$wsthemeoptions_email."' />";
				} else if (!empty($options['wsthemeoptions_email'])) {
					echo "<meta property='og:email' content='".$options['wsthemeoptions_email']."' />";
				}
			} else {
				if (!empty($options['email'])) {
					echo "<meta property='og:email' content='".$options['email']."' />";
				}
			}
			// og:phone
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_phone'])) {
					echo "<meta property='og:phone_number' content='".$options['wsthemeoptions_phone']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_phone)) {
					echo "<meta property='og:phone_number' content='".$wsthemeoptions_phone."' />";
				} else if (!empty($options['wsthemeoptions_phone'])) {
					echo "<meta property='og:phone_number' content='".$options['wsthemeoptions_phone']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_phone'])) {
					echo "<meta property='og:phone_number' content='".$options['wsthemeoptions_phone']."' />";
				}
			}
			// og:fax
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_fax'])) {
					echo "<meta property='og:fax_number' content='".$options['wsthemeoptions_fax']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_fax)) {
					echo "<meta property='og:fax_number' content='".$wsthemeoptions_fax."' />";
				} else if (!empty($options['wsthemeoptions_fax'])) {
					echo "<meta property='og:fax_number' content='".$options['wsthemeoptions_fax']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_fax'])) {
					echo "<meta property='og:fax_number' content='".$options['wsthemeoptions_fax']."' />";
				}
			}
			// og:latitude
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_latitude'])) {
					echo "<meta property='og:latitude' content='".$options['wsthemeoptions_latitude']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_latitude)) {
					echo "<meta property='og:latitude' content='".$wsthemeoptions_latitude."' />";
				} else if (!empty($options['wsthemeoptions_latitude'])) {
					echo "<meta property='og:latitude' content='".$options['wsthemeoptions_latitude']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_latitude'])) {
					echo "<meta property='og:latitude' content='".$options['wsthemeoptions_latitude']."' />";
				}
			}
			// og:longitude
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_longitude'])) {
					echo "<meta property='og:longitude' content='".$options['wsthemeoptions_longitude']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_longitude)) {
					echo "<meta property='og:longitude' content='".$wsthemeoptions_longitude."' />";
				} else if (!empty($options['wsthemeoptions_longitude'])) {
					echo "<meta property='og:longitude' content='".$options['wsthemeoptions_longitude']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_longitude'])) {
					echo "<meta property='og:longitude' content='".$options['wsthemeoptions_longitude']."' />";
				}
			}
			// og:street
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_address'])) {
					echo "<meta property='og:street-address' content='".$options['wsthemeoptions_address']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_address)) {
					echo "<meta property='og:street-address' content='".$wsthemeoptions_address."' />";
				} else if (!empty($options['wsthemeoptions_address'])) {
					echo "<meta property='og:street-address' content='".$options['wsthemeoptions_address']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_address'])) {
					echo "<meta property='og:street-address' content='".$options['wsthemeoptions_address']."' />";
				}
			}
			// og:locality
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_locality'])) {
					echo "<meta property='og:locality' content='".$options['wsthemeoptions_locality']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_locality)) {
					echo "<meta property='og:locality' content='".$wsthemeoptions_locality."' />";
				} else if (!empty($options['wsthemeoptions_locality'])) {
					echo "<meta property='og:locality' content='".$options['wsthemeoptions_locality']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_locality'])) {
					echo "<meta property='og:locality' content='".$options['wsthemeoptions_locality']."' />";
				}
			}
			// og:region
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_region'])) {
					echo "<meta property='og:region' content='".$options['wsthemeoptions_region']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_region)) {
					echo "<meta property='og:region' content='".$wsthemeoptions_region."' />";
				} else if (!empty($options['wsthemeoptions_region'])) {
					echo "<meta property='og:region' content='".$options['wsthemeoptions_region']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_region'])) {
					echo "<meta property='og:region' content='".$options['wsthemeoptions_region']."' />";
				}
			}
			// og:postal-code
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['wsthemeoptions_postal_code']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_postal_code)) {
					echo "<meta property='og:postal-code' content='".$wsthemeoptions_postal_code."' />";
				} else if (!empty($options['wsthemeoptions_postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['wsthemeoptions_postal_code']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['wsthemeoptions_postal_code']."' />";
				}
			}
			// og:country
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_country'])) {
					echo "<meta property='og:country-name' content='".$options['wsthemeoptions_country']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_country)) {
					echo "<meta property='og:country-name' content='".$wsthemeoptions_country."' />";
				} else if (!empty($options['wsthemeoptions_country'])) {
					echo "<meta property='og:country-name' content='".$options['wsthemeoptions_country']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_country'])) {
					echo "<meta property='og:country-name' content='".$options['wsthemeoptions_country']."' />";
				}
			}
			// icbm
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='ICBM' content='".$options['wsthemeoptions_latitude'].",".$options['wsthemeoptions_longitude']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_latitude) && !empty($wsthemeoptions_longitude)) {
					echo "<meta name='ICBM' content='".$wsthemeoptions_latitude.",".$wsthemeoptions_longitude."' />";
				} else if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='ICBM' content='".$options['wsthemeoptions_latitude'].",".$options['wsthemeoptions_longitude']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='ICBM' content='".$options['wsthemeoptions_latitude'].",".$options['wsthemeoptions_longitude']."' />";
				}
			}
			// geo.position
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='geo.position' content='".$options['wsthemeoptions_latitude'].";".$options['wsthemeoptions_longitude']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_latitude) && !empty($wsthemeoptions_longitude)) {
					echo "<meta name='geo.position' content='".$wsthemeoptions_latitude.";".$wsthemeoptions_longitude."' />";
				} else if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='geo.position' content='".$options['wsthemeoptions_latitude'].";".$options['wsthemeoptions_longitude']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='geo.position' content='".$options['wsthemeoptions_latitude'].";".$options['wsthemeoptions_longitude']."' />";
				}
			}
			// geo.placename
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_address']) && !empty($options['wsthemeoptions_locality']) && !empty($options['wsthemeoptions_region']) && !empty($options['wsthemeoptions_postal_code']) && !empty($options['wsthemeoptions_country'])) {
					echo "<meta name='geo.placename' content='".$options['wsthemeoptions_address'].", ".$options['wsthemeoptions_locality'].", ".$options['wsthemeoptions_region'].$options['wsthemeoptions_postal_code'].", ".$options['wsthemeoptions_country']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_address) && !empty($wsthemeoptions_locality) && !empty($wsthemeoptions_region) && !empty($wsthemeoptions_postal_code) && !empty($wsthemeoptions_country)) {
					echo "<meta name='geo.placename' content='".$wsthemeoptions_address.", ".$wsthemeoptions_locality.", ".$wsthemeoptions_region.$wsthemeoptions_postal_code.", ".$wsthemeoptions_country."' />";
				} else if (!empty($options['wsthemeoptions_address']) && !empty($options['wsthemeoptions_locality']) && !empty($options['wsthemeoptions_region']) && !empty($options['wsthemeoptions_postal_code']) && !empty($options['wsthemeoptions_country'])) {
					echo "<meta name='geo.placename' content='".$options['wsthemeoptions_address'].", ".$options['wsthemeoptions_locality'].", ".$options['wsthemeoptions_region'].$options['wsthemeoptions_postal_code'].", ".$options['wsthemeoptions_country']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_address']) && !empty($options['wsthemeoptions_locality']) && !empty($options['wsthemeoptions_region']) && !empty($options['wsthemeoptions_postal_code']) && !empty($options['wsthemeoptions_country'])) {
					echo "<meta name='geo.placename' content='".$options['wsthemeoptions_address'].", ".$options['wsthemeoptions_locality'].", ".$options['wsthemeoptions_region'].$options['wsthemeoptions_postal_code'].", ".$options['wsthemeoptions_country']."' />";
				}
			}
			// geo.region
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_country']) && !empty($options['wsthemeoptions_region'])) {
					echo "<meta name='geo.region' content='".$options['wsthemeoptions_country']."-".$options['wsthemeoptions_region']."' />";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_country) && !empty($wsthemeoptions_region)) {
					echo "<meta name='geo.region' content='".$wsthemeoptions_country."-".$wsthemeoptions_region."' />";
				} else if (!empty($options['wsthemeoptions_country']) && !empty($options['wsthemeoptions_region'])) {
					echo "<meta name='geo.region' content='".$options['wsthemeoptions_country']."-".$options['wsthemeoptions_region']."' />";
				}
			} else {
				if (!empty($options['wsthemeoptions_country']) && !empty($options['wsthemeoptions_region'])) {
					echo "<meta name='geo.region' content='".$options['wsthemeoptions_country']."-".$options['wsthemeoptions_region']."' />";
				}
			}
			// dc.title
			$wsthemeoptions_title = get_bloginfo('name');
			echo "<meta name='DC.title' content='".$wsthemeoptions_title."' />";
			// typography collections
			if (!empty($options['wsthemeoptions_typekit_id'])) {
				echo "<script type='text/javascript' src='//use.typekit.net/" . $options['wsthemeoptions_typekit_id'] . ".js'></script>";
				echo "<script type='text/javascript'>try{Typekit.load();}catch(e){}</script>";
			}
			if (!empty($options['wsthemeoptions_google_fonts'])) {
				echo $options['wsthemeoptions_google_fonts'];
			}
			// favicon
			if (!empty($options['wsthemeoptions_favicon'])) {
				echo "<link rel='icon' type='image/ico' href='" . $options['wsthemeoptions_favicon'] . "' />";
			}
			// icon144
			if (!empty($options['wsthemeoptions_icon144retina'])) {
				echo "<link rel='apple-touch-icon' sizes='144x144' href='" . $options['wsthemeoptions_icon144retina'] . "' />";
			}
			// icon114
			if (!empty($options['wsthemeoptions_icon114retina'])) {
				echo "<link rel='apple-touch-icon' sizes='114x114' href='" . $options['wsthemeoptions_icon114retina'] . "' />";
			}
			// icon72
			if (!empty($options['wsthemeoptions_icon72'])) {
				echo "<link rel='apple-touch-icon' sizes='72x72' href='" . $options['wsthemeoptions_icon72'] . "' />";
			}
			// icon57
			if (!empty($options['wsthemeoptions_icon57'])) {
				echo "<link rel='apple-touch-icon' sizes='57x57' href='" . $options['wsthemeoptions_icon57'] . "' />";
			}
			// windows app title
			$wsthemeoptions_windows_app_title = get_bloginfo('name');
			if (!empty($wsthemeoptions_windows_app_title)) {
				echo "<meta name='application-name' content='" . $wsthemeoptions_windows_app_title . "' />";
			}
			// windows app description
			$wsthemeoptions_windows_app_description = get_bloginfo('description');
			if (!empty($wsthemeoptions_windows_app_description)) {
				echo "<meta name='msapplication-tooltip' content='" . $wsthemeoptions_windows_app_description . "' />";
			}
			// windows icon
			if (!empty($options['wsthemeoptions_metro'])) {
				echo "<meta name='msapplication-TileImage' content='" . $options['wsthemeoptions_metro'] . "' />";
			}
			// windows icon bg
			if (!empty($options['wsthemeoptions_metrobg'])) {
				echo "<meta name='msapplication-TileColor' content='" . $options['wsthemeoptions_metrobg'] . "' />";
			}
			// google authorship url
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_google_author'])) {
					echo "<link href='" . $options['wsthemeoptions_google_author'] . "' rel='author'/>";
				}
			} else if (is_single() || is_singular() || is_page()) {
				if (!empty($wsthemeoptions_google_author)) {
					echo "<link href='" . $wsthemeoptions_google_author . "' rel='author'/>";
				} else {
					echo "<link href='" . $options['wsthemeoptions_google_author'] . "' rel='author'/>";
				}
			} else {
				if (!empty($options['wsthemeoptions_google_author'])) {
					echo "<link href='" . $options['wsthemeoptions_google_author'] . "' rel='author'/>";
				}
			}
			// google remarketing
		    if (!empty($wsthemeoptions_google_remarketing)) {
		    	echo $wsthemeoptions_google_remarketing;
		    }
		}
		add_action( 'wp_head', 'wsthemeoptions_header' );

	/* ===========================================================================
	Wordpress Logos
	============================================================================== */
		// wordpress login logo
		function custom_wordpress_login_logo() {
			$options = get_option('wsthemeoptions');
			$wsthemeoptions_wordpress_login_logo = $options['wsthemeoptions_wordpress_login_logo'];
			if (!empty($wsthemeoptions_wordpress_login_logo)) {

				echo "<style type='text/css'>h1 a { width: 168px !important; height: 168px !important;background-image: url(" . $wsthemeoptions_wordpress_login_logo . ") !important; background-size: 100% !important; }</style>";
			}
		}
		add_action('login_head', 'custom_wordpress_login_logo');

		// wordpress admin logo
		function custom_wordpress_admin_logo() {
			$options = get_option('wsthemeoptions');
			$wsthemeoptions_wordpress_admin_logo = $options['wsthemeoptions_wordpress_admin_logo'];
			if (!empty($wsthemeoptions_wordpress_admin_logo)) {
			   echo '<style type="text/css">#wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li#wp-admin-bar-wp-logo .ab-icon:before { content: "" !important; } #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li#wp-admin-bar-wp-logo .ab-icon { width: 20px; background-image: url(' . $wsthemeoptions_wordpress_admin_logo . ') !important; background-position: center 5px; background-repeat: no-repeat; background-size: 20px 20px; } @media screen and (max-width: 782px) { #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li#wp-admin-bar-wp-logo .ab-icon { width: 52px; background-image: url(' . $wsthemeoptions_wordpress_admin_logo . ') !important; background-position: center 8px; background-size: 28px 28px; } }</style>';
			}
		}
		add_action('wp_before_admin_bar_render', 'custom_wordpress_admin_logo');

	/* ===========================================================================
	Insert Values into Footer
	============================================================================== */
		function wsthemeoptions_footer() {
			$options = get_option('wsthemeoptions');
			// get google analytics code
			if ($options['wsthemeoptions_google_analytics']) {
				echo $options['wsthemeoptions_google_analytics'];
			}
		}
		add_action( 'wp_footer', 'wsthemeoptions_footer' );

?>
