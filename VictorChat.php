<?php
/*
	Plugin Name: VictorChat
	Plugin URI: http://www.victorchat.dk/plugin.php?lang=en
	Description: VictorChat is a live chat solution that helps website owners convert their visitors into customers!
	Version: 1.0
	Author: VictorChat
	Author URI: http://www.victorchat.dk/index.php?lang=en
	Compatible up to: 4.0 and up.
	License: © Copyright All rights Reserved. No copying, changing or anything else allowed, without written approval from VictorChat.dk
*/

//add_action('init', 'do_output_buffer');

add_action('wp_footer', 'VictorChat_init');

add_action('admin_menu', 'getVictorChatAdminMenu');

register_activation_hook( __FILE__, 'VictorChat_activate_plugin' );

add_action('admin_init', 'redirectToVictorChatAdminPage');


 load_plugin_textdomain( 'victorchatlang', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' ); 
//function do_output_buffer() {
//        ob_start();
//}

function VictorChat_init() {
	$license = get_option('txtLicense');
	addVictorChatScript($license);
}

function addVictorChatScript($license) {
	if ($license != '')
	{
		
$html =	$license;
		

echo $html;
	}	
}

function getVictorChatAdminMenu() {
	$icon = "http://www.victorchat.dk/images/plugins/wordpress/favicon.png";
	add_menu_page(__('VictorChat','victorchatlang'), __('VictorChat','victorchatlang'), 10, dirname( __FILE__ ) . '/VictorChat.php', '', $icon);
	add_submenu_page(dirname( __FILE__ ) . '/VictorChat.php', __('Settings','victorchatlang'), __('Settings','victorchatlang'), 'manage_options', dirname( __FILE__ ) . '/VictorChat.php', __('VictorChat_settings','victorchatlang'));
}

function VictorChat_settings() {
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.¨Refresh and the plugin will be installed anyway','victorchatlang'));
	}
	
	$hidVictorChat = 'hidVictorChat';

	if(isset($_POST[$hidVictorChat]) && $_POST[$hidVictorChat] == 'IsPostBack') {
		
		$html1 = stripslashes($_POST['txtLicense']);
       
  
		
		
		update_option('txtLicense', $html1);
?>
<div><p><?php _e('<span style="color:#52a634">Changes have been saved.</span> <strong>Start using VictorChat.</strong>', 'menu-general','victorchatlang' );?></p></div>
<?php
}
?>
<form name="form1" method="post" action="">
	<input type="hidden" name="<?php echo $hidVictorChat; ?>" value="IsPostBack"><br>
	<h1 style="color:#52a634"><?php _e('Getting Started with VictorChat','victorchatlang' );?></h1>
	<h3><?php _e('Step 1','victorchatlang' );?></h3>
    <p><?php _e('To add VictorChat onto your WordPress website, first <a href="http://www.victorchat.dk/signup.php?lang=en" target="_blank" title="Get a FREE VictorChat account">Sign up</a> for a FREE account','victorchatlang' );?></p>
    <h3><?php _e('Step 2','victorchatlang' );?></h3>
	<p><?php _e('<a href="http://www.victorchat.dk/login.php?lang=en" target="_blank" title="Login">Log into</a> your VictorChat account','victorchatlang' );?></p>
	 <h3><?php _e('Step 3','victorchatlang' );?></h3>
	<p><?php _e('Click <strong>Code & Setup</strong> in the left menu and copy the HTML code from there</p>','victorchatlang' );?>
   <h3><?php _e('Step 4','victorchatlang' );?></h3>
	<p><?php _e('Paste the HTML code into the below field','victorchatlang' );?></p>
    <h3><?php _e('Step 5','victorchatlang' );?></h3>
	<p>Click <strong>'Save'</strong></p>
	<textarea rows="5" cols="50" name="txtLicense"><?php echo htmlspecialchars(get_option('txtLicense')) ?></textarea>
	<br><em><small><?php echo _e('If you need help or have questions regarding this plugin, please contact VictorChat ','victorchatlang'); ?><a href="http://www.victorchat.dk/index.php?lang=en" target="_blank" title="Login"><?php _e('support','victorchatlang' );?></a></em></small>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save','victorchatlang'); ?>" />
	</p>
	</form>
<?php
}
?>
<?php
function VictorChat_activate_plugin() {
    add_option('redirectToVictorChatAdminPage', true);
}

function redirectToVictorChatAdminPage() {
    if (get_option('redirectToVictorChatAdminPage', false)) {
        delete_option('redirectToVictorChatAdminPage');
    	wp_redirect(admin_url('admin.php?page=victorchat/VictorChat.php'));
    }
}
?>
