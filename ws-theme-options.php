<?php
	/*
	Plugin Name: WS Theme Options
	Plugin URI:	https://bitbucket.org/lrswebsolutions/ws-theme-options
	Description: Theme options page for meta data, seo, social, analytics, webmaster tools, and more.
	Version: 1.0.0
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

		$screens = array( 'post', 'page' );
		foreach ( $screens as $screen ) {

	    	add_meta_box(
	    		'seo-meta',
	    		__( 'SEO' ),
	    		'seo_meta_cb',
	    		$screen,
	    		'normal',
	    		'high'
	    	);

	    }
	}

	function seo_meta_cb( $post )
	{
	    // Get values for filling in the inputs if we have them.
	    $title = get_post_meta( $post->ID, '_seo_title', true );
	    $keywords = get_post_meta( $post->ID, '_seo_keywords', true );
	    $description = get_post_meta( $post->ID, '_seo_description', true );
	    $geolocation = get_post_meta( $post->ID, '_seo_geolocation', true );
	    $extras = get_post_meta( $post->ID, '_seo_extras', true );
	    $redirect = get_post_meta( $post->ID, '_seo_redirect', true );
	    $google_plus_author = get_post_meta( $post->ID, '_seo_google_plus_author', true );
	    $google_remarketing = get_post_meta( $post->ID, '_seo_google_remarketing', true );

	    // Nonce to verify intention later
	    wp_nonce_field( 'save_seo_meta', 'seo_nonce' );
	    ?>
	    <p>
	        <label for="seo-url">Title</label>
	        <input type="text" class="widefat" id="seo-title" name="_seo_title" value="<?php echo $title; ?>" />
	    </p>
	    <p>
	        <label for="seo-keywords">Keywords</label>
	        <input type="text" class="widefat" id="seo-keywords" name="_seo_keywords" value="<?php echo $keywords; ?>" />
	    </p>
		<p>
	        <label for="seo-description">Description</label>
	        <textarea class="widefat" id="seo-description" name="_seo_description" rows="3"><?php echo $description; ?></textarea>
	    </p>
	    <p>
	        <label for="seo-geolocation">Geolocation</label>
	        <textarea class="widefat" id="seo-geolocation" name="_seo_geolocation" rows="3"><?php echo $geolocation; ?></textarea>
	    </p>
	    <p>
	        <label for="seo-extras">Extras</label>
	        <textarea class="widefat" id="seo-extras" name="_seo_extras" rows="3"><?php echo $extras; ?></textarea>
	    </p>
	    <p>
	        <label for="seo-redirect">301 Redirect URL</label>
	        <input type="text" class="widefat" id="seo-redirect" name="_seo_redirect" value="<?php echo $redirect; ?>" />
	    </p>
	    <p>
	        <label for="seo-google_plus_author">Google+ Author URL</label>
	        <input type="text" class="widefat" id="seo-google_plus_author" name="_seo_google_plus_author" value="<?php echo $google_plus_author; ?>" />
	    </p>
	    <p>
	        <label for="seo-google_remarketing">Google Remarketing</label>
	        <textarea class="widefat" id="google_remarketing" name="_seo_google_remarketing" rows="3"><?php echo $google_remarketing; ?></textarea>
	    </p>
	    <?php
	}

	add_action( 'save_post', 'seo_meta_save' );
	function seo_meta_save( $id )
	{
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

/*	Init plugin options to white list our options
	========================================================================== */

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

/*	Load up the menu page
	========================================================================== */
	function theme_options_add_page() {
		add_theme_page( __( 'WS Theme Options', 'ws_theme_options' ), __( 'WS Theme Options', 'ws_theme_options' ), 'edit_theme_options', 'ws_theme_options', 'theme_options_do_page' );
	}

