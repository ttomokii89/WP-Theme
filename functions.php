<?php

//-------------------------------
//UA
//-------------------------------
$ua = $_SERVER['HTTP_USER_AGENT'];
$is_sp = strpos($ua,'iPhone') !== false || strpos($ua,'Android') !== false || strpos($ua,'iPod') !== false;
$is_ie = strpos($ua,'msie') !== false || strpos($ua,'Trident') !== false;


//-------------------------------
//アイキャッチ表示
//-------------------------------
add_theme_support('post-thumbnails');


//-------------------------------
//管理バー非表示
//-------------------------------
add_filter('show_admin_bar', '__return_false');


//-------------------------------
//抜粋調整
//-------------------------------
function my_excerpt_length($length) {
	return 300;
}
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'my_excerpt_more');


//-------------------------------
//ビジュアルエディタ調整
//-------------------------------
add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ){
	$initArray['body_class'] = 'editor-area';
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
function extend_tiny_mce_before_init( $mce_init ) {
    $mce_init['cache_suffix'] = 'v='.time();
    return $mce_init;    
}
add_filter( 'tiny_mce_before_init', 'extend_tiny_mce_before_init' );


//-------------------------------
//canonical調整
//-------------------------------
remove_action('wp_head', 'rel_canonical');


//-------------------------------
//スマホの記事一覧表示件数
//-------------------------------
if($is_sp) {
    function change_limit_sp($query){
        if ($query->is_main_query()){
            $query->set('posts_per_page', 10);
        }
    }
    add_action('pre_get_posts','change_limit_sp');
}


//-------------------------------
//youtube埋め込み調整
//-------------------------------
function custom_youtube_oembed($code){
  if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
    $html = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&rel=0", $code);
    $html = '<div class="embed-youtube">' . $html . '</div>';
    return $html;
  }
  return $code;
}
add_filter('embed_oembed_html', 'custom_youtube_oembed');


//-------------------------------
//ウィジェット有効
//-------------------------------
function arphabet_widgets_init() {
	register_sidebar( array(
		'name' => 'ウィジェット',
		'id' => 'header_widget',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="sidebar__item-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


//-------------------------------
//Lazysizes
//-------------------------------
function customize_img_attr($content) {
    $re_content = $content;
    $re_content = preg_replace('/(<img[^>]*)\s+class="[^"]*"/', '$1 class="lazyload"', $content);
    $re_content = preg_replace('/(<img[^>]*)\s+src=/', '$1 data-src=', $re_content);
    $re_content = preg_replace('/(<img[^>]*)\s+srcset=/', '$1 data-srcset=', $re_content);
    $re_content = preg_replace('/(<iframe[^>]*)\s/', '$1 class="lazyload"', $re_content);
    $re_content = preg_replace('/(<iframe[^>]*)\s+src=/', '$1 data-src=', $re_content);
    return $re_content;
}
add_filter('the_content','customize_img_attr');
add_filter('post_thumbnail_html','customize_img_attr');


//-------------------------------
//レンダリングブロックなどの対策
//-------------------------------
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
function my_delete_local_jquery() {
    wp_deregister_script('jquery');
}
if (!is_admin()){
    add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );
}
//プラグインがヘッダーに入れるCSSを一旦解除
function dequeue_css_header() {
    wp_dequeue_style('contact-form-7');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('ez-icomoon');
    wp_dequeue_style('ez-toc');
    wp_dequeue_style('yyi_rinker_stylesheet');
}
add_action('wp_enqueue_scripts', 'dequeue_css_header');
//CSSファイルをフッターに出力
function enqueue_css_footer(){
    wp_enqueue_style('contact-form-7');
    wp_enqueue_style('wp-block-library');
    wp_enqueue_style('ez-icomoon');
    wp_enqueue_style('ez-toc');
    wp_enqueue_style('yyi_rinker_stylesheet');
}
add_action('wp_footer', 'enqueue_css_footer');
//JSファイルの移動
function move_js_footer(){
    //ヘッダーのスクリプトを一旦削除
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    //フッターにスクリプトを出力
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
}
add_action('wp_enqueue_scripts', 'move_js_footer');

?>