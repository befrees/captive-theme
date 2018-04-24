<div class="top-line flexbox just-between" id="bs-navbar-collapse-1" data-uk-sticky="{top:-5,  animation: 'uk-animation-slide-top'}">
    <div class="logo">
        <a href="<?php echo home_url(); ?>" class="logo-link">Insart</a>
    </div>
    <div class="top-line-right flexbox">
        <div class="contacts-top"><?php if(!dynamic_sidebar('sidebar-2')) echo '<!-- sidebar-2 -->' ?></div>
        <div class="menu-btn-wrap">
            <button class="btn-open-menu">
                <i class="nav-btn"></i>
                <i class="nav-btn"></i>
                <i class="nav-btn"></i>
            </button>
        </div>
        <?php get_template_part( 'parts/top-menu' ); ?>
    </div>
</div>