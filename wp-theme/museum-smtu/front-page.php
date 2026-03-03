<?php
/**
 * Шаблон главной страницы (Front Page)
 * Назначается через Настройки → Чтение → Главная страница
 */
get_header();
?>

<!-- ═══════════════════════════════════════════
     HERO
═══════════════════════════════════════════ -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-7 hero-content">
        <div class="hero-badge">Основан в 1941 году</div>
        <h1>Музей истории<br><span>кораблестроения</span><br>и мореплавания</h1>
        <p>Уникальная коллекция, раскрывающая историю Санкт-Петербургского морского технического университета — одного из старейших технических вузов России.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="<?php echo esc_url(home_url('/exposition/')); ?>" class="btn-museum">
            <i class="bi bi-grid-3x3-gap"></i> Экспозиция
          </a>
          <a href="<?php echo esc_url(home_url('/visitors/')); ?>#tour" class="btn-outline-museum">
            <i class="bi bi-camera-video"></i> Виртуальный тур
          </a>
        </div>

        <div class="hero-info">
          <div class="hero-info-item">
            <i class="bi bi-door-open"></i>
            <div>
              <strong>Вход свободный</strong>
              <div style="font-size:12px;opacity:.7">для всех желающих</div>
            </div>
          </div>
          <div class="hero-info-item">
            <i class="bi bi-clock"></i>
            <div>
              <strong>Пн–Пт <?php echo museum_opt('hours_weekday', '10:00–17:00'); ?></strong>
              <div style="font-size:12px;opacity:.7">Сб <?php echo museum_opt('hours_saturday', '11:00–15:00'); ?></div>
            </div>
          </div>
          <div class="hero-info-item">
            <i class="bi bi-geo-alt"></i>
            <div>
              <strong>ул. Лоцманская, 3</strong>
              <div style="font-size:12px;opacity:.7">м. Нарвская</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     СТАТИСТИКА
═══════════════════════════════════════════ -->
<section class="stats-section">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-number" data-count="1899" data-suffix="г."><span>1899</span></div>
          <div class="stat-label">Год основания вуза</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-number" data-count="3000" data-suffix="+">3000+</div>
          <div class="stat-label">Экспонатов</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-number" data-count="7">7</div>
          <div class="stat-label">Залов экспозиции</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <div class="stat-number" data-count="80000" data-suffix="+">80 000+</div>
          <div class="stat-label">Посетителей в год</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     О МУЗЕЕ
═══════════════════════════════════════════ -->
<section class="section-py">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 fade-in">
        <div class="section-header">
          <span class="section-label">О нас</span>
          <h2 class="section-title">Хранители морской истории России</h2>
          <div class="section-divider"></div>
        </div>
        <p>Музей СПбГМТУ — один из крупнейших технических музеев Санкт-Петербурга. Основанный более 80 лет назад, он бережно хранит историю отечественного кораблестроения, судьбы выпускников и традиции главного морского вуза страны.</p>
        <p>В фондах музея — модели кораблей, навигационные приборы, архивные документы, личные вещи выдающихся учёных и конструкторов, уникальные фотографии и артефакты, связанные с историей российского флота.</p>
        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn-navy mt-2">
          <i class="bi bi-arrow-right-circle"></i> Подробнее о музее
        </a>
      </div>
      <div class="col-lg-6 fade-in">
        <?php
        // Если задана миниатюра поста главной страницы — показываем её
        if (has_post_thumbnail()) :
            the_post_thumbnail('large', ['class' => 'img-fluid rounded', 'style' => 'border-radius:12px']);
        else : ?>
          <div style="background:linear-gradient(135deg,var(--navy) 0%,var(--navy-mid) 100%);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;opacity:0.4;color:white;">
            ⚓
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     ЗАЛЫ ЭКСПОЗИЦИИ
═══════════════════════════════════════════ -->
<section class="section-py bg-light-museum">
  <div class="container">
    <div class="section-header text-center fade-in">
      <span class="section-label">Коллекция</span>
      <h2 class="section-title">Залы экспозиции</h2>
      <div class="section-divider mx-auto"></div>
      <p class="section-desc mx-auto">Семь тематических залов, охватывающих всю историю отечественного кораблестроения</p>
    </div>

    <div class="row g-4">
      <?php
      $halls = [
          ['icon' => 'bi-water',        'bg' => 'linear-gradient(135deg,#0D1B33,#243558)', 'title' => 'История кораблестроения',   'desc' => 'От петровских верфей до современных судов',             'anchor' => 'shipbuilding'],
          ['icon' => 'bi-compass',      'bg' => 'linear-gradient(135deg,#1a2f52,#0f2240)', 'title' => 'История создания ЛКИ',      'desc' => 'Основание и становление университета',                 'anchor' => ''],
          ['icon' => 'bi-tsunami',      'bg' => 'linear-gradient(135deg,#122040,#1B2A4A)', 'title' => 'Подводное оборудование',    'desc' => 'Техника и технологии подводного флота',                'anchor' => 'underwater'],
          ['icon' => 'bi-shield-shaded','bg' => 'linear-gradient(135deg,#1c1a2e,#2d2558)', 'title' => 'Годы войны',               'desc' => 'Вклад университета в Победу 1945 года',               'anchor' => 'war'],
          ['icon' => 'bi-lightbulb',    'bg' => 'linear-gradient(135deg,#1a2e1a,#1B2A4A)', 'title' => 'Кабинет профессора',       'desc' => 'Рабочая обстановка учёных-кораблестроителей',          'anchor' => 'office'],
          ['icon' => 'bi-award',        'bg' => 'linear-gradient(135deg,#2a1a0d,#1B2A4A)', 'title' => 'Дипломный зал',            'desc' => 'Лучшие дипломные работы выпускников',                 'anchor' => 'diploma'],
      ];
      foreach ($halls as $hall) :
          $url = $hall['anchor']
              ? esc_url(home_url('/exposition/')) . '#' . $hall['anchor']
              : esc_url(home_url('/lki-history/'));
      ?>
        <div class="col-md-6 col-lg-4 fade-in">
          <a href="<?php echo $url; ?>" class="text-decoration-none d-block">
            <div class="expo-card">
              <div class="expo-card-bg" style="background:<?php echo esc_attr($hall['bg']); ?>;"></div>
              <div class="expo-card-content">
                <i class="bi <?php echo esc_attr($hall['icon']); ?> expo-card-icon"></i>
                <h5><?php echo esc_html($hall['title']); ?></h5>
                <p><?php echo esc_html($hall['desc']); ?></p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-5 fade-in">
      <a href="<?php echo esc_url(home_url('/exposition/')); ?>" class="btn-navy">
        <i class="bi bi-grid-3x3-gap"></i> Все залы экспозиции
      </a>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     ВИРТУАЛЬНЫЙ ТУР
