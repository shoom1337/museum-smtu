<?php
/**
 * Template Name: Контакты
 * Slug страницы: contacts
 */
get_header();
museum_breadcrumbs(['Контакты' => null]);
$map_src = museum_opt('yandex_map_src', '');
?>

<div class="page-hero">
  <div class="container">
    <h1>Контакты</h1>
    <p>Адрес, телефон, email и маршруты до музея</p>
  </div>
</div>


<section class="section-py">
  <div class="container">

    <!-- Карточки контактов -->
    <div class="row g-4 mb-5">
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center h-100">
          <div class="contact-icon mx-auto"><i class="bi bi-geo-alt"></i></div>
          <h5>Адрес</h5>
          <p><?php echo museum_opt('address', '190121, г. Санкт-Петербург, ул. Лоцманская, д. 3'); ?></p>
          <?php if ($map_src) : ?>
            <a href="#map" class="btn-navy mt-2" style="font-size:13px;">
              <i class="bi bi-map"></i> На карте
            </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center h-100">
          <div class="contact-icon mx-auto"><i class="bi bi-telephone"></i></div>
          <h5>Телефон</h5>
          <?php $phone = museum_opt('phone', '+7 (812) 123-45-67'); ?>
          <p><a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
          <p class="text-muted" style="font-size:13px;">Пн–Пт: 10:00–17:00</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center h-100">
          <div class="contact-icon mx-auto"><i class="bi bi-envelope"></i></div>
          <h5>Email</h5>
          <?php $email = museum_opt('email', 'museum@smtu.ru'); ?>
          <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
          <p class="text-muted" style="font-size:13px;">Ответим в течение 1–2 рабочих дней</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-in">
        <div class="contact-card text-center h-100">
          <div class="contact-icon mx-auto"><i class="bi bi-clock"></i></div>
          <h5>Часы работы</h5>
          <p>
            Пн–Пт: <?php echo museum_opt('hours_weekday', '10:00–17:00'); ?><br>
            Сб: <?php echo museum_opt('hours_saturday', '11:00–15:00'); ?><br>
            Вс: выходной
          </p>
        </div>
      </div>
    </div>


    <!-- Яндекс.Карты -->
    <?php if ($map_src) : ?>
      <div id="map" class="map-wrapper mb-5 fade-in">
        <iframe
          src="<?php echo esc_attr($map_src); ?>"
          width="100%" height="450"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Карта: Музей СПбГМТУ"
        ></iframe>
      </div>
    <?php else : ?>
      <!-- Заглушка карты — настройте в Настройки → Музей СПбГМТУ -->
      <div id="map" class="map-wrapper mb-5 fade-in" style="background:var(--light-bg);border:1px solid var(--border);border-radius:8px;height:320px;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--text-muted);">
        <i class="bi bi-map" style="font-size:48px;margin-bottom:12px;"></i>
        <p>Добавьте URL Яндекс.Карт в<br>
          <?php if (current_user_can('manage_options')) : ?>
            <a href="<?php echo esc_url(admin_url('options-general.php?page=museum-settings')); ?>">Настройки → Музей СПбГМТУ</a>
          <?php else : ?>
            настройках темы
          <?php endif; ?>
        </p>
      </div>
    <?php endif; ?>


    <!-- Как добраться -->
    <div class="row g-4 mb-5">
      <div class="col-12 fade-in">
        <div class="section-header">
          <span class="section-label">Маршруты</span>
          <h2 class="section-title">Как добраться</h2>
          <div class="section-divider"></div>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="info-block h-100">
          <h5><i class="bi bi-train-front me-2 text-gold"></i>Метро</h5>
          <p>Ст. м. <strong>Нарвская</strong> (Кировско-Выборгская линия).<br>Выход № 1, далее пешком 7 минут по ул. Нарвской до Лоцманской ул.</p>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="info-block h-100">
          <h5><i class="bi bi-bus-front me-2 text-gold"></i>Автобус / Троллейбус</h5>
          <p>Автобусы: <strong>65, 67, 71</strong>.<br>Остановка «ул. Лоцманская».<br>Трамваи: <strong>16, 18</strong> — ост. «Площадь Тургенева».</p>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="info-block h-100">
          <h5><i class="bi bi-car-front me-2 text-gold"></i>На автомобиле</h5>
          <p>С Нарвской пл. по ул. Нарвской до пересечения с ул. Лоцманской.<br>Парковка доступна на ул. Лоцманской.</p>
        </div>
      </div>
    </div>


    <!-- Адреса корпусов -->
    <div class="row g-4 mb-5 fade-in">
      <div class="col-12">
        <div class="section-header">
          <span class="section-label">Университет</span>
          <h2 class="section-title">Корпуса СПбГМТУ</h2>
          <div class="section-divider"></div>
        </div>
      </div>
      <?php
      $buildings = [
          ['Главный корпус (музей)', 'ул. Лоцманская, д. 3', 'Музей, деканаты, ректорат. м. Нарвская.'],
          ['Корпус «Техноград»',     'Лоцманская, д. 9',     'Учебные лаборатории и мастерские.'],
          ['Конструкторский корпус', 'ул. Фонтанки, д. 117', 'Научно-исследовательские отделы, м. Балтийская.'],
      ];
      foreach ($buildings as $b) : ?>
        <div class="col-md-4">
          <div class="contact-card h-100">
            <div class="contact-icon"><i class="bi bi-building"></i></div>
            <h5><?php echo esc_html($b[0]); ?></h5>
            <p><strong><?php echo esc_html($b[1]); ?></strong></p>
            <p class="text-muted"><?php echo esc_html($b[2]); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


    <!-- Форма обратной связи -->
    <div class="row g-5 fade-in">
      <div class="col-lg-8">
        <div class="section-header">
          <span class="section-label">Напишите нам</span>
          <h2 class="section-title">Форма обратной связи</h2>
          <div class="section-divider"></div>
        </div>

        <?php
        // Contact Form 7: раскомментируйте после установки плагина и укажите ID формы
        // echo do_shortcode('[contact-form-7 id="ВАШ_ID" title="Форма обратной связи"]');
        ?>

        <form id="contactForm" class="contact-form" method="post" action="#">
          <?php wp_nonce_field('museum_contact_form', 'museum_contact_nonce'); ?>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="cf_name">Имя и фамилия *</label>
              <input type="text" id="cf_name" name="cf_name" class="form-control" required placeholder="Иван Иванов">
            </div>
            <div class="col-md-6">
              <label for="cf_phone">Телефон</label>
              <input type="tel" id="cf_phone" name="cf_phone" class="form-control" placeholder="+7 (___) ___-__-__">
            </div>
            <div class="col-12">
              <label for="cf_email">Email *</label>
              <input type="email" id="cf_email" name="cf_email" class="form-control" required placeholder="example@mail.ru">
            </div>
            <div class="col-12">
              <label for="cf_subject">Тема обращения</label>
              <select id="cf_subject" name="cf_subject" class="form-select">
                <option value="">Выберите тему</option>
                <option>Запись на экскурсию</option>
                <option>Лекторий</option>
                <option>Аренда площадки</option>
                <option>Работа с архивами</option>
                <option>Сотрудничество</option>
                <option>Другое</option>
              </select>
            </div>
            <div class="col-12">
              <label for="cf_message">Сообщение *</label>
              <textarea id="cf_message" name="cf_message" class="form-control" rows="5" required placeholder="Ваш вопрос или предложение…"></textarea>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input type="checkbox" id="cf_privacy" class="form-check-input" required>
                <label for="cf_privacy" class="form-check-label" style="font-size:13px;font-weight:400;">
                  Я согласен(а) с <a href="<?php echo esc_url(home_url('/legal/')); ?>#privacy" target="_blank">политикой обработки персональных данных</a>
                </label>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn-museum">
                <i class="bi bi-send"></i> Отправить сообщение
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-lg-4">
        <div class="contact-card" style="position:sticky;top:80px;">
          <div class="contact-icon"><i class="bi bi-info-circle"></i></div>
          <h5>Важно знать</h5>
          <p style="font-size:14px;">Мы стараемся отвечать на все обращения в течение <strong>1–2 рабочих дней</strong>.</p>
          <hr>
          <p style="font-size:14px;"><i class="bi bi-telephone me-2 text-gold"></i>
            <?php $phone = museum_opt('phone', '+7 (812) 123-45-67'); ?>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
          </p>
          <p style="font-size:14px;"><i class="bi bi-envelope me-2 text-gold"></i>
            <?php $email = museum_opt('email', 'museum@smtu.ru'); ?>
            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<?php get_footer(); ?>
