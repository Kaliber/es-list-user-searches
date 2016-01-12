<?php
/**
* Plugin Name: ElasticSearch List User Searches
* Description: List User Searches in Wordpress back-end, from ElasticSearch queries.
* Plugin URI: http://#
* Author: Davey Kropf
* Author URI: https://dkropf.nl
* Version: 1.0
* License: GPL2
*/

/*
Copyright (C) 2016  Davey Kropf  davey.kropf@gmail.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'plugins_loaded', array( 'ES_LIST_USER_SEARCHES', 'get_instance' ) );
register_activation_hook( __FILE__, array( 'Setup', 'on_activation' ) );
register_uninstall_hook( __FILE__, array( 'Setup', 'on_uninstall' ) );

class ES_LIST_USER_SEARCHES {

  private static $instance = null;

  public static function get_instance() {
    if ( ! isset( self::$instance ) )
      self::$instance = new self;

    return self::$instance;
  }

  public function __construct()
  {
    add_action( current_filter(), array( $this, 'load_files' ), 30 );
  }

  public function load_files()
  {
    foreach ( glob( plugin_dir_path( __FILE__ ).'inc/*.php' ) as $file )
      include_once $file;
  }

}
