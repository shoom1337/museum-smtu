<?php
/**
 * Template Name: Посетителям
 * Slug страницы: visitors
 */
get_header();
museum_breadcrumbs(['Посетителям' => null]);
?>

<div class="page-hero">
  <div class="container">
    <h1><?php echo museum_opt('page_visitors_h1', 'Посетителям'); ?></h1>
    <p><?php echo museum_opt('page_visitors_sub', 'Правила, часы работы, виртуальный тур, лекторий и дополнительные услуги'); ?></p>
  </div>
</div>

<!-- Быстрая навигация -->
<div class="bg-light-museum border-bottom py-2 sticky-top" style="top:64px;z-index:100;">
  <div class="container">
    <div class="d-flex gap-4 flex-wrap">
      <a href="#info"     style="font-size:14px;font-weight:600;" class="text-navy">Информация</a>
      <a href="#tour"     style="font-size:14px;font-weight:600;" class="text-navy">Виртуальный тур</a>
      <a href="#lectures" style="font-size:14px;font-weight:600;" class="text-navy">Лекторий</a>
      <a href="#services" style="font-size:14px;font-weight:600;" class="text-navy">Дополнительные услуги</a>
    </div>
  </div>
</div>


<!-- ═══════════════════════════════════════════
     БЫСТРАЯ ИНФОРМАЦИЯ
═══════════════════════════════════════════ -->
<section id="info" class="section-py anchor-offset">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Перед визитом</span>
      <h2 class="section-title">Всё, что нужно знать</h2>
      <div class="section-divider"></div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-clock"></i></div>
          <h5>Часы работы</h5>
          <p>
            Пн–Пт: <?php echo museum_opt('hours_weekday', '10:00–17:00'); ?><br>
            Сб: <?php echo museum_opt('hours_saturday', '11:00–15:00'); ?><br>
            Вс: выходной
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-ticket-perforated"></i></div>
          <h5>Входной билет</h5>
          <p>Вход бесплатный<br>для всех категорий<br>посетителей</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-people"></i></div>
          <h5>Группы</h5>
          <p>Экскурсии для групп<br>по предварительной<br>записи</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center">
          <div class="contact-icon mx-auto"><i class="bi bi-camera"></i></div>
          <h5>Фотосъёмка</h5>
          <p>Разрешена для<br>личных нужд<br>без вспышки</p>
        </div>
      </div>
    </div>

    <div class="text-center mt-4 fade-in">
      <a href="<?php echo esc_url(home_url('/visit-rules/')); ?>" class="btn-navy">
        <i class="bi bi-list-check"></i> Подробные правила посещения
      </a>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     ВИРТУАЛЬНЫЙ ТУР
═══════════════════════════════════════════ -->
<section id="tour" class="section-py bg-navy anchor-offset">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5 fade-in">
        <span class="section-label">Онлайн</span>
        <h2 class="section-title section-title-white">Виртуальный тур</h2>
        <div class="section-divider"></div>
        <p style="color:rgba(255,255,255,0.75);">Исследуйте залы музея онлайн — детально рассматривайте экспонаты, узнавайте историю каждого зала. Доступен круглосуточно.</p>
        <div class="d-flex flex-wrap gap-3 mt-3">
          <div class="hero-info-item"><i class="bi bi-check-circle"></i><span>Бесплатно</span></div>
          <div class="hero-info-item"><i class="bi bi-check-circle"></i><span>24/7</span></div>
          <div class="hero-info-item"><i class="bi bi-check-circle"></i><span>С любого устройства</span></div>
        </div>
      </div>
      <div class="col-lg-7 fade-in">
        <!-- TODO: Замените на реальный iframe виртуального тура после интеграции -->
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
     ЛЕКТОРИЙ
═══════════════════════════════════════════ -->
<section id="lectures" class="section-py anchor-offset">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Образование</span>
      <h2 class="section-title">Лекторий</h2>
      <div class="section-divider"></div>
      <p class="section-desc">Регулярные лекции и образовательные программы для школьников, студентов и всех желающих</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4 fade-in">
        <div class="section-card h-100">
          <div class="section-card-img-placeholder"><i class="bi bi-mortarboard"></i></div>
          <div class="section-card-body">
            <h4>Лекции для школьников</h4>
            <p>Программы для учащихся 5–11 классов: история флота, кораблестроение, профориентация на морские профессии.</p>
            <a href="<?php echo esc_url(home_url('/contacts/')); ?>">Записаться <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="section-card h-100">
          <div class="section-card-img-placeholder"><i class="bi bi-book"></i></div>
          <div class="section-card-body">
            <h4>Лекции для студентов</h4>
            <p>Расширенные программы по истории науки и техники, встречи с выдающимися выпускниками.</p>
            <a href="<?php echo esc_url(home_url('/contacts/')); ?>">Записаться <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="section-card h-100">
          <div class="section-card-img-placeholder"><i class="bi bi-people"></i></div>
          <div class="section-card-body">
            <h4>Открытые лекции</h4>
            <p>Ежемесячные публичные лекции на темы истории флота и кораблестроения. Вход свободный.</p>
            <a href="<?php echo esc_url(home_url('/contacts/')); ?>">Расписание <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     ДОПОЛНИТЕЛЬНЫЕ УСЛУГИ
═══════════════════════════════════════════ -->
<section id="services" class="section-py bg-light-museum anchor-offset">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Для вас</span>
      <h2 class="section-title">Дополнительные услуги</h2>
      <div class="section-divider"></div>
    </div>

    <div class="row g-4">
      <?php
      $services = [
          ['bi-camera-reels',  'Экскурсионное обслуживание',  'Индивидуальные и групповые экскурсии с профессиональным гидом. Продолжительность: 1–2 часа.'],
          ['bi-building',      'Аренда площадки',             'Залы музея доступны для проведения корпоративных мероприятий, конференций и презентаций.'],
          ['bi-share',         'Работа с архивами',           'Помощь исследователям в работе с фондами и архивными материалами по предварительной договорённости.'],
          ['bi-gift',          'Сувенирная продукция',        'В музее доступны сувениры, буклеты и издания по истории СПбГМТУ и российского кораблестроения.'],
      ];
      foreach ($services as $s) : ?>
        <div class="col-md-6 col-lg-3 fade-in">
          <div class="contact-card text-center h-100">
            <div class="contact-icon mx-auto"><i class="bi <?php echo esc_attr($s[0]); ?>"></i></div>
            <h5><?php echo esc_html($s[1]); ?></h5>
            <p><?php echo esc_html($s[2]); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-4 fade-in">
      <a href="<?php echo esc_url(home_url('/contacts/')); ?>" class="btn-navy">
        <i class="bi bi-envelope"></i> Связаться с нами
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
