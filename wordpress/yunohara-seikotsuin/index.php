<?php get_header(); ?>

<div class="breadcrumb"><div class="container"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a><span>›</span><?php echo esc_html(wp_get_document_title()); ?></div></div>

<section class="section">
  <div class="container rich">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
          <h2 style="margin-bottom:14px"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php the_excerpt(); ?>
        </article>
        <hr style="margin:24px 0;border:0;border-top:1px solid #e2eae6">
      <?php endwhile; ?>
      <div style="text-align:center"><?php the_posts_pagination(); ?></div>
    <?php else : ?>
      <p>記事がありません。</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
