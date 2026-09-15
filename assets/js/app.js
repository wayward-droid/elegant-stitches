document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle'), nav = document.querySelector('.nav-links');
    toggle?.addEventListener('click', () => { const open = nav.classList.toggle('open'); toggle.setAttribute('aria-expanded', String(open)); toggle.textContent = open ? '×' : '☰' });
    document.querySelectorAll('[data-filter]').forEach(b => b.addEventListener('click', () => { document.querySelectorAll('[data-filter]').forEach(x => x.classList.remove('active')); b.classList.add('active'); const f = b.dataset.filter; document.querySelectorAll('.product-card').forEach(c => c.hidden = f !== 'All' && c.dataset.category !== f) }));
    const search = document.querySelector('#product-search'); search?.addEventListener('input', () => { const q = search.value.toLowerCase(); document.querySelectorAll('.product-card').forEach(c => c.hidden = !c.textContent.toLowerCase().includes(q)) });
    document.querySelectorAll('[data-qty]').forEach(b => b.addEventListener('click', () => { const input = b.parentElement.querySelector('input'); input.value = Math.max(0, +input.value + (b.dataset.qty === 'plus' ? 1 : -1)); input.form?.requestSubmit() }));
    const preview = document.querySelector('#image-preview-input'); preview?.addEventListener('change', () => { const img = document.querySelector('#image-preview'); if (preview.files[0]) { img.src = URL.createObjectURL(preview.files[0]); img.hidden = false } });
    document.querySelectorAll('.reveal').forEach(el => new IntersectionObserver(([x], o) => { if (x.isIntersecting) { el.classList.add('visible'); o.disconnect() } }, { threshold: .12 }).observe(el));
});
