<?php
/**
 * Template Name: Правила посещения
 * Slug страницы: visit-rules
 */
get_header();
museum_breadcrumbs(['Посетителям' => home_url('/visitors/'), 'Правила посещения' => null]);
?>

<div class="page-hero">
  <div class="container">
    <h1>Правила посещения</h1>
    <p>Условия посещения, режим работы и форма предварительной записи</p>
  </div>
</div>


<section class="section-py">
  <div class="container">
    <div class="row g-5">

      <!-- Левая колонка — правила -->
      <div class="col-lg-8">

        <div class="info-block fade-in">
          <h5><i class="bi bi-door-open me-2 text-gold"></i>Вход в музей</h5>
          <p>Вход в музей свободный для всех категорий посетителей. Посещение возможно самостоятельно или в составе экскурсионной группы.</p>
        </div>

        <div class="info-block fade-in">
          <h5><i class="bi bi-people me-2 text-gold"></i>Групповые посещения</h5>
          <p>Для групп от 8 человек обязательна предварительная запись не позднее чем за 3 рабочих дня. Школьные группы принимаются по согласованию с дирекцией.</p>
        </div>

        <div class="info-block fade-in">
          <h5><i class="bi bi-camera me-2 text-gold"></i>Фото- и видеосъёмка</h5>
          <p>Разрешена для личных нужд без вспышки. Коммерческая съёмка — только с письменного разрешения администрации.</p>
        </div>

        <div class="info-block fade-in">
          <h5><i class="bi bi-x-circle me-2 text-gold"></i>На территории запрещено</h5>
          <ul style="font-size:14px;color:var(--text-muted);padding-left:20px;margin:0;">
            <li>Курить, употреблять алкоголь и еду</li>
            <li>Трогать экспонаты руками</li>
            <li>Входить с животными (кроме собак-поводырей)</li>
            <li>Вести громкие разговоры по телефону</li>
            <li>Повреждать музейное имущество</li>
          </ul>
        </div>

        <div class="info-block fade-in">
          <h5><i class="bi bi-bag-x me-2 text-gold"></i>Гардероб и хранение вещей</h5>
          <p>При входе работает бесплатная гардеробная. Крупногабаритные сумки и рюкзаки оставляются в камере хранения.</p>
        </div>

        <div class="info-block fade-in">
          <h5><i class="bi bi-person-wheelchair me-2 text-gold"></i>Доступная среда</h5>
          <p>Музей оборудован пандусом при главном входе. При необходимости сопровождения — обратитесь к сотрудникам на входе.</p>
        </div>


        <!-- ═══════════════════════════════════════════
             ФОРМА ОБРАТНОЙ СВЯЗИ
        ═══════════════════════════════════════════ -->
        <div class="mt-5 fade-in">
          <div class="section-header">
            <span class="section-label">Записаться</span>
            <h2 class="section-title">Форма предварительной записи</h2>
            <div class="section-divider"></div>
          </div>

          <?php
          // Если установлен Contact Form 7 — укажите id вашей формы
          // echo do_shortcode('[contact-form-7 id="ВАШ_ID" title="Запись на экскурсию"]');
          // Иначе — используется HTML-форма ниже
          ?>

          <form id="visitForm" class="contact-form" method="post" action="#">
            <?php wp_nonce_field('museum_visit_form', 'museum_visit_nonce'); ?>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="vf_name">Имя и фамилия *</label>
                <input type="text" id="vf_name" name="vf_name" class="form-control" required placeholder="Иван Иванов">
              </div>
              <div class="col-md-6">
                <label for="vf_phone">Телефон *</label>
                <input type="tel" id="vf_phone" name="vf_phone" class="form-control" required placeholder="+7 (___) ___-__-__">
              </div>
              <div class="col-md-6">
                <label for="vf_email">Email</label>
                <input type="email" id="vf_email" name="vf_email" class="form-control" placeholder="example@mail.ru">
              </div>
              <div class="col-md-3">
                <label for="vf_group_size">Кол-во человек</label>
                <select id="vf_group_size" name="vf_group_size" class="form-select">
                  <option value="1">1 (индивидуально)</option>
                  <option value="2-7">2–7 (малая группа)</option>
                  <option value="8-20">8–20 (группа)</option>
                  <option value="20+">Более 20</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="vf_date">Желаемая дата</label>
                <input type="date" id="vf_date" name="vf_date" class="form-control"
                       min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
              </div>
              <div class="col-12">
                <label for="vf_message">Комментарий</label>
                <textarea id="vf_message" name="vf_message" class="form-control" rows="3"
                          placeholder="Дополнительные пожелания, тема экскурсии и т.д."></textarea>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input type="checkbox" id="vf_privacy" name="vf_privacy" class="form-check-input" required>
                  <label for="vf_privacy" class="form-check-label" style="font-size:13px;font-weight:400;">
                    Я согласен(а) с <a href="<?php echo esc_url(home_url('/legal/')); ?>#privacy" target="_blank">политикой конфиденциальности</a>
                  </label>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-museum">
                  <i class="bi bi-send"></i> Отправить заявку
                </button>
              </div>
            </div>
          </form>
        </div>

      </div><!-- /col-lg-8 -->

      <!-- Правая колонка — часы работы (sticky) -->
      <div class="col-lg-4">
        <div class="contact-card" style="position:sticky;top:80px;">
          <div class="contact-icon"><i class="bi bi-clock"></i></div>
          <h5>Режим работы</h5>
          <table class="table table-sm" style="font-size:14px;margin-top:16px;">
            <tbody>
              <tr><td>Понедельник</td><td><?php echo museum_opt('hours_weekday', '10:00–17:00'); ?></td></tr>
              <tr><td>Вторник</td>    <td><?php echo museum_opt('hours_weekday', '10:00–17:00'); ?></td></tr>
              <tr><td>Среда</td>      <td><?php echo museum_opt('hours_weekday', '10:00–17:00'); ?></td></tr>
              <tr><td>Четверг</td>    <td><?php echo museum_opt('hours_weekday', '10:00–17:00'); ?></td></tr>
              <tr><td>Пятница</td>    <td><?php echo museum_opt('hours_weekday', '10:00–17:00'); ?></td></tr>
              <tr><td>Суббота</td>    <td><?php echo museum_opt('hours_saturday', '11:00–15:00'); ?></td></tr>
              <tr class="text-muted"><td>Воскресенье</td><td>Выходной</td></tr>
            </tbody>
          </table>

          <hr>
          <h5 class="mt-3">Контакты</h5>
          <?php $phone = museum_opt('phone', '+7 (812) 123-45-67'); ?>
          <p style="font-size:14px;"><i class="bi bi-telephone me-2 text-gold"></i>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
          </p>
          <?php $email = museum_opt('email', 'museum@smtu.ru'); ?>
          <p style="font-size:14px;"><i class="bi bi-envelope me-2 text-gold"></i>
            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
          </p>
          <p style="font-size:14px;"><i class="bi bi-geo-alt me-2 text-gold"></i>
            <?php echo museum_opt('address', 'ул. Лоцманская, 3, Санкт-Петербург'); ?>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
