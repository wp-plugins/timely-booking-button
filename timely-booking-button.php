<?php
/*
 * Plugin Name: Timely Booking Button
 * Plugin URI: http://wordpress.org/extend/plugins/timely-booking-button/
 * Description: Adds a "Book Now" button for the Timely appointment management system to your WordPress site
 * Author: Timely Team
 * Version: 0.1
 * Author URI: http://www.gettimely.com/
 */
 
 function tbb_admin_actions() {  
    add_options_page("Timely", "Timely", 1, "timely-booking-button", "tbb_admin");  
}  

function tbb_admin() {
    include('timely-booking-button-admin.php');
}

function tbb_init()
{
  wp_register_sidebar_widget('tbb-widget','Timely Booking Button', 'tbb_widget_output', array ( 'description' => 'Add a booking button for your Timely account'));     
}
 
function tbb_widget_output() {    
    $account = get_option('tbb_account');
    $colour = get_option('tbb_colour'); 
    
    if ($account != "") {
        extract($args);
    
        echo $before_widget;?>
        <div style='padding: 20px 0;'>
        <script id="timelyScript" src="http://bookings.gettimely.com/widget/book-button.js"></script>
        <script>var timelyButton = new timelyButton("<?php echo $account; ?>"<?php echo ( $colour == 'dark' ? ', { style : "dark" }' : ''); ?>);</script>
        </div>
    <?php
        echo $after_widget;
    }    
}

function tbb_account_check_callback() {
    $url = "http://app.gettimely.com/Register/GetSubdomainAvailability/" . $_POST['tbb_account'];	
    $response = file_get_contents($url);
    
    echo ($response == "false" ? "correct" : "wrong");

	die(); // this is required to return a proper result
}

function admin_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/timely-booking-button.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}

function tbb_admin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=timely-booking-button">Settings</a>';
  	array_push( $links, $settings_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'tbb_admin_add_settings_link' );

add_action('admin_head', 'admin_register_head');
add_action("plugins_loaded", "tbb_init"); 
add_action('admin_menu', 'tbb_admin_actions');
add_action('wp_ajax_tbb_account_check', 'tbb_account_check_callback');

add_shortcode('tbb-button', 'tbb_widget_output');

?>
 
