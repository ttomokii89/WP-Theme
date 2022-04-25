<?php

//-------------------------------
//feed有効
//-------------------------------
add_theme_support( 'automatic-feed-links' );


//-------------------------------
//アイキャッチ表示
//-------------------------------
add_theme_support('post-thumbnails');
add_image_size('mini', 160, 90, false); 


//-------------------------------
//管理バー非表示
//-------------------------------
add_filter('show_admin_bar', '__return_false');


//---------------------------------
//GAからのデータ取得件数を600件にする
//---------------------------------
add_filter( 'sga_ranking_limit_filter', function( $limit ) { return 600; } );


//---------------------------------
//title
//---------------------------------
add_theme_support ('title-tag');
function rewrite_title($title) {
    if (is_front_page()) {
        $title['tagline'] = '';
    }elseif (is_single()) {
        $title['site'] = '';
    }
    return $title;
}
add_filter('document_title_parts', 'rewrite_title');


//-------------------------------
//軽量化
//-------------------------------
//絵文字削除
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');

//head内（ヘッダー）Embed系の記述削除 
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('template_redirect', 'rest_output_link_header', 11 );

//head内（ヘッダー）から不要なコード削除
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_site_icon', 99);
remove_action('wp_head', 'rel_canonical');

//デフォルトのjquery削除 ※jqueryが必要なプラグインのjsも削除される
function my_delete_local_jquery() {
    wp_deregister_script('jquery');
}
if (!is_admin()){
    add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );
}

//プラグインがヘッダーに入れるCSSを解除
function dequeue_css_header() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('yyi_rinker_stylesheet');
}
add_action('wp_enqueue_scripts', 'dequeue_css_header');


//-------------------------------
//robots調整
//-------------------------------
function custom_meta_robots( array $robots ) {
    if (is_tag() || is_search() || is_404()) {
        $robots['noindex']= true;
    }
    return $robots;
}
add_filter( 'wp_robots', 'custom_meta_robots' );


//-------------------------------
//インラインCSS
//-------------------------------
function output_style() {
    
    if (is_front_page()) {
        $css = 'front-page';
    } elseif (is_archive() || is_search() || is_page_template('blog.php')) {
        $css = 'archive';
    } elseif (is_single() || is_page()) {
        $css = 'entry';
    } elseif (is_404()) {
        $css = '404';
    } else {
        $css = 'common';
    }
    
    wp_register_style('style', false);
    wp_enqueue_style('style');
    $icss = file_get_contents(get_template_directory_uri() . '/asset/css/' . $css . '.css', true);
    wp_add_inline_style('style', $icss);
}
add_action('wp_enqueue_scripts', 'output_style');


//-------------------------------
//Lazyload周り
//-------------------------------
//srcsetやらない
add_filter('wp_calculate_image_srcset_meta', '__return_null');
//loading="lazy"
function loading_lazy($content) {
    $re_content = $content;
    //$re_content = preg_replace('/(<img[^>]*)\s+src=/', '$1 loading="lazy" src=', $re_content);
    $re_content = preg_replace('/(<iframe[^>]*)\s+src=/', '$1 loading="lazy" src=', $re_content);
    return $re_content;
}
add_filter('the_content', 'loading_lazy', 20);


//---------------------------------
// 内部リンクのブログカード化（ショートコード）
//---------------------------------
// 記事IDを指定して抜粋文を取得する
function ltl_get_the_excerpt($post_id){
  global $post;
  $post_bu = $post;
  $post = get_post($post_id);
  setup_postdata($post_id);
  $output = get_the_excerpt();
  $post = $post_bu;
  return $output;
}

