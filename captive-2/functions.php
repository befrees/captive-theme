<?php

include get_template_directory() . '/src/assets.php';

include get_template_directory() . '/src/custom-fields.php';



function dd($array, $die = false) {

    echo "<pre>", print_r($array, 1), "</pre>";

    if ($die)

        die();

}





// Отключаем админ панель для всех пользователей

show_admin_bar(false);

register_sidebar(array(

    'name' => __('Header'),

    'id' => 'sidebar-1',

    'description' => 'Header text',

    'before_widget' => '<aside id="%1$s" class="widget %2$s">',

    'after_widget' => '</aside>',

    'before_title' => '<h2 class="title-page">',

    'after_title' => '</h2>',

));

register_sidebar(array(

    'name' => __('Contacts line'),

    'id' => 'sidebar-2',

    'description' => '',

    'before_widget' => '<div id="%1$s" class="widget %2$s">',

    'after_widget' => '</div>',

    'before_title' => '<h1 class="widget-title">',

    'after_title' => '</h1>',

));



register_sidebar(array(

    'name' => __('Bottom'),

    'id' => 'sidebar-5',

    'before_widget' => '',

    'after_widget' => "",

    'before_title' => '<h3 class="widget-title">',

    'after_title' => '</h3>',

    'description' => __("Bottom text")

));

register_sidebar(array(

    'name' => __('Footer'),

    'id' => 'sidebar-4',

    'before_widget' => '<aside id="%1$s" class="widget %2$s">',

    'after_widget' => "</aside>",

    'before_title' => '<h3 class="widget-title">',

    'after_title' => '</h3>',

    'description' => __("Виджеты в футере")

));


register_sidebar(array(

    'name' => __('Copyright'),

    'id' => 'sidebar-6',

    'before_widget' => '',

    'after_widget' => "",

    'before_title' => '<h3 class="widget-title">',

    'after_title' => '</h3>',

    'description' => __("Виджеты в футере")

));



function my_myme_types($mime_types){

    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG

    return $mime_types;

}

add_filter('upload_mimes', 'my_myme_types', 1, 1);



add_filter( 'wp_nav_menu_args', 'new_args_menu' );



function new_args_menu($args=''){

// print_r($args);

  if($args['menu']->term_id==2 ){

    $args['container'] = false;

    $args['menu_class'] = 'menu nav nav-pills top-menu navbar-nav navbar-right';

  }



  return $args;

}



remove_action('wp_head', 'rel_canonical');

remove_filter( 'the_content', 'wpautop' ); // Отключаем автоформатирование в полном посте

remove_filter( 'the_excerpt', 'wpautop' ); // Отключаем автоформатирование в кратком(анонсе) посте

remove_filter('comment_text', 'wpautop'); // Отключаем автоформатирование в комментариях

//remove_action( 'wp_head', 'rsd_link' );

//remove_action( 'wp_head', 'wlwmanifest_link' );

// remove_action( 'wp_head', 'index_rel_link' );

//remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

//remove_action( 'wp_head', 'wp_generator' );

//remove_action( 'wp_head', 'feed_links_extra', 3 );

//remove_action( 'wp_head', 'feed_links', 2 );

//remove_action( 'wp_head', 'rel_canonical' );



if (!function_exists('theme_favicon')) {



    function theme_favicon() {

        if (is_file(TEMPLATEPATH . '/favicon.ico')):

            ?>

            <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />

            <?php

        endif;

    }



}

if (function_exists('add_theme_support')) {

    add_theme_support('post-thumbnails');

    add_theme_support('nav-menus');

    add_theme_support('automatic-feed-links');

    add_theme_support('post-formats', array('aside', 'gallery'));

}

if ( function_exists( 'add_image_size' ) ) {

    add_image_size( 'img_148_111', 148, 111, true );

    // add_image_size( 'img_120_120', 120, 120, true );

    add_image_size( 'img_132_132', 132, 132, true );

    add_image_size( 'img_276_166', 276, 166, true );

    add_image_size( 'img_276_176', 276, 176, true );

    add_image_size( 'img_278_278', 278, 278, true );

    // add_image_size( 'img_180_180', 180, 180, true );

    // add_image_size( 'img_200_200', 200, 200, true );

    // add_image_size( 'img_474_298', 474, 298, true );

    add_image_size( 'img_big', 1920, 1000, false );
    add_image_size( 'img_full', 2500, 0, false );

    add_image_size( 'img_project', 297, 210, true );

}

