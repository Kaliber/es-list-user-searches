<?php
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'register_admin_menu_page' );

function register_admin_menu_page() {
  add_dashboard_page( 'ES User searches', 'ES user searches', 'read', 'es-list-user-searches', 'load_page' );
}

function load_page() {
  require_once plugin_dir_path( __FILE__ ) . 'pages/overview.php';
}
