<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">

  <!-- Верхняя строка -->
  <div class="header-top d-none d-lg-block">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex gap-4">
          <span><i class="bi bi-clock"></i>Пн–Пт: <?php echo museum_opt('hours_weekday', '10:00–17:00'); ?>, Сб: <?php echo museum_opt('hours_saturday', '11:00–15:00'); ?></span>
          <span><i class="bi bi-geo-alt"></i><?php echo museum_opt('address', 'г. Санкт-Петербург, ул. Лоцманская, 3'); ?></span>
        </div>
        <div class="d-flex gap-3">
          <?php $phone = museum_opt('phone', '+7 (812) 123-45-67'); ?>
          <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', $phone)); ?>">
            <i class="bi bi-telephone"></i><?php echo esc_html($phone); ?>
          </a>
          <?php $email = museum_opt('email', 'museum@smtu.ru'); ?>
          <a href="mailto:<?php echo esc_attr($email); ?>">
            <i class="bi bi-envelope"></i><?php echo esc_html($email); ?>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Навигация -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">

      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
        <div class="brand-logo">⚓</div>
        <div class="brand-text">
          <span class="brand-name"><?php bloginfo('name'); ?></span>
          <span class="brand-sub">История кораблестроения</span>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-label="Меню">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto">

          <!-- О музее -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo museum_nav_active('about'); ?>"
               href="<?php echo esc_url(home_url('/about/')); ?>"
               data-bs-toggle="dropdown">О музее</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/about/')); ?>#history">
                <i class="bi bi-journal-text me-2"></i>История музея</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/about/')); ?>#documents">
                <i class="bi bi-file-earmark-text me-2"></i>Нормативные документы</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/about/')); ?>#administration">
                <i class="bi bi-people me-2"></i>Администрация</a></li>
            </ul>
          </li>

          <!-- Посетителям -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo museum_nav_active_section(['visitors', 'visit-rules']); ?>"
               href="<?php echo esc_url(home_url('/visitors/')); ?>"
               data-bs-toggle="dropdown">Посетителям</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/visit-rules/')); ?>">
                <i class="bi bi-list-check me-2"></i>Правила посещения</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/visitors/')); ?>#tour">
                <i class="bi bi-camera-video me-2"></i>Виртуальный тур</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/visitors/')); ?>#lectures">
                <i class="bi bi-mortarboard me-2"></i>Лекторий</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/visitors/')); ?>#services">
                <i class="bi bi-star me-2"></i>Дополнительные услуги</a></li>
            </ul>
          </li>

          <!-- Экспозиция -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php echo museum_nav_active_section(['exposition', 'lki-history']); ?>"
               href="<?php echo esc_url(home_url('/exposition/')); ?>"
               data-bs-toggle="dropdown">Экспозиция</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/exposition/')); ?>#shipbuilding">История кораблестроения</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/lki-history/')); ?>">История создания ЛКИ</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/exposition/')); ?>#underwater">Подводное оборудование</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/exposition/')); ?>#war">Годы войны</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/exposition/')); ?>#office">Кабинет профессора</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/exposition/')); ?>#diploma">Дипломный зал</a></li>
              <li><a class="dropdown-item" href="<?php echo esc_url(home_url('/graduates/')); ?>">Выдающиеся выпускники</a></li>
            </ul>
          </li>

          <!-- Выпускники -->
          <li class="nav-item">
            <a class="nav-link <?php echo museum_nav_active('graduates'); ?>"
               href="<?php echo esc_url(home_url('/graduates/')); ?>">Выпускники</a>
          </li>

          <!-- Фотогалерея -->
          <li class="nav-item">
            <a class="nav-link <?php echo museum_nav_active('gallery'); ?>"
               href="<?php echo esc_url(home_url('/gallery/')); ?>">Фотогалерея</a>
          </li>

          <!-- Контакты -->
          <li class="nav-item">
            <a class="nav-link <?php echo museum_nav_active('contacts'); ?>"
               href="<?php echo esc_url(home_url('/contacts/')); ?>">Контакты</a>
          </li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav>

</header>
