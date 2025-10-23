<?php

/**
 * Gets all widget companies, renders the ones that are in the meta field first, then the ones that are not in the meta field
 */
function recommended_companies_callback($post) {
  $selected_ids = (array) get_post_meta($post->ID, 'company_list', true);
  $company_list = get_posts( array(
    'post_type' => 'widget_company',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'fields' => 'ids',
  ));
  $not_selected = array_diff($company_list, $selected_ids);

  echo '<ul id="sortable" style="list-style:none; padding-left:0;">';
  foreach ($selected_ids as $id) {
    echo '<li style="margin-bottom:5px; border:1px solid #ddd; padding:5px; cursor:move;">';
    echo '<input type="checkbox" name="company_ids[]" value="' . esc_attr( $id ) . '" checked>'. esc_html(get_the_title($id));
    echo '</li>';
  }
  foreach ( $not_selected as $id ) {
    echo '<li style="margin-bottom:5px; border:1px solid #ddd; padding:5px; cursor:move;">';
    echo '<input type="checkbox" name="company_ids[]" value="' . esc_attr( $id ) . '">';
    echo esc_html( get_the_title($id) );
    echo '</li>';
  }
  echo '</ul>';
  echo '<script>
    jQuery(function($){
        $(\'#sortable\').sortable({
            items: \'li\',
            cursor: \'move\'
        });
    });
    </script>';
}

function add_list_meta_boxes() {
  add_meta_box(
    'recommended_companies',
    'Recommended Companies',
    'recommended_companies_callback',
    'recommended_list',
    'normal',
    'default'
  );
}
add_action( 'add_meta_boxes', 'add_list_meta_boxes' );

function save_recommended_list( $post_id ) {
  // only update if its a recommended_list post type
  if ( get_post_type( $post_id ) !== 'recommended_list' ) return;

  update_post_meta( $post_id, 'company_list', $_POST['company_ids'] ?? [] );
}
add_action( 'save_post', 'save_recommended_list' );