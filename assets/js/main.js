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
