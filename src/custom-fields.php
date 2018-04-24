<?php


// register_meta( 'post', 'bookname', array(
// 	'type'              => 'string',
// 	'description'       => 'Название книги',
// 	'single'            => true,
// 	'sanitize_callback' => 'sanitize_bookname_meta',
// 	'auth_callback'     => 'auth_bookname_meta',
// 	'show_in_rest'      => false,
// ) );

// function sanitize_bookname_meta( $meta_value, $meta_key, $object_type ){
// 	$meta_value = wp_strip_all_tags( $meta_value ); // Удалим html теги

// 	return $meta_value;
// }

// function auth_bookname_meta( $false, $meta_key, $postID, $user_id, $cap, $caps ){
// 	// запретим создание и редактирование этого метаполя для всех кроме админа
// 	if( ! current_user_can('manage_options') )
// 		return false;
// 	return true;
// }


/* Добавляем блоки в основную колонку на страницах постов и пост. страниц */
function myplugin_add_custom_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen )
		add_meta_box( 'myplugin_sectionid', 'Название мета блока', 'myplugin_meta_box_callback', $screen );
}
add_action('add_meta_boxes', 'myplugin_add_custom_box');

/* HTML код блока */
function myplugin_meta_box_callback() {
	// Используем nonce для верификации
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );

	// Поля формы для введения данных
	echo '<label for="myplugin_new_field">' . __("Description for this field", 'myplugin_textdomain' ) . '</label> ';
	echo '<input type="text" id= "myplugin_new_field" name="bookname" value="'.get_post_meta( $_GET['post'], 'bookname', true ).'" size="25" />';
}

/* Сохраняем данные, когда пост сохраняется */
function myplugin_save_postdata( $post_id ) {
	// проверяем nonce нашей страницы, потому что save_post может быть вызван с другого места.
	if ( ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) ) )
		return $post_id;

	// проверяем, если это автосохранение ничего не делаем с данными нашей формы.
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	// проверяем разрешено ли пользователю указывать эти данные
	if ( 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
		  return $post_id;
	} elseif( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Убедимся что поле установлено.
	if ( ! isset( $_POST['bookname'] ) )
		return;
		// die();
	// Все ОК. Теперь, нужно найти и сохранить данные
	// Очищаем значение поля input.
	$my_data = sanitize_text_field( $_POST['bookname'] );

	// Обновляем данные в базе данных.
	update_post_meta( $post_id, 'bookname', $my_data );
}
add_action( 'save_post', 'myplugin_save_postdata' );