//  ХЪлебные крошки



function dimox_breadcrumbs() {



    $showOnHome = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать

    $delimiter = '&gt;'; // разделить между "крошками"

    $home = 'Главная'; // текст ссылка "Главная"

    $showCurrent = 1; // 1 - показывать название текущей статьи/страницы, 0 - не показывать

    $before = '<span class="current">'; // тег перед текущей "крошкой"

    $after = '</span>'; // тег после текущей "крошки"



    global $post;

    $homeLink = get_bloginfo('url');



    if (is_home() || is_front_page()) {



        if ($showOnHome == 1)

            echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

    } else {



        echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';



        if (is_category()) {

            $thisCat = get_category(get_query_var('cat'), false);

            if ($thisCat->parent != 0)

                echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');

            echo $before . single_cat_title('', false) . $after; // названия категорий

        } elseif (is_search()) {

            echo $before . 'Результаты поиска по запросу "' . get_search_query() . '"' . $after;

        } elseif (is_day()) {

            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';

            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';

            echo $before . get_the_time('d') . $after;

        } elseif (is_month()) {

            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';

            echo $before . get_the_time('F') . $after;

        } elseif (is_year()) {

            echo $before . get_the_time('Y') . $after;

        } elseif (is_single() && !is_attachment()) {

            if (get_post_type() != 'post') {

                $post_type = get_post_type_object(get_post_type());

                $slug = $post_type->rewrite;

                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';

                if ($showCurrent == 1)

                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } else {

                $cat = get_the_category();

                $cat = $cat[0];

                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

                if ($showCurrent == 0)

                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);

                echo $cats;

                if ($showCurrent == 1)

                    echo $before . get_the_title() . $after;

            }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

            $post_type = get_post_type_object(get_post_type());

            echo $before . $post_type->labels->singular_name . $after;

        } elseif (is_attachment()) {

            $parent = get_post($post->post_parent);

            $cat = get_the_category($parent->ID);

            $cat = $cat[0];

            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';

            if ($showCurrent == 1)

                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif (is_page() && !$post->post_parent) {

            if ($showCurrent == 1)

                echo $before . get_the_title() . $after;

        } elseif (is_page() && $post->post_parent) {

            $parent_id = $post->post_parent;

            $breadcrumbs = array();

            while ($parent_id) {

                $page = get_page($parent_id);

                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';

                $parent_id = $page->post_parent;

            }

            $breadcrumbs = array_reverse($breadcrumbs);

            for ($i = 0; $i < count($breadcrumbs); $i++) {

                echo $breadcrumbs[$i];

                if ($i != count($breadcrumbs) - 1)

                    echo ' ' . $delimiter . ' ';

            }

            if ($showCurrent == 1)

                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif (is_tag()) {

            echo $before . 'Записи с тегом "' . single_tag_title('', false) . '"' . $after;

        } elseif (is_author()) {

            global $author;

            $userdata = get_userdata($author);

            echo $before . 'Статьи автора ' . $userdata->display_name . $after;

        } elseif (is_404()) {

            echo $before . 'Error 404' . $after;

        }



        if (get_query_var('paged')) {

            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())

                echo ' (';

            echo __('Page') . ' ' . get_query_var('paged');

            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())

                echo ')';

        }



        echo '</div>';

    }

}



// end dimox_breadcrumbs()

///////////////////////////////////////////////



function my_pagenavi() {

    global $wp_query;



    $big = 999999999; // уникальное число для замены



    $args = array(

        'base' => str_replace($big, '%#%', get_pagenum_link($big)),

        'format' => '',

        'current' => max(1, get_query_var('paged')),

        'total' => $wp_query->max_num_pages

    );



    $result = paginate_links($args);



    // удаляем добавку к пагинации для первой страницы

    $result = str_replace('/page/1"', '"', $result);



    echo $result;

}



