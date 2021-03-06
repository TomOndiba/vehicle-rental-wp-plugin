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



    public  function calendar_form_handler() {

        // if the submit button is clicked, send the email

        if ( isset( $_POST['pick-date-time'] ) ) {
            // sanitize form values
            $pick_up_date   = sanitize_text_field( $_POST["pick_up_date"] );
            $pick_up_time   = sanitize_text_field( $_POST["pick_up_time"] );
            $return_time = sanitize_text_field( $_POST["return_time"] );
            // setcookie("pickup-date-time",1 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );

            //REDIRECT TO PAGE
            $redirectTo="plugin-page";
            $url= add_query_arg( array(
                'pd' => $pick_up_date,
                'pt' => $pick_up_time,
                'rt' => $return_time,
            ), get_home_url()."/".$redirectTo );

            wp_redirect($url);
            exit();
        }
    }

    public function  demographic_form_handler(){
        if (isset($_POST['booker-demographic-submitted'])){

            $name=(!isset( $_POST['bkr_name']) && empty($_POST['bkr_name']) ? null :sanitize_text_field($_POST['bkr_name'])    );
            $email=(!isset( $_POST['bkr_email']) && empty($_POST['bkr_email']) ? null :sanitize_email($_POST['bkr_email'])    );
            $phone=(!isset( $_POST['bkr_phone']) && empty($_POST['bkr_phone']) ? null :sanitize_text_field($_POST['bkr_phone'])    );
            $dob=(!isset( $_POST['bkr_dob']) && empty($_POST['bkr_dob']) ? null :sanitize_text_field($_POST['bkr_dob'])    );
            $address=(!isset( $_POST['bkr_address']) && wp_checkdate($_POST['bkr_address']) ? null :sanitize_text_field($_POST['bkr_address'])    );
            $haddress=(!isset( $_POST['bkr_haddress']) && empty($_POST['bkr_address']) ? null :sanitize_text_field($_POST['bkr_haddress'])    );

            $pick_up_date=(!isset( $_POST['pick-up-date']) && wp_checkdate($_POST['pick-up-date']) ? null: sanitize_text_field($_POST['pick-up-date']) );
            $pick_up_time=(!isset( $_POST['pick-up-time']) && empty($_POST['pick-up-time']) ?null :sanitize_text_field($_POST['pick-up-time'])    );
            $return_time=(!isset( $_POST['return-time']) && empty($_POST['return-time']) ?null : sanitize_text_field($_POST['return-time'])    );

            if ( empty( $pick_up_date) || empty( $pick_up_time) || empty( $return_time) ) {
                //REDIRECT TO PAGE
                $redirectTo="calendar";
                $url=  get_home_url()."/".$redirectTo ;
                wp_redirect($url);
                exit();
            }


            if (empty($name) || empty($email) || empty($phone) || empty($address) ||  empty($dob)){
                $redirectTo="plugin-page"; //Type page name of another
                $url=  get_home_url()."/".$redirectTo ;
                wp_redirect($url);
                exit();
            }


            //INSERT data into Db
            global $wpdb;

            //$token="dsdsdasd";//md5($name.now());
            $token=bin2hex(mcrypt_create_iv(128, MCRYPT_DEV_URANDOM ));//bin2hex(random_bytes(8));

         //   echo "t--". $token;
           // exit();

            $wpdb->insert( 'wp_bookers',
                array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'hotel_address' => $haddress,
                    'dob' => $dob,
                    'dl_passport_image_path' => 'value1',
                    'token' => $token

                ),
                array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                    //'%d'
                )  );



            if ($wpdb->insert_id >0){

                     $new_booker_id = $wpdb->insert_id;

                    $wpdb->insert( 'wp_orders',
                        array(
                            'booker_id' => $new_booker_id,
                            'vehicle_id' => 1,
                            'pick_up_date' =>$pick_up_date,
                            'pick_up_time' =>$pick_up_time,
                            'return_time' => $return_time
                        ),
                        array(
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s'
                        )  );

                    $is_order_inserted=$wpdb->get_var( "SELECT COUNT(booker_id) FROM wp_orders" );

                    if ($is_order_inserted>0){

                      //  setcookie( "booker_token", $token,  DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );


//                        setcookie( "booker_token", $token);


                        $redirectTo="upload-dl"; //Type page name of another
                        $url= add_query_arg( array(
                            'tkn' => $token
                        ), get_home_url()."/".$redirectTo );
                        wp_redirect($url);


                        exit();
                        //echo "order-inserted " ;

                        //var_dump($_COOKIE['booker_token']);
                       //echo "d--- ".$_COOKIE['booker_token'];
                       //unset( $_COOKIE["booker_token"] );
                        // setcookie( "booker_token", '', time() - ( 15 * 60 ) );

                        //exit();
                    }else{
                        //echo "NOT---order-inserted ";
                        //$wpdb->show_errors();
                        //$wpdb->print_error();
                        exit();
                    }

            }else{
                exit();
            }

        }
    }


    public function upload_dl_handler(){
        if (isset($_POST['upload-dl-image-submitted'])){
            if ( ! function_exists( 'wp_handle_upload' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }

            $uploadedfile = $_FILES['file'];
            $upload_overrides = array( 'test_form' => false );
            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

            //if(!isset($_COOKIE[$v_username])) {
            global $wpdb;

            $booker_token=(!isset( $_POST['tkn']) && empty($_POST['tkn']) ?null : sanitize_text_field($_POST['tkn'])    );

            //Check Validity of token

          //  if(isset($_COOKIE['booker_token'])){
            if(empty($booker_token)){
                $redirectTo="calendar";
                $url=  get_home_url()."/".$redirectTo ;
                wp_redirect($url);
                exit();
            }
            $booker_row=$wpdb->get_row( "SELECT booker_id FROM wp_bookers WHERE token = '$booker_token' ");
            $booker_id=$booker_row->booker_id;


            if ( $movefile && ! isset( $movefile['error'] ) ) {

                $wpdb->update(
                    'wp_bookers',
                    array(
                        'dl_passport_image_path' =>  $movefile['file'],
                    ),
                    array( 'booker_id' => $booker_id ),
                    array(
                        '%s'
                    ),
                    array( '%d' )
                );

                //echo "File is valid, and was successfully uploaded.\n";

                $redirectTo="docu-sign-message";
               // $url=  get_home_url()."/".$redirectTo ;
                $url=add_query_arg( array(
                    'tkn' => $booker_token
                ), get_home_url()."/".$redirectTo );

                wp_redirect($url);
                exit();
            } else {
                /**
                 * Error generated by _wp_handle_upload()
                 * @see _wp_handle_upload() in wp-admin/includes/file.php
                 */
              //  echo $movefile['error'];
            }

        }
    }

    public function secure_submit_handler02(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        function SendEmail($to, $from, $subject, $body, $isHtml)
        {
            $message = '<html><body>';
            $message .= $body;
            $message .= '</body></html>';

            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";

            if ($isHtml) {
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
            }

            mail($to, $subject, $message, $headers);
        }

        function chargeToken($chargeService, $suToken, $validCardHolder, $additionalData)
        {
            try {
                $response = $chargeService->charge(
                    $_GET["payment_amount"],
                    'usd',
                    $suToken,
                    $validCardHolder,
                    false,
                    $additionalData
                );
            } catch (CardException $e) {
                return 'Failure: ' . $e->getMessage();
            } catch (Exception $e) {
                return 'Failure: ' . $e->getMessage();
            }
            return $response;
        }

        require_once "secure_submit_lib/Hps.php";

        $config = new HpsServicesConfig();
        $config->secretApiKey = 'skapi_cert_Mb_iAQCGC18A3ov5puHZ9Kr0JE57Y7cGLR9753pKOg';

// the following variables will be provided to you during certificaiton.
        $config->versionNumber = '0000';
        $config->developerId = '000000';

        $chargeService = new HpsCreditService($config);

        $address = new HpsAddress();
        $address->address = $_GET["Address"];
        $address->city = $_GET["City"];
        $address->state = $_GET["State"];
        $address->zip = $_GET["Zip"];
        $address->country = "United States";

        $validCardHolder = new HpsCardHolder();
        $validCardHolder->firstName = $_GET["FirstName"];
        $validCardHolder->lastName = $_GET["LastName"];
        $validCardHolder->address = $address;
        $validCardHolder->phone = $_GET["PhoneNumber"];

        $suToken = new HpsTokenData();
        $suToken->tokenValue = isset($_GET['token_value']) ? $_GET['token_value'] : '';

        $details = new HpsTransactionDetails();
        $details->invoiceNumber = $_GET["invoice_number"];

        $response = chargeToken($chargeService, $suToken, $validCardHolder, $details);

        if (is_string($response)) {
            echo "error: " . $response;
            exit;
        }

        $body = '<h1>Success!</h1>';
        $body .= '<p>Thank you, '.$_GET['FirstName'].', for your order of $'.$_GET["payment_amount"] .'.</p>';

        echo "Transaction Id: " . $response->transactionId;
        echo "<br />Invoice Number: " . $_GET["invoice_number"];
// i'm running windows, so i had to update this:
//ini_set("SMTP", "my-mail-server");

//SendEmail($_GET['Email'], 'donotreply@e-hps.com', 'Successful Charge!', $body, true);

    }

    public function secure_submit_handler(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

        function sendEmail($to, $from, $subject, $body, $isHtml)
        {
            $message = '<html><body>';
            $message .= $body;
            $message .= '</body></html>';

            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";

            if ($isHtml) {
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
            }

            mail($to, $subject, $message, $headers);
        }

        function chargeToken($creditService, $suToken, $validCardHolder, $additionalData)
        {
            try {
                $response = $creditService->charge(
                    $_GET["payment_amount"],
                    'usd',
                    $suToken,
                    $validCardHolder,
                    false,
                    $additionalData
                );
            } catch (CardException $e) {
                return 'Failure: ' . $e->getMessage();
            } catch (Exception $e) {
                return 'Failure: ' . $e->getMessage();
            }
            return $response;
        }

        require_once "secure_submit_lib/Hps.php";

        $config = new HpsServicesConfig();
        $config->secretApiKey = 'skapi_cert_Mb_iAQCGC18A3ov5puHZ9Kr0JE57Y7cGLR9753pKOg';

// the following variables will be provided to you during certificaiton.
        $config->versionNumber = '0000';
        $config->developerId = '000000';

        $creditService = new HpsCreditService($config);

        $address = new HpsAddress();
        $address->address = $_GET["Address"];
        $address->city = $_GET["City"];
        $address->state = $_GET["State"];
        $address->zip = $_GET["Zip"];
        $address->country = "United States";

        $validCardHolder = new HpsCardHolder();
        $validCardHolder->firstName = $_GET["FirstName"];
        $validCardHolder->lastName = $_GET["LastName"];
        $validCardHolder->address = $address;
        $validCardHolder->phone = $_GET["PhoneNumber"];

        $suToken = new HpsTokenData();
        $suToken->tokenValue = $_GET['token_value'];

        $details = new HpsTransactionDetails();
        $details->invoiceNumber = $_GET["invoice_number"];

        $response = chargeToken($creditService, $suToken, $validCardHolder, $details);

        if (is_string($response)) {
            echo "error: " . $response;
            exit;
        }

        $body = '<h1>Success!</h1>';
        $body .= '<p>Thank you, '.$_GET['FirstName'].', for your order of $'.$_GET["payment_amount"] .'.</p>';

        echo "Transaction Id: " . $response->transactionId;
        echo "<br />Invoice Number: " . $_GET["invoice_number"];

    }
    // User Demographic ShortCode
    public function html_user_demographic_form(){

        $pick_up_date=(!isset( $_GET['pd']) && wp_checkdate($_GET['pd']) ? null: sanitize_text_field($_GET['pd']) );
        $pick_up_time=(!isset( $_GET['pt']) && empty($_GET['pt']) ?null :sanitize_text_field($_GET['pt'])    );
        $return_time=(!isset( $_GET['rt']) && empty($_GET['rt']) ?null : sanitize_text_field($_GET['rt'])    );


        if ( empty( $pick_up_date) || empty( $pick_up_time) || empty( $return_time) ) {
            //REDIRECT TO PAGE
            $redirectTo="calendar";
            $url=  get_home_url()."/".$redirectTo ;
            wp_redirect($url);
            exit();
        }

        echo '

    <section class="hero bg-demographic">
      <div class="row intro">
       <div class="columns small-12 medium-4  medium-offset-7 margin-top-5" >
    <div class="translucent-form-overlay translucent-form-overlay-size">
      <form method="post" id="demographicForm" name="demographics" class="vr_plg_form">
        <h3>Please Enter Your Demograpphic Information</h3>
        <div class=" medium-12">
          <label for="bkr_name">Name* </label>
            <input id="bkr_name" type="text" name="bkr_name" placeholder="">

        </div>

        <div class="medium-12 ">
          <label for="brk_email">Email*</label>
            <input type="text" id="brk_email" name="bkr_email" placeholder="">
        </div>

        <div class="medium-12 ">
          <label for="brk_phone">Phone* </label>
            <input type="text" id="brk_phone" name="bkr_phone" placeholder="" class="phone">
        </div>

        <div class="medium-12 ">
          <label for="brk_dob">DOB* </label>
            <input id="brk_dob" type="text" name="bkr_dob" placeholder="" class="date">

        </div>

        <div class="medium-12 ">
          <label for="brk_address">Address* </label>
            <input id="brk_address" type="text" name="bkr_address" placeholder="">
        </div>

      <div class="medium-12 ">
          <label>Hotel Address
            <input type="text" name="bkr_haddress" placeholder="">
          </label>
        </div>
    <div class="medium-12 btn-div">
    <input type="hidden" name="pick-up-date" value="'.$pick_up_date.'" />
    <input type="hidden" name="pick-up-time" value="'.$pick_up_time.'" />
    <input type="hidden" name="return-time" value="'.$return_time.'" />
        <label>
         <input type="submit" class="primary button expand " name="booker-demographic-submitted" value="Next"/>
        </label>


        </div>

     </form>
    </div>
    </div>
    </div>
    </section>


<script src="'.plugin_dir_url( __FILE__ ).'js/jquery.validate.min.js"></script>
<script src="'.plugin_dir_url( __FILE__ ).'js/jquery.mask.min.js"></script>
<script src="'.plugin_dir_url( __FILE__ ).'js/demographic-validation.js"></script>
    ';
    }

    public function html_bookup_calender(){

        echo '

        <section class="hero bg-calender">
  <div class="row intro">

   <div class="large-4 large-centered columns margin-top-10">
<h2 class="text-center">Book Vehicle</h2>
<div class="translucent-form-overlay " >

  <form id="datepairExample" action="" method="post">

    <div class="row">
    <div class="large-12 columns">
      <label>Pick Up Day
        <input type="text" name="pick_up_date" placeholder="" class="date start" id="pick_up_date" >
      </label>
    </div>
</div>

<div class="row ">
 <div class="large-6 columns">
      <label>Pickup Time
        <input type="text" name="pick_up_time" placeholder="" class="time start" id="pick_up_time">
      </label>
    </div>
 <div class="large-6 columns">
      <label>Return Time
        <input type="text" name="return_time" placeholder="" class="time end" id="return_time">
      </label>
    </div>
</div>

<div class="row ">
<div class="large-12 columns btn-div">
    <label>
    <input type="submit" class="primary button expand " name="pick-date-time" value="Next" />
    </label>
</div>
    </div>

 </form>
</div>
</div>
</div>
</section>

<script src="'.plugin_dir_url( __FILE__ ).'js/calendar-validation.js"></script>
';

    }

    public function html_upload_dl_image(){

         if(!isset($_GET['tkn'])){
            $redirectTo="calendar";
            $url=  get_home_url()."/".$redirectTo ;
          //  wp_redirect($url);
            //exit();
        }

        $token=(!isset( $_GET['tkn']) && empty($_GET['tkn']) ?null : sanitize_text_field($_GET['tkn'])    );

        echo '

<script type="text/javascript" src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.js"></script>


<section class="hero bg-demographic">
  <div class="row intro">

   <div class="columns small-12 medium-4  medium-offset-7 margin-top-10" >


<div class="translucent-form-overlay" >
 <h3>Please Upload Image of Your Driving License or Passport</h3>
  <form id="filePickerForm" enctype="multipart/form-data" method="post" class="vr_plg_form">

    <div class="row">
    <div class="large-12 columns">
      <div id="image-preview">
  <label for="image-upload" id="image-label">Choose File</label>
  <input type="file" name="file" id="image-upload" class="required" accept="image/jpeg,image/png"/>
</div>
    </div>
</div>


<div class="row ">
<div class="large-12 columns btn-div">
    <h4 class="error"></h4>
    <input type="hidden" name="tkn" value="'.$token.'"/>
    <label>
     <input type="submit" class="primary button expand " name="upload-dl-image-submitted" value="Next"/>
    </label>
</div>
    </div>

 </form>
</div>
</div>
</div>
</section>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit

</script>

<script type="text/javascript">


$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });

});
jQuery.validator.setDefaults({
  //debug: true,
  success: "valid",
  errorPlacement: function(error, element) {
        error.appendTo(".error");
    }
});
$( "#filePickerForm" ).validate({


  rules: {
    file: {
      required: true,
      extension: "png|jpg"
    }
  },
messages: {
    file:   {
                required:"Please upload  driving license/passport image",
                extension:"Please upload Png or JPP image only"
        }
}




});

