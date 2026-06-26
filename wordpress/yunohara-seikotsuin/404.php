<?php get_header(); ?>

<div class="breadcrumb"><div class="container"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a><span>›</span>404</div></div>

<section class="section">
  <div class="container rich" style="text-align:center">
    <div class="sec-head"><span class="en">404</span><span class="ja">ページが見つかりません</span></div>
    <p>お探しのページは移動または削除された可能性があります。</p>
    <p style="margin-top:26px"><a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-green">トップページへ戻る</a></p>
  </div>
</section>

<?php get_footer(); ?>
