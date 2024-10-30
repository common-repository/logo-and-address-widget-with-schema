<?php
/*
 *
 * Plugin Name: Logo and Address Widget with Schema
 * Plugin URI:  https://www.webstix.com
 * Description: Widget to add a company logo and address to either the footer or side bar.
 * Author: Webstix
 * Author URI: https://www.webstix.com
 * Version: 2.9
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: logo-and-address-widget-with-schema
 * Tags: footer, logo-and-address, logo-and-address-widget, logo-and-address-widget-schema, logo-address
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Footer_Logo_and_Address  {
	/**
	 * @var string
	 */
	public $version = '1.0';
	public static $text_domain = 'logo-and-address-widget-with-schema';
	/**
	 * @var Footer_Logo_and_Address The single instance of the class
	 */
	protected static $_instance = null;

	protected function __construct() {
		$this->laawws_init();
		$laawws_hooks='';
		$laawws_styles='';
		$this->laawws_assets($laawws_hooks);
		$this->laawws_styles($laawws_styles);
	}
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function laawws_init() {
		add_action( 'widgets_init', function(){ register_widget( 'Logo_and_Address_Widget_with_Schema' );});
		add_action( 'admin_enqueue_scripts', array( $this, 'laawws_assets' ) );
		add_action( 'init', array( $this, 'laawws_styles' ) );
	}

	public function laawws_assets($laawws_hooks) {
		if( $laawws_hooks != 'widgets.php' )
    	return;
	    wp_enqueue_media();
		wp_register_script( 'laawws-media-upload', plugin_dir_url(__FILE__) . '/js/laawws-media-upload.js');
		wp_enqueue_script( 'laawws-media-upload' );

	}

	public function laawws_styles($laawws_styles) {
		wp_register_style('laawws-custom-styles', plugin_dir_url(__FILE__) . '/css/laawws-custom.css');
		wp_register_style('laawws-fontawesome-styles', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

		wp_enqueue_style('laawws-custom-styles');
		wp_enqueue_style('laawws-fontawesome-styles');
	}
}