</script>

';

    }

    public function html_docu_sign(){

        $booker_token=(!isset( $_GET['tkn']) && empty($_GET['tkn']) ?null : sanitize_text_field($_GET['tkn'])    );
        $status=(!isset( $_GET['status']) && empty($_GET['status']) ?null : sanitize_text_field($_GET['status'])    );

        if ($status=="signing_completed" && !empty($booker_token)){
            global $wpdb;
            $booker_row=$wpdb->get_row( "SELECT booker_id, booker_name, email FROM wp_bookers WHERE token = '$booker_token' ");
            $booker_id=$booker_row->booker_id;

            $wpdb->update(
                'wp_orders',
                array(
                    'document_signed' =>  'y'

                ),
                array( 'booker_id' => $booker_id ),
                array(
                    '%s'
                ),
                array( '%d' )
            );

            $redirectTo="calendar";
            $url=  get_home_url()."/".$redirectTo ;
            wp_redirect($url);
            exit();

        }

        if (!empty($booker_token)){

        require_once('docusign_lib/docuSign.php');
        $docSignSample = New DocuSignSample();
        $docSignSample->signatureRequestFromTemplate($booker_token);
    }

    }



/*<section class="hero bg-demographic">
  <div class="row intro">

   <div class="columns small-12 medium-4  medium-offset-7 margin-top-10" >
   <div class="translucent-form-overlay" >
 <h3>Card information</h3>
        <form class="payment_form form-horizontal" id="payment_form" method="post">

      <div class="form-group">
        <div id="securesubmit" class="col-sm-10"></div>
      </div>
<script src="'.plugin_dir_url( __FILE__ ).'js/calendar-validation.js"></script>
      <br />
      <input type="hidden" id="token_value" name="token_value" />
      <input type="button" value="Submit Payment" id="PaymentButton" />
      <br />
    </form>
    </div>
    </div>
    </div>
    </section>

  <script src="https://api.heartlandportico.com/SecureSubmit.v1/token/2.0/securesubmit.js"></script>
<script src="'.plugin_dir_url( __FILE__ ).'js/securesubmit.js"></script>*/
    public function html_secure_submit(){
        echo '
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="'.plugin_dir_url( __FILE__ ).'js/secure.submit-1.0.2.js"></script>*/

 <section class="hero bg-demographic">
      <div class="row intro">
       <div class="columns small-12 medium-4  medium-offset-7 margin-top-5" >
    <div class="translucent-form-overlay translucent-form-overlay-size">
      <form method="post" id="demographicForm" name="demographics" class="vr_plg_form">
        <h3>Please Enter Your Card Information</h3>
        <div class=" medium-12">
          <label for="card_number">Card Number* </label>
            <input id="card_number" type="text" name="card_number" placeholder="">

        </div>

        <div class="medium-12 ">
          <label for="card_cvc">CVC*</label>
            <input type="text" id="card_cvc" name="card_cvc" placeholder="">
        </div>

        <div class="medium-12">
          <label for="exp_month">Expiration Date* </label>
           <!-- <input type="text" id="exp_month" name="exp_month" placeholder="" class="phone">-->
            <select id="exp_month" name="exp_month" class="medium-5 columns">
			<option>01</option>
            		<option>02</option>
            		<option>03</option>
            		<option>04</option>
            		<option>05</option>
            		<option>06</option>
            		<option>07</option>
            		<option>08</option>
            		<option>09</option>
            		<option>10</option>
            		<option>11</option>
            		<option>12</option>
		</select>
		<label class="medium-2 columns text-center">/</label>
		<select id="exp_year" name="exp_year" class="medium-5 columns"></select>
        </div>

    <div class="medium-12 btn-div">
        <label>
         <input type="submit" class="primary button expand " name="booker-demographic-submitted" value="Next"  id="PaymentButton" />
        </label>


        </div>

     </form>
    </div>
    </div>
    </div>
    </section>
    <script src="'.plugin_dir_url( __FILE__ ).'js/securesubmit.js"></script>

        ';
    }


    // end User Demographic ShortCode

