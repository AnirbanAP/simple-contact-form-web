<?php
/**
 * The template for displaying author archive pages.
 *
 * @package Custom_Weavers
 */

get_header(); ?>

<div class="author-page-container">
    <div class="author-bio-section">
        <?php
        // Get the author object.
        $author = get_queried_object();
        ?>

        <h1><?php echo esc_html($author->display_name); ?></h1>

        <?php if (get_avatar($author->ID)) : ?>
            <div class="author-avatar">
                <?php echo get_avatar($author->ID, 150); ?>
            </div>
        <?php endif; ?>

        <div class="author-description">
            <p><?php echo esc_html(get_the_author_meta('description', $author->ID)); ?></p>
        </div>

        <div class="author-meta">
            <ul>
                <?php if (get_the_author_meta('user_url', $author->ID)) : ?>
                    <li><a href="<?php echo esc_url(get_the_author_meta('user_url', $author->ID)); ?>">Website</a></li>
                <?php endif; ?>
                <li><?php echo esc_html__('Posts:', 'your-theme-textdomain'); ?> <?php echo count_user_posts($author->ID); ?></li>
            </ul>
        </div>
    </div>

    <div class="author-posts-section">
        <h2><?php echo sprintf(__('Posts by %s', 'your-theme-textdomain'), esc_html($author->display_name)); ?></h2>

        <?php if (have_posts()) : ?>
            <div class="author-posts-list">
                <?php
                // Loop through the author's posts.
                while (have_posts()) : the_post(); ?>
                    <article <?php post_class(); ?>>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php the_excerpt(); ?></p>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination for author archive pages.
            the_posts_pagination(array(
                'prev_text' => __('Previous', 'your-theme-textdomain'),
                'next_text' => __('Next', 'your-theme-textdomain'),
            ));
            ?>
        <?php else : ?>
            <p><?php esc_html_e('This author has no posts yet.', 'your-theme-textdomain'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>

