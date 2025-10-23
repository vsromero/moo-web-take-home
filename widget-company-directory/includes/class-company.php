<?php
/**
 * Company Class
 *
 * This is a starting point for handling company data.
 * Feel free to modify, extend, or completely replace this approach.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class WCD_Company {

    /**
     * Company data structure
     *
     * @var array
     */
    private $data = array(
        'name'           => '',
        'rating'         => 0,
        'benefits'       => array(),
        'cons'           => array(),
        'has_free_trial' => false,
        'summary'        => '',
    );

    /**
     * Constructor
     *
     * @param array $data Optional. Company data to initialize with.
     */
    public function __construct( $data = array() ) {
        if ( ! empty( $data ) ) {
            $this->set_data( $data );
        }
    }

    /**
     * Set company data
     *
     * @param array $data Company data.
     */
    public function set_data( $data ) {
        foreach ( $data as $key => $value ) {
            if ( array_key_exists( $key, $this->data ) ) {
                $this->data[ $key ] = $value;
            }
        }
    }

    /**
     * Get company data
     *
     * @return array
     */
    public function get_data() {
        return $this->data;
    }

    /**
     * Get a specific property
     *
     * @param string $key Property key.
     * @return mixed
     */
    public function get( $key ) {
        return isset( $this->data[ $key ] ) ? $this->data[ $key ] : null;
    }

    /**
     * Set a specific property
     *
     * @param string $key Property key.
     * @param mixed $value Property value.
     */
    public function set( $key, $value ) {
        if ( array_key_exists( $key, $this->data ) ) {
            $this->data[ $key ] = $value;
        }
    }

    // TODO: Add methods for:
    // - Saving to WordPress (post, custom table, or option)
    // - Loading from WordPress
    // - Validation
    // - Any other business logic you need

    function save($post_id = 0) {
        $data = $this->get_data();
        $post_data = array(
            'post_title' => $data['name'],
            'post_content' => $data['summary'],
            'post_type' => 'widget_company',
            'post_status' => 'publish',
        );

        // Update or insert post
        if ($post_id) {
            $post_data['ID'] = $post_id;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }
        
        update_post_meta($post_id, 'rating', $data['rating']);
        update_post_meta($post_id, 'benefits_1', $data['benefits'][0]);
        update_post_meta($post_id, 'benefits_2', $data['benefits'][1]);
        update_post_meta($post_id, 'benefits_3', $data['benefits'][2]);
        update_post_meta($post_id, 'cons_1', $data['cons'][0]);
        update_post_meta($post_id, 'cons_2', $data['cons'][1]);
        update_post_meta($post_id, 'cons_3', $data['cons'][2]);
        update_post_meta($post_id, 'has_free_trial', (bool) $data['has_free_trial']);

        return $post_id;
    }

    public function load($post_id) {
        $post = get_post($post_id);
        if (!$post || $post->post_type !== 'widget_company') {
            return false;
        }

        $this->data = array(
            'name'  => $post->post_title,
            'summary'  => $post->post_content,
            'rating'  => get_post_meta($post_id, 'rating', true),
            'benefits_1'  => get_post_meta($post_id, 'benefits_1', true),
            'benefits_2'  => get_post_meta($post_id, 'benefits_2', true),
            'benefits_3'  => get_post_meta($post_id, 'benefits_3', true),
            'cons_1'  => get_post_meta($post_id, 'cons_1', true),
            'cons_2'  => get_post_meta($post_id, 'cons_2', true),
            'cons_3'  => get_post_meta($post_id, 'cons_3', true),
            'has_free_trial'  => get_post_meta($post_id, 'has_free_trial', true),
        );
        return true;
    }
}