class Logo_and_Address_Widget_with_Schema extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'logo-and-address-widget-with-schema', // Base ID
			'Logo and Address Widget with Schema', // Name
			array(
                'description' => __( 'Add a logo and address to the sidebar or footer', 'logo-and-address-widget-with-schema' )
            ) // Args
		);

		 add_action('wp_ajax_list_items', array($this, 'laawws_time_picker'));
	}

	public function laawws_time_picker($laawws_hours) { ?>

        <option <?php selected( $laawws_hours, " "); ?> value=" " > </option>
        <option <?php selected( $laawws_hours, "8:00 am"); ?> value="8:00 am" >8:00 am</option>
		<option <?php selected( $laawws_hours, "8:30 am"); ?> value="8:30 am" >8:30 am</option>
		<option <?php selected( $laawws_hours, "9:00 am"); ?> value="9:00 am" >9:00 am</option>
		<option <?php selected( $laawws_hours, "9:30 am"); ?> value="9:30 am" >9:30 am</option>
		<option <?php selected( $laawws_hours, "10:00 am"); ?> value="10:00 am" >10:00 am</option>
		<option <?php selected( $laawws_hours, "10:30 am"); ?> value="10:30 am" >10:30 am</option>
		<option <?php selected( $laawws_hours, "11:00 am"); ?> value="11:00 am" >11:00 am</option>
		<option <?php selected( $laawws_hours, "11:30 am"); ?> value="11:30 am" >11:30 am</option>
		<option <?php selected( $laawws_hours, "12:00 pm"); ?> value="12:00 pm" >12:00 pm</option>
		<option <?php selected( $laawws_hours, "12:30 pm"); ?> value="12:30 pm" >12:30 pm</option>
		<option <?php selected( $laawws_hours, "1:00 pm"); ?> value="1:00 pm" >1:00 pm</option>
		<option <?php selected( $laawws_hours, "1:30 pm"); ?> value="1:30 pm" >1:30 pm</option>
		<option <?php selected( $laawws_hours, "2:00 pm"); ?> value="2:00 pm" >2:00 pm</option>
		<option <?php selected( $laawws_hours, "2:30 pm"); ?> value="2:30 pm" >2:30 pm</option>
		<option <?php selected( $laawws_hours, "3:00 pm"); ?> value="3:00 pm" >3:00 pm</option>
		<option <?php selected( $laawws_hours, "3:30 pm"); ?> value="3:30 pm" >3:30 pm</option>
		<option <?php selected( $laawws_hours, "4:00 pm"); ?> value="4:00 pm" >4:00 pm</option>
		<option <?php selected( $laawws_hours, "4:30 pm"); ?> value="4:30 pm" >4:30 pm</option>
		<option <?php selected( $laawws_hours, "5:00 pm"); ?> value="5:00 pm" >5:00 pm</option>
		<option <?php selected( $laawws_hours, "5:30 pm"); ?> value="5:30 pm" >5:30 pm</option>
		<option <?php selected( $laawws_hours, "6:00 pm"); ?> value="6:00 pm" >6:00 pm</option>
		<option <?php selected( $laawws_hours, "6:30 pm"); ?> value="6:30 pm" >6:30 pm</option>
		<option <?php selected( $laawws_hours, "7:00 pm"); ?> value="7:00 pm" >7:00 pm</option>
		<option <?php selected( $laawws_hours, "7:30 pm"); ?> value="7:30 pm" >7:30 pm</option>
		<option <?php selected( $laawws_hours, "8:00 pm"); ?> value="8:00 pm" >8:00 pm</option>

   <?php }

	/**
	 * Back-end widget form creation
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		// outputs the options form on admin
			$laawws_widget_title = $laawws_footer_logo=$laawws_footer_logo_alt_text=$laawws_image_radio_buttons='';$laawws_address_line1='';$laawws_address_line2='';
			$laawws_city=$laawws_state=$laawws_zip=$laawws_address_radio_buttons=$laawws_address_fawesome_icon='';$laawws_address_custom_image ='';$laawws_phone ='';
			$laawws_fax =$laawws_email =$laawws_epf_radio_buttons =$laawws_open_hours =$laawws_open_hours_title ='';$laawws_open_hours_mon_fri ='';$laawws_close_hours_mon_fri ='';
			$laawws_open_hours_mon_fri_checked =$laawws_open_hours_mon =$laawws_close_hours_mon =$laawws_open_hours_mon_checked =$laawws_open_hours_tue ='';
			$laawws_close_hours_tue =$laawws_open_hours_tue_checked =$laawws_open_hours_wed =$laawws_close_hours_wed =$laawws_open_hours_wed_checked ='';
			$laawws_open_hours_thu =$laawws_close_hours_thu =$laawws_open_hours_thu_checked =$laawws_open_hours_fri =$laawws_close_hours_fri =$laawws_open_hours_fri_checked ='';
			$laawws_open_hours_sun2 =$laawws_close_hours_sun2 =$laawws_open_hours_sun_checked2 =$laawws_open_hours_sun =$laawws_close_hours_sun =$laawws_open_hours_sun_checked =$laawws_address_schema_buttons ='';
		// Check values
		if( $instance) {

			// Logo Section
			$laawws_widget_title = ! empty( sanitize_text_field($instance['laawws_widget_title'] )) ? sanitize_text_field($instance['laawws_widget_title']) : '';

			$laawws_footer_logo = ! empty( sanitize_text_field($instance['laawws_footer_logo'] )) ? sanitize_text_field($instance['laawws_footer_logo']) : '';

			$laawws_footer_logo_alt_text = ! empty( sanitize_text_field($instance['laawws_footer_logo_alt_text'] )) ? sanitize_text_field($instance['laawws_footer_logo_alt_text']) : '';

			$laawws_image_radio_buttons = ! empty( sanitize_text_field($instance['laawws_image_radio_buttons'] )) ? sanitize_text_field($instance['laawws_image_radio_buttons']) : '';


			// Address Section
			$laawws_address_line1 = ! empty( sanitize_text_field($instance['laawws_address_line1'] )) ? sanitize_text_field($instance['laawws_address_line1']) : '';

			$laawws_address_line2 = ! empty( sanitize_text_field($instance['laawws_address_line2'] )) ? sanitize_text_field($instance['laawws_address_line2']) : '';

			$laawws_city = ! empty( sanitize_text_field($instance['laawws_city'] )) ? sanitize_text_field($instance['laawws_city']) : '';

			$laawws_state = ! empty( sanitize_text_field($instance['laawws_state'] )) ? sanitize_text_field($instance['laawws_state']) : '';

			$laawws_zip = ! empty( sanitize_text_field($instance['laawws_zip'] )) ? sanitize_text_field($instance['laawws_zip']) : '';

			$laawws_address_radio_buttons = ! empty( sanitize_text_field($instance['laawws_address_radio_buttons'] )) ? sanitize_text_field($instance['laawws_address_radio_buttons']) : '';

			$laawws_address_fawesome_icon = ! empty( sanitize_text_field($instance['laawws_address_fawesome_icon'] )) ? sanitize_text_field($instance['laawws_address_fawesome_icon']) : '';
			$laawws_address_custom_image = ! empty( sanitize_text_field($instance['laawws_address_custom_image'] )) ? sanitize_text_field($instance['laawws_address_custom_image']) : '';


			// Phone/Fax/Email Section
			$laawws_phone = ! empty( sanitize_text_field($instance['laawws_phone'] )) ? sanitize_text_field($instance['laawws_phone']) : '';

			$laawws_fax = ! empty( sanitize_text_field($instance['laawws_email'] )) ? sanitize_text_field($instance['laawws_fax']) : '';

			$laawws_email = ! empty( sanitize_text_field($instance['laawws_email'] )) ? sanitize_text_field($instance['laawws_email']) : '';

			// Enable/Disable Label/Fontawesome icons for Email, Phone and Fax. epf means email, phone and fax
			$laawws_epf_radio_buttons = ! empty( sanitize_text_field($instance['laawws_epf_radio_buttons'] )) ? sanitize_text_field($instance['laawws_epf_radio_buttons']) : '';


			// Open Hours Section
			$laawws_open_hours = ! empty( sanitize_text_field($instance['laawws_open_hours'] )) ? sanitize_text_field($instance['laawws_open_hours']) : '';

			// Hours Title
			$laawws_open_hours_title = ! empty( sanitize_text_field($instance['laawws_open_hours_title'] )) ? sanitize_text_field($instance['laawws_open_hours_title']) : '';


			// Monday - Friday
			$laawws_open_hours_mon_fri = ! empty( sanitize_text_field($instance['laawws_open_hours_mon_fri'] )) ? sanitize_text_field($instance['laawws_open_hours_mon_fri']) : '';

			$laawws_close_hours_mon_fri = ! empty( sanitize_text_field($instance['laawws_close_hours_mon_fri'] )) ? sanitize_text_field($instance['laawws_close_hours_mon_fri']) : '';

			$laawws_open_hours_mon_fri_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_mon_fri_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_mon_fri_checked']) : '';


			// Monday
			$laawws_open_hours_mon = ! empty( sanitize_text_field($instance['laawws_open_hours_mon'] )) ? sanitize_text_field($instance['laawws_open_hours_mon']) : '';

			$laawws_close_hours_mon = ! empty( sanitize_text_field($instance['laawws_close_hours_mon'] )) ? sanitize_text_field($instance['laawws_close_hours_mon']) : '';

			$laawws_open_hours_mon_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_mon_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_mon_checked']) : '';


			// Tuesday
			$laawws_open_hours_tue = ! empty( sanitize_text_field($instance['laawws_open_hours_tue'] )) ? sanitize_text_field($instance['laawws_open_hours_tue']) : '';

			$laawws_close_hours_tue = ! empty( sanitize_text_field($instance['laawws_close_hours_tue'] )) ? sanitize_text_field($instance['laawws_close_hours_tue']) : '';

			$laawws_open_hours_tue_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_tue_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_tue_checked']) : '';


			// Wednesday
			$laawws_open_hours_wed = ! empty( sanitize_text_field($instance['laawws_open_hours_wed'] )) ? sanitize_text_field($instance['laawws_open_hours_wed']) : '';

			$laawws_close_hours_wed = ! empty( sanitize_text_field($instance['laawws_close_hours_wed'] )) ? sanitize_text_field($instance['laawws_close_hours_wed']) : '';

			$laawws_open_hours_wed_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_wed_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_wed_checked']) : '';


			// Thursday
			$laawws_open_hours_thu = ! empty( sanitize_text_field($instance['laawws_open_hours_thu'] )) ? sanitize_text_field($instance['laawws_open_hours_thu']) : '';

			$laawws_close_hours_thu = ! empty( sanitize_text_field($instance['laawws_close_hours_thu'] )) ? sanitize_text_field($instance['laawws_close_hours_thu']) : '';

			$laawws_open_hours_thu_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_thu_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_thu_checked']) : '';


			// Friday
			$laawws_open_hours_fri = ! empty( sanitize_text_field($instance['laawws_open_hours_fri'] )) ? sanitize_text_field($instance['laawws_open_hours_fri']) : '';

			$laawws_close_hours_fri = ! empty( sanitize_text_field($instance['laawws_close_hours_fri'] )) ? sanitize_text_field($instance['laawws_close_hours_fri']) : '';

			$laawws_open_hours_fri_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_fri_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_fri_checked']) : '';


			// Saturday
			$laawws_open_hours_sun2 = ! empty( sanitize_text_field($instance['laawws_open_hours_sun2'] )) ? sanitize_text_field($instance['laawws_open_hours_sun2']) : '';

			$laawws_close_hours_sun2 = ! empty( sanitize_text_field($instance['laawws_close_hours_sun2'] )) ? sanitize_text_field($instance['laawws_close_hours_sun2']) : '';

			$laawws_open_hours_sun_checked2 = ! empty( sanitize_text_field($instance['laawws_open_hours_sun_checked2'] )) ? sanitize_text_field($instance['laawws_open_hours_sun_checked2']) : '';


			// Sunday
			$laawws_open_hours_sun = ! empty( sanitize_text_field($instance['laawws_open_hours_sun'] )) ? sanitize_text_field($instance['laawws_open_hours_sun']) : '';

			$laawws_close_hours_sun = ! empty( sanitize_text_field($instance['laawws_close_hours_sun'] )) ? sanitize_text_field($instance['laawws_close_hours_sun']) : '';

			$laawws_open_hours_sun_checked = ! empty( sanitize_text_field($instance['laawws_open_hours_sun_checked'] )) ? sanitize_text_field($instance['laawws_open_hours_sun_checked']) : '';

			// Address Schema
			$laawws_address_schema_buttons = ! empty( sanitize_text_field($instance['laawws_address_schema_buttons'] )) ? sanitize_text_field($instance['laawws_address_schema_buttons']) : '';

		} ?>

		<h3 class="laawws-admin-logo"><i class="fa fa-image"></i> <span>Logo Section</span></h3>
		<p>
			<label for="<?php echo $this->get_field_id('laawws_widget_title'); ?>"><?php _e('Widget Title:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_widget_title'); ?>" name="<?php echo $this->get_field_name('laawws_widget_title'); ?>" type="text" value="<?php echo $laawws_widget_title; ?>" />
		</p>

		<p>
		   <label for="<?php echo $this->get_field_id( 'laawws_footer_logo' ); ?>"><?php _e( 'Select/Upload a Logo:' ); ?></label>
		   <input class="widefat" id="<?php echo $this->get_field_id( 'laawws_footer_logo' ); ?>" name="<?php echo $this->get_field_name( 'laawws_footer_logo' ); ?>" type="text" value="<?php echo esc_url( $laawws_footer_logo ); ?>" /><small class="laawws-small">(We suggest 250 pixels wide x 250 pixels high)</small><br><br>

		   <button class="laawws_upload_image_button button button-primary">Upload Image</button>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_footer_logo_alt_text'); ?>"><?php _e('Logo Alternate Text:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_footer_logo_alt_text'); ?>" name="<?php echo $this->get_field_name('laawws_footer_logo_alt_text'); ?>" type="text" value="<?php echo $laawws_footer_logo_alt_text; ?>" />
		</p>

		<p class="laawws_image_radio_wrap">
			<label for="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>"><?php _e('Logo Alignment:', 'laawws_wp_widget_plugin'); ?></label><br>
			<label for="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>_1">
		       <input class="laawws_image_radio_button" id="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>_1" name="<?php echo $this->get_field_name('laawws_image_radio_buttons'); ?>" type="radio" value="left" <?php if($laawws_image_radio_buttons === 'left'){ echo 'checked="checked"'; } ?>/><?php _e('Left'); ?>
		    </label>&nbsp;&nbsp;
		    <label for="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>_2">
		       <input class="laawws_image_radio_button" id="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>_2" name="<?php echo $this->get_field_name('laawws_image_radio_buttons'); ?>" type="radio" value="center" <?php if($laawws_image_radio_buttons === 'center'){ echo 'checked="checked"'; } ?> /><?php _e('Center'); ?>
		    </label>&nbsp;&nbsp;
		    <label for="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>_3">
		       <input class="laawws_image_radio_button" id="<?php echo $this->get_field_id('laawws_image_radio_buttons'); ?>_3" name="<?php echo $this->get_field_name('laawws_image_radio_buttons'); ?>" type="radio" value="right" <?php if($laawws_image_radio_buttons === 'right'){ echo 'checked="checked"'; } ?> /><?php _e('Right'); ?>
		    </label>
		</p>


		<h3 class="laawws-admin-logo"><i class="fa fa-map-marker"></i> <span>Address Section</span></h3>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_address_line1'); ?>"><?php _e('Address Line 1:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_address_line1'); ?>" name="<?php echo $this->get_field_name('laawws_address_line1'); ?>" type="text" value="<?php echo $laawws_address_line1; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_address_line2'); ?>"><?php _e('Address Line 2:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_address_line2'); ?>" name="<?php echo $this->get_field_name('laawws_address_line2'); ?>" type="text" value="<?php echo $laawws_address_line2; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_city'); ?>"><?php _e('City:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_city'); ?>" name="<?php echo $this->get_field_name('laawws_city'); ?>" type="text" value="<?php echo $laawws_city; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_state'); ?>"><?php _e('State:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_state'); ?>" name="<?php echo $this->get_field_name('laawws_state'); ?>" type="text" value="<?php echo $laawws_state; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_zip'); ?>"><?php _e('ZIP:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_zip'); ?>" name="<?php echo $this->get_field_name('laawws_zip'); ?>" type="text" value="<?php echo $laawws_zip; ?>" />
		</p>

		<p class="laawws_address_radio_wrap">
			<label for="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>"><?php _e('Address Icon:', 'laawws_wp_widget_plugin'); ?></label><br>
			<label for="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>_1">
		       <input class="laawws_image_radio_button" id="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>_1" name="<?php echo $this->get_field_name('laawws_address_radio_buttons'); ?>" type="radio" value="icon" <?php if($laawws_address_radio_buttons === 'icon'){ echo 'checked="checked"'; } ?>/><?php _e('Icon (Default)'); ?>
		    </label><br>
		    <label for="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>_2">
		       <input class="laawws_image_radio_button" id="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>_2" name="<?php echo $this->get_field_name('laawws_address_radio_buttons'); ?>" type="radio" value="font-awesome" <?php if($laawws_address_radio_buttons === 'font-awesome'){ echo 'checked="checked"'; } ?> /><?php _e('Fontawesome Class'); ?>
		    </label><br>

			    <?php if($laawws_address_radio_buttons == "font-awesome") {
					$laawws_address_style = "style='display:block;'";
				} else {
					$laawws_address_style = "style='display:none;'";
				} ?>

			    <span class="laawws_address_fawesome_wrap" <?php echo $laawws_address_style; ?>>
					<label for="<?php echo $this->get_field_id('laawws_address_fawesome_icon'); ?>"><?php _e('<i class="fa fa-address-card"></i>&nbsp; Fontawesome Icon:', 'laawws_wp_widget_plugin'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('laawws_address_fawesome_icon'); ?>" name="<?php echo $this->get_field_name('laawws_address_fawesome_icon'); ?>" type="text" value="<?php echo $laawws_address_fawesome_icon; ?>" /><small class="laawws-small">(Example: location-arrow)</small>
				</span>

		    <label for="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>_3">
		       <input class="laawws_image_radio_button" id="<?php echo $this->get_field_id('laawws_address_radio_buttons'); ?>_3" name="<?php echo $this->get_field_name('laawws_address_radio_buttons'); ?>" type="radio" value="custom-image" <?php if($laawws_address_radio_buttons === 'custom-image'){ echo 'checked="checked"'; } ?> /><?php _e('Custom Image'); ?>
		    </label>

		    	<?php if($laawws_address_radio_buttons == "custom-image") {
					$laawws_address_style = "style='display:block;'";
				} else {
					$laawws_address_style = "style='display:none;'";
				} ?>

				<span class="laawws_address_custom_image_wrap" <?php echo $laawws_address_style; ?>>
				   <label for="<?php echo $this->get_field_id( 'laawws_address_custom_image' ); ?>"><?php _e( 'Select/Upload an Icon:' ); ?></label>
				   <input class="widefat" id="<?php echo $this->get_field_id( 'laawws_address_custom_image' ); ?>" name="<?php echo $this->get_field_name( 'laawws_address_custom_image' ); ?>" type="text" value="<?php echo esc_url( $laawws_address_custom_image ); ?>" /><small class="laawws-small">(We suggest 20 pixels wide x 20 pixels high)</small><br><br>

				   <button class="laawws_upload_image_button button button-primary">Upload Image</button>
				</span>

		</p>


		<h3 class="laawws-admin-logo"><span>Phone/Fax/Email Section</span></h3>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_phone'); ?>"><?php _e('<i class="fa fa-phone"></i>&nbsp; Phone:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_phone'); ?>" name="<?php echo $this->get_field_name('laawws_phone'); ?>" type="text" value="<?php echo $laawws_phone; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_fax'); ?>"><?php _e('<i class="fa fa-fax"></i>&nbsp; Fax:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_fax'); ?>" name="<?php echo $this->get_field_name('laawws_fax'); ?>" type="text" value="<?php echo $laawws_fax; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('laawws_email'); ?>"><?php _e('<i class="fa fa-envelope"></i>&nbsp; Email:', 'laawws_wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('laawws_email'); ?>" name="<?php echo $this->get_field_name('laawws_email'); ?>" type="text" value="<?php echo $laawws_email; ?>" />
		</p>


		<p class="laawws_epf_radio_wrap">
			<label for="<?php echo $this->get_field_id('laawws_epf_radio_buttons'); ?>_1">
		       <input class="laawws_epf_radio_button" id="<?php echo $this->get_field_id('laawws_epf_radio_buttons'); ?>_1" name="<?php echo $this->get_field_name('laawws_epf_radio_buttons'); ?>" type="radio" value="icons" <?php if($laawws_epf_radio_buttons === 'icons'){ echo 'checked="checked"'; } ?>/><?php _e('Show Icons'); ?>
		    </label>&nbsp;&nbsp;
		    <label for="<?php echo $this->get_field_id('laawws_epf_radio_buttons'); ?>_2">
		       <input class="laawws_epf_radio_button" id="<?php echo $this->get_field_id('laawws_epf_radio_buttons'); ?>_2" name="<?php echo $this->get_field_name('laawws_epf_radio_buttons'); ?>" type="radio" value="label" <?php if($laawws_epf_radio_buttons === 'label'){ echo 'checked="checked"'; } ?> /><?php _e('Show Label'); ?>
		    </label>
		</p>

		<h3 class="laawws-admin-logo"><i class="fa fa-address-card"></i> <span>Address Schema Section</span></h3>

		<p class="laawws_address_radio_wrap">

			<label for="<?php echo $this->get_field_id('laawws_address_schema_buttons'); ?>_1">
		       <input class="laawws_address_schema_button" id="<?php echo $this->get_field_id('laawws_address_schema_buttons'); ?>_1" name="<?php echo $this->get_field_name('laawws_address_schema_buttons'); ?>" type="radio" value="on" <?php if($laawws_address_schema_buttons === 'on'){ echo 'checked="checked"'; } ?>/><?php _e('On'); ?>
		    </label>&nbsp;&nbsp;
		    <label for="<?php echo $this->get_field_id('laawws_address_schema_buttons'); ?>_2">
		       <input class="laawws_address_schema_button" id="<?php echo $this->get_field_id('laawws_address_schema_buttons'); ?>_2" name="<?php echo $this->get_field_name('laawws_address_schema_buttons'); ?>" type="radio" value="off" <?php if($laawws_address_schema_buttons === 'off'){ echo 'checked="checked"'; } ?> /><?php _e('Off'); ?>
			</label>
		</p>


		<br /><h3 class="laawws-admin-logo"><i class="fa fa-clock-o"></i> <span>Business Hours Section</span></h3>

		<p>
			<input id="<?php echo $this->get_field_id('laawws_open_hours'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours'); ?>" class="widefat laawws-open-hrs-checkbox" type="checkbox" value="open" <?php checked('open', $laawws_open_hours); ?> />

			<label for="<?php echo $this->get_field_id('laawws_open_hours'); ?>">Show Business Hours</label>

		</p>

		<?php if($laawws_open_hours == "open") {
			$pclass = "style='display:block;'";
		} else {
			$pclass = "style='display:none;'";
		} ?>

		<div class="laawws-open-hrs-time-wrap" <?php echo $pclass; ?>>

			<p>
				<label for="<?php echo $this->get_field_id('laawws_open_hours_title'); ?>">Label:</label>

				<input class="widefat" id="<?php echo $this->get_field_id('laawws_open_hours_title'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_title'); ?>" type="text" value="<?php echo $laawws_open_hours_title; ?>" placeholder="Business Hours" /><br/>
			</p>


			<!-- Monday to Friday -->
			<p class="clearfix">

				<span class="laawws-date-left mon-fri">

					<input id="<?php echo $this->get_field_id('laawws_open_hours_mon_fri_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_mon_fri_checked'); ?>" class="widefat" type="checkbox" value="monfri" <?php checked('monfri', $laawws_open_hours_mon_fri_checked); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_mon_fri'); ?>"><?php _e('', 'laawws_open_hours_mon_fri'); ?> Mon-Fri:</label>

				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Monday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_mon_fri'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_mon_fri'); ?>" class="laawws-open-hrs-monfri" >

			        	<?php $this->laawws_time_picker($laawws_open_hours_mon_fri); ?>

		        	</select>

		        </span>

		        <span class="laawws-date-right">

					<!-- Closing time for Monday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_mon_fri'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_mon_fri'); ?>">

						<?php $this->laawws_time_picker($laawws_close_hours_mon_fri); ?>

			        </select>

				</span>

	        </p>

	        <p style="text-align: center;"> - OR - </p>


			<!-- Monday -->
			<p class="clearfix">

				<span class="laawws-date-left mon">

					<input id="<?php echo $this->get_field_id('laawws_open_hours_mon_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_mon_checked'); ?>" class="widefat" type="checkbox" value="mon" <?php checked('mon', $laawws_open_hours_mon_checked); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_mon'); ?>"><?php _e('', 'laawws_open_hours_mon'); ?>Mon: </label>

				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Monday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_mon'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_mon'); ?>" class="laawws-open-hrs-mon" >

			        	<?php $this->laawws_time_picker($laawws_open_hours_mon); ?>

			        </select>

		        </span>

		        <span class="laawws-date-right">

					<!-- Closing time for Monday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_mon'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_mon'); ?>">

						<?php $this->laawws_time_picker($laawws_close_hours_mon); ?>

			        </select>
				</span>

	        </p>


	        <!-- Tuesday -->
			<p class="clearfix">

				<span class="laawws-date-left tue">

			        <input id="<?php echo $this->get_field_id('laawws_open_hours_tue_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_tue_checked'); ?>" class="widefat" type="checkbox" value="tue" <?php checked('tue', $laawws_open_hours_tue_checked); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_tue'); ?>"><?php _e('', 'laawws_open_hours_tue'); ?>Tue: </label>
				</span>

				<span class="laawws-date-center">
					<!-- Starting time for Tuesday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_tue'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_tue'); ?>" class="laawws-open-hrs-tue" >

			        	<?php $this->laawws_time_picker($laawws_open_hours_tue); ?>

			        </select>
		        </span>

		        <span class="laawws-date-right">

					<!-- Closing time for Tuesday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_tue'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_tue'); ?>">

			        	<?php $this->laawws_time_picker($laawws_close_hours_tue); ?>

			        </select>
				</span>

	        </p>


	        <!-- Wednesday -->
	        <p class="clearfix">

		        <span class="laawws-date-left wed">

			        <input id="<?php echo $this->get_field_id('laawws_open_hours_wed_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_wed_checked'); ?>" class="widefat" type="checkbox" value="wed" <?php checked('wed', $laawws_open_hours_wed_checked); ?> />

			        <label for="<?php echo $this->get_field_id('laawws_open_hours_wed'); ?>"><?php _e('', 'laawws_open_hours_wed'); ?>Wed: </label>
				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Wednesday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_wed'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_wed'); ?>" class="laawws-open-hrs-wed" >

			        	<?php $this->laawws_time_picker($laawws_open_hours_wed); ?>

			        </select>

				</span>

				<span class="laawws-date-right">

					<!-- Closing time for Wednesday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_wed'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_wed'); ?>">

			        	<?php $this->laawws_time_picker($laawws_close_hours_wed); ?>

			        </select>
				</span>

	        </p>


	        <!-- Thursday -->
	        <p class="clearfix">

		        <span class="laawws-date-left thu">

			        <input id="<?php echo $this->get_field_id('laawws_open_hours_thu_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_thu_checked'); ?>" class="widefat" type="checkbox" value="thu" <?php checked('thu', $laawws_open_hours_thu_checked); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_thu'); ?>"><?php _e('', 'laawws_open_hours_thu'); ?>Thu: </label>

				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Thursday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_thu'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_thu'); ?>" class="laawws-open-hrs-thu">

			        	<?php $this->laawws_time_picker($laawws_open_hours_thu); ?>

			        </select>

				</span>

				<span class="laawws-date-right">

					<!-- Closing time for Monday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_thu'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_thu'); ?>">

			        	<?php $this->laawws_time_picker($laawws_close_hours_thu); ?>

			        </select>
				</span>

	        </p>


	        <!-- Friday -->
	        <p class="clearfix">

		        <span class="laawws-date-left fri">

			        <input id="<?php echo $this->get_field_id('laawws_open_hours_fri_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_fri_checked'); ?>" class="widefat" type="checkbox" value="fri" <?php checked('fri', $laawws_open_hours_fri_checked); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_fri'); ?>"><?php _e('', 'laawws_open_hours_fri'); ?>Fri: </label>

				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Thursday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_fri'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_fri'); ?>" class="laawws-open-hrs-fri">

			       		<?php $this->laawws_time_picker($laawws_open_hours_fri); ?>

			        </select>

				</span>

				<span class="laawws-date-right">

					<!-- Closing time for Monday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_fri'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_fri'); ?>">

			        	<?php $this->laawws_time_picker($laawws_close_hours_fri); ?>

			        </select>

				</span>

			</p>


			<!-- Saturday -->
			<p class="clearfix">

				<span class="laawws-date-left sats">

			        <input id="<?php echo $this->get_field_id('laawws_open_hours_sun_checked2'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_sun_checked2'); ?>" class="widefat" type="checkbox" value="sun2" <?php checked('sun2', $laawws_open_hours_sun_checked2); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_sun2'); ?>">Sat: </label>

				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Sunday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_sun2'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_sun2'); ?>" class="laawws-open-hrs-sun2" >

						<?php $this->laawws_time_picker($laawws_open_hours_sun2); ?>

					</select>

				</span>

				<span class="laawws-date-right">

					<!-- Closing time for Sunday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_sun2'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_sun2'); ?>">

			        	<?php $this->laawws_time_picker($laawws_close_hours_sun2); ?>

			        </select>
				</span>

	        </p>


	        <!-- Sunday -->
			<p class="clearfix">

				<span class="laawws-date-left sun">

			        <input id="<?php echo $this->get_field_id('laawws_open_hours_sun_checked'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_sun_checked'); ?>" class="widefat" type="checkbox" value="sun" <?php checked('sun', $laawws_open_hours_sun_checked); ?> />

					<label for="<?php echo $this->get_field_id('laawws_open_hours_sun'); ?>">Sun: </label>
				</span>

				<span class="laawws-date-center">

					<!-- Starting time for Sunday-->
					<select id="<?php echo $this->get_field_id('laawws_open_hours_sun'); ?>" name="<?php echo $this->get_field_name('laawws_open_hours_sun'); ?>" class="laawws-open-hrs-sun" >

						<?php $this->laawws_time_picker($laawws_open_hours_sun); ?>

					</select>

				</span>

				<span class="laawws-date-right">

					<!-- Closing time for Sunday -->
			        <select id="<?php echo $this->get_field_id('laawws_close_hours_sun'); ?>" name="<?php echo $this->get_field_name('laawws_close_hours_sun'); ?>">

			        	<?php $this->laawws_time_picker($laawws_close_hours_sun); ?>

			        </select>

				</span>

	        </p>

	        <hr class="laawws-btm-line">

		</div>

		<?php

	} // Function close

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function update($new_instance, $old_instance) {

		$instance = $old_instance;

		// Widget Title
		$instance['laawws_widget_title'] = ( ! empty( $new_instance['laawws_widget_title'] ) ) ? $new_instance['laawws_widget_title'] : '';

		// Logo Section
		$instance['laawws_footer_logo'] = ( ! empty( $new_instance['laawws_footer_logo'] ) ) ? esc_attr($new_instance['laawws_footer_logo']) : '';

		$instance['laawws_footer_logo_alt_text'] = ( ! empty( $new_instance['laawws_footer_logo_alt_text'] ) ) ? esc_attr($new_instance['laawws_footer_logo_alt_text']) : '';

		$instance['laawws_image_radio_buttons'] = ! empty( ($new_instance['laawws_image_radio_buttons'] )) ? esc_attr($new_instance['laawws_image_radio_buttons']) : '';

		// Address Section
		$instance['laawws_address_line1'] = ( ! empty( $new_instance['laawws_address_line1'] ) ) ? esc_attr($new_instance['laawws_address_line1']) : '';

		$instance['laawws_address_line2'] = ( ! empty( $new_instance['laawws_address_line2'] ) ) ? esc_attr($new_instance['laawws_address_line2']) : '';

		$instance['laawws_city'] = ( ! empty( $new_instance['laawws_city'] ) ) ? esc_attr($new_instance['laawws_city']) : '';

		$instance['laawws_state'] = ( ! empty( $new_instance['laawws_state'] ) ) ? esc_attr($new_instance['laawws_state']) : '';

		$instance['laawws_zip'] = ( ! empty( $new_instance['laawws_zip'] ) ) ? esc_attr($new_instance['laawws_zip']) : '';

		$instance['laawws_address_radio_buttons'] = ( ! empty( $new_instance['laawws_address_radio_buttons'] ) ) ? esc_attr($new_instance['laawws_address_radio_buttons']) : '';

		$instance['laawws_address_fawesome_icon'] = ( ! empty( $new_instance['laawws_address_fawesome_icon'] ) ) ? esc_attr($new_instance['laawws_address_fawesome_icon']) : '';

		$instance['laawws_address_custom_image'] = ( ! empty( $new_instance['laawws_address_custom_image'] ) ) ? esc_attr($new_instance['laawws_address_custom_image']) : '';


		// Phone/Fax/Email Section
		$instance['laawws_phone'] = ( ! empty( $new_instance['laawws_phone'] ) ) ? esc_attr($new_instance['laawws_phone']) : '';

		$instance['laawws_fax'] = ( ! empty( $new_instance['laawws_fax'] ) ) ? esc_attr($new_instance['laawws_fax']) : '';

		$instance['laawws_email'] = ( ! empty( $new_instance['laawws_email'] ) ) ? esc_attr($new_instance['laawws_email']) : '';

		$instance['laawws_epf_radio_buttons'] = ( ! empty( $new_instance['laawws_epf_radio_buttons'] ) ) ? esc_attr($new_instance['laawws_epf_radio_buttons']) : '';


		// Open Hours Section
		$instance['laawws_open_hours'] = ( ! empty( $new_instance['laawws_open_hours'] ) ) ? esc_attr($new_instance['laawws_open_hours']) : '';

		// Hours Title
		$instance['laawws_open_hours_title'] = ( ! empty( $new_instance['laawws_open_hours_title'] ) ) ? esc_attr($new_instance['laawws_open_hours_title']) : '';


		// Monday - Friday
		$instance['laawws_open_hours_mon_fri'] = ( ! empty( $new_instance['laawws_open_hours_mon_fri'] ) ) ? esc_attr($new_instance['laawws_open_hours_mon_fri']) : '';

		$instance['laawws_close_hours_mon_fri'] = ( ! empty( $new_instance['laawws_close_hours_mon_fri'] ) ) ? esc_attr($new_instance['laawws_close_hours_mon_fri']) : '';

		$instance['laawws_open_hours_mon_fri_checked'] = ( ! empty( $new_instance['laawws_open_hours_mon_fri_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_mon_fri_checked']) : '';


		// Monday
		$instance['laawws_open_hours_mon'] = ( ! empty( $new_instance['laawws_open_hours_mon'] ) ) ? esc_attr($new_instance['laawws_open_hours_mon']) : '';

		$instance['laawws_close_hours_mon'] = ( ! empty( $new_instance['laawws_close_hours_mon'] ) ) ? esc_attr($new_instance['laawws_close_hours_mon']) : '';

		$instance['laawws_open_hours_mon_checked'] = ( ! empty( $new_instance['laawws_open_hours_mon_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_mon_checked']) : '';

		// Tuesday
		$instance['laawws_open_hours_tue'] = ( ! empty( $new_instance['laawws_open_hours_tue'] ) ) ? esc_attr($new_instance['laawws_open_hours_tue']) : '';

		$instance['laawws_close_hours_tue'] = ( ! empty( $new_instance['laawws_close_hours_tue'] ) ) ? esc_attr($new_instance['laawws_close_hours_tue']) : '';

		$instance['laawws_open_hours_tue_checked'] = ( ! empty( $new_instance['laawws_open_hours_tue_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_tue_checked']) : '';

		// Wedneday
		$instance['laawws_open_hours_wed'] = ( ! empty( $new_instance['laawws_open_hours_wed'] ) ) ? esc_attr($new_instance['laawws_open_hours_wed']) : '';

		$instance['laawws_close_hours_wed'] = ( ! empty( $new_instance['laawws_close_hours_wed'] ) ) ? esc_attr($new_instance['laawws_close_hours_wed']) : '';

		$instance['laawws_open_hours_wed_checked'] = ( ! empty( $new_instance['laawws_open_hours_wed_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_wed_checked']) : '';

		// Thursday
		$instance['laawws_open_hours_thu'] = ( ! empty( $new_instance['laawws_open_hours_thu'] ) ) ? esc_attr($new_instance['laawws_open_hours_thu']) : '';

		$instance['laawws_close_hours_thu'] = ( ! empty( $new_instance['laawws_close_hours_thu'] ) ) ? esc_attr($new_instance['laawws_close_hours_thu']) : '';

		$instance['laawws_open_hours_thu_checked'] = ( ! empty( $new_instance['laawws_open_hours_thu_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_thu_checked']) : '';

		// Friday
		$instance['laawws_open_hours_fri'] = ( ! empty( $new_instance['laawws_open_hours_fri'] ) ) ? esc_attr($new_instance['laawws_open_hours_fri']) : '';

		$instance['laawws_close_hours_fri'] = ( ! empty( $new_instance['laawws_close_hours_fri'] ) ) ? esc_attr($new_instance['laawws_close_hours_fri']) : '';

		$instance['laawws_open_hours_fri_checked'] = ( ! empty( $new_instance['laawws_open_hours_fri_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_fri_checked']) : '';

		// Saturday
		$instance['laawws_open_hours_sun2'] = ( ! empty( $new_instance['laawws_open_hours_sun2'] ) ) ? esc_attr($new_instance['laawws_open_hours_sun2']) : '';

		$instance['laawws_close_hours_sun2'] = ( ! empty( $new_instance['laawws_close_hours_sun2'] ) ) ? esc_attr($new_instance['laawws_close_hours_sun2']) : '';

		$instance['laawws_open_hours_sun_checked2'] = ( ! empty( $new_instance['laawws_open_hours_sun_checked2'] ) ) ? esc_attr($new_instance['laawws_open_hours_sun_checked2']) : '';

		// Sunday
		$instance['laawws_open_hours_sun'] = ( ! empty( $new_instance['laawws_open_hours_sun'] ) ) ? esc_attr($new_instance['laawws_open_hours_sun']) : '';

		$instance['laawws_close_hours_sun'] = ( ! empty( $new_instance['laawws_close_hours_sun'] ) ) ? esc_attr($new_instance['laawws_close_hours_sun']) : '';

		$instance['laawws_open_hours_sun_checked'] = ( ! empty( $new_instance['laawws_open_hours_sun_checked'] ) ) ? esc_attr($new_instance['laawws_open_hours_sun_checked']) : '';


		// Address Schema
		$instance['laawws_address_schema_buttons'] = ( ! empty( $new_instance['laawws_address_schema_buttons'] ) ) ? esc_attr($new_instance['laawws_address_schema_buttons']) : '';


		return $instance;
	}


	// Display widget
	public function widget($args, $instance) {

	extract( $args );

	// Widget Title
	$laawws_widget_title = ! empty( $instance['laawws_widget_title'] ) ? $instance['laawws_widget_title'] : '';

	// Logo Section
	$laawws_footer_logo = ! empty( $instance['laawws_footer_logo'] ) ? $instance['laawws_footer_logo'] : '';
	$laawws_footer_logo_alt_text = ! empty( $instance['laawws_footer_logo_alt_text'] ) ? $instance['laawws_footer_logo_alt_text'] : '';
	$laawws_image_radio_buttons = ! empty( $instance['laawws_image_radio_buttons'] ) ? $instance['laawws_image_radio_buttons'] : '';

	// Address Section
	$laawws_address_line1 = ! empty( $instance['laawws_address_line1'] ) ? $instance['laawws_address_line1'] : '';
	$laawws_address_line2 = ! empty( $instance['laawws_address_line2'] ) ? $instance['laawws_address_line2'] : '';
	$laawws_city = ! empty( $instance['laawws_city'] ) ? $instance['laawws_city'] : '';
	$laawws_state = ! empty( $instance['laawws_state'] ) ? $instance['laawws_state'] : '';
	$laawws_zip = ! empty( $instance['laawws_zip'] ) ? $instance['laawws_zip'] : '';
	$laawws_address_radio_buttons = ! empty( $instance['laawws_address_radio_buttons'] ) ? $instance['laawws_address_radio_buttons'] : '';
	$laawws_address_fawesome_icon = ! empty( $instance['laawws_address_fawesome_icon'] ) ? $instance['laawws_address_fawesome_icon'] : '';
	$laawws_address_custom_image = ! empty( $instance['laawws_address_custom_image'] ) ? $instance['laawws_address_custom_image'] : '';


	// Email/Phone/Fax Section Section
	$laawws_email = ! empty( $instance['laawws_email'] ) ? $instance['laawws_email'] : '';
	$laawws_phone = ! empty( $instance['laawws_phone'] ) ? $instance['laawws_phone'] : '';
	$laawws_fax = ! empty( $instance['laawws_fax'] ) ? $instance['laawws_fax'] : '';
	$laawws_epf_radio_buttons = ! empty( $instance['laawws_epf_radio_buttons'] ) ? $instance['laawws_epf_radio_buttons'] : '';


	// Open Hours Section
	$laawws_open_hours = ! empty( $instance['laawws_open_hours'] ) ? $instance['laawws_open_hours'] : '';

	// Hours title
	$laawws_open_hours_title = ! empty( $instance['laawws_open_hours_title'] ) ? $instance['laawws_open_hours_title'] : '';

	// Monday - Friday
	$laawws_open_hours_mon_fri = ! empty( $instance['laawws_open_hours_mon_fri'] ) ? $instance['laawws_open_hours_mon_fri'] : '';
	$laawws_close_hours_mon_fri = ! empty( $instance['laawws_close_hours_mon_fri'] ) ? $instance['laawws_close_hours_mon_fri'] : '';
	$laawws_open_hours_mon_fri_checked = ! empty( $instance['laawws_open_hours_mon_fri_checked'] ) ? $instance['laawws_open_hours_mon_fri_checked'] : '';

	// Monday
	$laawws_open_hours_mon = ! empty( $instance['laawws_open_hours_mon'] ) ? $instance['laawws_open_hours_mon'] : '';
	$laawws_close_hours_mon = ! empty( $instance['laawws_close_hours_mon'] ) ? $instance['laawws_close_hours_mon'] : '';
	$laawws_open_hours_mon_checked = ! empty( $instance['laawws_open_hours_mon_checked'] ) ? $instance['laawws_open_hours_mon_checked'] : '';

	// Tuesday
	$laawws_open_hours_tue = ! empty( $instance['laawws_open_hours_tue'] ) ? $instance['laawws_open_hours_tue'] : '';
	$laawws_close_hours_tue = ! empty( $instance['laawws_close_hours_tue'] ) ? $instance['laawws_close_hours_tue'] : '';
	$laawws_open_hours_tue_checked = ! empty( $instance['laawws_open_hours_tue_checked'] ) ? $instance['laawws_open_hours_tue_checked'] : '';

	// Wednesday
	$laawws_open_hours_wed = ! empty( $instance['laawws_open_hours_wed'] ) ? $instance['laawws_open_hours_wed'] : '';
	$laawws_close_hours_wed = ! empty( $instance['laawws_close_hours_wed'] ) ? $instance['laawws_close_hours_wed'] : '';
	$laawws_open_hours_wed_checked = ! empty( $instance['laawws_open_hours_wed_checked'] ) ? $instance['laawws_open_hours_wed_checked'] : '';

	// Thursday
	$laawws_open_hours_thu = ! empty( $instance['laawws_open_hours_thu'] ) ? $instance['laawws_open_hours_thu'] : '';
	$laawws_close_hours_thu = ! empty( $instance['laawws_close_hours_thu'] ) ? $instance['laawws_close_hours_thu'] : '';
	$laawws_open_hours_thu_checked = ! empty( $instance['laawws_open_hours_thu_checked'] ) ? $instance['laawws_open_hours_thu_checked'] : '';

	// Friday
	$laawws_open_hours_fri = ! empty( $instance['laawws_open_hours_fri'] ) ? $instance['laawws_open_hours_fri'] : '';
	$laawws_close_hours_fri = ! empty( $instance['laawws_close_hours_fri'] ) ? $instance['laawws_close_hours_fri'] : '';
	$laawws_open_hours_fri_checked = ! empty( $instance['laawws_open_hours_fri_checked'] ) ? $instance['laawws_open_hours_fri_checked'] : '';

	// Saturday
	$laawws_open_hours_sun2 = ! empty( $instance['laawws_open_hours_sun2'] ) ? $instance['laawws_open_hours_sun2'] : '';
	$laawws_close_hours_sun2 = ! empty( $instance['laawws_close_hours_sun2'] ) ? $instance['laawws_close_hours_sun2'] : '';
	$laawws_open_hours_sun_checked2 = ! empty( $instance['laawws_open_hours_sun_checked2'] ) ? $instance['laawws_open_hours_sun_checked2'] : '';

	// Sunday
	$laawws_open_hours_sun = ! empty( $instance['laawws_open_hours_sun'] ) ? $instance['laawws_open_hours_sun'] : '';
	$laawws_close_hours_sun = ! empty( $instance['laawws_close_hours_sun'] ) ? $instance['laawws_close_hours_sun'] : '';
	$laawws_open_hours_sun_checked = ! empty( $instance['laawws_open_hours_sun_checked'] ) ? $instance['laawws_open_hours_sun_checked'] : '';


	// Address Schema
	$laawws_address_schema_buttons = ! empty( $instance['laawws_address_schema_buttons'] ) ? $instance['laawws_address_schema_buttons'] : '';

	// Get website name and URL
	$laawws_blog_url = get_site_url();
	$laawws_blog_name = get_bloginfo('name');

	ob_start();
	echo $before_widget;

	// Display the widget
	echo '<div class="widget-text laawws-footer-logo-address ">';
	echo '<div class="clearfix">';

	// Check if title is set
	if ( $laawws_widget_title ) {
		echo $before_title . $laawws_widget_title . $after_title ;
	}

	// Check if Logo details are set
	if($laawws_image_radio_buttons == "left") {
		$laawws_img_class = " alignleft";
	} elseif ($laawws_image_radio_buttons == "center") {
		$laawws_img_class = " aligncenter";
	} else {
		$laawws_img_class = " alignright";
	}

	// Check if Logo is set
	if ( $laawws_footer_logo  ) {
		if($laawws_footer_logo_alt_text ) {
			echo '<div class="wsx-ft-clsFooterlogo"><a href="'.$laawws_blog_url.'" title="'.$laawws_footer_logo_alt_text.'"><img class='. $laawws_img_class.' src="'.$laawws_footer_logo.'" alt="'.$laawws_footer_logo_alt_text.'"></a></div>';
		} else {
			echo '<div class="wsx-ft-clsFooterlogo"><a href="'.$laawws_blog_url.'" title="'.$laawws_blog_name.'"><img class='. $laawws_img_class.' src="'.$laawws_footer_logo.'" alt="'.$laawws_blog_name.'"></a></div>';
		}
	}

	// Check if Address is set
	if ( $laawws_address_line1 || $laawws_address_line2) {

		if($laawws_epf_radio_buttons == "label") {

			echo '<div class="wsx-ft-office-location"><div class="clearfix laawws-btm-address"><span class="style3 wsx-ft-address">';

			echo '<span class="laawws-address-line1">'.nl2br(html_entity_decode($laawws_address_line1)).'</span>';

			echo '<span class="laawws-address-line2">'. html_entity_decode($laawws_address_line2).'</span>';

			echo html_entity_decode($laawws_city).', '. html_entity_decode($laawws_state).' '. html_entity_decode($laawws_zip).'';

			echo '</span></div></div>';

		} else {

				// Check if Address section needs Fontawesome icon
				if($laawws_address_radio_buttons == "font-awesome") {
					echo '<div class="wsx-ft-office-location"><div class="clearfix laawws-btm-address"><i class="fa fa-'.$laawws_address_fawesome_icon.'"></i><span class="style3 wsx-ft-address">';
				} elseif ($laawws_address_radio_buttons == "custom-image") { // Check if Address section needs custom Background Image
					echo '<div class="wsx-ft-office-location" style="background: url('.$laawws_address_custom_image.')  no-repeat scroll left top; padding-left: 30px"><div class="clearfix laawws-btm-address"><span class="style3 wsx-ft-address">';
				} else {
					// Use default fa-map-marker icon
					echo '<div class="wsx-ft-office-location"><div class="clearfix laawws-btm-address"><i class="fa fa-map-marker"></i><span class="style3 wsx-ft-address">';
				}

				echo '<span class="laawws-address-line1">'.nl2br(html_entity_decode($laawws_address_line1)).'</span>';

				echo '<span class="laawws-address-line2">'. html_entity_decode($laawws_address_line2).'</span>';

				echo '<span class="laawws-address-line3">'. html_entity_decode($laawws_city).', '. html_entity_decode($laawws_state).' '. html_entity_decode($laawws_zip).'</span>';

				echo '</span></div></div>';
		}
	}

	// Add the address schema if enabled
	if($laawws_address_schema_buttons == "on") {

		$laawws_address_schema = '<script type="application/ld+json">';
		$laawws_address_schema .= '{';
		$laawws_address_schema .= '"@context": "http://www.schema.org",
		  "@type": "Organization",';

		if($laawws_blog_name != "") {
		  $laawws_address_schema .= '"name": "'.$laawws_blog_name.'",';
		}

		$laawws_address_schema .= '"address": {';
			$laawws_address_schema .= '"@type": "PostalAddress",';
			if($laawws_address_line1 != "") {
				$laawws_address_schema .= '"streetAddress": "'.$laawws_address_line1.'",';
			}
			if($laawws_zip != "") {
				$laawws_address_schema .= '"postOfficeBoxNumber": "'.$laawws_zip.'",';
			}
			if($laawws_city != "") {
					$laawws_address_schema .= '"addressLocality": "'.$laawws_city.'",';
				}
				if($laawws_state != "") {
				$laawws_address_schema .= '"addressRegion": "'.$laawws_state.'",';
			}
			if($laawws_zip != "") {
				$laawws_address_schema .= '"postalCode": "'.$laawws_zip.'",';
			}
		$laawws_address_schema .= '},';
		$laawws_address_schema .= '"contactPoint": {';
			$laawws_address_schema .= '"@type": "ContactPoint",';
			if($laawws_zip != "") {
				$laawws_address_schema .= '"telephone": "'.$laawws_phone.'"';
			}
		$laawws_address_schema .= '}}';

		$laawws_address_schema .= '</script>';

		echo $laawws_address_schema;
	}


	// Check if Phone is set
	if ( $laawws_phone) {
		if($laawws_epf_radio_buttons == "label") {
			echo '<span class="wsx-ft-phone">Phone: <a href="tel:'.$laawws_phone.'">'.$laawws_phone.'</a></span>';
		} else {
			echo '<span class="wsx-ft-phone"><i class="fa fa-phone"></i><a href="tel:'.$laawws_phone.'">'.$laawws_phone.'</a></span>';
		}
	}

	// Check if Fax is set
	if ( $laawws_fax) {
		if($laawws_epf_radio_buttons == "label") {
			echo '<span class="wsx-ft-fax">Fax: '.$laawws_fax.'</span>';
		} else {
			echo '<span class="wsx-ft-fax"><i class="fa fa-fax"></i> '.$laawws_fax.'</span>';
		}
	}

	// Check if Email is set
	if ( $laawws_email) {
		if($laawws_epf_radio_buttons == "label") {
			echo '<span class="wsx-ft-email">Email: <a href="mailto:'.antispambot($laawws_email, 1).'">'.$laawws_email.'</a></span>';
		} else {
			echo '<span class="wsx-ft-email"><i class="fa fa-envelope"></i><a href="mailto:'.antispambot($laawws_email, 1).'">'.$laawws_email.'</a></span>';
		}
	}

	// Show Business hours starts here
	if($laawws_open_hours == "open") {

		// Show Business Hours Title
		if($laawws_open_hours_title != "") {

			echo '<div class="laawws-open-hrs"><h4>'.$laawws_open_hours_title.'</h4></div>';

		} else {

			echo '<div class="laawws-open-hrs"><h4>Business Hours</h4></div>';
		}



		// Check if the operational hours is set for Monday
		if($laawws_open_hours_mon_fri_checked == "monfri") {

			if($laawws_open_hours_mon_fri_checked == " "|| $laawws_close_hours_mon_fri == " ") {

			} else {
				echo '<span class="clearfix laawws-mon-fri-time-wrap"><span class="laawws-day-label mon-fri">Mon - Fri:</span><span class="laawws-mon-fri-time">'.$laawws_open_hours_mon_fri.' - '.$laawws_close_hours_mon_fri .'</span></span>';
			}

		} else {

			// Check if the operational hours is set for Monday
			if($laawws_open_hours_mon_checked == "mon") {
				if($laawws_open_hours_mon == " "|| $laawws_close_hours_mon == " ") {
				} else {			echo '<span class="clearfix"><span class="laawws-day-label">Mon:</span><span class="laawws-mon-time">'.$laawws_open_hours_mon.' - '.$laawws_close_hours_mon .'</span></span>';
				}
			}

			// Check if the operational hours is set for Tuesday

			if($laawws_open_hours_tue_checked == "tue") {
				if($laawws_open_hours_tue == " "|| $laawws_close_hours_tue == " ") {
				} else {
					echo '<span class="clearfix"><span class="laawws-day-label">Tue:</span><span class="laawws-tue-time"> '.$laawws_open_hours_tue.' - '.$laawws_close_hours_tue .'</span></span>';
				}
			}

			// Check if the operational hours is set for Wednesday
			if($laawws_open_hours_wed_checked == "wed") {
				if($laawws_open_hours_wed == " "|| $laawws_open_hours_wed == " ") {
				} else {
					echo '<span class="clearfix"><span class="laawws-day-label">Wed:</span><span class="laawws-wed-time"> '.$laawws_open_hours_wed.' - '.$laawws_close_hours_wed .'</span></span>';
				}
			}

			// Check if the operational hours is set for Thursday
			if($laawws_open_hours_thu_checked == "thu") {
				if($laawws_open_hours_thu == " "|| $laawws_close_hours_thu == " ") {
				} else {
					echo '<span class="clearfix"><span class="laawws-day-label">Thu:</span><span class="laawws-thu-time"> '.$laawws_open_hours_thu.' - '.$laawws_close_hours_thu .'</span></span>';
				}
			}

			// Check if the operational hours is set for Friday
			if($laawws_open_hours_fri_checked == "fri") {
				if($laawws_open_hours_fri == " "|| $laawws_close_hours_fri == " ") {
				} else {
					echo '<span class="clearfix"><span class="laawws-day-label fri">Fri:</span><span class="laawws-fri-time"> '.$laawws_open_hours_fri.' - '.$laawws_close_hours_fri .'</span></span>';
				}
			}
		}


		// Check if the operational hours is set for Saturday
		if($laawws_open_hours_sun_checked2 == "sun2") {
			if($laawws_open_hours_sun2 == " " || $laawws_close_hours_sun2 == " ") {
			} else {
				echo '<span class="clearfix"><span class="laawws-day-label">Sat:</span><span class="laawws-sat-time"> '.$laawws_open_hours_sun2.' - '.$laawws_close_hours_sun2 .'</span></span>';
			}
		}

		// Check if the operational hours is set for Sunday
		if($laawws_open_hours_sun_checked == "sun") {
			if($laawws_open_hours_sun == " " || $laawws_close_hours_sun == " ") {
			} else {
				echo '<span class="clearfix"><span class="laawws-day-label">Sun:</span><span class="laawws-sun-time"> '.$laawws_open_hours_sun.' - '.$laawws_close_hours_sun .'</span></span>';
			}
		}

	} // Show Business hours ends here

	echo '</div></div>';

	echo $after_widget;
	ob_end_flush();
	}

}
Footer_Logo_and_Address::instance(); ?>