function wp_corenavi() {

    global $wp_query, $wp_rewrite;

    $pages = '';

    $max = $wp_query->max_num_pages;

    if (!$current = get_query_var('paged'))

        $current = 1;

    $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));

    $a['total'] = $max;

    $a['current'] = $current;



    $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить

    $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей

    $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце

    $a['prev_text'] = '< назад'; //текст ссылки "Предыдущая страница"

    $a['next_text'] = 'вперед >'; //текст ссылки "Следующая страница"



    if ($max > 1)

        echo '<div class="navigation pager">';

    if ($total == 1 && $max > 1)

        $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>' . "\r\n";

    echo $pages . paginate_links($a);

    //echo  paginate_links($a);

    if ($max > 1)

        echo '</div>';

}

$theme_url = '';

add_action('init', 'url_theme');

function url_theme(){



$theme_url = get_template_directory_uri().'/';

return $theme_url;

}





//////////////////////////////////////////////////////







add_action('init', 'contact_send');

function contact_send(){

  if(isset($_POST['vfb-submit'])){

    queue_flash_message('Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.', 'success');

  }

}



function form_send(){

  if(isset($_POST['form_id'])){

    $p = $_POST;

    $resp = array('err'=>array());

    switch($_POST['form_id']){

        case 'callback' : // Обратный звонок



          $name = strip_tags(trim($p['cb_name']));

          $phone = strip_tags(trim($p['cb_phone']));

          // echo "name - $name \n";

          // echo "Phone - $phone \n";

          if((int)$p['cpt_2'] < 98){

            $resp['err'][] = 'cpt_2';

          }

          if(empty($name)){

            $resp['err'][] = 'cb_name';

          }

          if(empty($phone) || !valid_phone($phone)){

            $resp['err'][] = 'cb_phone';

          }

          if(empty($resp['err'])){

            $message = 'User ' . $name . ' <br>';

            $message .= 'Phone ' . $phone . '<br>';

            $headers = "From: Golfstreem site <golfstreem@mail.com>\r\n";

            $headers .= 'content-type: text/html';



            if(mail(get_option('admin_email'), 'New order', $message, $headers)){

              $resp['success'] = 'Ваша заявка успешно отправлена.';

            }

          }

        break;

        case 'contacts' :

            // print_r($p);

            $name = strip_tags(trim($p['cname']));

          $email = strip_tags(trim($p['cemail']));

          $text = strip_tags(trim($p['ctext']));

          // echo "name - $name \n";

          // echo "Phone - $phone \n";

          if((int)$p['cpt_1'] < 98){

            $resp['err'][] = 'cpt_1';

          }

          if(empty($name)){

            $resp['err'][] = 'cname';

          }

          if(empty($email) || !valid_email($email)){



            $resp['err'][] = 'cemail';

          }

          if(empty($resp['err'])){

            $message = 'User ' . $name . ' <br>';

            $message .= 'Email ' . $email . '<br>';

            $message .= "<p> $text </p>";

            $headers = "From: Golfstreem site <golfstreem@mail.com>\r\n";

            $headers .= 'content-type: text/html';



            if(mail(get_option('admin_email'), 'New order', $message, $headers)){

              $resp['success'] = 'Ваша заявка успешно отправлена.';

            }

          }

        break;



    }



    echo json_encode($resp);



        exit();

  }

  if(isset($_POST['order']) && $_POST['order'] == 1){

    $p = $_POST;

    // print_r($p);

    $resp = array('err'=>array());



    $name = strip_tags(trim($p['fname']));

    $fam  = strip_tags(trim($p['ffam']));

    $phone = strip_tags(trim($p['fphone']));

    $email = strip_tags(trim($p['femail']));

    $city = strip_tags(trim($p['fcity']));



      if(empty($name)){

        $resp['err'][] = 'fname';

      }

      if(empty($fam)){

        $resp['err'][] = 'ffam';

      }

      if(empty($city)){

        $resp['err'][] = 'fcity';

      }



      if(empty($phone) || !valid_phone($phone)){

        $resp['err'][] = 'fphone';

      }



      if(empty($email) || !valid_email($email)){

        $resp['err'][] = 'femail';

      }



      if(empty($resp['err'])){





        $message = 'User ' . $name . ' ' . $fam . '<br>';



        $message .= 'Email ' . $email . '<br>';



        $message .= 'Phone ' . $phone . '<br>';



        $message .= 'City ' . $city . '<br>';



        if(isset($p['fprog'])){

          foreach ($p['fprog'] as $pr) {

            $message .= '<h3>' . $pr . '</h3>';

          }

        }



        $headers = "From: Congress site <congress@mail.com>\r\n";



      $headers .= 'content-type: text/html';



      if(mail(get_option('admin_email'), 'New order', $message, $headers)){

        $resp['success'] = pll__('Ваша заявка успешно отправлена.');

      }

    }



        echo json_encode($resp);



        exit();

  }

}



