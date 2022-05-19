<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/webcreativeng
 * @since      1.0.0
 *
 * @package    Cl_shiga_login
 * @subpackage Cl_shiga_login/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cl_shiga_login
 * @subpackage Cl_shiga_login/admin
 * @author     Oderinde Oluwasegun (Victor) <info@webcreativeng.com>
 */
class Cl_shiga_login_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Add Admin Menu to General Settings.
	 */
	public function add_admin_menu() {
		$page_title = 'Shiga - Custom WP Login :: Settings';
		$menu_title = 'Shiga - Custom Login';
		$capability = 'manage_options';
		$slug = 'cl_shiga_wp';
		$callback = array( $this, 'plugin_settings_page_content' );

		$hook = add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
		add_action( 'admin_print_scripts-' . $hook, array( $this, 'enqueue_scripts') );
	}

	public function plugin_settings_page_content() {
		wp_enqueue_media();

        $current_logo_id = get_option( 'cl_login_logo_url' );
        $logo = wp_get_attachment_image_url( $current_logo_id, 'full' );
		$logoUrl = $logo ?: CL_SHIGA_WP_LOGO;
		$uploadText = $logo ? 'Replace Image': 'Upload Image';

        //Background Color
        $bg_color = get_option( 'cl_background_color' , '#91a3a4' );
		?>
		<div class="wrap">
			<h2>Custom Settings for Shiga Login Plugin</h2>
			<form method="post" action="options.php">
                <h4>Select or Update Login Image:</h4>
                <div style="display:flex;margin-bottom: 15px;">
                    <div id='cl_upload_image_preview' style="text-align: center;min-width: 250px;">
                        <img src="<?php echo $logoUrl; ?>" style="width: 200px;" /><br>
                        <small>Current Login Logo</small>
                    </div>
                    <div style="min-width: 200px;">
                        <p>
                            <input id="cl_upload_image_btn" type="button" class="button" value="<?php echo $uploadText; ?>" />
                        </p>
                    </div>
                </div>
                <div style="display:flex;">
                    <div id='cl_upload_image_preview' style="min-width: 250px;">
                        <input id="cl_login_color_id" type="text" value="<?php echo $bg_color; ?>" class="cl_color_field"><br>
                        <small>Current Login Page Background Color</small>
                    </div>
                    <div style="min-width: 200px;">
                    </div>
                </div>


				<input type='hidden' name='cl_login_logo_id' id='cl_login_logo_id' value='<?php echo $current_logo_id ?: -1 ; ?>'>
				<?php wp_nonce_field('cl_update_nonce', 'cl_upd_nonce'); ?>
                <p>
                    <button type="button" id="cl_update_options_submit" class="button"><?php _e('Update Settings', 'cl_shiga_login'); ?></button>
                </p>
			</form>
		</div> <?php
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cl_shiga_login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cl_shiga_login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cl_shiga_login-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cl_shiga_login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cl_shiga_login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        // Add the color picker css file
		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( $this->plugin_name . '-admin-js', plugin_dir_url( __FILE__ ) . 'js/cl_shiga_login-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );
//        wp_localize_script( $this->plugin_name . '-admin-js',  'wda_ajax', array( 'url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_nonce_field('cl_nonce_action', 'wdanonce') ) );


		// Include our custom jQuery file with WordPress Color Picker dependency
//		wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}



	/**
	 * Ajax for fetching a featured image
	 *
	 * @uses array $_POST The id of the image
	 * @return string: A JSON encoded string
	 */
	public function cl_ajax_get_image() {
		$image_id = $_POST['img'];
		echo wp_get_attachment_image($image_id, array(200, 200));
		die();
	}

	/**
	 * Update Plugin options
	 */
	public function cl_update_options() {

//        var_dump($_POST);exit;

		try {
			if (!wp_verify_nonce($_POST['nonce'], 'cl_update_nonce'))
				throw new Exception(
					__("Sorry! You failed the security check", 'cl_shiga_login'),
					1
				);

//            Do the right thing....
			$imageId = $_POST['imgId'];
			$colorId = $_POST['colorId'];

			//set option name cl_login_logo_url
			update_option( 'cl_login_logo_url', intval($imageId) );
			update_option( 'cl_background_color', $colorId );

			$data['success'] = true;
			$data['message'] = __('Login Logo set Successfully', 'cl_shiga_login');

		} catch (Exception $ex) {
			$data['success'] = false;
			$data['message'] = sprintf(
				'%s',
				$ex->getMessage()
			);
		}
		die(json_encode($data));
	}

}