//内部リンクをはてなカード風にするショートコード
function nlink_scode($atts) {
    extract(shortcode_atts(array(
        'url'=>"",
        'title'=>"",
        'excerpt'=>"",
        'img'=>""
    ),$atts));

    $id = url_to_postid($url);//URLから投稿IDを取得

    $img_width ="90";//画像サイズの幅指定
    $img_height = "90";//画像サイズの高さ指定
    $no_image = 'noimageに指定したい画像があればここにパス';//アイキャッチ画像がない場合の画像を指定

    //タイトルを取得
    if(empty($title)){
        $title = esc_html(get_the_title($id));
    }
    //抜粋文を取得
    if(empty($excerpt)){
        $excerpt = esc_html(ltl_get_the_excerpt($id));
    }

    if(empty($img)){
        //アイキャッチ画像を取得
        if(has_post_thumbnail($id)) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($id),array($img_width,$img_height));
            $img_tag = "<img loading='lazy' src='" . $img[0] . "' alt='{$title}' width=" . $img[1] . " height=" . $img[2] . " />";
            $imgg = $img[0];
        }else{
            $img_tag = false;
        }
    }else{
        $img_tag = "<img loading='lazy' src='" . $img . "' alt='{$title}' width=" . $img_width . " height=" . $img_height . " />";
        $imgg = $img;
    }
    
    
    if(isset($_GET['amp'])){
        $card_thumb .= '<div class="card__thumb" style="background:url('. $imgg .') no-repeat center/cover;">&nbsp;</div>';
    }else{
        $card_thumb .= '<div class="card__thumb">'. $img_tag .'</div>';
    }

    $nlink .='
<div class="card">
    <a class="card__wrap" href="'. $url .'">
      <div class="card__info">
          <div class="card__title">'. $title .' </div>
          <div class="card__excerpt">'. $excerpt .'</div>
          <div class="card__url">lostmortal.net</div>
      </div>
      '. $card_thumb .'
    </a>
</div>';

    return $nlink;
}
add_shortcode("nlink", "nlink_scode");

//テキストリンクver
function textLink($atts) {
    extract(shortcode_atts(array(
        'url'=>"",
        'title'=>""
    ),$atts));
    
    //URLから投稿IDを取得
    $id = url_to_postid($url);

    //タイトルを取得
    if(empty($title)){
        $title = esc_html(get_the_title($id));
    }

    return '<a class="tlink" href="'. $url .'"> '. $title .' </a>';

}
add_shortcode('tlink', 'textLink');


//---------------------------------
//記事ページ系
//---------------------------------
//目次
function add_toc($content){
    //参考：https://u-web-nana.com/function-table-of-contents/
    if (is_single() && !in_category('lostmortal')) {
        
        //広告（アドセンス）
        /*
        if(isset($_GET['amp'])){
            $ad = '<div class="entryAd entryAd--first"><amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-1872274200889143" data-ad-slot="3822138513" data-auto-format="rspv" data-full-width=""><div overflow=""></div></amp-ad></div>';
        }else{
            $ad = '<div class="entryAd entryAd--first"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1872274200889143" data-ad-slot="3822138513" data-ad-format="auto" data-full-width-responsive="true"></ins></div>';
        }
        */
        
        //広告（アドマネージャー）
        /*
        if(isset($_GET['amp'])){
            $adm = '<div class="entryAd entryAd--first"><amp-ad layout="fluid" height="fluid" type="doubleclick" data-slot="/22073270373/lostmortal_adsense" data-multi-size="580x400"></amp-ad></div>';
        }else{
            $adm = '<div class="entryAd entryAd--first"><div id="div-gpt-ad-1597798031289-0"><script>googletag.cmd.push(function(){googletag.display("div-gpt-ad-1597798031289-0");});</script></div></div>';
        }
        */
        
        $pattern = '/<h[2-3]>(.+?)<\/h[2-3]>/s';
        preg_match_all($pattern, $content, $elements, PREG_SET_ORDER);

        if (count($elements) >= 2) {
            $toc = '';
            $i = 0;
            $currentlevel = 0;
            $id = 'anc-';

            foreach ($elements as $element) {
                $id .= $i + 1;
                $replace_title = preg_replace('/<(h[2-3])>(.+?)<\/(h[2-3])>/s', '<$1 id="' . $id . '">$2</$3>', $element[0]);
                $content = str_replace($element[0], $replace_title, $content);

                if (strpos($element[0], '<h2') !== false) {
                    $level = 1;
                } elseif (strpos($element[0], '<h3') !== false) {
                    $level = 2;
                }

                while ($currentlevel < $level) {
                    if ($currentlevel === 0) {
                        $toc .= '<ul class="entryToc__list">';
                    } else {
                        $toc .= '<ul class="entryToc__listChild">';
                    }
                    $currentlevel++;
                }

                while ($currentlevel > $level) {
                    $toc .= '</li></ul>';
                    $currentlevel--;
                }

                // 目次の項目で使用する要素を指定
                $toc .= '<li class="entryToc__item"><a href="#' . $id . '" class="entryToc__link">' . $element[1] . '</a>';
                $i++;
                $id = 'anc-';
            } // foreach

            // 目次の最後の項目をどの要素から作成したかによりタグの閉じ方を変更
            while ($currentlevel > 0) {
                $toc .= '</li></ul>';
                $currentlevel--;
            }

            $index = '<nav class="entryToc" id="js-entryToc"><div class="entryToc__heading">もくじ</div>' . $toc . '</nav>';
            $h2 = '/<h2.*?>/i';

            if (preg_match($h2, $content, $h2s)) {
                //$content = preg_replace($h2, $index . $ad . $h2s[0], $content, 1); //アドセンスあり
                $content = preg_replace($h2, $index . $h2s[0], $content, 1);
            }
        }
    }
    return $content;
}
add_filter('the_content', 'add_toc');


