<?php
if (!defined('ABSPATH')) exit;

/* =========================================================
   癒の原整骨院 テーマ functions
   ========================================================= */

/* ---- 院の基本情報（編集はここ） ---- */
define('YNH_TEL',      '093-287-5590');
define('YNH_TEL_RAW',  '0932875590');
define('YNH_LINE_URL', 'https://lin.ee/xnoZxgP');
define('YNH_IG_URL',   'https://www.instagram.com/yunohara_1112/');
define('YNH_KARADA_URL','https://yunohara-karada-labo.com/');

/* ---- テーマサポート ---- */
function ynh_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
}
add_action('after_setup_theme', 'ynh_setup');

/* ---- CSS / JS ---- */
function ynh_assets() {
    $dir = get_template_directory_uri();
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('ynh-fonts', 'https://fonts.googleapis.com/css2?family=Lato:wght@700;900&family=Noto+Sans+JP:wght@400;500;700;900&display=swap', array(), null);
    wp_enqueue_style('ynh-style', $dir . '/assets/css/style.css', array(), $ver);
    wp_enqueue_script('ynh-main', $dir . '/assets/js/main.js', array(), $ver, true);
    wp_localize_script('ynh-main', 'YNH', array('themeUri' => $dir));
}
add_action('wp_enqueue_scripts', 'ynh_assets');

/* ---- カスタム投稿タイプ：コラム ---- */
function ynh_register_column() {
    register_post_type('column', array(
        'labels' => array(
            'name'          => 'コラム',
            'singular_name' => 'コラム',
            'add_new_item'  => 'コラムを追加',
            'edit_item'     => 'コラムを編集',
            'all_items'     => 'コラム一覧',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_position'=> 5,
        'menu_icon'    => 'dashicons-edit',
        'rewrite'      => array('slug' => 'column', 'with_front' => false),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
    register_taxonomy('column_cat', 'column', array(
        'labels' => array('name' => 'コラムカテゴリ', 'singular_name' => 'コラムカテゴリ'),
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'column-cat', 'with_front' => false),
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'ynh_register_column');

/* ---- ヘッダーナビのアクティブ表示 ---- */
function ynh_cur($cond) {
    return $cond ? ' aria-current="page"' : '';
}

/* ---- コラムのサムネイルURL（アイキャッチ→無ければカテゴリ別SVG） ---- */
function ynh_column_thumb_url($post_id) {
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, 'large');
    }
    $slug = get_post_field('post_name', $post_id);
    $map = array(
        'jiko-taiou' => 'taiou',
        'muchiuchi'  => 'muchiuchi',
        'jibaiseki'  => 'jibaiseki',
    );
    $key = isset($map[$slug]) ? $map[$slug] : 'service';
    return get_template_directory_uri() . '/assets/img/blog-' . $key . '.svg';
}

/* ---- 構造化データ（トップ：MedicalClinic / LocalBusiness ＋ FAQ） ---- */
function ynh_jsonld() {
    if (!is_front_page()) return;
    $biz = array(
        '@context' => 'https://schema.org',
        '@type' => array('MedicalClinic', 'LocalBusiness'),
        'name' => get_bloginfo('name'),
        'url' => home_url('/'),
        'telephone' => '+81-93-287-5590',
        'address' => array(
            '@type' => 'PostalAddress',
            'postalCode' => '808-0027',
            'addressRegion' => '福岡県',
            'addressLocality' => '北九州市若松区',
            'streetAddress' => '北湊町5-62 愛暮利伊フォーチュン北湊Ⅱ 2号室',
        ),
        'openingHoursSpecification' => array(
            array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array('Monday','Tuesday','Wednesday','Thursday','Friday'), 'opens' => '09:00', 'closes' => '13:00'),
            array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array('Monday','Tuesday','Wednesday','Thursday','Friday'), 'opens' => '15:00', 'closes' => '20:00'),
            array('@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array('Saturday'), 'opens' => '09:00', 'closes' => '14:00'),
        ),
        'priceRange' => '￥￥',
    );
    echo "\n" . '<script type="application/ld+json">' . wp_json_encode($biz, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'ynh_jsonld');

/* ---- アーカイブの表示件数 ---- */
function ynh_column_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('column')) {
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'ynh_column_per_page');
