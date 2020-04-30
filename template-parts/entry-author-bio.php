<?php
/**
 * The template for displaying Author info
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


if ((bool)get_theme_mod('show_author_bio', true)) : ?>

    <?php $authors = get_multiple_authors(); ?>

    <?php foreach ($authors as $author) : ?>
        <div class="author-bio">
            <div class="author-title-wrapper">
                <div class="author-avatar vcard">
                    <?php echo $author->get_avatar(160); ?>
                </div>
                <h2 class="author-title heading-size-4">
                    <?php
                    printf(
                    /* translators: %s: Author name. */
                        __('By %s', 'twentytwenty'),
                        esc_html($author->display_name)
                    );
                    ?>
                </h2>
            </div><!-- .author-name -->
            <div class="author-description">
                <?php if (!empty($author->description)) : ?>
                    <?php echo wp_kses_post(wpautop($author->description)); ?>
                <?php endif; ?>
                <a class="author-link" href="<?php echo esc_url($author->link); ?>" rel="author">
                    <?php _e('View Archive <span aria-hidden="true">&rarr;</span>', 'twentytwenty'); ?>
                </a>
            </div><!-- .author-description -->

        </div><!-- .author-bio -->
    <?php endforeach; ?>
<?php endif; ?>
