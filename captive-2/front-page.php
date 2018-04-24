<!DOCTYPE html>
<html lang="en">
<head>
	<?php get_header('head') ?>
</head>
<body <?php body_class() ?>>

    <?php get_header() ?>

    <div class="container-baner">

    	<?php $baner = get_field('main_baner', $post->ID) ?>

    	   <div class="picture" style="background-image: url(<?= $baner['sizes']['img_full'] ?>);">

    	   		<div class="mainPic"><img src="<?= $baner['sizes']['img_full'] ?>" alt="<?= $baner['alt'] ?>"></div>

    	   		<div class="frontColor">

    	   			<div class="frontText container-fluid">

    	   				<div class="row">

    	   					<div class="col-md-11 col-lg-9 col-lg-offset-1">

    	   						<?= get_field('main_baner_text', $post->ID) ?>

    	   					</div>
    	   				</div>
    	   			</div>
    	   		</div>
    	   </div> <!-- .picture -->
    </div> <!-- .container-baner -->
    <div class="officeFoto">
        <div class="container-fluid ">
            <!-- Офис -->
            <div class="row">

                <div class="twiceBlock flexbox">

                    <div class="col-img col-md-6">

                        <?php $baner2 = get_field('block_2_image', $post->ID) ?>

                    <img src="<?= $baner2['sizes']['img_full'] ?>" alt="<?= $baner2['alt'] ?>">
                    <!-- <span class="lbl-1"><span class="lbl-1-top">R&D </span><span class="lbl-1-bottom">CENTERS</span></span> -->
                    </div>

                    <div class="col-text col-md-6 flexbox">
                        <div class="rightText">
                        <h2>About us</h2>
                            <p><?php echo get_field('block_2_text', $post->ID) ?></p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div> <!-- .officeFoto -->

    <div class="luckyBlock">

        <!-- We Are Lucky -->
<?php /* ?>
        <!-- <img class="znack" src="<?= get_template_directory_uri() ?>/img/FonZnack.png" alt=""> -->
*/ ?>
        <div class="container">

            <div class="row">

                <div class="title-block h1"><?= get_field('wl_title', $post->ID) ?></div>

                <div class="luckyItems flexbox">

                <?php foreach(get_field('wl_items') as $k => $item): ?>



                    <div class="luckyItem luckyItem-<?= $k+1 ?> num">

                            <div class="img"><img src="<?= $item['image']['url'] ?>" alt="<?= $item['image']['alt'] ?>"></div>

                            <div class="luckyItem-text"><?= $item['text'] ?></div>

                    </div>

                <?php endforeach; ?>

                </div>

            </div>

        </div>

    </div> <!-- .luckyBlock -->



<div class="block-work-with">

    <div class="oneString">

        <h2  class="title-block">We Work With</h2>

    </div>

    <div class="twoPhoto">

        <!-- Двойное фото -->

        <div class="row_ flexbox">

            <?php if($ww_items = get_field('we_work_items', $post->ID)): ?>

                <?php foreach($ww_items as $k => $itm): ?>

                <div class="itm-ww itm-ww-<?= $k+1 ?>">

                    <img src="<?= $itm['image']['sizes']['img_full'] ?>" alt="<?= $itm['image']['alt'] ?>">

                    <div class="textPhoto"><div><p><?= $itm['text'] ?></p></div></div>

                </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <div class="underLine"></div>

    </div>

</div> <!-- .block-work-with -->


<?php $dif_img = get_field('how_we_are_different_image', $post->ID);
// dd($dif_img);
 ?>
	<div class="bridgeOnFon" style="background-image: url(<?= $dif_img['sizes']['img_full'] ?>"><!-- на фоне мост -->
        <div class="container">
            <div class="row flexbox">
                <div class="col-md-6 col-md-offset-6 flexbox">
                    <div class="bridgeOnFon__inner">
                        <h2  class="title-block"><?= get_field('how_we_are_different_title', $post->ID) ?></h2>

                        <div class="bridgeTextOne"><?= get_field('how_we_are_different_text', $post->ID) ?></div>
                    </div>
                </div>
            </div>
        </div>

		<i class="bg-222"></i>

		<!-- <img src="<?= get_template_directory_uri() ?>/img/fonPhoto.png" alt=""> -->

	</div>


	<div class="mapWorld"><!-- карта мира -->
<?php $block_map = get_field('column'); ?>
        <h3 class="title-block"><?= get_field('title_block_map') ?></h3>
        <div class="map-wrap">
        <div class="map__img">
		<img src="<?= get_template_directory_uri() ?>/img/mapFon.png" alt="">
        <div class="map__inner">
		      <div class="parent">
					<div class="one item item_1">
						<span><?= $block_map[0]['count'] ?></span>
						<h4><?= $block_map[0]['title'] ?></h4>
						<p><?= $block_map[0]['text'] ?></p>
					</div>
					<div class="two item item_2">
						<span><?= $block_map[1]['count'] ?></span>
                        <h4><?= $block_map[1]['title'] ?></h4>
                        <p><?= $block_map[1]['text'] ?></p>
					</div>
					<div class="three item item_3">
						<span><?= $block_map[2]['count'] ?></span>
                        <h4><?= $block_map[2]['title'] ?></h4>
                        <p><?= $block_map[2]['text'] ?></p>
					</div>
			</div> <!-- .parent -->
    		<div class="onMapSec">
    			<h2><?= get_field('bottom_map_title') ?></h2>
    			<p><?= get_field('bottom_map_text') ?></p>
    		</div> <!-- .onMapSec -->
        </div> <!-- .map__inner -->
        </div>
	</div>
</div>


	<div class="block-parthners logoGroup">

        <?php if($parthners = get_field('parthners', $post->ID)): ?>

            <div class="container">

                <div class="row list flexbox">

                    <?php foreach($parthners as $item): ?>

    			     <div class="parthner-item flexbox"><img src="<?= $item['logo']['url'] ?>" alt="<?= $item['logo']['alt'] ?>"></div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endif ?>

	</div>


    <div class="block-hww ">
        
    	<div class="clearfix">

            <!-- кнопка -->
<?php $bc_img = get_field('image_bp', $post->ID);
// dd($bc_img);
 ?>
            <div class="btnBlock" style="background-image: url(<?= $bc_img['sizes']['img_full'] ?>)">

                <!-- <img src="<?php // get_template_directory_uri() ?>/img/fonBtn.png" alt=""> -->
                <div class="hww-inner text-center">
        
                    <h2 class="title-block">How We Work</h2>

                    <a type="button" href="<?= get_the_permalink(108); ?>">CHECK IT OUT</a>

                    <div class="caption-btn"><?php echo get_field('text_bp') ?></div>

                    <div class="arrDown">
                         <svg aria-hidden="true" data-prefix="fas" data-icon="triangle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576.03 512"" class=""><path d="M329.6 24c-18.4-32-64.7-32-83.2 0L6.5 440c-18.4 31.9 4.6 72 41.6 72H528c36.9 0 60-40 41.6-72l-240-416z" class=""></path></svg>

                     </div>

                </div>
            </div> <!-- .btnBlock -->

        </div>
    </div>	

	<?php get_footer(); ?>



</body>



</html>