<?php

add_action('wp_enqueue_scripts', 'twentytwentychildEnqueueStyles');
function twentytwentychildEnqueueStyles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_filter('twentytwenty_post_meta_location_single_top', 'twentytwentyFilterPostMeta');

function twentytwentyFilterPostMeta($post_meta)
{
    $authorMetaIndex = array_search('author', $post_meta);

    if (false !== $authorMetaIndex) {
        $post_meta[$authorMetaIndex] = 'authors';
    }

    return $post_meta;
}

add_action('twentytwenty_start_of_post_meta_list', 'twentytwentychildStartMeta', 10, 3);

function twentytwentychildStartMeta($post_id, $post_meta, $location)
{
    if (in_array('authors', $post_meta, true)) {
        $authors = get_multiple_authors();
        $links   = [];

        foreach ($authors as $author) {
            $links[] = sprintf(
                '<a href="%s">%s</a>',
                esc_url($author->link),
                esc_html($author->display_name)
            );
        }
        ?>
        <li class="post-author meta-wrapper">
            <span class="meta-icon">
                <span class="screen-reader-text"><?php _e('Post author', 'twentytwenty'); ?></span>
                <?php twentytwenty_the_theme_svg('user'); ?>
            </span>
            <span class="meta-text">
                <?php
                printf(
                /* translators: %s: Author name. */
                    __('By %s', 'twentytwenty'),
                    implode(', ', $links)
                );
                ?>
            </span>
        </li>
        <?php
    }
}