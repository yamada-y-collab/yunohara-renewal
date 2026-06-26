<?php
/*
Template Name: 施術メニュー・料金
*/
get_header();
?>
<section class="page-hero has-bread" style="margin-top:0">
  <span class="en">MENU & PRICE</span>
  <h1>施術メニュー・料金</h1>
</section>
<div class="breadcrumb"><div class="container"><a href="<?php echo home_url('/'); ?>">ホーム</a><span>›</span>施術メニュー・料金</div></div>

<!-- 保険施術 -->
<section class="section">
  <div class="container">
    <div class="sec-head"><span class="sec-wm">INSURANCE</span><span class="en">INSURANCE</span><span class="ja">保険施術</span></div>
    <p style="text-align:center;max-width:760px;margin:0 auto 40px;color:var(--ink-soft)">捻挫・打撲・挫傷（肉離れ）など、原因がはっきりしたケガには各種健康保険が適用されます。国家資格を持つ柔道整復師が、症状に合わせて施術を組み立てます。</p>

    <div class="svc">
      <div class="svc-ico">🙌</div>
      <div class="svc-main">
        <h3>手技治療</h3>
        <p>柔道整復師が手で直接、筋肉や関節にアプローチする施術です。緊張した筋肉やこりをやさしくほぐして血流を改善し、痛みをやわらげます。機械では届きにくい部分も、お身体の状態を確かめながら一つひとつ丁寧に施術します。</p>
        <span class="price">健康保険適用（料金目安は下記）</span>
      </div>
    </div>
    <div class="svc">
      <div class="svc-ico">📡</div>
      <div class="svc-main">
        <h3>超音波治療</h3>
        <p>1秒間に数百万回の微細な振動を体の深部に届け、患部を内側からやさしくマッサージします。手では届きにくい深いところの炎症・腫れ・慢性的な痛みにアプローチし、温熱効果で血行も促進します。</p>
        <span class="price">健康保険適用（料金目安は下記）</span>
      </div>
    </div>
    <div class="svc">
      <div class="svc-ico">🦵</div>
      <div class="svc-main">
        <h3>Dr.メドマー（空気圧マッサージ）</h3>
        <p>脚などにエアブーツを装着し、空気圧で順番に圧迫・解放を繰り返す施術です。滞った血液やリンパの流れを促し、むくみ・だるさ・冷えの改善をサポート。立ち仕事やスポーツ後のケアにもおすすめです。</p>
        <span class="price">健康保険適用（料金目安は下記）</span>
      </div>
    </div>
    <div class="svc">
      <div class="svc-ico">🏃</div>
      <div class="svc-main">
        <h3>リハビリ・運動指導</h3>
        <p>痛みが改善したあとも再発しないよう、機能回復トレーニングや、姿勢・動作のクセを改善する指導を行います。ご自宅でできる簡単なストレッチもお伝えし、痛みの出にくい身体づくりまでサポートします。</p>
        <span class="price">健康保険適用（料金目安は下記）</span>
      </div>
    </div>
    <p class="svc-note">💴 <strong>保険料金の目安</strong>：初診 1,000〜2,000円程度／2回目以降 400〜600円程度（負担割合により変動します）。適用の可否は症状によって異なりますので、詳しくは受付でご案内します。</p>
  </div>
</section>

<!-- 自費施術 -->
<section class="section section-soft">
  <div class="container">
    <div class="sec-head"><span class="sec-wm">SELF-PAY</span><span class="en">SELF-PAY</span><span class="ja">自費施術</span></div>
    <p style="text-align:center;max-width:760px;margin:0 auto 40px;color:var(--ink-soft)">保険適用外の、より専門的・集中的なケアのメニューです。慢性的な不調や、根本からの改善・予防を目指す方におすすめです。</p>

    <div class="svc">
      <div class="svc-ico">⚡</div>
      <div class="svc-main">
        <h3>特殊電気治療 ES-5000<span class="min">1回 7分</span></h3>
        <p>立体動態波・微弱電流・神経筋刺激（EMS）を使い分けられる治療器です。手技では届きにくい体の深部の痛みや、神経性のしびれにまでアプローチ。プロの現場でも使われる機器で、急性のケガから慢性的な不調まで幅広く対応します。</p>
        <span class="price"><span class="yen">初回 1,000円</span>／1回 1,200円</span>
        <span class="svc-more">※回数券・フリーパスあり　<a href="<?php echo home_url('/es5000/'); ?>" style="color:var(--green)">▶ 詳しく見る</a></span>
      </div>
    </div>
    <div class="svc">
      <div class="svc-ico">🧍</div>
      <div class="svc-main">
        <h3>姿勢矯正</h3>
        <p>骨盤や背骨のゆがみを整え、痛みの出にくい正しい姿勢へ導く施術です。猫背・反り腰・肩や骨盤の左右差が気になる方、デスクワークで姿勢が崩れがちな方におすすめ。見た目の印象や肩こり・腰痛の予防にもつながります。</p>
        <span class="price"><span class="yen">初回 1,000円</span>／1回 2,000円</span>
        <span class="svc-more">※回数券・フリーパスあり</span>
      </div>
    </div>
  </div>
</section>

<!-- 酸素カプセル -->
<section class="section">
  <div class="container">
    <div class="sec-head"><span class="sec-wm">OXYGEN</span><span class="en">OXYGEN CAPSULE</span><span class="ja">酸素カプセル</span></div>
    <p style="text-align:center;max-width:760px;margin:0 auto 36px;color:var(--ink-soft)">酸素濃度30%・1.3気圧の環境で全身に酸素を届け、疲労回復・睡眠改善・美肌などをサポート。施術との併用がおすすめです。</p>
    <table class="price-table">
      <tr><th>30分コース</th><td><span class="yen">初回 1,000円</span>／1回 2,000円／4回回数券 7,000円</td></tr>
      <tr><th>60分コース</th><td>1回 4,000円／4回回数券 14,000円</td></tr>
    </table>
    <p style="text-align:center;margin-top:24px"><a href="<?php echo home_url('/oxygen/'); ?>" class="btn btn-ghost">酸素カプセルの詳細を見る</a></p>
  </div>
</section>

<!-- 注意書き -->
<section class="section section-soft">
  <div class="container rich">
    <div class="callout">
      <p class="ttl">料金について</p>
      <p>※料金はすべて税込です。回数券・フリーパスの内容は院内にてご案内します。<br>※交通事故（自賠責保険）・労災の場合は窓口負担がかからないケースがあります。詳しくは<a href="<?php echo home_url('/accident/'); ?>">交通事故・むち打ち治療のページ</a>をご覧ください。</p>
    </div>
  </div>
</section>
<?php get_footer(); ?>
