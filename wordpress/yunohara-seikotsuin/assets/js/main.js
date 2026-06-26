// ===== ドロワーメニュー開閉 =====
const hamburger = document.getElementById('hamburger');
const drawer = document.getElementById('drawer');
if (hamburger && drawer) {
  const toggle = (force) => {
    const open = drawer.classList.toggle('open', force);
    hamburger.classList.toggle('open', open);
    document.body.style.overflow = open ? 'hidden' : '';
  };
  hamburger.addEventListener('click', () => toggle());
  drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', () => toggle(false)));
  document.addEventListener('keydown', e => { if (e.key === 'Escape') toggle(false); });
}

// ===== スクロールでふわっと表示 =====
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.style.opacity = 1;
      e.target.style.transform = 'none';
      io.unobserve(e.target);
    }
  });
}, { threshold: 0.12 });

document.querySelectorAll('.feature, .menu-card, .flow-step, .worry-list li, .reco-list li, .symptom-card, .split > div')
  .forEach((el, i) => {
    el.style.opacity = 0;
    el.style.transform = 'translateY(26px)';
    el.style.transition = `opacity .6s ${(i % 4) * 0.08}s, transform .6s ${(i % 4) * 0.08}s`;
    io.observe(el);
  });

// ===== コラムのサムネイル：背景未設定のカードに関連イラストを自動はめ込み =====
// アーカイブ/関連カードは PHP 側で背景設定済み。ここでは静的カード（トップのコラム枠・本文内の関連カード）を補完する。
(function () {
  const themeUri = (window.YNH && YNH.themeUri) ? YNH.themeUri : '';
  const base = themeUri + '/assets/img/blog-';
  const byHref = [
    ['/column/jiko-taiou', 'taiou'],
    ['/column/muchiuchi', 'muchiuchi'],
    ['/column/jibaiseki', 'jibaiseki'],
    ['/accident', 'service'],
  ];
  const byTag = [[/酸素/, 'oxygen'], [/腰痛|肩こり/, 'koshi'], [/スポーツ/, 'sports']];
  document.querySelectorAll('.blog-card').forEach(card => {
    const ph = card.querySelector('.ph');
    if (!ph || ph.style.background) return; // PHPで背景設定済みはスキップ
    const href = card.getAttribute('href') || '';
    let key = null;
    for (const [k, v] of byHref) { if (href.indexOf(k) !== -1) { key = v; break; } }
    if (!key) {
      const tag = ph.querySelector('.tag');
      const tx = tag ? tag.textContent : '';
      for (const [re, k] of byTag) { if (re.test(tx)) { key = k; break; } }
    }
    if (!key) return;
    ph.childNodes.forEach(n => { if (n.nodeType === 3) n.textContent = ''; });
    ph.style.background = `center/cover no-repeat url('${base}${key}.svg')`;
  });
})();
