<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ===== ヘッダー ===== -->
<header class="site-header">
  <div class="header-inner">
    <div class="header-sns">
      <a href="<?php echo esc_url(YNH_IG_URL); ?>" target="_blank" rel="noopener" aria-label="Instagram公式"><svg viewBox="0 0 40 40" width="38" height="38" aria-hidden="true"><defs><linearGradient id="igg" x1="0" y1="40" x2="40" y2="0" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f9ce34"/><stop offset=".45" stop-color="#ee2a7b"/><stop offset="1" stop-color="#6228d7"/></linearGradient></defs><rect width="40" height="40" rx="11" fill="url(#igg)"/><rect x="11" y="11" width="18" height="18" rx="6" fill="none" stroke="#fff" stroke-width="2.4"/><circle cx="20" cy="20" r="4.8" fill="none" stroke="#fff" stroke-width="2.4"/><circle cx="26.6" cy="13.4" r="1.7" fill="#fff"/></svg></a>
      <a href="<?php echo esc_url(YNH_LINE_URL); ?>" target="_blank" rel="noopener" aria-label="LINE公式アカウント"><svg viewBox="0 0 40 40" width="38" height="38" aria-hidden="true"><rect width="40" height="40" rx="11" fill="#06c755"/><text x="20" y="21" text-anchor="middle" dominant-baseline="central" fill="#fff" font-family="Arial,Helvetica,sans-serif" font-weight="800" font-size="10.5" letter-spacing=".3">LINE</text></svg></a>
    </div>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
      <span class="logo-text"><strong><?php bloginfo('name'); ?></strong><small>北九州市若松区 ｜ 酸素カプセル・交通事故治療</small></span>
    </a>
    <nav class="header-nav">
      <a href="<?php echo esc_url(home_url('/')); ?>"<?php echo ynh_cur(is_front_page()); ?>>ホーム</a>
      <a href="<?php echo esc_url(home_url('/menu/')); ?>"<?php echo ynh_cur(is_page('menu')); ?>>施術メニュー</a>
      <a href="<?php echo esc_url(home_url('/oxygen/')); ?>"<?php echo ynh_cur(is_page('oxygen')); ?>>酸素カプセル</a>
      <a href="<?php echo esc_url(home_url('/es5000/')); ?>"<?php echo ynh_cur(is_page('es5000')); ?>>ES-5000</a>
      <a href="<?php echo esc_url(home_url('/accident/')); ?>"<?php echo ynh_cur(is_page('accident')); ?>>交通事故</a>
      <a href="<?php echo esc_url(home_url('/symptoms/')); ?>"<?php echo ynh_cur(is_page('symptoms')); ?>>対応症状</a>
      <a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>"<?php echo ynh_cur(is_post_type_archive('column') || is_singular('column')); ?>>コラム</a>
    </nav>
    <div class="header-info">
      <span class="recept">受付｜平日 9:00-13:00 / 15:00-20:00<br>土 9:00-14:00（日・祝休）</span>
      <a href="tel:<?php echo esc_attr(YNH_TEL_RAW); ?>" class="tel"><?php echo esc_html(YNH_TEL); ?></a>
    </div>
    <button class="hamburger" id="hamburger" aria-label="メニュー">
      <span class="bars"><span></span><span></span><span></span></span>
      <small>MENU</small>
    </button>
  </div>
</header>

<!-- ドロワー -->
<div class="drawer" id="drawer">
  <nav>
    <a href="<?php echo esc_url(home_url('/')); ?>">ホーム<span class="en">HOME</span></a>
    <a href="<?php echo esc_url(home_url('/#reason')); ?>">選ばれる理由<span class="en">REASON</span></a>
    <a href="<?php echo esc_url(home_url('/menu/')); ?>">施術メニュー・料金<span class="en">MENU</span></a>
    <a href="<?php echo esc_url(home_url('/oxygen/')); ?>">酸素カプセル<span class="en">OXYGEN CAPSULE</span></a>
    <a href="<?php echo esc_url(home_url('/es5000/')); ?>">特殊電気治療 ES-5000<span class="en">ES-5000</span></a>
    <a href="<?php echo esc_url(home_url('/accident/')); ?>">交通事故・むち打ち<span class="en">ACCIDENT</span></a>
    <a href="<?php echo esc_url(home_url('/symptoms/')); ?>">対応症状<span class="en">SYMPTOMS</span></a>
    <a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>">コラム<span class="en">COLUMN</span></a>
    <a href="<?php echo esc_url(home_url('/#access')); ?>">アクセス<span class="en">ACCESS</span></a>
    <a href="<?php echo esc_url(YNH_KARADA_URL); ?>" target="_blank" rel="noopener">姉妹院 カラダ研究所<span class="en">GROUP ↗</span></a>
    <a href="<?php echo esc_url(home_url('/#contact')); ?>">予約・お問い合わせ<span class="en">CONTACT</span></a>
  </nav>
</div>
