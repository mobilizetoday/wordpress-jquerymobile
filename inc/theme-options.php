<?php
/**
 * Theme Options
 */

function jqmobile_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'jqmobile-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2011-04-28' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'jqmobile_admin_enqueue_scripts' );

function jqmobile_theme_options_init() {
	if ( false === jqmobile_get_theme_options() )
		add_option( 'jqmobile_theme_options', jqmobile_get_default_theme_options() );

	register_setting(
		'jqmobile_options',
		'jqmobile_theme_options',
		'jqmobile_theme_options_validate'
	);

	wp_enqueue_script( 'jquery-ui-tabs' );
}
add_action( 'admin_init', 'jqmobile_theme_options_init' );

function jqmobile_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'jqmobile' ),
		__( 'Theme Options', 'jqmobile' ),
		'edit_theme_options',
		'theme_options',
		'jqmobile_theme_options_render_page'
	);

	if ( ! $theme_page )
		return;

	$help = '<p>' . __( 'Your current theme, jQMobile, provides Basic and Advanced settings. See descriptions below.', 'jqmobile' ) . '</p>' .
		'<p><strong>Basic Settings</strong></p>' .
		'<ol>' .
			'<li>' . __( '<strong>Color Scheme</strong>: Here you can choose one of the available color schemes for your website. By default three schemes are available: "Default", "Valencia" and "Green".', 'jqmobile' ) . '</li>' .
			'<li>' . __( '<strong>Upload Scheme</strong>: Optionally you may create your own color scheme using <a href="http://jquerymobile.com/themeroller/" target="_blank">ThemeRoller Mobile</a>. Once your custom scheme is created and downloaded you may upload it here by clicking "Upload" button.', 'jqmobile' ) . '</li>' .
			'<li>' . __( '<strong>Mobile Layout</strong>: Here you may control the position of the sidebar. It can be left- or right-side aligned.', 'jqmobile' ) . '</li>' .
		'</ol>' .

		'<p><strong>' . __( 'Advanced Settings', 'jqmobile' ) . '</strong></p>' .
		'<p>' . __( 'You may use advanced settings for tuning up your custom created color scheme downloaded from <a href="http://jquerymobile.com/themeroller/" target="_blank">ThemeRoller Mobile</a>.', 'jqmobile' ) . '</p>' .
		'<p>' . __( 'ThemeRoller Mobile allows you to create up to 26 unique color "swatches" marked by letters from "a" to "z". Each swatch defines the look and feel for a bar, content block and a button with normal, hover and pressed interaction states. Within your site, you may assign swatch letters to the elements on a page to mix and match swatch colors for really rich designs. The elements available for customizing are: "Header", "Body", "Footer", "Post Teaser", "Sticky Post", "Widget", "Widget Content", "Comments" and "Comment Form".', 'jqmobile' ) . '</p>' .

		'<p>' . __( 'Don\'t forget to click "Save Changes" to save all the updates have made to the jQMobile theme options.', 'jqmobile' ) . '</p>' .
		'<p><strong>' . __( 'For more information:', 'jqmobile' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://jquerymobile.com/" target="_blank">jQuery Mobile</a>', 'jqmobile' ) . '</p>'.
		'<p>' . __( '<a href="http://jquerymobile.com/themeroller/" target="_blank">ThemeRoller</a>', 'jqmobile' ) . '</p>'.
		'<p>' . __( '<a href="http://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'jqmobile' ) . '</p>';

	add_contextual_help( $theme_page, $help );
}
add_action( 'admin_menu', 'jqmobile_theme_options_add_page' );


function jqmobile_color_schemes() {

	$color_scheme_options = jqmobile_theme_directories();

	if (!sizeof($color_scheme_options)) return false;

	return apply_filters( 'jqmobile_color_schemes', $color_scheme_options );
}

function jqmobile_theme_directories() {

		$theme_root = dirname(__DIR__ )."/themes";
		$themes_dir = @opendir($theme_root);

		$theme_files = array();

		if ( !$themes_dir )
			return false;

		while ( ($theme_dir = readdir($themes_dir)) !== false ) {

			if ( is_dir($theme_root . '/' . $theme_dir) && is_readable($theme_root . '/' . $theme_dir) ) {
				if ( $theme_dir[0] == '.' || $theme_dir == 'CVS' )
					continue;

				if (file_exists($theme_root . '/' . $theme_dir . '/jquery.mobile.theme.css')) {
					$theme_files[] = $theme_dir;
				}
			}
		}

		@closedir($theme_root);

		return $theme_files;
}


function jqmobile_mobile_layouts() {
	$layout_options = array(
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content on left', 'jqmobile' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content-sidebar.png',
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Content on right', 'jqmobile' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-content.png',
		),
	);

	return apply_filters( 'jqmobile_mobile_layouts', $layout_options );
}

