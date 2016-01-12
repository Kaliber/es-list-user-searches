<div class="wrap">
  <h2>ES User Searches</h2>

  <h3>Total Searches</h3>  
  <div style="width: 30%; float: left; margin-right: 2%;">
    <table class="widefat">
      <thead>
        <tr><th colspan="2">Totals</th></tr>
      </thead>
      <tbody>
        <tr>
          <th>When</th><th>Searches</th>
        </tr>
        <tr>
          <td style="padding: 3px 5px">Today and yesterday</td>
          <td style="padding: 3px 5px;"><?php echo ES_List_User_Searches_Overview::get_count_search_queries( 'last_day' ); ?></td>
        </tr>
        <tr>
          <td style="padding: 3px 5px">Last 7 days</td>
          <td style="padding: 3px 5px;"><?php echo ES_List_User_Searches_Overview::get_count_search_queries( 'last_7days' ); ?></td>
        </tr>
        <tr>
          <td style="padding: 3px 5px">Last 30 days</td>
          <td style="padding: 3px 5px;"><?php echo ES_List_User_Searches_Overview::get_count_search_queries( 'last_30days' ); ?></td>
        </tr>
        <tr>
          <td style="padding: 3px 5px">Forever</td>
          <td style="padding: 3px 5px;"><?php echo ES_List_User_Searches_Overview::get_count_search_queries(); ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <?php if ( ES_List_User_Searches_Overview::common_query_counter() > 0 ) : ?>
  <div style="clear: both"></div>
  <h3>Common Queries</h3>
  <p>Here you can see the 20 most common user search queries, how many times those queries were made and how many results were found for those queries.</p>

    <?php $results = ES_List_User_Searches_Overview::get_searched_query_data( 'last_day' ); ?>
    <?php if ($results) : ?>
    <div style="width: 30%; float: left; margin-right: 2%">
      <table class="widefat">
        <thead>
          <tr><th colspan="3">Today and yesterday</th></tr>
        </thead>
        <tbody>
          <tr>
            <th>Query</th><th>#</th><th>Hits</th>
          </tr>
          <?php foreach ($results as $result) { ?>
            <tr>
              <td style="padding: 3px 5px"><a href="<?php echo $result->url ?>"><?php echo $result->query ?></a></td>
              <td style="padding: 3px 5px;"><?php echo $result->count ?></td>
              <td style="padding: 3px 5px;"><?php echo $result->hits ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <?php $results = ES_List_User_Searches_Overview::get_searched_query_data( 'last_7days' ); ?>
    <?php if ($results) : ?>
    <div style="width: 30%; float: left; margin-right: 2%">
      <table class="widefat">
        <thead>
          <tr><th colspan="3">Last 7 days</th></tr>
        </thead>
        <tbody>
          <tr>
            <th>Query</th><th>#</th><th>Hits</th>
          </tr>
          <?php foreach ($results as $result) { ?>
            <tr>
              <td style="padding: 3px 5px"><a href="<?php echo $result->url ?>"><?php echo $result->query ?></a></td>
              <td style="padding: 3px 5px;"><?php echo $result->count ?></td>
              <td style="padding: 3px 5px;"><?php echo $result->hits ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <?php $results = ES_List_User_Searches_Overview::get_searched_query_data( 'last_30days' ); ?>
    <?php if ($results) : ?>
    <div style="width: 30%; float: left; margin-right: 2%">
      <table class="widefat">
        <thead>
          <tr><th colspan="3">Last 30 days</th></tr>
        </thead>
        <tbody>
          <tr>
            <th>Query</th><th>#</th><th>Hits</th>
          </tr>
          <?php foreach ($results as $result) { ?>
            <tr>
              <td style="padding: 3px 5px"><a href="<?php echo $result->url ?>"><?php echo $result->query ?></a></td>
              <td style="padding: 3px 5px;"><?php echo $result->count ?></td>
              <td style="padding: 3px 5px;"><?php echo $result->hits ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  <?php endif; ?>

  <?php if ( ES_List_User_Searches_Overview::unsuccessful_query_counter() > 0 ) : ?>
    <div style="clear: both"></div>
    <h3>Unsuccessful Queries</h3>

    <?php $results = ES_List_User_Searches_Overview::get_searched_query_data( 'last_day', false ); ?>
    <?php if ($results) : ?>
    <div style="width: 30%; float: left; margin-right: 2%">
      <table class="widefat">
        <thead>
          <tr><th colspan="3">Today and yesterday</th></tr>
        </thead>
        <tbody>
          <tr>
            <th>Query</th><th>#</th><th>Hits</th>
          </tr>
          <?php foreach ($results as $result) { ?>
            <tr>
              <td style="padding: 3px 5px"><a href="<?php echo $result->url ?>"><?php echo $result->query ?></a></td>
              <td style="padding: 3px 5px;"><?php echo $result->count ?></td>
              <td style="padding: 3px 5px;"><?php echo $result->hits ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <?php $results = ES_List_User_Searches_Overview::get_searched_query_data( 'last_7days', false ); ?>
    <?php if ($results) : ?>
    <div style="width: 30%; float: left; margin-right: 2%">
      <table class="widefat">
        <thead>
          <tr><th colspan="3">Last 7 days</th></tr>
        </thead>
        <tbody>
          <tr>
            <th>Query</th><th>#</th><th>Hits</th>
          </tr>
          <?php foreach ($results as $result) { ?>
            <tr>
              <td style="padding: 3px 5px"><a href="<?php echo $result->url ?>"><?php echo $result->query ?></a></td>
              <td style="padding: 3px 5px;"><?php echo $result->count ?></td>
              <td style="padding: 3px 5px;"><?php echo $result->hits ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <?php $results = ES_List_User_Searches_Overview::get_searched_query_data( 'last_30days', false ); ?>
    <?php if ($results) : ?>
    <div style="width: 30%; float: left; margin-right: 2%">
      <table class="widefat">
        <thead>
          <tr><th colspan="3">Last 30 days</th></tr>
        </thead>
        <tbody>
          <tr>
            <th>Query</th><th>#</th><th>Hits</th>
          </tr>
          <?php foreach ($results as $result) { ?>
            <tr>
              <td style="padding: 3px 5px"><a href="<?php echo $result->url ?>"><?php echo $result->query ?></a></td>
              <td style="padding: 3px 5px;"><?php echo $result->count ?></td>
              <td style="padding: 3px 5px;"><?php echo $result->hits ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  <?php endif; ?>

</div>
