<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Custom_Theme
 */

get_header();
?>

<div class="container mt-5">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8 <?php if ( ! is_active_sidebar( 'search-sidebar' ) ) : ?>mx-auto<?php endif; ?>">
            <header class="search-header mb-4">
                <h1 class="page-title">
                    <?php
                    /* Translators: %s is the search query */
                    printf( esc_html__( 'Search Results for: %s', 'your-theme-textdomain' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header>

            <?php if ( have_posts() ) : ?>

                <!-- Start the Loop -->
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </header>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e( 'Read More', 'your-theme-textdomain' ); ?></a>
                        </footer>
                    </article>
                <?php endwhile; ?>

                <!-- Pagination -->
                <div class="pagination mb-5">
                    <?php
                    the_posts_pagination( array(
                        'prev_text' => __( '&laquo; Previous', 'your-theme-textdomain' ),
                        'next_text' => __( 'Next &raquo;', 'your-theme-textdomain' ),
                        'mid_size'  => 2,
                    ));
                    ?>
                </div>

            <?php else : ?>
                <!-- No Results Found -->
                <div class="no-results not-found">
                    <h2><?php esc_html_e( 'Nothing Found', 'your-theme-textdomain' ); ?></h2>
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'your-theme-textdomain' ); ?></p>
                    <?php get_search_form(); // Display search form ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar (if active) -->
        <?php if ( is_active_sidebar( 'search-sidebar' ) ) : ?>
            <div class="col-lg-4">
                <?php get_sidebar(); // Include sidebar.php ?>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php
get_footer();
?>

