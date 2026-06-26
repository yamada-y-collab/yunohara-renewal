<!-- ===== CTA帯 ===== -->
<section class="cta-band" id="contact">
  <div class="container">
    <span class="en">CONTACT</span>
    <h2>まずはお気軽にご相談ください</h2>
    <p>痛みのことも、酸素カプセルのことも、交通事故のことも。あなたの「回復」を全力でサポートします。</p>
    <div class="cta-band-btns">
      <a href="tel:<?php echo esc_attr(YNH_TEL_RAW); ?>" class="cta-tel"><small>お電話でのご予約・ご相談</small><strong><?php echo esc_html(YNH_TEL); ?></strong></a>
      <a href="<?php echo esc_url(YNH_LINE_URL); ?>" target="_blank" rel="noopener" class="btn btn-line btn-lg">LINEで予約・相談する</a>
    </div>
  </div>
</section>

<!-- ===== フッター ===== -->
<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <strong><?php bloginfo('name'); ?></strong>
      <small>〒808-0027 福岡県北九州市若松区北湊町5-62<br>愛暮利伊フォーチュン北湊Ⅱ 2号室<br>TEL <?php echo esc_html(YNH_TEL); ?></small>
    </div>
    <ul class="footer-nav">
      <li><a href="<?php echo esc_url(home_url('/#reason')); ?>">選ばれる理由</a></li>
      <li><a href="<?php echo esc_url(home_url('/menu/')); ?>">施術メニュー・料金</a></li>
      <li><a href="<?php echo esc_url(home_url('/oxygen/')); ?>">酸素カプセル</a></li>
      <li><a href="<?php echo esc_url(home_url('/es5000/')); ?>">特殊電気治療 ES-5000</a></li>
      <li><a href="<?php echo esc_url(home_url('/accident/')); ?>">交通事故・むち打ち</a></li>
      <li><a href="<?php echo esc_url(home_url('/symptoms/')); ?>">対応症状</a></li>
      <li><a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>">コラム</a></li>
      <li><a href="<?php echo esc_url(home_url('/#access')); ?>">アクセス</a></li>
      <li><a href="<?php echo esc_url(home_url('/#faq')); ?>">よくある質問</a></li>
      <li><a href="<?php echo esc_url(YNH_KARADA_URL); ?>" target="_blank" rel="noopener">姉妹院 カラダ研究所 ↗</a></li>
      <li><a href="<?php echo esc_url(home_url('/#contact')); ?>">お問い合わせ</a></li>
    </ul>
  </div>
  <p class="copyright">&copy; <?php bloginfo('name'); ?> All Rights Reserved.</p>
</footer>

<!-- 右側固定CTA(PC) -->
<div class="float-cta">
  <span class="badge">お気軽にご相談</span>
  <a href="<?php echo esc_url(YNH_LINE_URL); ?>" target="_blank" rel="noopener" class="fbtn fbtn-line">LINEで<br>予約・相談<small>💬</small></a>
  <a href="tel:<?php echo esc_attr(YNH_TEL_RAW); ?>" class="fbtn fbtn-tel">お電話<br>はこちら<small>📞</small></a>
</div>

<!-- スマホ固定CTA -->
<div class="mobile-cta">
  <a href="tel:<?php echo esc_attr(YNH_TEL_RAW); ?>" class="m-tel"><span>📞</span>電話</a>
  <a href="<?php echo esc_url(YNH_LINE_URL); ?>" target="_blank" rel="noopener" class="m-line"><span>💬</span>LINE予約</a>
  <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="m-form"><span>✉</span>相談</a>
</div>

<?php wp_footer(); ?>
</body>
</html>
