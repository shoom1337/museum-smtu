/* =============================================
   Музей СПбГМТУ — Main JS
   Bootstrap 5
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

  // ─── Активный пункт меню ───────────────────────
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPath) {
      link.classList.add('active');
    }
  });

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

    gradCards.forEach(card => {
      const name     = (card.dataset.name || '').toLowerCase();
      const cardYear = card.dataset.year || '';

      const matchName = !query || name.includes(query);
      const matchYear = year === 'all' || cardYear === year;

      card.style.display = (matchName && matchYear) ? '' : 'none';
    });

    // Счётчик результатов
    const counter = document.getElementById('graduatesCount');
    if (counter) {
      const visible = [...gradCards].filter(c => c.style.display !== 'none').length;
      counter.textContent = visible;
    }
  }

  // ─── Форма обратной связи ─────────────────────
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const btn = contactForm.querySelector('[type="submit"]');
      const originalText = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Отправляем...';

      setTimeout(() => {
        contactForm.innerHTML = `
          <div class="text-center py-4">
            <div class="mb-3" style="font-size:48px; color: var(--gold)">✓</div>
            <h4 class="mb-2">Сообщение отправлено!</h4>
            <p class="text-muted">Мы свяжемся с вами в ближайшее время.</p>
          </div>`;
      }, 1200);
    });
  }

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
    // Создаём модальное окно
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
        const img     = this.querySelector('img');
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
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
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

/* ─── CSS fade-in ────────────────────────────── */
const style = document.createElement('style');
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
