
    <div class="container-fluid"><!-- Меню навигации -->
        <div class="top-line clearfix">
            <header class="mainPageHeader">
                <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
                <?php if(!is_front_page()): ?><a href="<?php echo get_home_url(); ?>" id="logo"><img src="<?= get_template_directory_uri() ?>/img/Logo.png" ></a>
                <?php else: ?><span id="logo"><img src="<?= get_template_directory_uri() ?>/img/Logo.png" ></span><?php endif; ?>
                    <div>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-main">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- <div class="collapse navbar-collapse" id="nav-main"> -->
                        <!-- </div> -->
                        </div>
                        <?php wp_nav_menu( array(
                            'menu'=> 'Main menu', 
                            'container'=>'div', 
                            'container_class' => 'collapse navbar-collapse',
                            'container_id' => 'nav-main',
                            'menu_class'=> 'nav navbar-nav'
                            ) ); ?>
                    </nav>
                </div>
            </header>
        </div>
    </div>