add_filter('body_class', 'browser_body_class');



function browser_body_class($classes) {

    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;



    if ($is_lynx)

        $classes[] = 'lynx';

    elseif ($is_gecko)

        $classes[] = 'gecko';

    elseif ($is_opera)

        $classes[] = 'opera';

    elseif ($is_NS4)

        $classes[] = 'ns4';

    elseif ($is_safari)

        $classes[] = 'safari';

    elseif ($is_chrome)

        $classes[] = 'chrome';

    elseif ($is_IE)

        $classes[] = 'ie';

    else

        $classes[] = 'unknown';



    if ($is_iphone)

        $classes[] = 'iphone';



    switch(get_locale()){

        case 'ru_RU':

            $classes[] = 'l-ru';

            break;

        case 'uk':

            $classes[] = 'l-uk';

            break;

        default :

            $classes[] = 'l-ru';

            break;

    }

    return $classes;

}

function new_excerpt_length($length) {

    return 30;

}

// add_filter('excerpt_length', 'new_excerpt_length');



function new_excerpt_more($more) {

    return '';

}

add_filter('excerpt_more', 'new_excerpt_more');



function recalls_get(){

    $query = new WP_Query( 'post_type=recall' );

    return $query;

}



function quests($parent=0){

    $args = array(

        'orderby'       => 'id',

        'order'         => 'ASC',

        'hide_empty'    => true,

        // 'exclude'       => array(),

        // 'exclude_tree'  => array(),

        // 'include'       => array(),

        // 'number'        => '',

        'fields'        => 'all',

        // 'slug'          => '',

        'parent'         => $parent,

        'hierarchical'  => false,

        'child_of'      => 0,

        'get'           => 'all', // ставим all чтобы получить все термины

        // 'name__like'    => '',

        'pad_counts'    => false,

        // 'offset'        => '',

        // 'search'        => '',

        // 'cache_domain'  => 'core',

        'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.

        'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.

    );

    return get_terms( array( 'question' ), $args );

}



function post_res($cat){

    $args = array(

        'post_type'=> 'resp',

        'tax_query' => array(

            array(

                'taxonomy' => 'question',

                'field' => 'term_id',

                'terms' => $cat

            )

        )

    );



    $query = new WP_Query( $args );

    //print_r($query);



    //$posts = get_posts(array('category'=>$cat));

    return $query->posts;

}



function defListResp(){

    $args = array(

        'post_type'=> 'resp',

         'meta_query' => array(

                'relation' => 'AND',

                array(

                    'key' => 'resp_def',

                    'value' => 1

                ),

            )

    );



    $query = new WP_Query( $args );



    return $query;

}

add_action('init', 'search_resp');

function search_resp(){

    if(isset($_GET['search_resp'])){



    }

}



/////////////////////////////////////////



function befrees_previous_album_link(){}





function befrees_previous_post_link( $format = '%link', $link = '&laquo; %title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {

    return befrees_adjacent_post_link( $format, $link, $in_same_term, $excluded_terms, true, $taxonomy );

}



