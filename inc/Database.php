<?php
if ( !defined( 'ABSPATH' ) ) exit;

class ES_List_User_Searches_Database {

  private static function get_table_name() {
    global $wpdb;
    return $wpdb->prefix . 'es_user_searches';
  }

  public static function install_database() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = self::get_table_name();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
      query varchar(200) NOT NULL,
      url varchar(255) DEFAULT '' NOT NULL,
      hits mediumint(9) DEFAULT 0 NOT NULL,
      UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
  }

  public static function clear_table() {
    global $wpdb;

    $table_name = self::get_table_name();
    $wpdb->query( 'TRUNCATE TABLE '. $table_name );
  }

  public static function save_search( $search_query, $total_hits, $search_url ) {
    $search_query = esc_sql( $search_query );
    $search_url   = esc_sql( $search_url );
    $total_hits   = esc_sql( $total_hits );

    if ( strlen( $search_query ) > 200 ) {
      $search_query = substr( $search_query, 0, 200 );
    }

    if ( strlen( $search_url ) > 200 ) {
      $search_url = substr( $search_url, 0, 255 );
    }

    global $wpdb;

    $table_name = self::get_table_name();
    $wpdb->query( $wpdb->prepare( 
      "
        INSERT INTO $table_name
        ( query, url, hits )
        VALUES ( %s, %s, %d )
      ", 
      $search_query, $search_url, $total_hits 
    ) );
  }

  public static function get_count( $where_condition = null ) {
    global $wpdb;

    $table_name = self::get_table_name();

    if ( is_null( $where_condition ) ) {
      return $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" );
    }
    return $wpdb->get_var( "SELECT COUNT(id) FROM $table_name WHERE $where_condition" );
  }

  public static function get_data( $where_condition ) {
    global $wpdb;

    $table_name = self::get_table_name();
    return $wpdb->get_results( 
      "
        SELECT ID, query, hits, url, count(query) as count
        FROM $table_name
        WHERE $where_condition
        GROUP BY query
        ORDER BY count DESC
        LIMIT 0, 20
      "
    );
  }

}
