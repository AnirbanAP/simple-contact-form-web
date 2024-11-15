<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Custom_Theme
 */

get_header();
?>

<div class="container text-center mt-5">
    <h1 class="display-4">404 - Page Not Found</h1>
    <p class="lead">Oops! The page you are looking for does not exist.</p>

    <div class="mt-4">
        <a href="<?php echo home_url(); ?>" class="btn btn-primary">Go Back to Home</a>
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn btn-secondary">Visit Blog</a>
    </div>
</div>

<?php
get_footer();