function befrees_next_post_link( $format = '%link', $link = '%title &raquo;', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category' ) {

    return befrees_adjacent_post_link( $format, $link, $in_same_term, $excluded_terms, false, $taxonomy );

}





function befrees_adjacent_post_link( $format, $link, $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {

    if ( $previous && is_attachment() )

        $post = get_post( get_post()->post_parent );

    else

        $post = get_adjacent_post( $in_same_term, $excluded_terms, $previous, $taxonomy );



    if ( ! $post ) {

        $output = '';

    } else {

        $title = $post->post_title;



        if ( empty( $post->post_title ) )

            $title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );



        /** This filter is documented in wp-includes/post-template.php */

        $title = apply_filters( 'the_title', $title, $post->ID );



        $date = mysql2date( 'j F Y', $post->post_date );

        $rel = $previous ? 'prev' : 'next';



        $string = '<div class="ts-page-element element element-dropzone ">

                  <a href="' . get_permalink( $post ) . '"  data-role="button" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-up-c"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">';

        $inlink = str_replace( '%title', $title, $link );

        // $inlink = str_replace( '%date', $date, $inlink );

        $inlink = $string . $inlink . '</span></span></a></div>';

        // $inlink .= '<span class="link-date">'. $date . '</span>';



        $output = str_replace( '%link', $inlink, $format );

    }



    $adjacent = $previous ? 'previous' : 'next';



    /**

     * Filter the adjacent post link.

     *

     * The dynamic portion of the hook name, `$adjacent`, refers to the type

     * of adjacency, 'next' or 'previous'.

     *

     * @since 2.6.0

     * @since 4.2.0 Added the `$adjacent` parameter.

     *

     * @param string  $output   The adjacent post link.

     * @param string  $format   Link anchor format.

     * @param string  $link     Link permalink format.

     * @param WP_Post $post     The adjacent post.

     * @param string  $adjacent Whether the post is previous or next.

     */

    return apply_filters( "{$adjacent}_post_link", $output, $format, $link, $post, $adjacent );

}



function get_link_respons($id){

  $txn = wp_get_post_terms($id, 'question');

  $parents=array();

  $parents[] = $txn[0]->term_id;

  $parent = get_term($txn[0]->parent,'question');

  // echo $txn[0]->parent;



  if($parent->term_id){

    $parents[] = $parent->term_id;

    if($parent->parent != 0) $parents[] = $parent->parent;

  }

  $cp = array_reverse($parents);

  // print_r($parents);

  // print_r($cp);

  $link = $_SERVER['REDIRECT_URL'].'?';

  for($i=0;$i<count($cp); $i++){

    if($i==0){$link .= 'sel-part='.$cp[$i];}

    if($i==1){$link .= '&sel-cat='.$cp[$i];}

    if($i==2){$link .= '&sel-subcat='.$cp[$i];}

  }

  return $link;

}



function get_progs($parent=array(0)){

  $args = array(

    'post_type'       => 'programm',

    'post_parent__in' => $parent,

    'post_status'     => 'publish',

    'orderby'         => array( 'menu_order' => 'ASC' )

    );

  $out = new WP_Query($args);

  return $out;

}





function valid_email($str)

  {

    if (function_exists('idn_to_ascii') && $atpos = strpos($str, '@'))

    {

      $str = substr($str, 0, ++$atpos).idn_to_ascii(substr($str, $atpos));

    }



    return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);

  }

function valid_phone($number, $lengths = NULL)

  {

    if ( ! is_array($lengths))

    {

      $lengths = array(7,10,11);

    }



    // Remove all non-digit characters from the number

    $number = preg_replace('/\D+/', '', $number);



    // Check if the number is within range

    return in_array(strlen($number), $lengths);

  }





/* Register our shortcodes. */

add_shortcode( 'column', 'column_shortcode' );

add_shortcode( 'clear', 'clear_floats_shortcode' );

add_shortcode( 'row', 'row_shortcode' );

add_shortcode( 'div', 'div_shortcode' );
add_shortcode( 'lev1', 'div_shortcode' );
add_shortcode( 'lev2', 'div_shortcode' );
add_shortcode( 'lev3', 'div_shortcode' );
add_shortcode( 'lev4', 'div_shortcode' );

