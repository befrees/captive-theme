<!DOCTYPE html>
<html lang="en">
<head>
    <?php get_header('head') ?>
</head>
<body <?php body_class() ?>>
    <div class="wrapper">
        <?php get_header() ?>
        <div class="middle" id="middle">
            <div class="container">
                <?php while(have_posts()): the_post(); ?>
                <div class="row">
                    <div class="h1 text-center"><?= get_the_title(); ?></div>
                    <div class="content"><?php the_content() ?></div>
                </div>
            <?php endwhile; ?>
            </div>
        </div> <!-- #middle -->
    </div>
    <?php get_footer(); ?>
</body>
</html>

