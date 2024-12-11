
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
<!--header sction-->


<header class="main-header">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="<?= esc_url(home_url()); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/WeaversWebLogo.svg" alt="<?php bloginfo('name'); ?> Logo" class="d-td-none me-2">
        </a>

        </div>
    </nav>
    

    <?php echo do_shortcode("[simple_custom_form id='21' name='New Html Form 2']	"); ?>
</header>