<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Custom_Weavers
 */

get_header(); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <?php if (have_posts()) : ?>
                <header class="page-header mb-4">
                    <h1 class="page-title"><?php _e('Latest Posts', 'your-theme-textdomain'); ?></h1>
                </header>

                <div class="row">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', ['class' => 'card-img-top img-fluid']); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <p class="card-text">
                                        <?php the_excerpt(); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Read More', 'your-theme-textdomain'); ?></a>
                                </div>
                                <div class="card-footer text-muted">
                                    <small><?php echo __('Published on ', 'your-theme-textdomain') . get_the_date(); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('&laquo; Previous', 'your-theme-textdomain'),
                        'next_text' => __('Next &raquo;', 'your-theme-textdomain'),
                    ));
                    ?>
                </div>

            <?php else : ?>
                <p><?php _e('No posts found.', 'your-theme-textdomain'); ?></p>
            <?php endif; ?>
        </div>

        <!-- Sidebar Area -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?php _e('Search', 'your-theme-textdomain'); ?></h5>
                </div>
                <div class="card-body">
                    <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo home_url('/'); ?>">
                        <input class="form-control mr-sm-2" type="search" name="s" placeholder="<?php _e('Search', 'your-theme-textdomain'); ?>" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php _e('Search', 'your-theme-textdomain'); ?></button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title"><?php _e('Recent Posts', 'your-theme-textdomain'); ?></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php
                        $args = array(
                            'posts_per_page' => 5,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        $recent_posts = new WP_Query($args);
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                            <li class="list-group-item">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <small class="text-muted"><?php echo __('Published on ', 'your-theme-textdomain') . get_the_date(); ?></small>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

