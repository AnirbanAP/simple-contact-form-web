<?php
/**
 * The template for displaying category archive pages.
 *
 * @package Custom_Weavers
 */

get_header(); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <header class="archive-header mb-4">
                <h1 class="archive-title">
                    <?php single_cat_title(); ?>
                </h1>
                <div class="category-description text-muted mb-4">
                    <?php echo category_description(); ?>
                </div>
            </header>

            <?php if (have_posts()) : ?>
                <div class="post-list">
                    <?php
                    while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
                            <div class="card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', array('class' => 'card-img-top img-fluid')); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="card-body">
                                    <h2 class="card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta text-muted mb-2">
                                        <small>
                                            <?php echo __('Published on ', 'your-theme-textdomain') . get_the_date(); ?>
                                        </small>
                                    </div>
                                    <div class="card-text">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                        <?php _e('Read More', 'your-theme-textdomain'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('&laquo; Previous', 'your-theme-textdomain'),
                        'next_text' => __('Next &raquo;', 'your-theme-textdomain'),
                    ));
                    ?>
                </div>

            <?php else : ?>
                <p><?php _e('No posts found in this category.', 'your-theme-textdomain'); ?></p>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

