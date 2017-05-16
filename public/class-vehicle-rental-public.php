<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Public {

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
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        /*Datepicker Styles*/
        wp_enqueue_style( $this->plugin_name."datepicker-control", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/jquery.timepicker.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->plugin_name."bootstrap-datepicker", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/bootstrap-datepicker.css', array(), $this->version, 'all' );
        /*end Datepicker Styles*/

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vehicle-rental-public.css', array(), $this->version, 'all' );

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
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        /* DatePicker Scripts*/
        wp_enqueue_script( $this->plugin_name."dp1", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/jquery.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name."dp2", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/jquery.timepicker.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name."dp3", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/bootstrap-datepicker.js', array( 'jquery' ), $this->version, false );
        //bottom scripts
        wp_enqueue_script( $this->plugin_name."dp4", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/datepair.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script( $this->plugin_name."dp5", plugin_dir_url( __FILE__ ) . 'js/datepicker-control/jquery.datepair.js', array( 'jquery' ), $this->version, true );
        /* end daptepicker Scripts*/

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vehicle-rental-public.js', array( 'jquery' ), $this->version, true );

	}




    // User Demographic ShortCode
   public function html_user_demographic_form(){
    echo '   <div class="columns small-12 medium-4">
<div class="translucent-form-overlay translucent-form-overlay-size">
  <form>
    <h3>Please Enter Your Demograpphic Information</h3>
    <div class=" medium-12">
      <label>Name
        <input type="text" name="keyword" placeholder="">
      </label>
    </div>

    <div class="medium-12 ">
      <label>Email
        <input type="text" name="location" placeholder="">
      </label>
    </div>

    <div class="medium-12 ">
      <label>Phone
        <input type="text" name="location" placeholder="">
      </label>
    </div>

    <div class="medium-12 ">
      <label>DOB
        <input type="text" name="location" placeholder="">
      </label>
    </div>

    <div class="medium-12 ">
      <label>Address
        <input type="text" name="location" placeholder="">
      </label>
    </div>

  <div class="medium-12 ">
      <label>Hotel Address
        <input type="text" name="location" placeholder="">
      </label>
    </div>
<div class="medium-12 btn-div">
    <label>
    <button type="button" class="primary button expand search-button">
      Next
    </button>
    </label>

    </div>

 </form>
</div>
</div>';
    }

   public  function form_handler() {

        // if the submit button is clicked, send the email
        if ( isset( $_POST['cf-submitted'] ) ) {

            // sanitize form values
            $name    = sanitize_text_field( $_POST["cf-name"] );
            $email   = sanitize_email( $_POST["cf-email"] );
            $subject = sanitize_text_field( $_POST["cf-subject"] );
            $message = esc_textarea( $_POST["cf-message"] );

            // get the blog administrator's email address


            // If email has been process for sending, display a success message
          echo "congo";
        }
    }

   public  function shortcode_user_demographic(){
            ob_start();
            //$this->form_handler();
            //method to handle request

            $this->html_user_demographic_form();
        return ob_get_clean();
        }

    // end User Demographic ShortCode



    //** Booking Calender  */
    public function html_bookup_calender(){

        echo '

   <div class="large-4 large-centered columns">

<div class="translucent-form-overlay" >
  <form id="datepairExample" action="">

    <div class="row">
    <div class="large-12 columns">
      <label>Pick Up Day
        <input type="text" name="keyword" placeholder="" class="date start" >
      </label>
    </div>
</div>

<div class="row ">
 <div class="large-6 columns">
      <label>Pickup Time
        <input type="text" name="keyword" placeholder="" class="time start">
      </label>
    </div>
 <div class="large-6 columns">
      <label>Return Time
        <input type="text" name="keyword" placeholder="" class="time end">
      </label>
    </div>
</div>

<div class="row ">
<div class="large-12 columns btn-div">
    <label>
    <button type="submit" class="primary button expand search-button">
      Next
    </button>
    </label>
</div>
    </div>

 </form>
</div>
</div>
';

    }

    public  function shortcode_booking_calender(){
        ob_start();
        //$this->form_handler();
        //method to handle request

        $this->html_bookup_calender();

        return ob_get_clean();
}

    // end Booking Calender


    public function html_upload_dl_image(){

        echo '

   <div class="large-4 large-centered columns">

<div class="translucent-form-overlay" >
  <form id="datepairExample" action="">

    <div class="row">
    <div class="large-12 columns">
      <label>Pick Up Day
        <input type="text" name="keyword" placeholder="" class="date start" >
      </label>
    </div>
</div>

<div class="row ">
 <div class="large-6 columns">
      <label>Pickup Time
        <input type="text" name="keyword" placeholder="" class="time start">
      </label>
    </div>
 <div class="large-6 columns">
      <label>Return Time
        <input type="text" name="keyword" placeholder="" class="time end">
      </label>
    </div>
</div>

<div class="row ">
<div class="large-12 columns btn-div">
    <label>
    <button type="submit" class="primary button expand search-button">
      Next
    </button>
    </label>
</div>
    </div>

 </form>
</div>
</div>
';

    }

    public  function shortcode_html_upload_dl_image(){
        ob_start();
        //$this->form_handler();
        //method to handle request

        $this->html_bookup_calender();

        return ob_get_clean();
    }



    // This method is to register all shortcodes
    public function register_shortcodes() {
        add_shortcode('user_demographic_control', array ($this, 'shortcode_user_demographic'));
        add_shortcode('user_booking_calender_control', array ($this, 'shortcode_booking_calender'));

    }

}
