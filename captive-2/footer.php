<footer id="site-footer">

        <!-- Футер -->

        <div class="aboutInfo">

            <div class="container footer-top">

                <div class="row">
                    <div class="col-md-3 col-md-offset-1 hidden-sm hidden-xs">
                        
                            <?php wp_nav_menu( array(
                            'menu'=> 'Main menu', 
                            // 'container'=>false, 
                            'container_class' => 'footer-menu-box',
                            // 'container_id' => 'bs-example-navbar-collapse-1',
                            'menu_class'=> 'footer-menu'
                            ) ); ?>
                    </div>
                    <div class="col-md-3 col-md-offset-1 hidden-sm hidden-xs">
                        <div class="allAdres">
                                <?php if(!dynamic_sidebar('sidebar-4')) echo '<!-- sidebar-4 -->' ?> 
                            </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1 text-center">
                        <div class="logo-footer hidden-sm hidden-xs"><img class="footerLogo" src="<?= get_template_directory_uri() ?>/img/Logo.png" alt=""></div>
                        <div class="copy text-center"><?php if(!dynamic_sidebar('sidebar-6')) echo '<!-- sidebar-6 -->' ?> </div>
                    </div>

                </div>

            </div>
        </div>

    </footer>



<?php wp_footer() ?>

<?php get_template_part( 'parts/modals' ); ?>

   

<?php //echo do_shortcode( '[wpforms id="170" title="false" description="false"]'); ?>