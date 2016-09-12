<?php
/*
Plugin Name: Minit Cron Purge
Plugin URI: https://geek.hellyer.kiwi/plugins/
Description: Purges the Minit cache automatically, via WP Cron
Author: Ryan Hellyer
Version: 1.0
Author URI: https://geek.hellyer.kiwi/
*/


/**
 * Purge Minit cache via WP Cron job.
 */
class Minit_Cron_Purge {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		// Schedule and deschedule on plugin activation/deactivation
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		// Hook the cache purge
		add_action( 'minit_cron_purge', array( $this, 'purge_cache' ) );

	}

	/*
	 * Activate Cron job
	 */
	public static function activate() {
		wp_schedule_event( time(), 'weekly', 'minit_cron_purge' );
	}

	/*
	 * Deactivate Cron job
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook( 'minit_cron_purge' );
	}

	/*
	 * Purge the cache.
	 */
	public function purge_cache() {

		do_action( 'minit-cache-purge-delete' );

	}

}
new Minit_Cron_Purge;
