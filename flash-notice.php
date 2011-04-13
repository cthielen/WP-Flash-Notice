<?php
/**
 * @package Flash_Notice
 * @version 0.1
 */
/*
Plugin Name: Flash Notice
Plugin URI: 
Description: Displays a notice in the template where desired. Notice can be string or HTML.
Author: Christopher Thielen
Version: 0.1
Author URI: http://christopherthielen.com/
*/

// Set the default message to NULL
add_option('wp-flash-notice-msg', "");

// Template tag function to be called from any template
function flash_notice_tag() {
	echo get_option('wp-flash-notice-msg');
}

// Set up the admin panel menu
add_action('admin_menu', 'wp_flash_notice_create_menu');

function wp_flash_notice_create_menu() {
	// create new top-level menu
	add_menu_page('Flash Notice Settings', 'Flash Notice Settings', 'administrator', __FILE__, 'flash_notice_settings_page');

	// call register settings function
	add_action( 'admin_init', 'register_flash_notice_settings' );
}


function register_flash_notice_settings() {
	register_setting( 'wp-flash-notice-settings-group', 'wp-flash-notice-msg' );
}

function flash_notice_settings_page() {
?>
<div class="wrap">
<h2>Flash Notice</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'wp-flash-notice-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Flash Notice</th>
        <td><textarea name="wp-flash-notice-msg" rows="8" cols="50"><?php echo get_option('wp-flash-notice-msg'); ?></textarea><br /><i>Set as blank to disable.</i></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>

<?php } ?>
