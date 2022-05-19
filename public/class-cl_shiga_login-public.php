<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/webcreativeng
 * @since      1.0.0
 *
 * @package    Cl_shiga_login
 * @subpackage Cl_shiga_login/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cl_shiga_login
 * @subpackage Cl_shiga_login/public
 * @author     Oderinde Oluwasegun (Victor) <info@webcreativeng.com>
 */
class Cl_shiga_login_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cl_shiga_login-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cl_shiga_login-public.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Return the HOME URL
	 *
	 * @return string|void
	 */
	public function get_login_logo_url() {
		return home_url();
	}

	/**
	 * Return the Blog Name & Description
	 *
	 * @return string
	 */
	public function get_login_logo_url_title() {
		return get_bloginfo('name')." - ".get_bloginfo('description');
	}


	public function shiga_login_css() {
		$current_logo_id = get_option( 'cl_login_logo_url' );
		$logo = wp_get_attachment_image_url( $current_logo_id, 'full' );
		$logoUrl = $logo ?: CL_SHIGA_WP_LOGO;
//		$imageUrl = get_option( 'cl_login_logo_url' , plugins_url( 'public/images/wp-default-logo.png' , __FILE__));
		$backgroundColor = get_option( 'cl_background_color' , '#91a3a4' );
		?>
		<style>
            .login #login h1 {
                background-color: <?php echo $backgroundColor; ?>;
            }
            .login #login h1 a {
                background-image: url(<?php echo $logoUrl; ?>);
            }
		</style>
	<?php
		wp_enqueue_style('login-css', plugins_url('css/login.min.css', __FILE__), false);
	}
}
