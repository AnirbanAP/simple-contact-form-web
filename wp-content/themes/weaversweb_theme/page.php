<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Custom_Theme
 */

get_header();
?>

<div class="container mt-5">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8 <?php if ( ! is_active_sidebar( 'page-sidebar' ) ) : ?>mx-auto<?php endif; ?>">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="mb-4">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php
                            the_content();
                            
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . __( 'Pages:', 'your-theme-textdomain' ),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php if ( comments_open() || get_comments_number() ) : ?>
                            <footer class="page-footer mt-5">
                                <?php comments_template(); ?>
                            </footer>
                        <?php endif; ?>
                    </article>

                <?php endwhile;
            else : ?>
                <div class="no-posts">
                    <h2><?php esc_html_e( 'No content available', 'your-theme-textdomain' ); ?></h2>
                    <p><?php esc_html_e( 'Sorry, no content found for this page.', 'your-theme-textdomain' ); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar Area (if active) -->
        <?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>
            <div class="col-lg-4">
                <?php get_sidebar(); // Include sidebar.php ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
?>