public function send_booking_confirmation_email_to_booker($booker_email){
    try{

        $to = $booker_email;
        $subject = "vehicle booked";
        $content = "we have booked vehicle for you. Please show this email message at pick place to our staff.";
        $status = wp_mail($to, $subject, $content);

    }
    catch(Exception $e){
        var_dump ($e);
    }

}

    public  function shortcode_user_demographic(){
        ob_start();
        //$this->form_handler();
        $this->html_user_demographic_form();
        $this->demographic_form_handler();
        return ob_get_clean();
    }

    public  function shortcode_booking_calender(){
        ob_start();
        $this->html_bookup_calender();
        $this->calendar_form_handler();
        return ob_get_clean();
    }

    public  function shortcode_html_upload_dl_image(){
        ob_start();
        //$this->form_handler();
        //method to handle request

        $this->html_upload_dl_image();
        $this->upload_dl_handler();
        return ob_get_clean();
    }

    public  function shortcode_docu_sign(){
        ob_start();
        //$this->form_handler();
        $this->html_docu_sign();
        return ob_get_clean();
    }

    public  function shortcode_secure_submit(){
        ob_start();
        //$this->form_handler();
        $this->html_secure_submit();
        $this->secure_submit_handler();
        return ob_get_clean();
    }


    // This method is to register all shortcodes
    public function register_shortcodes() {
        add_shortcode('user_demographic_control', array ($this, 'shortcode_user_demographic'));
        add_shortcode('user_booking_calender_control', array ($this, 'shortcode_booking_calender'));
        add_shortcode('user_upload_image_control', array ($this, 'shortcode_html_upload_dl_image'));
        add_shortcode('user_docu_sign_control', array ($this, 'shortcode_docu_sign'));
        add_shortcode('user_secure_submit_control', array ($this, 'shortcode_secure_submit'));


    }

}
