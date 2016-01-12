<?php
if ( !defined( 'ABSPATH' ) ) exit;

class Setup {

  public static function on_activation() {
    if ( !current_user_can( 'activate_plugins' ) ) {
      return;
    }
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "activate-plugin_{$plugin}" );

    Database::install_database();
  }

  public static function on_uninstall() {
    if ( !current_user_can( 'activate_plugins' ) ) {
      return;
    }
    check_admin_referer( 'bulk-plugins' );

    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
      return;

    Database::clear_table();
  }

}
