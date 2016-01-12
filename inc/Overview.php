<?php
if ( !defined( 'ABSPATH' ) ) exit;

class ES_List_User_Searches_Overview {

  public static function get_count_search_queries( $filter_name = null ) {
    if ( is_null( $filter_name ) ) {
      return ES_List_User_Searches_Database::get_count();
    }

    $where_condition = self::get_between_date_condition_by_filter_name( $filter_name );
    return ES_List_User_Searches_Database::get_count( $where_condition );
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
    $where_condition = self::get_between_date_condition_by_filter_name( 'last_30days' );
    return ES_List_User_Searches_Database::get_count( $where_condition );
  }

  public static function unsuccessful_query_counter() {
    $where_condition = self::get_between_date_condition_by_filter_name( 'last_30days' );
    return ES_List_User_Searches_Database::get_count( $where_condition . ' AND hits = 0' );
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

    return ES_List_User_Searches_Database::get_data( $where_condition );
  }

}
