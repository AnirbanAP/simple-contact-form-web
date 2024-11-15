<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Custom_Weavers
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<div class="page-header mb-4">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</div>


			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); ?>

			<div class="card horizontal mb-4">
                  <div class="row g-0">

                    <?php if (has_post_thumbnail()) : ?>
                      <div class="col-lg-6 col-xl-5 col-xxl-4">
                        <a href="<?php the_permalink(); ?>">
                          <?php the_post_thumbnail('medium', array('class' => 'card-img-lg-start')); ?>
                        </a>
                      </div>
                    <?php endif; ?>

                    <div class="col">
                      <div class="card-body">
					  <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
                          <?php the_title('<h2 class="blog-post-title h5">', '</h2>'); ?>
                        </a>
					  </div>
					</div>

				</div>
			</div>

<?php 
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();