//youtube埋め込み
function custom_youtube_oembed($code){
    if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
        $html = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&rel=0", $code);
        $html = '<div class="embed-youtube">' . $html . '</div>';
        return $html;
    }
    return $code;
}
add_filter('embed_oembed_html', 'custom_youtube_oembed', 99);

//rinkerのPCだけ_blank
function yyi_rinker_rel_target_text() {
	if ( wp_is_mobile() ) {
		return '';
	} else {
		return 'rel="nofollow noopener" target="_blank"';
	}

}
add_filter ( 'yyi_rinker_rel_target_text', 'yyi_rinker_rel_target_text', 20 );

//rinkerクレジット削除
function yyi_rinker_delete_credit_html_data( $meta_datas ) {
	$meta_datas[ 'credit' ] = '';
	return $meta_datas;
}
add_filter( 'yyi_rinker_meta_data_update',  'yyi_rinker_delete_credit_html_data', 200 );


//-------------------------------
//その他ショートコード
//-------------------------------
//記事内広告3
function adsense3() {
    if(isset($_GET['amp'])){
return '
<amp-ad width="100vw" height=320
     type="adsense"
     data-ad-client="ca-pub-1872274200889143"
     data-ad-slot="6025045510"
     data-auto-format="rspv"
     data-full-width>
  <div overflow></div>
</amp-ad>
';  
    } else {
return '
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-1872274200889143"
     data-ad-slot="1752302625"></ins>
';
    }
}
add_shortcode('ad3', 'adsense3');

//記事内広告4
function adsense4() {
    if(isset($_GET['amp'])){
return '
<amp-ad width="100vw" height=320
     type="adsense"
     data-ad-client="ca-pub-1872274200889143"
     data-ad-slot="9987394831"
     data-auto-format="rspv"
     data-full-width>
  <div overflow></div>
</amp-ad>
';
    } else {
return '
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-1872274200889143"
     data-ad-slot="6242099902"></ins>
';
    }
}
add_shortcode('ad4', 'adsense4');

//Amazon Musicバナー
function amazonMusic() {
return '
<div class="amznbnr">
<div>リスナーとして Amazon Music 推してます</div>
<iframe src="https://rcm-fe.amazon-adsystem.com/e/cm?o=9&p=12&l=ur1&category=primemusic&banner=0KNYR311TAKJYKTSVT02&f=ifr&linkID=62a8f37d6448e727e5f8922e46de18c0&t=ct9a1998-22&tracking_id=ct9a1998-22" width="300" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
</div>
';
}
add_shortcode('amazonMusic', 'amazonMusic');


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
///////////////////////////////////////
// Gutenberg用のCSSを読み込む
///////////////////////////////////////
add_action( 'enqueue_block_editor_assets', 'gutenberg_stylesheets_custom_demo' );
function gutenberg_stylesheets_custom_demo() {
  //現在適用しているテーマのeditor-style.cssを読み込む
  $editor_style_url = get_theme_file_uri('/editor-style.css');
  wp_enqueue_style( 'theme-editor-style', $editor_style_url );
 
}


?>