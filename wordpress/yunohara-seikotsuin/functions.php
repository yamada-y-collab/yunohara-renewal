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

/* ---- Googleクチコミ（数値が変わったらここだけ更新） ---- */
define('YNH_REVIEW_SCORE', '4.9');
define('YNH_REVIEW_COUNT', '12');
// GBPの「クチコミを増やす」で取得した共有リンクに差し替え可
define('YNH_REVIEW_URL', 'https://www.google.com/search?q=' . rawurlencode('癒の原整骨院 北九州市若松区'));

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

/* =========================================================
   SEO：ページ別のタイトル・メタディスクリプション・OGP・canonical
   ※ SEO SIMPLE PACK 等のSEOプラグインを併用する場合は二重出力になるため、
     どちらか一方に統一してください（このテーマ側SEOを止めるには
     ynh_seo_title フィルタと ynh_seo_head アクションの add をコメントアウト）。
   ========================================================= */
function ynh_seo_data() {
    $t = null; $d = null; $canon = null;
    if (is_front_page()) {
        $t = '癒の原整骨院｜北九州市若松区の整骨院｜酸素カプセル・交通事故治療';
        $d = '北九州市若松区の癒の原整骨院。地域初の酸素カプセル導入。腰痛・肩こり・スポーツ外傷・交通事故治療・労災に対応。若松駅から車で5分、駐車場11台完備。';
        $canon = home_url('/');
    } elseif (is_page('menu')) {
        $t = '施術メニュー・料金｜癒の原整骨院｜北九州市若松区';
        $d = '北九州市若松区・癒の原整骨院の施術メニューと料金。手技治療・超音波治療・Dr.メドマーなどの保険施術、特殊電気治療ES-5000・姿勢矯正・酸素カプセルの自費施術を詳しくご紹介します。';
        $canon = get_permalink();
    } elseif (is_page('oxygen')) {
        $t = '酸素カプセル｜癒の原整骨院｜北九州市若松区・地域初導入';
        $d = '北九州市若松区・癒の原整骨院の酸素カプセル。地域初導入。酸素濃度30%・1.3気圧で疲労回復・睡眠改善・美肌・肩こり腰痛緩和。30分1,000円〜。着替え不要。';
        $canon = get_permalink();
    } elseif (is_page('es5000')) {
        $t = '特殊電気治療 ES-5000｜癒の原整骨院｜北九州市若松区｜神経の痛み・しびれに';
        $d = '北九州市若松区・癒の原整骨院の特殊電気治療「ES-5000」。立体動態波・微弱電流・神経筋刺激で、神経性の痛みやしびれ、深部のコリ、スポーツ外傷までアプローチ。プロの現場でも使われる治療器です。';
        $canon = get_permalink();
    } elseif (is_page('accident')) {
        $t = '交通事故・むち打ち治療｜癒の原整骨院｜北九州市若松区【自賠責0円】';
        $d = '北九州市若松区で交通事故治療なら癒の原整骨院。むち打ち・首の痛み・しびれに対応し、自賠責保険適用で窓口負担0円。保険会社対応・他院からの転院もサポート。若松駅から車で5分、夜20時まで受付。';
        $canon = get_permalink();
    } elseif (is_page('symptoms')) {
        $t = '対応症状｜癒の原整骨院｜北九州市若松区｜腰痛・肩こり・スポーツ外傷';
        $d = '北九州市若松区・癒の原整骨院の対応症状。腰痛・肩こり・ぎっくり腰・寝違え・捻挫・五十肩・坐骨神経痛・スポーツ外傷など。回復に特化したオーダーメイド施術で根本改善を目指します。';
        $canon = get_permalink();
    } elseif (is_post_type_archive('column')) {
        $t = 'コラム｜癒の原整骨院｜北九州市若松区｜交通事故・体のケア情報';
        $d = '北九州市若松区・癒の原整骨院のコラム。交通事故・むち打ち、酸素カプセル、腰痛・肩こりなど、体のケアに役立つ情報を院長・柔道整復師が解説します。';
        $canon = get_post_type_archive_link('column');
    } elseif (is_singular('column')) {
        $t = get_the_title() . '｜癒の原整骨院｜北九州市若松区';
        // 手動抜粋があれば優先。無ければ本文の最初の段落（見出し・メタ表記を避ける）
        $ex = get_post_field('post_excerpt', get_the_ID());
        if (!$ex) {
            $content = get_post_field('post_content', get_the_ID());
            if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $content, $m)) {
                $ex = trim(wp_strip_all_tags($m[1]));
            }
            if (!$ex) {
                $ex = wp_trim_words(wp_strip_all_tags($content), 90, '…');
            }
        }
        $d = mb_substr($ex, 0, 120);
        $canon = get_permalink();
    }
    return array('title' => $t, 'desc' => $d, 'canon' => $canon);
}

/* タイトルタグの上書き */
function ynh_seo_title($title) {
    $s = ynh_seo_data();
    return $s['title'] ? $s['title'] : $title;
}
add_filter('pre_get_document_title', 'ynh_seo_title', 20);

/* メタ／OGP／canonical 出力 */
function ynh_seo_head() {
    $s = ynh_seo_data();
    $title = $s['title'] ? $s['title'] : wp_get_document_title();
    $desc  = $s['desc'];
    $canon = $s['canon'];
    $ogimg = '';
    if (is_singular('column') && has_post_thumbnail()) {
        $ogimg = get_the_post_thumbnail_url(get_the_ID(), 'large');
    }
    if (!$ogimg) {
        $ogimg = get_template_directory_uri() . '/assets/img/storefront.jpg';
    }
    echo "\n";
    if ($desc)  echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    if ($canon) echo '<link rel="canonical" href="' . esc_url($canon) . '">' . "\n";
    echo '<meta property="og:type" content="' . (is_front_page() ? 'website' : 'article') . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    if ($desc) echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canon ? $canon : home_url('/')) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:locale" content="ja_JP">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($ogimg) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action('wp_head', 'ynh_seo_head', 1);

/* =========================================================
   旧URL（静的サイトの *.html）→ 新URL 301リダイレクト
   .com は .jp へパスをそのまま転送するため、.jp 側で .html を新URLに対応付ける。
   ========================================================= */
function ynh_legacy_redirects() {
    $map = array(
        'index.html'            => '/',
        'oxygen.html'           => '/oxygen/',
        'es5000.html'           => '/es5000/',
        'accident.html'         => '/accident/',
        'symptoms.html'         => '/symptoms/',
        'menu.html'             => '/menu/',
        'blog.html'             => '/column/',
        'blog-jiko-taiou.html'  => '/column/jiko-taiou/',
        'blog-muchiuchi.html'   => '/column/muchiuchi/',
        'blog-jibaiseki.html'   => '/column/jibaiseki/',
    );
    $path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
    $path = ltrim((string) $path, '/');
    if (isset($map[$path])) {
        wp_redirect(home_url($map[$path]), 301);
        exit;
    }
}
add_action('template_redirect', 'ynh_legacy_redirects');

/* ---- アーカイブの表示件数 ---- */
function ynh_column_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('column')) {
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'ynh_column_per_page');
