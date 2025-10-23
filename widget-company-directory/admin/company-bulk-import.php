<?php

// register import page in admin menu
function register_import_pages() {
  add_menu_page(
    'Import Widget Companies',
    'Import Widget Companies',
    'manage_options',
    'widget-company-import',
    function() {
      echo '
      <div>
        <h1>Import Widget Companies</h1>
        <form action="/wp-admin/admin-post.php" method="post">
          <input type="hidden" name="action" value="widget_company_import">
          <button class="button button-primary">Import Companies Now</button>
        </form>
      </div>
      ';
    }
  )  ;
}
add_action('admin_menu', 'register_import_pages');

/**
 * Handle the import using the save WCD_Company method
 */
function handle_company_import() {
  $file = WIDGET_COMPANY_DIRECTORY_PLUGIN_DIR . 'data/companies_data.json';
  $companies = json_decode(file_get_contents($file), true);
  foreach ($companies as $company) {
    $widget_company = new WCD_Company($company);
    $widget_company->save();
  }
  wp_redirect('/wp-admin/edit.php?post_type=widget_company');
}
add_action('admin_post_widget_company_import', 'handle_company_import');