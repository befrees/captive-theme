<?php 
/**
* Template name: About Us
*/
 ?>
  <!DOCTYPE html>
<html lang="en">
<head>

    <?php get_header('head') ?>

</head>

<body <?php body_class( '' ); ?>>
    <?php get_header() ?>

<?php while(have_posts()): the_post(); ?>
<!-- центральная фотография -->
<div class="frontFoto" style="background-image: url(<?php the_post_thumbnail_url('img_full') ?>);">

   <div class="color">
    <div class="container">
        <div class="row">
            <div class="move col-sm-offset-1 col-sm-10">
                    <?php echo get_field('text_tp') ?>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="aboutBlock">
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10 inner">
            <h1><?php the_title() ?></h1>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
        
    </div>
</div>
</div>


<?php endwhile; ?>
    <?php get_footer(); ?>

</body>

</html>