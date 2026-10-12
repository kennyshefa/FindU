
(function () {
    'use strict';

    const $  = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

    /*  Toast */
    const toast = $('#toast');
    let toastTimer;

    function showToast(message, type) {
        toast.textContent = message;
        toast.className = 'toast is-show' + (type ? ' toast--' + type : '');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.classList.remove('is-show'), 3200);
    }

    /* Navbar: menu mobile & dropdown user */
    const navToggle = $('#nav-toggle');
    const navLinks  = $('#nav-links');
    const userBtn   = $('#user-btn');
    const userList  = $('#user-list');

    navToggle.addEventListener('click', e => {
        e.stopPropagation();
        const open = navLinks.classList.toggle('is-open');
        navToggle.setAttribute('aria-expanded', open);
    });

    userBtn.addEventListener('click', e => {
        e.stopPropagation();
        const willOpen = userList.hidden;
        userList.hidden = !willOpen;
        userBtn.setAttribute('aria-expanded', willOpen);
    });

    function closeMenus() {
        userList.hidden = true;
        userBtn.setAttribute('aria-expanded', 'false');
        navLinks.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.user-menu') && !e.target.closest('.navbar__links')) closeMenus();
    });

    /* Tabs*/
    const tabs   = $$('.tab');
    const panels = $$('.panel');

    function activateTab(name, updateHash = true) {
        const target = $('#panel-' + name);
        if (!target) return;

        tabs.forEach(t => {
            const on = t.dataset.tab === name;
            t.classList.toggle('is-active', on);
            t.setAttribute('aria-selected', on);
        });
        panels.forEach(p => { p.hidden = p !== target; });

        if (updateHash) history.replaceState(null, '', '#' + name);
    }

    tabs.forEach(t => t.addEventListener('click', () => activateTab(t.dataset.tab)));

    // Buka tab sesuai hash URL, mis. profile.html#klaim
    const initialTab = location.hash.replace('#', '');
    if (initialTab) activateTab(initialTab, false);

    /* Aksi Cepat: data-action="modal:id" atau "tab:nama" */
    $$('[data-action]').forEach(btn => {
        btn.addEventListener('click', () => {
            const [type, value] = btn.dataset.action.split(':');
            if (type === 'modal') openModal(value);
            if (type === 'tab') {
                activateTab(value);
                $('.tabs').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /*  Modal */
    let lastFocus = null;

    function openModal(id) {
        const modal = document.getElementById(id);
        if (!modal) return;
        lastFocus = document.activeElement;
        modal.hidden = false;
        document.body.style.overflow = 'hidden';
        const first = $('input:not([disabled])', modal);
        if (first) setTimeout(() => first.focus(), 30);
    }

    function closeModal(modal) {
        modal.hidden = true;
        document.body.style.overflow = '';
        $$('.field', modal).forEach(f => f.classList.remove('is-invalid'));
        if (lastFocus) lastFocus.focus();
    }

    $$('[data-open]').forEach(b => b.addEventListener('click', () => openModal(b.dataset.open)));

    $$('.modal').forEach(modal => {
        $$('[data-close]', modal).forEach(b => b.addEventListener('click', () => closeModal(modal)));
        modal.addEventListener('mousedown', e => { if (e.target === modal) closeModal(modal); });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            $$('.modal').filter(m => !m.hidden).forEach(closeModal);
            closeMenus();
        }
    });

    /* Validasi form */
    function setError(input, message) {
        const field = input.closest('.field');
        field.classList.add('is-invalid');
        $('.field__err', field).textContent = message;
    }

    $$('.field input').forEach(inp =>
        inp.addEventListener('input', () => inp.closest('.field').classList.remove('is-invalid'))
    );

    const phonePattern = /^\+?[0-9\s\-]{8,18}$/;

    /*  Form Edit Profil  */
    const formEdit = $('#form-edit');

    formEdit.addEventListener('submit', e => {
        e.preventDefault();

        const nama    = formEdit.nama.value.trim();
        const telepon = formEdit.telepon.value.trim();
        let ok = true;

        if (!nama) { setError(formEdit.nama, 'Nama wajib diisi.'); ok = false; }
        if (!phonePattern.test(telepon)) {
            setError(formEdit.telepon, 'Masukkan nomor telepon yang valid, mis. +62 812 3456 7890.');
            ok = false;
        }
        if (!ok) return;

        // Perbarui tampilan (ganti dengan fetch() ke server bila sudah ada backend)
        $$('[data-bind="nama"]').forEach(el => (el.textContent = nama));
        $$('[data-bind="telepon"]').forEach(el => (el.textContent = telepon));

        const words = nama.split(/\s+/).slice(0, 2);
        $('#avatar').textContent = words.map(w => w[0].toUpperCase()).join('');

        closeModal($('#modal-edit'));
        showToast('Profil berhasil disimpan.', 'success');
    });

    /*  Form Ganti Password  */
    const formPass = $('#form-password');
    const pwNew    = $('#pw-new');
    const pwRepeat = $('#pw-repeat');
    const meter    = $('#pw-meter');
    const hint     = $('#pw-hint');

    const levels = [
        { w: '0%',   c: '#dc3545', t: 'Minimal 8 karakter, kombinasikan huruf dan angka.' },
        { w: '25%',  c: '#dc3545', t: 'Terlalu lemah.' },
        { w: '50%',  c: '#f59e0b', t: 'Cukup, tambahkan huruf besar atau simbol.' },
        { w: '75%',  c: '#84cc16', t: 'Bagus.' },
        { w: '100%', c: '#12a05f', t: 'Kuat.' }
    ];

    pwNew.addEventListener('input', () => {
        const v = pwNew.value;
        let score = 0;
        if (v.length >= 8) score++;
        if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
        if (/\d/.test(v)) score++;
        if (/[^A-Za-z0-9]/.test(v)) score++;
        if (!v) score = 0;
        else if (score === 0) score = 1;

        const lv = levels[score];
        meter.style.width = lv.w;
        meter.style.background = lv.c;
        hint.textContent = lv.t;
    });

    formPass.addEventListener('submit', e => {
        e.preventDefault();
        let ok = true;

        if (!formPass.lama.value) { setError(formPass.lama, 'Password lama wajib diisi.'); ok = false; }
        if (pwNew.value.length < 8) { setError(pwNew, 'Password baru minimal 8 karakter.'); ok = false; }
        if (pwRepeat.value !== pwNew.value) { setError(pwRepeat, 'Konfirmasi password tidak sama.'); ok = false; }
        if (!ok) return;

        // TODO: kirim ke server (fetch) untuk memverifikasi password lama & menyimpan yang baru
        formPass.reset();
        meter.style.width = '0%';
        hint.textContent = levels[0].t;
        closeModal($('#modal-password'));
        showToast('Password berhasil diganti.', 'success');
    });

    /*  Animasi hitung angka ringkasan (sekali saat dimuat) */
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!reduceMotion) {
        $$('[data-count]').forEach(el => {
            const end = parseInt(el.dataset.count, 10);
            if (!end) return;
            let cur = 0;
            el.textContent = '0';
            const timer = setInterval(() => {
                cur++;
                el.textContent = cur;
                if (cur >= end) clearInterval(timer);
            }, 140);
        });
    }
})();
