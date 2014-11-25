<?php
	/*
	Plugin Name: WS Theme Options
	Plugin URI:	https://bitbucket.org/lrswebsolutions/ws-theme-options
	Description: Universal theme options providing advanced geolocation, app icons, custom dashboard and login logos, analytics, remarketing, and web font fields sitewide and post/page specific. For use in addition to a full featured SEO plugin such as Wordpress SEO by Yoast.
	Version: 2.1.1
	Author: LRS Web Solutions/AJ Troxell
	License: GNU General Public License v2
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: ws-theme-options
	Bitbucket Plugin URI: https://bitbucket.org/lrswebsolutions/ws-theme-options
	Bitbucket Branch: master
	*/

	/* ===========================================================================
	Post/Page Custom Fields
	============================================================================== */
		add_action( 'add_meta_boxes', 'add_wsthemeoptions_meta' );
		function add_wsthemeoptions_meta() {

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
		    		__( 'SEO Extras' ),
		    		'wsthemeoptions_meta_cb',
		    		$screen,
		    		'advanced',
		    		'low'
		    	);

		    }
		}

		function wsthemeoptions_meta_cb( $post ) {
		    $wsthemeoptions_email = get_post_meta( $post->ID, 'wsthemeoptions_email', true );
		    $wsthemeoptions_phone = get_post_meta( $post->ID, 'wsthemeoptions_phone', true );
		    $wsthemeoptions_fax = get_post_meta( $post->ID, 'wsthemeoptions_fax', true );
		    $wsthemeoptions_latitude = get_post_meta( $post->ID, 'wsthemeoptions_latitude', true );
		    $wsthemeoptions_longitude = get_post_meta( $post->ID, 'wsthemeoptions_longitude', true );
		    $wsthemeoptions_address = get_post_meta( $post->ID, 'wsthemeoptions_address', true );
		    $wsthemeoptions_locality = get_post_meta( $post->ID, 'wsthemeoptions_locality', true );
		    $wsthemeoptions_region = get_post_meta( $post->ID, 'wsthemeoptions_region', true );
		    $wsthemeoptions_postal_code = get_post_meta( $post->ID, 'wsthemeoptions_postal_code', true );
		    $wsthemeoptions_country = get_post_meta( $post->ID, 'wsthemeoptions_country', true );
		    $wsthemeoptions_google_author = get_post_meta( $post->ID, 'wsthemeoptions_google_author', true );
		    $wsthemeoptions_google_remarketing = get_post_meta( $post->ID, 'wsthemeoptions_google_remarketing', true );

		    // Nonce to verify intention later
		    wp_nonce_field( 'save_wsthemeoptions_meta', 'wsthemeoptions_nonce' );
		    ?>
		    <p>
		        <label for="email">Email</label>
		        <input type="text" class="widefat" id="email" name="email" value="<?php echo $wsthemeoptions_email; ?>" />
		    </p>
		    <p>
		        <label for="phone">Phone Number</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_phone; ?>" />
		    </p>
			<p>
		        <label for="fax">Fax Number</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_fax; ?>" />
		    </p>
		    <p>
		        <label for="latitude">Latitude</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_latitude; ?>" />
		    </p>
		    <p>
		        <label for="longitude">Longitude</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_longitude; ?>" />
		    </p>
		    <p>
		        <label for="address">Address</label>
		        <input type="text" class="widefat" id="address" name="address" value="<?php echo $wsthemeoptions_address; ?>" />
		    </p>
		    <p>
		        <label for="seo-locality">Locality</label>
		        <input type="text" class="widefat" id="locality" name="locality" value="<?php echo $wsthemeoptions_locality; ?>" />
		    </p>
		    <p>
		        <label for="region">Region</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_region; ?>" />
		    </p>
		    <p>
		        <label for="postal_code">Postal Code</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_postal_code; ?>" />
		    </p>
		    <p>
		        <label for="country">Country</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_country; ?>" />
		    </p>
		    <p>
		        <label for="google_author">Google Author</label>
		        <input type="text" class="widefat" id="phone" name="phone" value="<?php echo $wsthemeoptions_google_author; ?>" />
		    </p>
		    <p>
		        <label for="google_remarketing">Google Remarketing</label>
		        <textarea class="widefat" id="google_remarketing" name="google_remarketing" rows="3"><?php echo $wsthemeoptions_google_remarketing; ?></textarea>
		    </p>
		    <?php
		}

		add_action( 'save_post', 'wsthemeoptions_meta_save' );

		function wsthemeoptions_meta_save( $id ) {
		    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		    if( !isset( $_POST['wsthemeoptions_nonce'] ) || !wp_verify_nonce( $_POST['wsthemeoptions_nonce'], 'save_wsthemeoptions_meta' ) ) return;

		    // if ( ! current_user_can( 'edit_post', $post->ID ) ) return;

		    if( isset( $_POST['wsthemeoptions_email'] ) )
		        update_post_meta( $id, 'wsthemeoptions_email', esc_attr( strip_tags( $_POST['wsthemeoptions_email'] ) ) );
		    if( isset( $_POST['wsthemeoptions_phone'] ) )
		        update_post_meta( $id, 'wsthemeoptions_phone', esc_attr( strip_tags( $_POST['wsthemeoptions_phone'] ) ) );
		    if( isset( $_POST['wsthemeoptions_fax'] ) )
		        update_post_meta( $id, 'wsthemeoptions_fax', esc_attr( strip_tags( $_POST['wsthemeoptions_fax'] ) ) );
		    if( isset( $_POST['wsthemeoptions_latitude'] ) )
		        update_post_meta( $id, 'wsthemeoptions_latitude', esc_attr( strip_tags( $_POST['wsthemeoptions_latitude'] ) ) );
		    if( isset( $_POST['wsthemeoptions_longitude'] ) )
		        update_post_meta( $id, 'wsthemeoptions_longitude', esc_attr( strip_tags( $_POST['wsthemeoptions_longitude'] ) ) );
		    if( isset( $_POST['wsthemeoptions_address'] ) )
		        update_post_meta( $id, 'wsthemeoptions_address', esc_attr( strip_tags( $_POST['wsthemeoptions_address'] ) ) );
		    if( isset( $_POST['wsthemeoptions_locality'] ) )
		        update_post_meta( $id, 'wsthemeoptions_locality', esc_attr( strip_tags( $_POST['wsthemeoptions_locality'] ) ) );
		    if( isset( $_POST['wsthemeoptions_region'] ) )
		        update_post_meta( $id, 'wsthemeoptions_region', esc_attr( strip_tags( $_POST['wsthemeoptions_region'] ) ) );
		    if( isset( $_POST['wsthemeoptions_postal_code'] ) )
		        update_post_meta( $id, 'wsthemeoptions_postal_code', esc_attr( strip_tags( $_POST['wsthemeoptions_postal_code'] ) ) );
		    if( isset( $_POST['wsthemeoptions_country'] ) )
		        update_post_meta( $id, 'wsthemeoptions_country', esc_attr( strip_tags( $_POST['wsthemeoptions_country'] ) ) );
		    if( isset( $_POST['wsthemeoptions_google_author'] ) )
		        update_post_meta( $id, 'wsthemeoptions_google_author', esc_attr( strip_tags( $_POST['wsthemeoptions_google_author'] ) ) );
		    if( isset( $_POST['wsthemeoptions_google_remarketing'] ) )
		        update_post_meta( $id, 'wsthemeoptions_google_remarketing', esc_attr( strip_tags( $_POST['wsthemeoptions_google_remarketing'] ) ) );
		}

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
													"Description" => "Dimensions: 84x84 pixels (168x168 for hi-dpi) | Replaces the default login logo."
												),
												array(
													"Input" => "wsthemeoptions_wordpress_admin_logo",
													"Label" => "Wordpress Admin Logo",
													"Description" => "Dimensions: 28x28 pixels (40x40 for hi-dpi) | Replaces the default admin logo."
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
			global $post;

			$options = get_option('wsthemeoptions');

			$wsthemeoptions_email = get_post_meta( $post->ID, 'wsthemeoptions_email', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_email'])) {
					echo "<meta property='og:email' content='".$options['wsthemeoptions_email']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_phone = get_post_meta( $post->ID, 'wsthemeoptions_phone', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_phone'])) {
					echo "<meta property='og:phone_number' content='".$options['wsthemeoptions_phone']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_fax = get_post_meta( $post->ID, 'wsthemeoptions_fax', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_fax'])) {
					echo "<meta property='og:fax_number' content='".$options['wsthemeoptions_fax']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_latitude = get_post_meta( $post->ID, 'wsthemeoptions_latitude', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_latitude'])) {
					echo "<meta property='og:latitude' content='".$options['wsthemeoptions_latitude']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_longitude = get_post_meta( $post->ID, 'wsthemeoptions_longitude', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_longitude'])) {
					echo "<meta property='og:longitude' content='".$options['wsthemeoptions_longitude']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_address = get_post_meta( $post->ID, 'wsthemeoptions_address', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_address'])) {
					echo "<meta property='og:street-address' content='".$options['wsthemeoptions_address']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_locality = get_post_meta( $post->ID, 'wsthemeoptions_locality', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_locality'])) {
					echo "<meta property='og:locality' content='".$options['wsthemeoptions_locality']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_region = get_post_meta( $post->ID, 'wsthemeoptions_region', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_region'])) {
					echo "<meta property='og:region' content='".$options['wsthemeoptions_region']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_postal_code = get_post_meta( $post->ID, 'wsthemeoptions_postal_code', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_postal_code'])) {
					echo "<meta property='og:postal-code' content='".$options['wsthemeoptions_postal_code']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_country = get_post_meta( $post->ID, 'wsthemeoptions_country', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_country'])) {
					echo "<meta property='og:country-name' content='".$options['wsthemeoptions_country']."' />";
				}
			} else if (is_single() || is_page()) {
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

			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='ICBM' content='".$options['wsthemeoptions_latitude'].",".$options['wsthemeoptions_longitude']."' />";
				}
			} else if (is_single() || is_page()) {
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

			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_latitude']) && !empty($options['wsthemeoptions_longitude'])) {
					echo "<meta name='geo.position' content='".$options['wsthemeoptions_latitude'].";".$options['wsthemeoptions_longitude']."' />";
				}
			} else if (is_single() || is_page()) {
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

			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_address']) && !empty($options['wsthemeoptions_locality']) && !empty($options['wsthemeoptions_region']) && !empty($options['wsthemeoptions_postal_code']) && !empty($options['wsthemeoptions_country'])) {
					echo "<meta name='geo.placename' content='".$options['wsthemeoptions_address'].", ".$options['wsthemeoptions_locality'].", ".$options['wsthemeoptions_region'].$options['wsthemeoptions_postal_code'].", ".$options['wsthemeoptions_country']."' />";
				}
			} else if (is_single() || is_page()) {
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

			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_country']) && !empty($options['wsthemeoptions_region'])) {
					echo "<meta name='geo.region' content='".$options['wsthemeoptions_country']."-".$options['wsthemeoptions_region']."' />";
				}
			} else if (is_single() || is_page()) {
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

			$wsthemeoptions_title = get_bloginfo('name');
			echo "<meta name='DC.title' content='".$wsthemeoptions_title."' />";

			// typography
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
			// google author url
			$wsthemeoptions_google_author = get_post_meta( $post->ID, 'wsthemeoptions_google_author', true );
			if (is_front_page() || is_home()) {
				if (!empty($options['wsthemeoptions_google_author'])) {
					echo "<link href='" . $options['wsthemeoptions_google_author'] . "' rel='author'/>";
				}
			} else if (is_single() || is_page()) {
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
			// get remarketing script if present
			$wsthemeoptions_google_remarketing = get_post_meta( $post->ID, 'wsthemeoptions_google_remarketing', true );
		    if (!empty($wsthemeoptions_google_remarketing)) {
		    	echo $wsthemeoptions_google_remarketing;
		    }
		}
		add_action( 'wp_head', 'wsthemeoptions_header' );

	/* ===========================================================================
	Wordpress Logos
	============================================================================== */
	// wordpress login logo
	$options = get_option('wsthemeoptions');

			if (!empty($wsthemeoptions_wordpress_login_logo)) {
				$wsthemeoptions_wordpress_login_logo = $options['wsthemeoptions_wordpress_login_logo'];
				function custom_wordpress_login_logo() {
					echo "<style type='text/css'>h1 a { background-image: url(" . $GLOBALS['wsthemeoptions_wordpress_login_logo'] . ") !important; }</style>";
				}
				add_action('login_head', 'custom_wordpress_login_logo');
			}
			// wordpress admin logo
			if (!empty($wsthemeoptions_wordpress_admin_logo)) {
				$wsthemeoptions_wordpress_admin_logo = $options['wsthemeoptions_wordpress_admin_logo'];
				function custom_wordpress_admin_logo() {
				   echo '<style type="text/css">#wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li#wp-admin-bar-wp-logo .ab-icon:before { content: "" !important; } #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li#wp-admin-bar-wp-logo .ab-icon { width: 20px; background-image: url(' . $GLOBALS['wsthemeoptions_wordpress_admin_logo'] . ') !important; background-position: center 5px; background-repeat: no-repeat; background-size: 20px 20px; } @media screen and (max-width: 782px) { #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default li#wp-admin-bar-wp-logo .ab-icon { width: 52px; background-image: url(' . $GLOBALS['wsthemeoptions_wordpress_admin_logo'] . ') !important; background-position: center 8px; background-size: 28px 28px; } }</style>';
				}
				add_action('wp_before_admin_bar_render', 'custom_wordpress_admin_logo');
			}

	/* ===========================================================================
	Insert Values into Footer
	============================================================================== */
		function wsthemeoptions_footer() {
			$options = get_option('wsthemeoptions_wsthemeoptions');
			// get google analytics code
			if ($options['wsthemeoptions_google_analytics']) {
				echo $options['wsthemeoptions_google_analytics'];
			}
		}
		add_action( 'wp_footer', 'wsthemeoptions_footer' );

?>
