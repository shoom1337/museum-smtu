<!-- ═══════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════ -->
<footer class="site-footer">
  <div class="container">
    <div class="row g-5">

      <!-- Логотип и описание -->
      <div class="col-lg-4">
        <div class="footer-brand">
          <div class="brand-logo">⚓</div>
          <p>Музей истории кораблестроения и мореплавания Санкт-Петербургского государственного морского технического университета</p>
        </div>
      </div>

      <!-- О музее -->
      <div class="col-md-4 col-lg-2">
        <p class="footer-title">О музее</p>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url(home_url('/about/')); ?>#history"><i class="bi bi-chevron-right"></i>История музея</a></li>
          <li><a href="<?php echo esc_url(home_url('/about/')); ?>#documents"><i class="bi bi-chevron-right"></i>Документы</a></li>
          <li><a href="<?php echo esc_url(home_url('/about/')); ?>#administration"><i class="bi bi-chevron-right"></i>Администрация</a></li>
        </ul>
      </div>

      <!-- Разделы -->
      <div class="col-md-4 col-lg-3">
        <p class="footer-title">Разделы</p>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url(home_url('/exposition/')); ?>"><i class="bi bi-chevron-right"></i>Экспозиция</a></li>
          <li><a href="<?php echo esc_url(home_url('/graduates/')); ?>"><i class="bi bi-chevron-right"></i>Выпускники</a></li>
          <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>"><i class="bi bi-chevron-right"></i>Фотогалерея</a></li>
          <li><a href="<?php echo esc_url(home_url('/visitors/')); ?>"><i class="bi bi-chevron-right"></i>Посетителям</a></li>
          <li><a href="<?php echo esc_url(home_url('/contacts/')); ?>"><i class="bi bi-chevron-right"></i>Контакты</a></li>
        </ul>
      </div>

      <!-- Контакты -->
      <div class="col-md-4 col-lg-3">
        <p class="footer-title">Контакты</p>
        <div class="footer-contacts">
          <p><i class="bi bi-geo-alt-fill"></i><?php echo museum_opt('address', '190121, г. Санкт-Петербург, ул. Лоцманская, д. 3'); ?></p>
          <?php $phone = museum_opt('phone', '+7 (812) 123-45-67'); ?>
          <p><i class="bi bi-telephone-fill"></i>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
          </p>
          <?php $email = museum_opt('email', 'museum@smtu.ru'); ?>
          <p><i class="bi bi-envelope-fill"></i>
            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
          </p>
          <p><i class="bi bi-clock-fill"></i>
            Пн–Пт: <?php echo museum_opt('hours_weekday', '10:00–17:00'); ?><br>
            Сб: <?php echo museum_opt('hours_saturday', '11:00–15:00'); ?>
          </p>
        </div>
      </div>

    </div>
  </div><!-- /.container -->

  <div class="footer-bottom">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span>© <?php echo date('Y'); ?> Музей СПбГМТУ. Все права защищены.</span>
        <div class="d-flex gap-3">
          <a href="<?php echo esc_url(home_url('/legal/')); ?>#privacy">Политика конфиденциальности</a>
          <a href="<?php echo esc_url(home_url('/legal/')); ?>#agreement">Пользовательское соглашение</a>
        </div>
      </div>
    </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
