<?php
/**
* Template name: Contact page
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
<?php $img = get_field(head_img); ?>
<div class="frontFoto3 frontFoto" style="background-image: url(<?= $img['sizes']['img_full'] ?>);">

   <div class="color3 color">
    <div class="container">
        <div class="row">
            <div class="smile col-lg-offset-1 col-md-11 col-lg-9">
                   <?php the_field('head_text') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contactBlock bg-grad">
    <div class="container">
        <div class="row">
            <h2 class="text-center"><?php the_title() ?></h2>
            <div class="formPlace">
            <div class="col-sm-4 col-sm-offset-1">
                <?php the_content(); ?>

            </div>
        </div>
        <div class="col-sm-3 col-sm-offset-3">
             <div class="adresPlace">
                 <?php the_field('right_text') ?>
                 <div class="imgGroup">
                    <?php if($social = get_field('social')): ?>
                        <?php foreach($social as $item): ?>
                            <a href="<?= $item['link'] ?>" target="_blank">
                                <img src="<?= $item['icon'] ?>" alt="" height="33" width="33">
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php /* if(get_field('link_g')): ?>
                     <a href="<?= get_field('link_g') ?>" target="_blank"><img src="<?= get_template_directory_uri(); ?>/img/goo.png" alt=""></a>
                    <?php endif; ?>
                    <?php if(get_field('link_p')): ?>
                     <a href="<?= get_field('link_p') ?>" target="_blank"><img src="<?= get_template_directory_uri(); ?>/img/P.png" alt=""></a>
                    <?php endif; ?>
                    <?php if(get_field('link_fb')): ?>
                     <a href="<?= get_field('link_fb') ?>" target="_blank"><img src="<?= get_template_directory_uri(); ?>/img/face.png" alt=""></a>
                    <?php endif;*/ ?>
                 </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- кнопка -->
<?php $bc_img = get_field('bc_image') ?>
<div class="btnBlock3 btnBlock" style="background-image: url(<?= $bc_img['sizes']['img_full'] ?>);">
    <div class="hww-inner">
        <?php echo get_field('bc_text') ?>
    </div>
</div>

<?php endwhile; ?>
    <?php get_footer(); ?>

</body>

</html>



