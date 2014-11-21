<?php
	/*
	Plugin Name: WS Theme Options
	Plugin URI:	https://bitbucket.org/lrswebsolutions/ws-theme-options
	Description: Universal theme options providing advanced geolocation, icons, analytics, remarketing, and web font fields sitewide and post/page specific. For use in addition to a full featured SEO plugin such as Wordpress SEO by Yoast.
	Version: 2.0.0
	Author: LRS Web Solutions/AJ Troxell
	License: GNU General Public License v2
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: ws-theme-options
	Bitbucket Plugin URI: https://bitbucket.org/lrswebsolutions/ws-theme-options
	*/

	/* ===========================================================================
	Post/Page Custom Fields
	============================================================================== */
		add_action( 'add_meta_boxes', 'add_seo_meta' );
		function add_seo_meta() {

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
		    		'seo-meta',
		    		__( 'SEO Extras' ),
		    		'seo_meta_cb',
		    		$screen,
		    		'advanced',
		    		'low'
		    	);

		    }
		}

		function seo_meta_cb( $post ) {
		    $email = get_post_meta( $post->ID, 'email', true );
		    $phone = get_post_meta( $post->ID, 'phone', true );
		    $fax = get_post_meta( $post->ID, 'fax', true );
		    $latitude = get_post_meta( $post->ID, 'latitude', true );
		    $longitude = get_post_meta( $post->ID, 'longitude', true );
		    $address = get_post_meta( $post->ID, 'address', true );
		    $locality = get_post_meta( $post->ID, 'locality', true );
		    $region = get_post_meta( $post->ID, 'region', true );
		    $postal_code = get_post_meta( $post->ID, 'postal_code', true );
		    $country = get_post_meta( $post->ID, 'country', true );
		    $google_author = get_post_meta( $post->ID, 'google_author', true );
		    $google_remarketing = get_post_meta( $post->ID, 'google_remarketing', true );

		    // Nonce to verify intention later
		    wp_nonce_field( 'save_seo_meta', 'seo_nonce' );
		    ?>
		    <p>
		        <label for="email">Email</label>
		        <input type="text" class="widefat" id="email" name="email" value="<?php echo $email; ?>" />
		    </p>
		    <p>
		        <label for="phone">Phone Number</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $phone; ?>" />
		    </p>
			<p>
		        <label for="fax">Fax Number</label>
		        <textarea class="widefat" id="fax" name="fax" rows="3"><?php echo $fax; ?></textarea>
		    </p>
		    <p>
		        <label for="latitude">Latitude</label>
		        <textarea class="widefat" id="latitude" name="latitude" rows="3"><?php echo $latitude; ?></textarea>
		    </p>
		    <p>
		        <label for="longitude">Longitude</label>
		        <textarea class="widefat" id="longitude" name="longitude" rows="3"><?php echo $longitude; ?></textarea>
		    </p>
		    <p>
		        <label for="address">Address</label>
		        <input type="text" class="widefat" id="address" name="address" value="<?php echo $address; ?>" />
		    </p>
		    <p>
		        <label for="seo-locality">Locality</label>
		        <input type="text" class="widefat" id="locality" name="locality" value="<?php echo $locality; ?>" />
		    </p>
		    <p>
		        <label for="region">Region</label>
		        <textarea class="widefat" id="region" name="region" rows="3"><?php echo $region; ?></textarea>
		    </p>
		    <p>
		        <label for="postal_code">Postal Code</label>
		        <textarea class="widefat" id="postal_code" name="postal_code" rows="3"><?php echo $postal_code; ?></textarea>
		    </p>
		    <p>
		        <label for="country">Country</label>
		        <textarea class="widefat" id="country" name="country" rows="3"><?php echo $country; ?></textarea>
		    </p>
		    <p>
		        <label for="google_author">Google Author</label>
		        <textarea class="widefat" id="google_author" name="google_author" rows="3"><?php echo $google_author; ?></textarea>
		    </p>
		    <p>
		        <label for="google_remarketing">Google Remarketing</label>
		        <textarea class="widefat" id="google_remarketing" name="google_remarketing" rows="3"><?php echo $google_remarketing; ?></textarea>
		    </p>
		    <?php
		}

		add_action( 'save_post', 'seo_meta_save' );

		function seo_meta_save( $id ) {
		    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		    if( !isset( $_POST['seo_nonce'] ) || !wp_verify_nonce( $_POST['seo_nonce'], 'save_seo_meta' ) ) return;

		    if( !current_user_can( 'edit_post' ) ) return;

		    if( isset( $_POST['_seo_title'] ) )
		        update_post_meta( $id, '_seo_title', esc_attr( strip_tags( $_POST['_seo_title'] ) ) );
		    if( isset( $_POST['_seo_keywords'] ) )
		        update_post_meta( $id, '_seo_keywords', esc_attr( strip_tags( $_POST['_seo_keywords'] ) ) );
		    if( isset( $_POST['_seo_description'] ) )
		        update_post_meta( $id, '_seo_description', esc_attr( strip_tags( $_POST['_seo_description'] ) ) );
		    if( isset( $_POST['_seo_geolocation'] ) )
		        update_post_meta( $id, '_seo_geolocation', esc_attr( strip_tags( $_POST['_seo_geolocation'] ) ) );
		    if( isset( $_POST['_seo_extras'] ) )
		        update_post_meta( $id, '_seo_extras', esc_attr( strip_tags( $_POST['_seo_extras'] ) ) );
		    if( isset( $_POST['_seo_redirect'] ) )
		        update_post_meta( $id, '_seo_redirect', esc_attr( strip_tags( $_POST['_seo_redirect'] ) ) );
		    if( isset( $_POST['_seo_google_plus_author'] ) )
		        update_post_meta( $id, '_seo_google_plus_author', esc_attr( strip_tags( $_POST['_seo_google_plus_author'] ) ) );
		    if( isset( $_POST['_seo_google_remarketing'] ) )
		        update_post_meta( $id, '_seo_google_remarketing', esc_attr( strip_tags( $_POST['_seo_google_remarketing'] ) ) );
		}

	/* ===========================================================================
	Theme Options
	============================================================================== */
		add_action( 'admin_init', 'theme_options_init' );
		add_action( 'admin_menu', 'theme_options_add_page' );

		function theme_options_admin_scripts() {
			if ( is_admin() ){ // for Admin Dashboard Only
				// Embed the Script on our Plugin's Option Page Only
				if ( isset($_GET['page']) && $_GET['page'] == 'ws_theme_options' ) {
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
		function theme_options_init(){
			register_setting( 'lrs_options', 'ws_theme_options', 'theme_options_validate' );
		}

		function admin_register_head() {
		    echo '<link rel="stylesheet" type="text/css" href="' . plugins_url( 'assets/css/options.css' , __FILE__ ) . '" />';

		    $enquire = '//cdnjs.cloudflare.com/ajax/libs/enquire.js/2.0.0/enquire.min.js';
		    echo "<script type='text/javascript' src='$enquire'></script>\n";

			echo '<script type="text/javascript" src="' . plugins_url( 'assets/js/options.min.js' , __FILE__ ) . '"></script>';
		}

		add_action('admin_head', 'admin_register_head');

		$current_theme = wp_get_theme();
		$theme_slug = $current_theme->get( 'TextDomain' );


	/* ===========================================================================
	Load up the menu page
	============================================================================== */
		function theme_options_add_page() {
			add_theme_page( __( 'WS Theme Options', 'ws_theme_options' ), __( 'WS Theme Options', 'ws_theme_options' ), 'edit_theme_options', 'ws_theme_options', 'theme_options_do_page' );
		}

	/* ===========================================================================
	Create the options page
	============================================================================== */
		function theme_options_do_page() {
			global $select_options, $search_options, $tagline_options, $logo_options;

			if ( ! isset( $_REQUEST['settings-updated'] ) )
				$_REQUEST['settings-updated'] = false;
			?>

			<!-- wrap -->
			<div class="wrap-options">
				<?php screen_icon(); echo "<div class='header'><h2><i class='dashicons dashicons-hammer'></i>" . __( ' WS Theme Options', 'ws_theme_options' ) . "</h2></div>"; ?>

				<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
					<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ws_theme_options' ); ?></strong></p></div>
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
							<?php settings_fields( 'lrs_options' ); ?>
							<?php $options = get_option( 'ws_theme_options' ); ?>

							<!-- options panel general -->
							<div class="theme-options-panel-section" id="theme-options-panel-section-general">
								<p>These replace default meta information added in by Wordpress, most importantly for the homepage. Meta fields on individual pages will override these values.</p>
								<table class="form-table table-options">
									<tbody>
										<?php
											$general = array(
												array(
													"Input" => "email",
													"Label" => "Email",
													"Description" => ""
												),
												array(
													"Input" => "phone",
													"Label" => "Phone",
													"Description" => ""
												),
												array(
													"Input" => "fax",
													"Label" => "Fax",
													"Description" => ""
												),
												array(
													"Input" => "latitude",
													"Label" => "Latitude",
													"Description" => ""
												),
												array(
													"Input" => "longitude",
													"Label" => "Longitude",
													"Description" => ""
												),
												array(
													"Input" => "address",
													"Label" => "Address",
													"Description" => ""
												),
												array(
													"Input" => "locality",
													"Label" => "Locality",
													"Description" => "City, area, etc."
												),
												array(
													"Input" => "region",
													"Label" => "Region",
													"Description" => "State, district, etc."
												),
												array(
													"Input" => "postal_code",
													"Label" => "Postal Code",
													"Description" => ""
												),
												array(
													"Input" => "country",
													"Label" => "Country",
													"Description" => ""
												)
											);
											foreach ( $general as $input ) {
										        echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='ws_theme_options[".$input['Input']."]' class='regular-text' type='text' name='ws_theme_options[".$input['Input']."]' value='";
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
													"Input" => "favicon",
													"Label" => "Favicon",
													"Description" => "Dimensions: 16x16 pixels | Filename: favicon.ico"
												),
												array(
													"Input" => "icon144retina",
													"Label" => "iPad retina",
													"Description" => "Dimensions: 144x144 pixels | Filename: apple-touch-icon-144x144.png"
												),
												array(
													"Input" => "icon114retina",
													"Label" => "iPhone retina",
													"Description" => "Dimensions: 114x114 pixels | Filename: apple-touch-icon-114x114.png"
												),
												array(
													"Input" => "icon72",
													"Label" => "iPad 2, iPhone 3",
													"Description" => "Dimensions: 72x72 pixels | Filename: apple-touch-icon--72x72.png"
												),
												array(
													"Input" => "icon57",
													"Label" => "iPhone 3Gs / iPod Touch",
													"Description" => "Dimensions: 57x57 pixels | Filename: apple-touch-icon-57x57.png"
												),
												array(
													"Input" => "metro",
													"Label" => "Win 8 Start Icon",
													"Description" => "Dimensions: 144x144 pixels | Filename: metro-icon.png (preferably single color)"
												),
												array(
													"Input" => "metrobg",
													"Label" => "Win 8 Start Icon Background",
													"Description" => "HEX value, e.g., #cc2127"
												)
											);
											foreach ( $images as $input ) {
												echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='ws_theme_options[".$input['Input']."]' class='regular-text ".$input['Input']."' type='text' name='ws_theme_options[".$input['Input']."]' value='";
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
													"Input" => "google_author",
													"Label" => "Google Author URL",
													"Description" => ""
												),
												array(
													"Input" => "google_analytics",
													"Label" => "Google Analytics",
													"Description" => "Include opening and closing script tags."
												),
												array(
													"Input" => "google_remarketing",
													"Label" => "Google Remarketing",
													"Description" => "Include opening and closing script tags."
												)

											);
											$first = true;
											foreach ( $google as $input ) {
												if ( $first ) {
													echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='ws_theme_options[".$input['Input']."]' class='regular-text' type='text' name='ws_theme_options[".$input['Input']."]' value='";
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
													echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><textarea id='ws_theme_options[".$input['Input']."]'  name='ws_theme_options[".$input['Input']."]' rows='5' cols='50' class='large-text code'>";
													echo esc_attr_e( $options[$input['Input']] );
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
													"Input" => "typekit_id",
													"Label" => "TypeKit Kit ID"
												),
												array(
													"Input" => "google_fonts",
													"Label" => "Google Fonts",
													"Description" => "Full code: &lt;link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'&gt;"
												)
											);
											foreach ( $misc as $input ) {
										        echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='ws_theme_options[".$input['Input']."]' class='regular-text' type='text' name='ws_theme_options[".$input['Input']."]' value='";
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
							<input type="submit" class="button-primary" value="<?php _e( 'Update Options', 'ws_theme_options' ); ?>"  id="theme_options_save" />
						</p>
					</form>
				</div>
			</div>
			<!-- /wrap -->


		<?php }

		/*	Sanitize and validate input. Accepts an array, return a sanitized array.
		============================================================================== */
			function theme_options_validate( $input ) {

				// Say our text option must be safe text with no HTML tags
				$inputValidateArray;
				$inputValidateArray["favicon"] = "favicon";
				$inputValidateArray["icon144retina"] = "icon144retina";
				$inputValidateArray["icon114retina"] = "icon114retina";
				$inputValidateArray["icon72"] = "icon72";
				$inputValidateArray["icon57"] = "icon57";
				$inputValidateArray["metro"] = "metro";
				$inputValidateArray["metrobg"] = "metrobg";
				foreach( $inputValidateArray as $key => $value) {
					$input[$value] = wp_filter_nohtml_kses( $input[$value] );
				}

				$inputValidateArray;
				$inputValidateArray["email"] = "email";
				$inputValidateArray["phone"] = "phone";
				$inputValidateArray["fax"] = "fax";
				$inputValidateArray["latitude"] = "latitude";
				$inputValidateArray["longitude"] = "longitude";
				$inputValidateArray["address"] = "address";
				$inputValidateArray["locality"] = "locality";
				$inputValidateArray["region"] = "region";
				$inputValidateArray["postal_code"] = "postal_code";
				$inputValidateArray["country"] = "country";
				$inputValidateArray["google_author"] = "google_author";
				$inputValidateArray["google_remarketing"] = "google_remarketing";

				$inputValidateArray["typekit_id"] = "typekit_id";
				$inputValidateArray["google_fonts"] = "google_fonts";
				foreach( $inputValidateArray as $key => $value) {
					$input[$value] = $input[$value];
				}

				return $input;
			}

	/* ===========================================================================
	Insert Values into Header
	============================================================================== */
		function seo_header() {
			global $post;

			$options = get_option('ws_theme_options');

			$email = get_post_meta( $post->ID, 'email', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['email'])) {
					echo "<meta property='og:email' content='".$options['email']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($email)) {
					echo "<meta property='og:email' content='".$email."' />";
				} else if (!empty($options['email'])) {
					echo "<meta property='og:email' content='".$options['email']."' />";
				}
			} else {
				if (!empty($options['email'])) {
					echo "<meta property='og:email' content='".$options['email']."' />";
				}
			}

			$phone = get_post_meta( $post->ID, 'phone', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['phone'])) {
					echo "<meta property='og:phone_number' content='".$options['phone']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($phone)) {
					echo "<meta property='og:phone_number' content='".$phone."' />";
				} else if (!empty($options['phone'])) {
					echo "<meta property='og:phone_number' content='".$options['phone']."' />";
				}
			} else {
				if (!empty($options['phone'])) {
					echo "<meta property='og:phone_number' content='".$options['phone']."' />";
				}
			}

			$fax = get_post_meta( $post->ID, 'fax', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['fax'])) {
					echo "<meta property='og:fax_number' content='".$options['fax']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($fax)) {
					echo "<meta property='og:fax_number' content='".$fax."' />";
				} else if (!empty($options['fax'])) {
					echo "<meta property='og:fax_number' content='".$options['fax']."' />";
				}
			} else {
				if (!empty($options['fax'])) {
					echo "<meta property='og:fax_number' content='".$options['fax']."' />";
				}
			}

			$latitude = get_post_meta( $post->ID, 'latitude', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['latitude'])) {
					echo "<meta property='og:latitude' content='".$options['latitude']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($latitude)) {
					echo "<meta property='og:latitude' content='".$latitude."' />";
				} else if (!empty($options['latitude'])) {
					echo "<meta property='og:latitude' content='".$options['latitude']."' />";
				}
			} else {
				if (!empty($options['latitude'])) {
					echo "<meta property='og:latitude' content='".$options['latitude']."' />";
				}
			}

			$longitude = get_post_meta( $post->ID, 'longitude', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['longitude'])) {
					echo "<meta property='og:longitude' content='".$options['longitude']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($longitude)) {
					echo "<meta property='og:longitude' content='".$longitude."' />";
				} else if (!empty($options['longitude'])) {
					echo "<meta property='og:longitude' content='".$options['longitude']."' />";
				}
			} else {
				if (!empty($options['longitude'])) {
					echo "<meta property='og:longitude' content='".$options['longitude']."' />";
				}
			}

			$address = get_post_meta( $post->ID, 'address', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['address'])) {
					echo "<meta property='og:street-address' content='".$options['address']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($address)) {
					echo "<meta property='og:street-address' content='".$address."' />";
				} else if (!empty($options['address'])) {
					echo "<meta property='og:street-address' content='".$options['address']."' />";
				}
			} else {
				if (!empty($options['address'])) {
					echo "<meta property='og:street-address' content='".$options['address']."' />";
				}
			}

			$locality = get_post_meta( $post->ID, 'locality', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['locality'])) {
					echo "<meta property='og:locality' content='".$options['locality']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($locality)) {
					echo "<meta property='og:locality' content='".$locality."' />";
				} else if (!empty($options['locality'])) {
					echo "<meta property='og:locality' content='".$options['locality']."' />";
				}
			} else {
				if (!empty($options['locality'])) {
					echo "<meta property='og:locality' content='".$options['locality']."' />";
				}
			}

			$region = get_post_meta( $post->ID, 'region', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['region'])) {
					echo "<meta property='og:region' content='".$options['region']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($region)) {
					echo "<meta property='og:region' content='".$region."' />";
				} else if (!empty($options['region'])) {
					echo "<meta property='og:region' content='".$options['region']."' />";
				}
			} else {
				if (!empty($options['region'])) {
					echo "<meta property='og:region' content='".$options['region']."' />";
				}
			}

			$postal_code = get_post_meta( $post->ID, 'postal_code', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['postal_code']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($postal_code)) {
					echo "<meta property='og:postal-code' content='".$postal_code."' />";
				} else if (!empty($options['postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['postal_code']."' />";
				}
			} else {
				if (!empty($options['postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['postal_code']."' />";
				}
			}

			$country = get_post_meta( $post->ID, 'country', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['country'])) {
					echo "<meta property='og:country-name' content='".$options['country']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($country)) {
					echo "<meta property='og:country-name' content='".$country."' />";
				} else if (!empty($options['country'])) {
					echo "<meta property='og:country-name' content='".$options['country']."' />";
				}
			} else {
				if (!empty($options['country'])) {
					echo "<meta property='og:country-name' content='".$options['country']."' />";
				}
			}

			if (is_front_page() || is_home()) {
				if (!empty($options['latitude']) && !empty($options['longitude'])) {
					echo "<meta name='ICBM' content='".$options['latitude'].",".$options['longitude']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($latitude) && !empty($longitude)) {
					echo "<meta name='ICBM' content='".$latitude.",".$longitude."' />";
				} else if (!empty($options['latitude']) && !empty($options['longitude'])) {
					echo "<meta name='ICBM' content='".$options['latitude'].",".$options['longitude']."' />";
				}
			} else {
				if (!empty($options['latitude']) && !empty($options['longitude'])) {
					echo "<meta name='ICBM' content='".$options['latitude'].",".$options['longitude']."' />";
				}
			}

			if (is_front_page() || is_home()) {
				if (!empty($options['latitude']) && !empty($options['longitude'])) {
					echo "<meta name='geo.position' content='".$options['latitude'].";".$options['longitude']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($latitude) && !empty($longitude)) {
					echo "<meta name='geo.position' content='".$latitude.";".$longitude."' />";
				} else if (!empty($options['latitude']) && !empty($options['longitude'])) {
					echo "<meta name='geo.position' content='".$options['latitude'].";".$options['longitude']."' />";
				}
			} else {
				if (!empty($options['latitude']) && !empty($options['longitude'])) {
					echo "<meta name='geo.position' content='".$options['latitude'].";".$options['longitude']."' />";
				}
			}

			if (is_front_page() || is_home()) {
				if (!empty($options['address']) && !empty($options['locality']) && !empty($options['region']) && !empty($options['postal_code']) && !empty($options['country'])) {
					echo "<meta name='geo.placename' content='".$options['address'].", ".$options['locality'].", ".$options['region'].$options['postal_code'].", ".$options['country']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($address) && !empty($locality) && !empty($region) && !empty($postal_code) && !empty($country)) {
					echo "<meta name='geo.placename' content='".$address.", ".$locality.", ".$region.$postal_code.", ".$country."' />";
				} else if (!empty($options['address']) && !empty($options['locality']) && !empty($options['region']) && !empty($options['postal_code']) && !empty($options['country'])) {
					echo "<meta name='geo.placename' content='".$options['address'].", ".$options['locality'].", ".$options['region'].$options['postal_code'].", ".$options['country']."' />";
				}
			} else {
				if (!empty($options['address']) && !empty($options['locality']) && !empty($options['region']) && !empty($options['postal_code']) && !empty($options['country'])) {
					echo "<meta name='geo.placename' content='".$options['address'].", ".$options['locality'].", ".$options['region'].$options['postal_code'].", ".$options['country']."' />";
				}
			}

			if (is_front_page() || is_home()) {
				if (!empty($options['country']) && !empty($options['region'])) {
					echo "<meta name='geo.region' content='".$options['country']."-".$options['region']."' />";
				}
			} else if (is_single() || is_page()) {
				if (!empty($country) && !empty($region)) {
					echo "<meta name='geo.region' content='".$country."-".$region."' />";
				} else if (!empty($options['country']) && !empty($options['region'])) {
					echo "<meta name='geo.region' content='".$options['country']."-".$options['region']."' />";
				}
			} else {
				if (!empty($options['country']) && !empty($options['region'])) {
					echo "<meta name='geo.region' content='".$options['country']."-".$options['region']."' />";
				}
			}

			$title = get_bloginfo('name');
			echo "<meta name='DC.title' content='".$title."' />";

			// typography
			if (!empty($options['typekit_id'])) {
				echo "<script type='text/javascript' src='//use.typekit.net/" . $options['typekit_id'] . ".js'></script>";
				echo "<script type='text/javascript'>try{Typekit.load();}catch(e){}</script>";
			}
			if (!empty($options['google_fonts'])) {
				echo $options['google_fonts'];
			}

			// favicon
			if (!empty($options['favicon'])) {
				echo "<link rel='icon' type='image/ico' href='" . $options['favicon'] . "' />";
			}
			// icon144
			if (!empty($options['icon144retina'])) {
				echo "<link rel='apple-touch-icon' sizes='144x144' href='" . $options['icon144retina'] . "' />";
			}
			// icon114
			if (!empty($options['icon114retina'])) {
				echo "<link rel='apple-touch-icon' sizes='114x114' href='" . $options['icon114retina'] . "' />";
			}
			// icon72
			if (!empty($options['icon72'])) {
				echo "<link rel='apple-touch-icon' sizes='72x72' href='" . $options['icon72'] . "' />";
			}
			// icon57
			if (!empty($options['icon57'])) {
				echo "<link rel='apple-touch-icon' sizes='57x57' href='" . $options['icon57'] . "' />";
			}
			// windows icon
			if (!empty($options['metro'])) {
				echo "<meta name='msapplication-TileImage' content='" . $options['metro'] . "' />";
			}
			// windows icon bg
			if (!empty($options['metrobg'])) {
				echo "<meta name='msapplication-TileColor' content='" . $options['metrobg'] . "' />";
			}

			// google author url
			$google_author = get_post_meta( $post->ID, 'google_author', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['google_author'])) {
					echo "<link href='" . $options['google_author'] . "' rel='author'/>";
				}
			} else if (is_single() || is_page()) {
				if (!empty($google_author)) {
					echo "<link href='" . $google_author . "' rel='author'/>";
				} else {
					echo "<link href='" . $options['google_author'] . "' rel='author'/>";
				}
			} else {
				if (!empty($options['google_author'])) {
					echo "<link href='" . $options['google_author'] . "' rel='author'/>";
				}
			}

			// get remarketing script if present
			$google_remarketing = get_post_meta( $post->ID, 'google_remarketing', true );
		    if (!empty($google_remarketing)) {
		    	echo $google_remarketing;
		    }
		}
		add_action( 'wp_head', 'seo_header' );

	/* ===========================================================================
	Insert Values into Footer
	============================================================================== */
		function seo_footer() {
			$options = get_option('ws_theme_options');
			// get google analytics code
			if ($options['google_analytics']) {
				echo $options['google_analytics'];
			}
		}
		add_action( 'wp_footer', 'seo_footer' );

?>
