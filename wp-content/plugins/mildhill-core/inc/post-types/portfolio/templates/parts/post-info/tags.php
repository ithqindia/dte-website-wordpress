<?php
    $tags   = wp_get_post_terms( get_the_ID(), 'portfolio-tag' );

    if( is_array( $tags ) && count( $tags ) ) { ?>

        <div class="qodef-e qodef-portofolio-tags">
            <h5>
                <?php esc_html_e( 'Tag: ', 'mildhill-core' ); ?>
            </h5>
            <?php foreach ($tags as $tag){?>
                <a itemprop="url" class="qodef-portfolio-tag" href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>">
                    <?php echo esc_html($tag->name); ?>
                </a>
            <?php }?>
        </div>

<?php }
