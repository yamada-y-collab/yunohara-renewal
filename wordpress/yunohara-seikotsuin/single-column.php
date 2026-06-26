<?php get_header(); ?>

<?php while (have_posts()) : the_post();
  $terms = get_the_terms(get_the_ID(), 'column_cat');
  $cat = ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'コラム';
?>

<div class="breadcrumb" style="margin-top:var(--header-h)"><div class="container"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a><span>›</span><a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>">コラム</a><span>›</span><?php the_title(); ?></div></div>

<article class="section">
  <div class="container rich">
    <?php the_content(); ?>
  </div>
</article>

<?php
$rel = new WP_Query(array(
  'post_type'      => 'column',
  'posts_per_page' => 3,
  'post__not_in'   => array(get_the_ID()),
  'orderby'        => 'date',
  'order'          => 'DESC',
));
if ($rel->have_posts()) : ?>
<section class="section section-soft">
  <div class="container">
    <div class="sec-head"><span class="en">RELATED</span><span class="ja">関連コラム</span></div>
    <div class="related-grid">
      <?php while ($rel->have_posts()) : $rel->the_post();
        $rterms = get_the_terms(get_the_ID(), 'column_cat');
        $rcat = ($rterms && !is_wp_error($rterms)) ? esc_html($rterms[0]->name) : 'コラム';
        $rthumb = esc_url(ynh_column_thumb_url(get_the_ID()));
      ?>
      <a class="blog-card" href="<?php the_permalink(); ?>">
        <div class="ph" style="background:center/cover no-repeat url('<?php echo $rthumb; ?>')"><span class="tag"><?php echo $rcat; ?></span></div>
        <div class="bd"><h3><?php the_title(); ?></h3><span class="more">続きを読む ›</span></div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
