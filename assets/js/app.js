document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle'), nav = document.querySelector('.nav-links');
    toggle?.addEventListener('click', () => { const open = nav.classList.toggle('open'); toggle.setAttribute('aria-expanded', String(open)); toggle.textContent = open ? '×' : '☰' });
    document.querySelectorAll('[data-filter]').forEach(b => b.addEventListener('click', () => { document.querySelectorAll('[data-filter]').forEach(x => x.classList.remove('active')); b.classList.add('active'); const f = b.dataset.filter; document.querySelectorAll('.product-card').forEach(c => c.hidden = f !== 'All' && c.dataset.category !== f) }));
    const search = document.querySelector('#product-search'); search?.addEventListener('input', () => { const q = search.value.toLowerCase(); document.querySelectorAll('.product-card').forEach(c => c.hidden = !c.textContent.toLowerCase().includes(q)) });
    document.querySelectorAll('[data-qty]').forEach(b => b.addEventListener('click', () => { const input = b.parentElement.querySelector('input'); input.value = Math.max(0, +input.value + (b.dataset.qty === 'plus' ? 1 : -1)); input.form?.requestSubmit() }));
    const preview = document.querySelector('#image-preview-input'); preview?.addEventListener('change', () => { const img = document.querySelector('#image-preview'); if (preview.files[0]) { img.src = URL.createObjectURL(preview.files[0]); img.hidden = false } });
    document.querySelectorAll('.reveal').forEach(el => new IntersectionObserver(([x], o) => { if (x.isIntersecting) { el.classList.add('visible'); o.disconnect() } }, { threshold: .12 }).observe(el));
});
    const floatCart = document.querySelector('#floating-cart');
    if (floatCart) {
        const saved = JSON.parse(localStorage.getItem('floatingCartPos') || 'null');
        if (saved) {
            floatCart.style.left = saved.left + 'px';
            floatCart.style.top = saved.top + 'px';
            floatCart.style.right = 'auto';
            floatCart.style.bottom = 'auto';
        }
        let dragging = false, moved = false, offsetX = 0, offsetY = 0;
        const start = (x, y) => {
            dragging = true; moved = false;
            const r = floatCart.getBoundingClientRect();
            offsetX = x - r.left; offsetY = y - r.top;
            floatCart.style.right = 'auto'; floatCart.style.bottom = 'auto';
        };
        const move = (x, y) => {
            if (!dragging) return;
            moved = true;
            let left = Math.max(0, Math.min(window.innerWidth - floatCart.offsetWidth, x - offsetX));
            let top = Math.max(0, Math.min(window.innerHeight - floatCart.offsetHeight, y - offsetY));
            floatCart.style.left = left + 'px';
            floatCart.style.top = top + 'px';
        };
        const end = () => {
            if (!dragging) return;
            dragging = false;
            if (moved) localStorage.setItem('floatingCartPos', JSON.stringify({ left: parseFloat(floatCart.style.left), top: parseFloat(floatCart.style.top) }));
        };
        floatCart.addEventListener('mousedown', e => start(e.clientX, e.clientY));
        document.addEventListener('mousemove', e => move(e.clientX, e.clientY));
        document.addEventListener('mouseup', end);
        floatCart.addEventListener('touchstart', e => start(e.touches[0].clientX, e.touches[0].clientY), { passive: true });
        document.addEventListener('touchmove', e => move(e.touches[0].clientX, e.touches[0].clientY), { passive: true });
        document.addEventListener('touchend', end);
        floatCart.addEventListener('click', e => { if (moved) e.preventDefault(); });
    }