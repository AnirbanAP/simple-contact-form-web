<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Custom_Weavers
 */

get_header(); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header mb-4">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', array('class' => 'img-fluid mb-4'));
                            }
                            ?>
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            <div class="entry-meta text-muted mb-4">
                                <small>
                                    <?php echo __('Published on ', 'your-theme-textdomain') . get_the_date(); ?> |
                                    <?php echo __('By ', 'your-theme-textdomain') . get_the_author(); ?>
                                </small>
                            </div>
                        </header>

                        <div class="entry-content">
                            <?php
                            the_content();
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'your-theme-textdomain'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <footer class="entry-footer mt-4">
                            <div class="tags-links">
                                <?php the_tags('<span class="badge bg-secondary">', '</span> <span class="badge bg-secondary">', '</span>'); ?>
                            </div>
                        </footer>

                    </article>

                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile;
            else :
                echo '<p>' . __('No posts found.', 'your-theme-textdomain') . '</p>';
            endif;
            ?>
        </div>

        <div class="col-lg-4">
            <aside class="sidebar">
                <!-- Search Form -->
                <div class="search-form mb-4">
                    <h4><?php _e('Search', 'your-theme-textdomain'); ?></h4>
                    <?php echo get_search_form(); ?>
                </div>

                <div class="recent-posts">
                    <h4><?php _e('Recent Posts', 'your-theme-textdomain'); ?></h4>
                    <ul class="list-unstyled">
                        <?php
                        $recent_posts = new WP_Query(array(
                            'posts_per_page' => 5,
                            'post_status'    => 'publish',
                        ));

                        if ($recent_posts->have_posts()) :
                            while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                <li class="mb-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<li>' . __('No recent posts', 'your-theme-textdomain') . '</li>';
                        endif;
                        ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>

