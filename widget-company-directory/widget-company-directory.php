<?php
/**
 * Plugin Name: Widget Company Block
 * Plugin URI: https://github.com/yourusername/widget-company-directory
 * Description: A WordPress plugin take home assessment block for managing widget companies and creating curated recommended lists.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: widget-company-directory
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 */
define( 'WIDGET_COMPANY_DIRECTORY_VERSION', '1.0.0' );
define( 'WIDGET_COMPANY_DIRECTORY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WIDGET_COMPANY_DIRECTORY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_widget_company_directory() {
    // TODO: Add activation logic here
    // Examples: Create database tables, set default options, flush rewrite rules
}
register_activation_hook( __FILE__, 'activate_widget_company_directory' );

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_widget_company_directory() {
    // TODO: Add deactivation logic here
    // Example: Flush rewrite rules
}
register_deactivation_hook( __FILE__, 'deactivate_widget_company_directory' );

/**
 * Register the Gutenberg block
 */
function widget_directory_register_blocks() {
    $asset_file = WIDGET_COMPANY_DIRECTORY_PLUGIN_DIR . 'build/index.asset.php';

    // Only register if the build files exist
    if ( file_exists( $asset_file ) ) {
        $asset = require $asset_file;

        // Register the block script
        wp_register_script(
            'widget-company-directory-block-editor',
            WIDGET_COMPANY_DIRECTORY_PLUGIN_URL . 'build/index.js',
            $asset['dependencies'],
            $asset['version']
        );

        // Register the editor styles
        wp_register_style(
            'widget-company-directory-block-editor-style',
            WIDGET_COMPANY_DIRECTORY_PLUGIN_URL . 'build/index.css',
            array(),
            filemtime( WIDGET_COMPANY_DIRECTORY_PLUGIN_DIR . 'build/index.css' )
        );

        // Register the frontend styles
        wp_register_style(
            'widget-company-directory-block-style',
            WIDGET_COMPANY_DIRECTORY_PLUGIN_URL . 'build/style-index.css',
            array(),
            filemtime( WIDGET_COMPANY_DIRECTORY_PLUGIN_DIR . 'build/style-index.css' )
        );

        // Register the block type
        register_block_type( 'widget-directory/company-list', array(
            'editor_script' => 'widget-company-directory-block-editor',
            'editor_style'  => 'widget-company-directory-block-editor-style',
            'style'         => 'widget-company-directory-block-style',
        ) );
    } else {
        // Show admin notice if build doesn't exist
        add_action( 'admin_notices', 'widget_directory_build_notice' );
    }
}
add_action( 'init', 'widget_directory_register_blocks' );

/**
 * Display admin notice when block assets haven't been built
 */
function widget_directory_build_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p>
            <strong>Widget Company Directory:</strong> Block assets not found.
            Please run <code>npm run build</code> in the plugin directory to build the blocks.
        </p>
    </div>
    <?php
}


/**
 * Initialize the plugin
 */
function run_widget_company_directory() {
    // TODO: Initialize your plugin functionality here
    // Load your classes, register custom post types, etc.

    // Example: Load the Company class
    // require_once WIDGET_COMPANY_DIRECTORY_PLUGIN_DIR . 'includes/class-company.php';
}
add_action( 'plugins_loaded', 'run_widget_company_directory' );

/**
 * Register CPT for widget company and recommended list
 */
function register_custom_post_types() {
    register_post_type('widget_company', [
        'label' => 'Widget Companies',
        'public' => true,
        'show_in_menu' => true,
        'supports' => ['title', 'editor', 'custom-fields'],
    ]);
    register_post_type('recommended_list', [
        'label' => 'Recommended List',
        'public' => true,
        'show_in_menu' => 'edit.php?post_type=widget_company',
        'supports' => ['title'],
    ]);
}
add_action('init', 'register_custom_post_types');