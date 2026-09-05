<?php
/* コラムカテゴリのアーカイブ */
get_header();
$term = get_queried_object();
?>
<section class="page-hero has-bread" style="margin-top:0">
  <span class="en">COLUMN</span>
  <h1><?php echo esc_html($term->name); ?>のコラム</h1>
</section>
<div class="breadcrumb"><div class="container"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a><span>›</span><a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>">コラム</a><span>›</span><?php echo esc_html($term->name); ?></div></div>

<section class="section">
  <div class="container">
    <?php if ($term->description) : ?>
      <p style="text-align:center;max-width:720px;margin:0 auto 44px;color:var(--ink-soft)"><?php echo esc_html($term->description); ?></p>
    <?php endif; ?>
    <div class="blog-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post();
        $thumb = esc_url(ynh_column_thumb_url(get_the_ID()));
      ?>
      <a class="blog-card" href="<?php the_permalink(); ?>">
        <div class="ph" style="background:center/cover no-repeat url('<?php echo $thumb; ?>')"><span class="tag"><?php echo esc_html($term->name); ?></span></div>
        <div class="bd">
          <div class="date"><?php echo esc_html(get_the_date('Y.m.d')); ?></div>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html(wp_trim_words(get_the_excerpt() ? get_the_excerpt() : wp_strip_all_tags(get_the_content()), 50)); ?></p>
          <span class="more">続きを読む ›</span>
        </div>
      </a>
      <?php endwhile; else : ?>
      <p style="text-align:center">記事は準備中です。</p>
      <?php endif; ?>
    </div>
    <p style="text-align:center;margin-top:30px"><a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>" class="btn btn-ghost">コラム一覧を見る</a></p>
  </div>
</section>

<?php get_footer(); ?>
