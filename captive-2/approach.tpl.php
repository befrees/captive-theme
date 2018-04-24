<?php 
/**
* Template name: Page approach
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
<div class="frontFoto2 frontFot" style="background-image: url(<?php the_post_thumbnail_url('img_full') ?>);">

   <div class="color2 color">
    <div class="container">
        <div class="row">
            <div class="blueText col-sm-offset-2 col-sm-8">
            <?php echo get_field('text_tp') ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- компенсация -->
<div class="compens">
    <div class="container">
        <div class="row">
            <?php echo do_shortcode( (get_post_meta( get_the_ID(), 'text_top_content', true ))); ?>
            
        </div>
    </div>
</div>

<div class="approachBlock">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="headItem">
                    <h1><?php the_title(); ?></h1>
                    <div><?php the_content(); ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="parBlock">
                <?php if($blocks = get_field('blocks')):
                $blocks_chunk = array_chunk($blocks, 2);
                 ?>
                    <?php
                    foreach($blocks_chunk as $i => $block): ?>
                    <div class="container container-<?= $i+1 ?> <?php if($i == 0) echo 'first'; ?> <?php if($i == (count($blocks_chunk)-1)) echo 'last'; ?> ">
                        <div class="row parBlock-row flexbox">
                    <?php foreach($block as $k => $item):
                    $img = $item['image'];  ?>
                        <div class="childItem col-md-6 col-xs-4888 col-xs-offset-88<?= $k%2 ? '1' : '2' ?> <?= $k==4 ? 'spec' : '' ?>">
                            <div class="childItem__inner text-center">
                                <figure><img src="<?php echo $img['url'] ?>" alt=""></figure>
                                <h3><?= $item['title'] ?></h3>
                                <div class="text-left"><?= $item['text'] ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>     
        </div>
    </div>
</div>

<!-- кнопка -->
<?php $bc_img = get_field('image_bp') ?>
<div class="btnBlock2 btnBlock" style="background-image: url(<?= $bc_img['sizes']['img_full'] ?>);">
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