<?php get_header(); ?>

<div class="breadcrumb"><div class="container"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a><span>›</span>コラム</div></div>

<section class="section">
  <div class="container">
    <div class="sec-head"><span class="sec-wm">COLUMN</span><span class="en">COLUMN</span><span class="ja">お役立ちコラム</span></div>
    <p style="text-align:center;max-width:720px;margin:0 auto 44px;color:var(--ink-soft)">交通事故・むち打ち、酸素カプセル、腰痛・肩こりなど、体のケアに役立つ情報を院長・柔道整復師が解説します。</p>
    <div class="blog-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post();
        $terms = get_the_terms(get_the_ID(), 'column_cat');
        $cat = ($terms && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'コラム';
        $thumb = esc_url(ynh_column_thumb_url(get_the_ID()));
      ?>
      <a class="blog-card" href="<?php the_permalink(); ?>">
        <div class="ph" style="background:center/cover no-repeat url('<?php echo $thumb; ?>')"><span class="tag"><?php echo $cat; ?></span></div>
        <div class="bd">
          <div class="date"><?php echo esc_html(get_the_date('Y.m.d')); ?></div>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html(wp_trim_words(get_the_excerpt() ? get_the_excerpt() : wp_strip_all_tags(get_the_content()), 50)); ?></p>
          <span class="more">続きを読む ›</span>
        </div>
      </a>
      <?php endwhile; else : ?>
      <p style="text-align:center">コラムは準備中です。</p>
      <?php endif; ?>
    </div>
    <div style="text-align:center;margin-top:30px"><?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '« 前へ', 'next_text' => '次へ »')); ?></div>
  </div>
</section>

<?php get_footer(); ?>
