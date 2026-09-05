<?php
/*
 * 固定ページの既定テンプレート
 * （専用テンプレート未指定のページ：プライバシーポリシー等）
 */
get_header();
while (have_posts()) : the_post(); ?>

<section class="page-hero has-bread" style="margin-top:0">
  <span class="en">PAGE</span>
  <h1><?php the_title(); ?></h1>
</section>
<div class="breadcrumb"><div class="container"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a><span>›</span><?php the_title(); ?></div></div>

<section class="section">
  <div class="container rich">
    <?php the_content(); ?>
  </div>
</section>

<?php endwhile; ?>
<?php get_footer(); ?>