/* ===========================================================================
	Create the options page
	========================================================================== */
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
						<a href="#theme-options-panel-section-general">SEO <i class="dashicons dashicons-arrow-right-alt2"></i></a>
					</li><li>
						<a href="#theme-options-panel-section-icons">Icons <i class="dashicons dashicons-arrow-right-alt2"></i></a>
					</li><li>
						<a href="#theme-options-panel-section-social">Social <i class="dashicons dashicons-arrow-right-alt2"></i></a>
					</li><li>
						<a href="#theme-options-panel-section-analytics">Analytics <i class="dashicons dashicons-arrow-right-alt2"></i></a>
					</li><li>
						<a href="#theme-options-panel-section-webmastertools">Webmaster Tools <i class="dashicons dashicons-arrow-right-alt2"></i></a>
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
											"Input" => "seo_site_title",
											"Label" => "Title",
											"Description" => ""
										),
										array(
											"Input" => "seo_site_keywords",
											"Label" => "Keywords",
											"Description" => ""
										),
										array(
											"Input" => "seo_site_description",
											"Label" => "Description",
											"Description" => ""
										),
										array(
											"Input" => "seo_site_geolocation",
											"Label" => "Geolocation",
											"Description" => "Geolocation tags such as geo.position, geo.placename, geo.region, and ICBM."
										),
										array(
											"Input" => "seo_site_extra",
											"Label" => "Extras",
											"Description" => "Extra meta tags such as robots, Googlebot, audience, distribution, etc. Do not include geolocation tags here."
										)
									);
									foreach ( $general as $input ) {
									echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><textarea id='ws_theme_options[".$input['Input']."]'  name='ws_theme_options[".$input['Input']."]' rows='5' cols='50' class='large-text code'>";
									if (!empty($options[$input['Input']])) {
										echo esc_attr_e( $options[$input['Input']] );
									}
									echo "</textarea>";
									if (!empty($input['Description'])) {
										echo "<p class='description'>".$input['Description']."</p>";
									}
									echo "</td></tr>";

								} ?>
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
								} ?>
							</tbody>
						</table>
					</div>
					<!-- /options panel icons -->

					<!-- options panel social -->
					<div class="theme-options-panel-section" id="theme-options-panel-section-social">
						<table class="form-table table-options">
							<tbody>
								<?php
									$social = array(
										array(
											"Input" => "twitter",
											"Label" => "Twitter Username",
											"Description" => "Do not include @ symbol"
										),
										array(
											"Input" => "gplus_publisher",
											"Label" => "Google+ Publisher URL",
											"Description" => "Is applied sitewide"
										),
										array(
											"Input" => "gplus_author",
											"Label" => "Google+ Author URL",
											"Description" => "Is applied sitewide but overridden by individual post/page values"
										)
									);
									foreach ( $social as $input ) {
									echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='ws_theme_options[".$input['Input']."]' class='regular-text' type='text' name='ws_theme_options[".$input['Input']."]' value='";
									if (!empty($options[$input['Input']])) {
										echo esc_attr_e( $options[$input['Input']] );
									}
									echo "' class='regular-text' />";
									if (!empty($input['Description'])) {
										echo "<p class='description'>".$input['Description']."</p>";
									}
									echo "</td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
					<!-- /options panel social -->

					<!-- options panel analytics -->
					<div class="theme-options-panel-section" id="theme-options-panel-section-analytics">
						<p>Google analytics tracking code.</p>
						<table class="form-table table-options">
							<tbody>
								<?php
									$google = array(
										array(
											"Input" => "google_analytics",
											"Label" => "Javascript",
											"Description" => "Include opening and closing script tags."
										)

									);

									foreach ( $google as $input ) {
									echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><textarea id='ws_theme_options[".$input['Input']."]'  name='ws_theme_options[".$input['Input']."]' rows='10' cols='50' class='large-text code'>";
									echo esc_attr_e( $options[$input['Input']] );
									echo "</textarea>";
									if (!empty($input['Description'])) {
										echo "<p class='description'>".$input['Description']."</p>";
									}
									echo "</td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
					<!-- /options panel analytics -->

					<!-- options panel webmaster tools -->
					<div class="theme-options-panel-section" id="theme-options-panel-section-webmastertools">
						<p>Full meta tag</p>
						<table class="form-table table-options">
							<tbody>
								<?php
									$webmastertools = array(
										array(
											"Input" => "google_webmaster_tools",
											"Label" => "Google Webmaster Tools"
										),
										array(
											"Input" => "bing_webmaster_tools",
											"Label" => "Bing Webmaster Tools"
										)

									);
									foreach ( $webmastertools as $input ) {
									echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><input id='ws_theme_options[".$input['Input']."]' class='regular-text' type='text' name='ws_theme_options[".$input['Input']."]' value='";
									if (!empty($options[$input['Input']])) {
										echo esc_attr_e( $options[$input['Input']] );
									}
									echo "' class='regular-text' />";
									if (!empty($input['Description'])) {
										echo "<p class='description'>".$input['Description']."</p>";
									}
									echo "</td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
					<!-- /options panel webmaster tools -->

					<!-- options panel misc -->
					<div class="theme-options-panel-section" id="theme-options-panel-section-misc">
						<table class="form-table table-options">
							<tbody>
								<?php
									$misc = array(
										array(
											"Input" => "typekit_id",
											"Label" => "TypeKit ID"
										),
										array(
											"Input" => "google_fonts",
											"Label" => "Google Fonts",
											"Description" => "Full code: &lt;link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'&gt;"
										)
									);

									$first = true;
									foreach ( $misc as $input ) {
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
									        echo "<tr valign='top'><th scope='row'><label for='ws_theme_options[".$input['Input']."]'>".$input['Label']."</label></th></tr><tr><td><textarea id='ws_theme_options[".$input['Input']."]'  name='ws_theme_options[".$input['Input']."]' rows='10' cols='50' class='large-text code'>";
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
			========================================================================== */

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
		$inputValidateArray["seo_site_title"] = "seo_site_title";
		$inputValidateArray["seo_site_keywords"] = "seo_site_keywords";
		$inputValidateArray["seo_site_description"] = "seo_site_description";
		$inputValidateArray["seo_site_geolocation"] = "seo_site_geolocation";
		$inputValidateArray["seo_site_extra"] = "seo_site_extra";
		$inputValidateArray["twitter"] = "twitter";
		$inputValidateArray["gplus_publisher"] = "gplus_publisher";
		$inputValidateArray["gplus_author"] = "gplus_author";
		$inputValidateArray["copyright"] = "copyright";
		$inputValidateArray["google_analytics"] = "google_analytics";
		$inputValidateArray["google_webmaster_tools"] = "google_webmaster_tools";
		$inputValidateArray["bing_webmaster_tools"] = "bing_webmaster_tools";
		$inputValidateArray["typekit_id"] = "typekit_id";
		$inputValidateArray["google_fonts"] = "google_fonts";
		foreach( $inputValidateArray as $key => $value) {
			$input[$value] = $input[$value];
		}

		return $input;

	}

	function seo_header() {
		global $post;

		$options = get_option('ws_theme_options');

		//// seo
		// get post/page meta_title if present or default
		$meta_title = get_post_meta( $post->ID, '_seo_title', true );
		if (!empty($meta_title)) {
			echo "<title>" . $meta_title . "</title>";
		} else {
			echo "<title>" . $options['seo_site_title'] . "</title>";
		}

		// get post/page meta_keywords if present or default
		$meta_keywords = get_post_meta( $post->ID, '_seo_keywords', true );
		if (!empty($meta_keywords)) {
			echo "<meta http-equiv='keywords' name='keywords' content='" . $meta_keywords . "'/>";
		} else {
			echo "<meta http-equiv='keywords' name='keywords' content='" . $options['seo_site_keywords'] . "'/>";
		}

		// get post/page meta_description if present or default
		$meta_description = get_post_meta( $post->ID, '_seo_description', true );
		if (!empty($meta_description)) {
			echo "<meta http-equiv='description' content='" . $meta_description . "'/>";
		} else {
			echo "<meta http-equiv='description' content='" . $options['seo_site_description'] . "'/>";
		}

		// google webmaster tools
		if (!empty($options['google_webmaster_tools'])) {
			echo $options['google_webmaster_tools'];
		}

		// bing webmaster tools
		if (!empty($options['bing_webmaster_tools'])) {
			echo $options['bing_webmaster_tools'];
		}

		// get post/page meta_geolocation if present or default
		$meta_geolocation = get_post_meta( $post->ID, '_seo_geolocation', true );
		if (!empty($meta_geolocation)) {
			echo $meta_geolocation;
		} else {
			echo $options['seo_site_geolocation'];
		}

		// get post/page meta_extra if present or default
		$meta_extra = get_post_meta( $post->ID, '_seo_extras', true );
		if (!empty($meta_extra)) {
			echo $meta_extra;
		} else {
			echo $options['seo_site_extra'];
		}

		// typography
		if (!empty($options['typekit_id'])) {
			echo "<script type='text/javascript' src='//use.typekit.net/" . $options['typekit_id'] . ".js'></script>";
			echo "<script type='text/javascript'>try{Typekit.load();}catch(e){}</script>";
		}
		if (!empty($options['google_fonts'])) {
			echo $options['google_fonts'];
		}

		// twitter card
		$thumbnail = $options['icon144retina'];
		$twitter = $options['twitter'];
		if (!empty($twitter)) {
		    echo "<meta name='twitter:card' content='summary'>";
		    echo "<meta name='twitter:image' content='" . $thumbnail . "'>";
		    echo "<meta name='twitter:site' content='@" . $twitter . "'>";
		    echo "<meta name='twitter:creator' content='@" . $twitter . "'>";
		}

		// open graph
		echo "<meta property='og:title' content='";
			echo the_title();
		echo "'/>";

		echo "<meta property='og:description' content='" . the_excerpt_rss() . "' />";
		echo "<meta property='og:url' content='";
			echo the_permalink();
		echo "'/>";

		$fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail');

		if (!empty($fb_image)) {
		    echo "<meta property='og:image' content='" . $fb_image[0] . "' />";
		} else {
			echo "<meta property='og:image' content='" . $thumbnail . "' />";
		}

		echo "<meta property='og:type' content='";
			if (is_single() || is_page()) {
				echo 'article';
			} else {
				echo 'website';
			}
		echo "/>";

		echo "<meta property='og:site_name' content='";
			echo bloginfo('name');
		echo "'/>";

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

		// 301 redirect
		$meta_redirect = get_post_meta( $post->ID, 'seo_page_redirect', true );
	    if (!empty($meta_redirect)) {
	    	header('HTTP/1.1 301 Moved Permanently');
			header('Location:' . $meta_redirect);
			exit;
	    }

		// google publisher url
		if (!empty($options['gplus_publisher'])) {
			echo "<link href='" . $options['gplus_publisher'] . "' rel='publisher'/>";
		}

		// google author url
		$seo_gplus_author = get_post_meta( $post->ID, '_seo_google_plus_author', true );
		if (!empty($seo_gplus_author)) {
			echo "<link href='" . $seo_gplus_author . "' rel='author'/>";
		} else {
			echo "<link href='" . $options['gplus_author'] . "' rel='author'/>";
		}

		// get remarketing script if present
		$remarketing = get_post_meta( $post->ID, '_seo_google_remarketing', true );
	    if (!empty($remarketing)) {
	    	echo $remarketing;
	    }

	}
	add_action( 'wp_head', 'seo_header' );

function seo_footer() {
	$options = get_option('ws_theme_options');
	// get google analytics code
	if ($options['google_analytics']) {
		echo $options['google_analytics'];
	}
}
add_action( 'wp_footer', 'seo_footer' );


?>
