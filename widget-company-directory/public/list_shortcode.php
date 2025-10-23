<?php

function render_company_list_block($atts, $content = null) {
    $list_id = $atts['id'] ?? false;

    if ( ! $list_id ) {
        return '<p>No list selected.</p>';
    }

    $company_ids = get_post_meta( $list_id, 'company_list', true );
    if ( empty( $company_ids ) ) {
        return '<p>No companies found in this list.</p>';
    }

    ob_start();
    echo '<div class="wcd-company-list"><h3>Company List Block</h3>';
    foreach ( $company_ids as $id ) {
        $company = new WCD_Company();
        $company->load( $id );
        $data = $company->get_data();

        ?>
        <div class="wcd-company">
            <h3><strong><?php echo esc_html( $data['name'] ); ?></strong></h3>
            <p>Rating: <?php echo esc_html( $data['rating'] ); ?>/10</p>
            <?php if ( $data['has_free_trial'] ) : ?>
                <span class="badge">Free Trial</span>
            <?php endif; ?>
            <ul>
                <li><?php echo esc_html( $data['benefits_1'] ); ?></li>
                <li><?php echo esc_html( $data['benefits_2'] ); ?></li>
                <li><?php echo esc_html( $data['benefits_3'] ); ?></li>
            </ul>
            <ul>
                <li><?php echo esc_html( $data['cons_1'] ); ?></li>
                <li><?php echo esc_html( $data['cons_2'] ); ?></li>
                <li><?php echo esc_html( $data['cons_3'] ); ?></li>
            </ul>
            <p><?php echo esc_html( $data['summary'] ); ?></p>
        </div>
        <hr>
        <?php
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode('recommended_list', 'render_company_list_block');