function jqmobile_theme_options_render_page() {
	?>
	<script type="text/javascript" charset="utf8" >
		jQuery(document).ready(function($) {
			jQuery("#tabs").tabs({
				select: function(event, ui) {
					jQuery('#tabs .nav-tab-wrapper a').removeClass('nav-tab-active');
					jQuery('#tabs .nav-tab-wrapper a').filter(function(i){return i == ui.index;}).addClass('nav-tab-active');
				}
			});
		});
	</script>

	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'jqmobile' ), get_current_theme() ); ?></h2>
		<?php $tabs = array( 'basic' => 'Basic Settings', 'advanced' => 'Advanced Settings'); settings_errors(); ?>

			<table width="100%" border="0" style="padding:5px 10px;">
				<tr>
					<td>
						<p style="margin:0;padding: 0 0 18px 0;">If you like this theme and want it to be even better as well as to see new FREE mobile compatible themes from MobilizeToday.com, you are welcome to donate.</p>
						<p style="margin:0;padding: 0 0 18px 0;"><a href="http://www.mobilizetoday.com/" target="_blank" title="Make your existing website mobile with MobilizeToday!" style="display:block;width: 650px;height: 80px;background: url(http://www.mobilizetoday.com/images/banners/optimize-website-650.jpg) no-repeat;text-indent: -7777px;overflow: hidden;">Make your existing website mobile with MobilizeToday</a></p>
					</td>
					<td style="vertical-align:top;">
						<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
							<div>
								<input type="hidden" value="_s-xclick" name="cmd"/>
								<input type="hidden" value="LPEQ5VUBRJSLA" name="hosted_button_id"/>
								<input type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="http://www.mobilizetoday.com/images/donate.gif"/>
								<img height="1" width="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt=""/>
							</div>
						</form>
					</td>
				</tr>
			</table>
		
		<div id="tabs">

		<ul class="nav-tab-wrapper">

		<?php
		$current = 'basic';
		foreach( $tabs as $tab => $name ){
			$class = ( $tab == $current ) ? ' nav-tab-active' : '';
			echo "<li><a class='nav-tab$class' href='#$tab'>$name</a></li>";
		}
		?>
		</ul>

		<?php /*
		<iframe id="jqmobile_theme_preview" width="320" height="480" src="<?php echo get_stylesheet_directory_uri()."/themes/preview.php"?>"></iframe>

		*/ ?>
		
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php
				settings_fields( 'jqmobile_options' );
				$options = jqmobile_get_theme_options();
				$default_options = jqmobile_get_default_theme_options();
			?>


			<div id="basic">

			<table class="form-table">
				<tr valign="top" class="color-scheme">
					<th scope="row"><label for="jqmobile_color_scheme"><?php _e( 'Color Scheme', 'jqmobile' ); ?></label></th>
					<td>
						<select id="jqmobile_color_scheme" name="jqmobile_theme_options[color_scheme]">
						
						
						<?php
							foreach ( jqmobile_color_schemes() as $scheme ) {
								?>
									<option value="<?php echo esc_attr( $scheme ); ?>" <?php selected( $options['color_scheme'], $scheme ); ?> /> <?php echo $scheme; ?></option>
								<?php
							}
						?>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="jqmobile_upload"><?php echo _e('Upload Scheme', 'jqmobile'); ?></label></th>
					<td><input name="jqmobile_upload"  class="regular-text" id="jqmobile_upload" type="file" /> <?php submit_button( __( 'Upload' ), 'button', 'upload', false ); ?> <br/><span class="description">Get your custom created color scheme from <a href="http://jquerymobile.com/themeroller/" target="_blank">ThemeRoller Mobile</a></span></td>
				</tr>

				<tr valign="top" class="image-radio-option mobile-layout"><th scope="row"><?php _e( 'Mobile Layout', 'jqmobile' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Mobile Layout', 'jqmobile' ); ?></span></legend>
						<?php
							foreach ( jqmobile_mobile_layouts() as $layout ) {
								?>
								<div class="layout">
									<label class="description">
										<input type="radio" name="jqmobile_theme_options[mobile_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['mobile_layout'], $layout['value'] ); ?> />
										<span>
											<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="68" height="122" alt="" />
											<?php echo $layout['label']; ?>
										</span>
									</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>
			</table>

			</div>
			

			<div id="advanced">

				<table class="form-table">
					<?php
						foreach ( jqmobile_mobile_entities() as $entity => $value ) {
					?>
						<tr valign="top">
							<th scope="row"><label for="jqmobile_ui_<?php print $entity;?>"><?php echo $value['label']; ?></label></th>
							<td>
								<select id="jqmobile_ui_<?php print $entity; ?>" name="jqmobile_theme_options[ui][<?php print $entity; ?>]">
									<option value="-1"><?php _e( 'Default', 'jqmobile' ); ?></option>
									<?php foreach (range('a', 'z') as $i) {
										?>
											<option value="<?php echo $i; ?>" <?php if (isset($options['ui'][$entity])) { selected( $options['ui'][$entity], $i ); } ?>><?php echo $i; ?></option>
										<?php
									} ?>
								</select>
								<span class="description">Default: "<?php print $value['default']; ?>"</span>
							</td>
						</tr>
					<?php
					}
				?>
				</table>
			</div>
			</div>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function jqmobile_theme_options_validate( $input ) {
	$output = $defaults = jqmobile_get_default_theme_options();

	$uploadfiles = $_FILES['jqmobile_upload'];
	
	if ($uploadfiles['error'] == 0) {

		require_once(ABSPATH . 'wp-admin/includes/file.php');
		
		WP_Filesystem();


		global $wp_filesystem;
		
		$filetmp = $uploadfiles['tmp_name'];
		$filename = $uploadfiles['name'];

		$unpack_folder = $wp_filesystem->wp_content_dir() . 'themeroller/';
		$old_files = $wp_filesystem->dirlist($unpack_folder);

		if ( !empty($old_files) ) {
			foreach ( $old_files as $file )
				$wp_filesystem->delete($unpack_folder . $file['name'], true);
		}

		//We need a working directory
		$working_dir = $unpack_folder . basename($filename, '.zip');

		// Clean up working directory
		if ( $wp_filesystem->is_dir($working_dir) )
			$wp_filesystem->delete($working_dir, true);


		// Unzip package to working directory
		$result = unzip_file($filetmp, $working_dir); //TODO optimizations, Copy when Move/Rename would suffice?

		if ( is_wp_error($result) ) {
			$wp_filesystem->delete($working_dir, true);
			// @TODO: error handling
			exit;
		}

		$new_files = $wp_filesystem->dirlist($working_dir.'/themes');

		$target_name = '';
		$target_dir = '';
		
		foreach($new_files as $key => $value) {
			if (preg_match('/\.css$/', $value['name'])) {
				$target_name = str_replace('.min', '', preg_replace('/\.css$/', '', $value['name']));
			 }
		}

		if ($target_name) {

			$target_dir = get_stylesheet_directory().'/themes/'.$target_name;
			
			if ( $wp_filesystem->is_dir($target_dir) )
				$wp_filesystem->delete($target_dir, true);

			
			if ( !$wp_filesystem->mkdir($target_dir, FS_CHMOD_DIR) ) exit;
			if ( !$wp_filesystem->mkdir($target_dir."/images", FS_CHMOD_DIR) ) exit;

			// @TODO: error handling
			copy_dir($working_dir.'/themes/images', $target_dir.'/images');
			$wp_filesystem->copy($working_dir.'/themes/'.$target_name.'.css', $target_dir.'/jquery.mobile.theme.css', true, FS_CHMOD_FILE);
			
		}
	}

	if ( isset( $input['color_scheme'] ) && in_array( $input['color_scheme'], jqmobile_color_schemes() ) )
		$output['color_scheme'] = $input['color_scheme'];

	if ( isset( $input['mobile_layout'] ) && array_key_exists( $input['mobile_layout'], jqmobile_mobile_layouts() ) )
		$output['mobile_layout'] = $input['mobile_layout'];

	$output['ui'] = array();


	$entities = jqmobile_mobile_entities();
	$range = range('a', 'z');
	
	foreach($input['ui'] as $key => $value) {
		if (array_key_exists($key, $entities) && in_array($value, $range)) {
			$output['ui'][$key] = $value;
		}
	}

	// @TODO: ui validation
	return apply_filters( 'jqmobile_theme_options_validate', $output, $input, $defaults );
}

function jqmobile_enqueue_color_scheme() {
	$options = jqmobile_get_theme_options();
	$color_scheme = $options['color_scheme'];

	wp_enqueue_style( 'jqmobile-'.$color_scheme, get_template_directory_uri() . '/themes/'.$color_scheme.'/jquery.mobile.theme.css', array(), null );

	do_action( 'jqmobile_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'jqmobile_enqueue_color_scheme' );

function jqmobile_layout_classes( $existing_classes ) {
	$options = jqmobile_get_theme_options();

	$current_layout = $options['mobile_layout'];
	$classes = array();

	if ( 'content-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	elseif ( 'sidebar-content' == $current_layout )
		$classes[] = 'left-sidebar';

	$classes = apply_filters( 'jqmobile_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'jqmobile_layout_classes' );