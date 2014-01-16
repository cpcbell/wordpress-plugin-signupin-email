<?php
/**
 * Plugin Name: SignUpIn Email 
 * Plugin URI: http://jupiterbase.com/signupin-email
 * Description: Overrides standard registration / sign up email.
 * Version: 1.0
 * Author: jbell 
 * Author URI: http://jupiterbase.com
 * License: GPL2
 */

if ( !function_exists('wp_new_user_notification') ) :
/**
 * Notify the blog admin of a new user, normally via email.
 *
 * @since 2.0
 *
 * @param int $user_id User ID
 * @param string $plaintext_pass Optional. The user's plaintext password
 */
function wp_new_user_notification($user_id, $plaintext_pass = '') {
	$user = get_userdata( $user_id );

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$signIn = join(array(get_site_url(),'/sign-in/'));

	$message  = sprintf(__('Username: %s'), $user->user_email) . "\r\n";
	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
	$message .= sprintf(__('Sign in at: %s'),$signIn) . "\r\n";

	wp_mail($user->user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);

}
endif;

?>