add_shortcode('items-about', 'add_about_elems' );



function add_about_elems(){

  global $post;

  $out;

  $items = get_post_meta( $post->ID, 'elems', true );

  // print_r($items);

  if($items){

    $out .= '<div class="items-about cf">';

    foreach ($items as $key => $item) {

      $out .= '<div class="about-item bdr">

                      <span class="bdr-icon">

                  <img src="' . wp_get_attachment_image_url($item['image'], 'fuul') . '" class="attachment-full size-full wp-post-image" alt="prj1">                        </span>

                      <span class="bdr-label"><span>'. $item['text'] . '</span></span>

              </div>';

    }

    $out .= '</div>';

  }

  return $out;

}



/**

 * The column shortcode.

 * @param array $atts an array of shortcode attributes

 * @param string $content the content between the shortcode tags

 * @return string

 */

function div_shortcode( $atts, $content = '' ){
     /* Extract the shortcode attributes. */

    extract( shortcode_atts( array(
      
      'class' => ''
        ), $atts ) );
// echo $content;
    /* Parse any nested shortcodes and clean up the formatting. */

    $content = parse_shortcode_content( $content );

    /* Assemble the output. */

    // $content = do_shortcode( $content );

    $output = "<div class=\"$class\">$content</div>";

    return $output;
}
function column_shortcode( $atts, $content = '' ) {

    /* Extract the shortcode attributes. */

    extract( shortcode_atts( array(
      // 'width' => '48%',
      // 'spacing' => '0',

      'class' => 'col-md-6'
        ), $atts ) );



    /* Parse any nested shortcodes and clean up the formatting. */

    $content = parse_shortcode_content( $content );



    /* Assemble the output. */

    // $style = "style='float: left; width: $width; margin-right: $spacing;'";

    // $output = "<div $style class=\"$class\">$content</div>";

    $output = "<div class=\"$class\">$content</div>";



    return $output;

}



function row_shortcode( $atts, $content = '' ) {



    /* Extract the shortcode attributes. */

    extract( shortcode_atts( array(

      // 'width' => '48%',

      // 'spacing' => '0',

      'class' => 'row'

        ), $atts ) );



    /* Parse any nested shortcodes and clean up the formatting. */

    $content = parse_shortcode_content( $content );



    /* Assemble the output. */

    // $style = "style='float: left; width: $width; margin-right: $spacing;'";

    // $output = "<div $style class=\"$class\">$content</div>";

    $output = "<div class=\"$class\">$content</div>";



    return $output;

}



/**

 * The float clearing shortcode.

 * @return string

 */

function clear_floats_shortcode() {

    return "<div style='clear: both;'></div>";

}



/**

 * Process the content of a shortcode.

 * Parses any nested shortcodes, then adds paragraphs, then removes

 * the invalid markup wpautop() sometimes adds.

 * @param string $content the content passed by a shortcode

 * @return string

 */

function parse_shortcode_content( $content ) {



    /* Parse nested shortcodes and add formatting. */

    $content = trim( wpautop( do_shortcode( $content ) ) );



    /* Remove '</p>' from the start of the string. */

    if ( substr( $content, 0, 4 ) == '</p>' )

        $content = substr( $content, 4 );



    /* Remove '<p>' from the end of the string. */

    if ( substr( $content, -3, 3 ) == '<p>' )

        $content = substr( $content, 0, -3 );



    /* Remove any instances of '<p></p>'. */

    $content = str_replace( array( '<p></p>' ), '', $content );



    return $content;

}





/**

* video parser

*/