═══════════════════════════════════════════ -->
<section class="section-py bg-navy">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5 fade-in">
        <span class="section-label">Онлайн</span>
        <h2 class="section-title section-title-white">Виртуальный тур по музею</h2>
        <div class="section-divider"></div>
        <p style="color:rgba(255,255,255,0.7);">Не можете посетить нас лично? Исследуйте залы музея онлайн — в любое время, из любого места. Интерактивный тур позволяет детально рассмотреть экспонаты и узнать историю каждого зала.</p>
        <a href="<?php echo esc_url(home_url('/visitors/')); ?>#tour" class="btn-museum mt-2">
          <i class="bi bi-play-circle"></i> Начать тур
        </a>
      </div>
      <div class="col-lg-7 fade-in">
        <div class="tour-placeholder">
          <i class="bi bi-camera-video-fill"></i>
          <h4>Виртуальный тур</h4>
          <p>Интерактивный 360° обход музея<br>будет доступен после интеграции</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     ПЛАН ВИЗИТА
═══════════════════════════════════════════ -->
<section class="section-py">
  <div class="container">
    <div class="section-header text-center fade-in">
      <span class="section-label">Информация</span>
      <h2 class="section-title">Планируйте визит</h2>
      <div class="section-divider mx-auto"></div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-clock"></i></div>
          <h5>Часы работы</h5>
          <p>Пн–Пт: <?php echo museum_opt('hours_weekday', '10:00 – 17:00'); ?><br>
             Суббота: <?php echo museum_opt('hours_saturday', '11:00 – 15:00'); ?><br>
             Воскресенье: выходной</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-ticket-perforated"></i></div>
          <h5>Вход</h5>
          <p>Вход свободный<br>для всех категорий<br>посетителей</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-geo-alt"></i></div>
          <h5>Адрес</h5>
          <p>ул. Лоцманская, 3<br>м. Нарвская<br>Санкт-Петербург</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-people"></i></div>
          <h5>Группам</h5>
          <p>Экскурсии для групп<br>по предварительной<br>записи</p>
        </div>
      </div>
    </div>

    <div class="text-center mt-4 fade-in">
      <a href="<?php echo esc_url(home_url('/visit-rules/')); ?>" class="btn-navy me-3">
        <i class="bi bi-list-check"></i> Правила посещения
      </a>
      <a href="<?php echo esc_url(home_url('/contacts/')); ?>" class="btn-navy">
        <i class="bi bi-telephone"></i> Записаться на экскурсию
      </a>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     CTA — ВЫПУСКНИКИ
═══════════════════════════════════════════ -->
<section class="cta-section section-py">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-7 fade-in">
        <span class="section-label">База данных</span>
        <h2 class="section-title section-title-white mb-3">Найдите своего выпускника</h2>
        <p style="color:rgba(255,255,255,0.7);margin-bottom:32px;">
          В нашей базе хранятся сведения о тысячах выпускников СПбГМТУ — выдающихся инженерах, конструкторах и адмиралах российского флота.
        </p>
        <a href="<?php echo esc_url(home_url('/graduates/')); ?>" class="btn-museum">
          <i class="bi bi-search"></i> Поиск выпускников
        </a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
