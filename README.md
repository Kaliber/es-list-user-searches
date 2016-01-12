
# es-list-user-searches

Custom build wordpress plugin for saving searched queries into a database and get in the Wordpress back-end an overview of the most common searched queries. 

### How to save a searched query into the database
You need to call the plugin to save the searched query in the database. For example:

```php
  // Check if the plugin exists / is enabled
  if ( class_exists( ES_LIST_USER_SEARCHES ) ) {
    // Send searched query results
    ES_LIST_USER_SEARCHES::save_search( $searched_query, $site_url, $total_hits );
  }
```
