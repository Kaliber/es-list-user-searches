<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Setup
{
  public static function on_activation()
  {
    if ( ! current_user_can( 'activate_plugins' ) )
      return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "activate-plugin_{$plugin}" );

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
  }

  public static function on_deactivation()
  {
    if ( ! current_user_can( 'activate_plugins' ) )
      return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "deactivate-plugin_{$plugin}" );

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
  }

  public static function on_uninstall()
  {
    if ( ! current_user_can( 'activate_plugins' ) )
      return;
    check_admin_referer( 'bulk-plugins' );

    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
      return;

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
  }
}