function parseVideoByURL($current_video_url) {

    $out = array();

        $pos = strpos ( $current_video_url, 'http://' );

        $posS = strpos ( $current_video_url, 'https://' );

        if ($pos === false && $posS === false) {

            $current_video_url = 'http://' . $current_video_url;

        }

        

        // parse url and detect type

        $media_source = explode ( '/', $current_video_url );

        $media_source = explode ( '.', $media_source [2] );

        

        if ((($media_source [0] == 'www') && ($media_source [1] == 'vimeo')) || ($media_source [0] == 'vimeo')) {

            // vimeo

            // update_post_meta ( $post_id, 'video_type', 'vimeo' ); // set type



            $out['video_type'] = 'vimeo';

                

            $vimeo_key = explode ( '.com/', $current_video_url );

            $vimeo_key = @explode ( '?', $vimeo_key [1] );

            // get info

            $data = @json_decode ( file_get_contents ( 'http://vimeo.com/api/v2/video/' . $vimeo_key [0] . '.json' ) );

                

            $thumb = '';

            $width = 0;

            $height = 0;

            if (isset ( $data [0]->thumbnail_large )) {

                /**

                * thumbnail_large, thumbnail_small, thumbnail_medium

                */

                $thumb = $data [0]->thumbnail_large;

                $width = intval ( $data [0]->width );

                $height = intval ( $data [0]->height );



                // print_r($data [0]);

        

                // update_post_meta ( $post_id, 'video_thumb', $thumb );

                // update_post_meta ( $post_id, 'video_source', '<iframe src="//player.vimeo.com/video/' . $vimeo_key [0] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>' );

                $out['video_thumb'] = $thumb;

                $out['video_source'] = '<iframe src="//player.vimeo.com/video/' . $vimeo_key [0] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

            }

        } else if ((($media_source [0] == 'www') && ($media_source [1] == 'youtube')) || ($media_source [0] == 'youtu')) {

            //update_post_meta ( $post_id, 'video_type', 'youtube' ); // set type

              $out['video_type'] = 'youtube';



            if (strpos ( $current_video_url, "&v" ) || strpos ( $current_video_url, "?v" )) {

                $youtube_key = explode ( '/', $current_video_url );

                $youtube_key = @explode ( 'v=', $youtube_key [3] );

                $youtube_key = @explode ( '&', $youtube_key [1] );

            } else {

                $youtube_key = @explode ( '?', $current_video_url );

                $youtube_key [0] = @substr ( $youtube_key [0], - 11 );

            }

                /**

                * maxresdefault, hqdefault, mqdefault

                */

            $thumb = '//i.ytimg.com/vi/' . $youtube_key [0] . '/mqdefault.jpg?custom=true&w=264&h=175';

            $width = 560;

            $height = 349;

                

            // update_post_meta ( $post_id, 'video_thumb', $thumb );

            // update_post_meta ( $post_id, 'video_source', '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $youtube_key [0] . '?rel=0" frameborder="0" allowfullscreen></iframe>' );

            $out['video_thumb'] = $thumb;

            $out['video_source'] = '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $youtube_key [0] . '?rel=0" frameborder="0" allowfullscreen></iframe>';

        } else if ((($media_source [1] == 'wistia')) || ($media_source [0] == 'wistia')) {

            //update_post_meta ( $post_id, 'video_type', 'wistia' ); // set type

              $out['video_type'] = 'wistia';  

            $url = 'http://fast.wistia.com/oembed?url=' . $current_video_url . '&width=640&height=480';

            $ch = curl_init ();

            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

            curl_setopt ( $ch, CURLOPT_URL, $url );

            $result = curl_exec ( $ch );

            curl_close ( $ch );

            $wistia = json_decode ( $result );

                

            // update_post_meta ( $post_id, 'video_thumb', isset ( $wistia->{'thumbnail_url'} ) ? $wistia->{'thumbnail_url'} : '' );

            // update_post_meta ( $post_id, 'video_source', isset ( $wistia->{'html'} ) ? $wistia->{'html'} : '' );

            $out['video_thumb'] = isset ( $wistia->{'thumbnail_url'} ) ? $wistia->{'thumbnail_url'} : '' ;

            $out['video_source'] = isset ( $wistia->{'html'} ) ? $wistia->{'html'} : '';

        }

        return $out;

    }



function get_reviews($post_id){

  $out = new WP_Query(array(

        'post_type' => 'review',

          'meta_query' => array(

            array(

              'key' => 'client',

              'value' => $post_id

            ),

          ))

    );

  return $out;

  }

