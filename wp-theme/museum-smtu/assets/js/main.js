/* =============================================
   Музей СПбГМТУ — Main JS (WordPress)
   Bootstrap 5
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

  // ─── Sticky header тень ───────────────────────
  window.addEventListener('scroll', () => {
    const header = document.querySelector('.site-header');
    if (header) {
      header.style.boxShadow = window.scrollY > 10
        ? '0 4px 24px rgba(0,0,0,0.35)'
        : '0 2px 16px rgba(0,0,0,0.25)';
    }
  });

  // ─── Поиск выпускников ───────────────────────
  const searchInput = document.getElementById('graduateSearch');
  const yearTabs    = document.querySelectorAll('.year-tab');
  const gradCards   = document.querySelectorAll('.graduate-card');

  if (searchInput) {
    searchInput.addEventListener('input', filterGraduates);
  }

  yearTabs.forEach(tab => {
    tab.addEventListener('click', function () {
      yearTabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');
      filterGraduates();
    });
  });

  function filterGraduates() {
    const query     = searchInput ? searchInput.value.toLowerCase().trim() : '';
    const activeTab = document.querySelector('.year-tab.active');
    const year      = activeTab ? activeTab.dataset.year : 'all';

    let visibleCount = 0;

    gradCards.forEach(card => {
      const name     = (card.dataset.name || '').toLowerCase();
      const cardYear = card.dataset.year || '';

      const matchName = !query || name.includes(query);
      const matchYear = year === 'all' || cardYear === year;
      const visible   = matchName && matchYear;

      card.style.display = visible ? '' : 'none';
      if (visible) visibleCount++;
    });

    // Счётчик
    const counter = document.getElementById('graduatesCount');
    if (counter) counter.textContent = visibleCount;

    // Сообщение "не найдено"
    const noResults = document.getElementById('noResults');
    if (noResults) noResults.style.display = visibleCount === 0 ? '' : 'none';
  }

  // ─── Форма обратной связи ─────────────────────
  ['contactForm', 'visitForm'].forEach(formId => {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const btn = form.querySelector('[type="submit"]');
      const originalHTML = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Отправляем...';

      // TODO: Замените setTimeout на реальный AJAX/fetch запрос к WordPress
      // (wp_ajax_museum_contact или плагин Contact Form 7)
      setTimeout(() => {
        form.innerHTML = `
          <div class="text-center py-5">
            <div style="font-size:56px;color:var(--gold)">✓</div>
            <h4 class="mt-3 mb-2">Сообщение отправлено!</h4>
            <p class="text-muted">Мы свяжемся с вами в ближайшее время.</p>
          </div>`;
      }, 1200);
    });
  });

  // ─── Анимация появления элементов ───────────────
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
  } else {
    document.querySelectorAll('.fade-in').forEach(el => el.classList.add('visible'));
  }

  // ─── Lightbox для галереи ────────────────────
  const galleryItems = document.querySelectorAll('.gallery-item');
  if (galleryItems.length > 0 && typeof bootstrap !== 'undefined') {
    const modalHtml = `
      <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 pb-0">
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-2">
              <img id="galleryModalImg" src="" alt="" class="img-fluid rounded" style="max-height:80vh">
              <p id="galleryModalCaption" class="text-muted mt-2 mb-0 small"></p>
            </div>
          </div>
        </div>
      </div>`;
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));

    galleryItems.forEach(item => {
      item.addEventListener('click', function () {
        const img = this.querySelector('img');
        const caption = this.dataset.caption || '';
        document.getElementById('galleryModalImg').src = img ? img.src : '';
        document.getElementById('galleryModalCaption').textContent = caption;
        modal.show();
      });
    });
  }

  // ─── Плавный скролл к якорям ─────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const hash = this.getAttribute('href');
      if (hash === '#') return;
      const target = document.querySelector(hash);
      if (target) {
        e.preventDefault();
        const offset = 80; // высота sticky header
        const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // ─── Счётчик статистики ───────────────────────
  function animateCounter(el) {
    const target   = parseInt(el.dataset.count, 10);
    const duration = 1800;
    const step     = target / (duration / 16);
    let current    = 0;

    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      el.textContent = Math.floor(current).toLocaleString('ru-RU') + (el.dataset.suffix || '');
    }, 16);
  }

  if ('IntersectionObserver' in window) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));
  } else {
    document.querySelectorAll('[data-count]').forEach(el => animateCounter(el));
  }

});

/* ─── CSS fade-in (инжектируется один раз) ─── */
if (!document.getElementById('museum-fade-style')) {
  const style = document.createElement('style');
  style.id = 'museum-fade-style';
  style.textContent = `
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.55s ease, transform 0.55s ease;
    }
    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }
  `;
  document.head.appendChild(style);
}
