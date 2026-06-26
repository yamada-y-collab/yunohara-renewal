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

// ===== ブログサムネイル（関連イラストを自動はめ込み） =====
(function () {
  const byHref = {
    'blog-jiko-taiou.html': 'taiou',
    'blog-muchiuchi.html': 'muchiuchi',
    'blog-jibaiseki.html': 'jibaiseki',
    'accident.html': 'service'
  };
  const byTag = [[/酸素/, 'oxygen'], [/腰痛|肩こり/, 'koshi'], [/スポーツ/, 'sports']];
  document.querySelectorAll('.blog-card').forEach(card => {
    const ph = card.querySelector('.ph');
    if (!ph) return;
    const href = card.getAttribute('href') || '';
    let key = null;
    for (const k in byHref) { if (href.endsWith(k)) { key = byHref[k]; break; } }
    if (!key) {
      const tag = ph.querySelector('.tag');
      const tx = tag ? tag.textContent : '';
      for (const [re, k] of byTag) { if (re.test(tx)) { key = k; break; } }
    }
    if (!key) return;
    // ダミーのテキスト（「記事」等）を消し、関連イラストを背景に
    ph.childNodes.forEach(n => { if (n.nodeType === 3) n.textContent = ''; });
    ph.style.background = `center/cover no-repeat url('assets/img/blog-${key}.svg')`;
  });
})();
