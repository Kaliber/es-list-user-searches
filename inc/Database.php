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

  public static function get_count_search_queries( $filter_name = null ) {
    if ( is_null( $filter_name ) ) {
      return self::get_count();
    }

    return self::get_count( self::get_between_date_condition_by_filter_name( $filter_name ) );
  }

  private static function get_count( $where_condition = null ) {
    global $wpdb;

    $table_name = self::get_table_name();

    if ( is_null( $where_condition ) ) {
      return $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" );
    }
    return $wpdb->get_var( "SELECT COUNT(id) FROM $table_name WHERE $where_condition" );
  }

  private static function get_between_date_condition_by_filter_name( $filter_name ) {
    if ( $filter_name === 'last_day' ) {
      return 'time BETWEEN DATE_ADD(NOW(), INTERVAL -1 day) AND NOW()';
    }
    elseif ( $filter_name === 'last_7days' ) {
      return 'time BETWEEN DATE_ADD(NOW(), INTERVAL -7 day) AND NOW()';
    }
    elseif ( $filter_name === 'last_30days' ) {
      return 'time BETWEEN DATE_ADD(NOW(), INTERVAL -30 day) AND NOW()';
    }
  }
  
  public static function common_query_counter() {
    return self::get_count( self::get_between_date_condition_by_filter_name( 'last_30days' ) );
  }

  public static function unsuccessful_query_counter() {
    $where_condition = self::get_between_date_condition_by_filter_name( 'last_30days' );
    return self::get_count( $where_condition . ' AND hits = 0' );
  }

  public static function get_searched_query_data( $filter_name = null, $successful = true ) {
    if ( $successful ) {
      $where_condition = 'hits > 0';
    } else {
      $where_condition = 'hits = 0';
    }

    if ( !is_null( $filter_name ) ) {
      $where_condition .= ' AND ';
      $where_condition .= self::get_between_date_condition_by_filter_name( $filter_name );
    }

    return self::get_data( $where_condition );
  }

  private static function get_data( $where_condition ) {
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
