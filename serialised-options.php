<?php
/*
Plugin Name: WP CLI Serialised Options
Description: wp option get xyz will return 'array' if it's a PHP array serialised. This is great for humans, but awful for automation.
Author: Tom J Nowell, Code For The People
Version: 1.0
Author URI: http://codeforthepeople.net
*/

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	/**
	 * Manage widget settings.
	 *
	 * @package wp-cli
	 */
	class CFTP_Serialised_Options_Command extends WP_CLI_Command {

		/**
		 * export option
		 */
		public function export( $args, $assoc_args ) {
			$option = '';
			if ( ! empty( $assoc_args['option'] ) ) {
				$option = $assoc_args['option'];
			}
			$value  = get_option( $option );
			echo base64_encode( serialize( $value ) );
		}

		public function import( $args, $assoc_args ) {
			$option = '';
			if ( ! empty( $assoc_args['option'] ) ) {
				$option = $assoc_args['option'];
			}
			$value = '';
			if ( ! empty( $assoc_args['value'] ) ) {
				$value = $assoc_args['value'];
			}

			$data = unserialize( trim( base64_decode( $value ) ) );

			$updated = update_option( $option, $data );
			if ( $updated ) {
				//
			} else {
				WP_CLI::error( 'Option "'.$option.'" update failed' );
			}
		}

	}

	WP_CLI::add_command( 'serialised_option', 'CFTP_Serialised_Options_Command' );
}
