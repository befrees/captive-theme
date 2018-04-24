<?php 
/**
* Template name: Page 1
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

   <div class="color right-color-block">
            <?php the_field('text_tp') ?>
        </div>
</div>

<div class="stageBlock">
    <div class="container">
        <div class="row">
            <h1><?php the_title() ?></h1>
            <div class="content">
                <?php the_content(); ?>
        </div>
        
    </div>
</div>
</div>

<!-- кнопка -->
<?php $bc_img = get_field('image_bp');
// dd($bc_img);
 ?>
<div class="btnBlock4 btnBlock" style="background-image: url(<?= $bc_img['sizes']['img_full'] ?>);">
    <div class="hww-inner">
        <?php echo get_field('text_bp') ?>
        <div class="arrDown">
                <svg aria-hidden="true" data-prefix="fas" data-icon="triangle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576.03 512" " class=" "><path d="M329.6 24c-18.4-32-64.7-32-83.2 0L6.5 440c-18.4 31.9 4.6 72 41.6 72H528c36.9 0 60-40 41.6-72l-240-416z " class=" "></path></svg>
                </div>
            </div>
    </div>
</div>

<?php endwhile; ?>
    <?php get_footer(); ?>

</body>

</html>