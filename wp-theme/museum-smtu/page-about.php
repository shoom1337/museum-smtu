<?php
/**
 * Template Name: О музее
 * Slug страницы: about
 */
get_header();
museum_breadcrumbs(['О музее' => null]);
?>

<!-- Page Hero -->
<div class="page-hero">
  <div class="container">
    <h1><?php echo museum_opt('page_about_h1', 'О музее'); ?></h1>
    <p><?php echo museum_opt('page_about_sub', 'История, документы и администрация Музея СПбГМТУ'); ?></p>
  </div>
</div>

<!-- Быстрая навигация по секциям -->
<div class="bg-light-museum border-bottom py-2 sticky-top" style="top:64px;z-index:100;">
  <div class="container">
    <div class="d-flex gap-4 flex-wrap">
      <a href="#history" class="text-navy fw-600" style="font-size:14px;font-weight:600;">История музея</a>
      <a href="#documents" class="text-navy fw-600" style="font-size:14px;font-weight:600;">Нормативные документы</a>
      <a href="#administration" class="text-navy fw-600" style="font-size:14px;font-weight:600;">Администрация</a>
    </div>
  </div>
</div>


<!-- ═══════════════════════════════════════════
     ИСТОРИЯ МУЗЕЯ
═══════════════════════════════════════════ -->
<section id="history" class="section-py anchor-offset">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Прошлое и настоящее</span>
      <h2 class="section-title">История музея</h2>
      <div class="section-divider"></div>
    </div>

    <div class="row g-5">
      <div class="col-lg-7 fade-in">
        <?php the_content(); // Если нужно — редактируется через редактор страницы ?>

        <p>Музей истории кораблестроения и мореплавания СПбГМТУ основан в 1941 году. За более чем восемь десятилетий в его стенах собрана уникальная коллекция, отражающая историю отечественного кораблестроения и деятельность Ленинградского кораблестроительного института (ныне — СПбГМТУ).</p>
        <p>Сегодня музей располагает семью тематическими залами и насчитывает более 3000 экспонатов: модели кораблей, навигационные приборы, архивные материалы, личные вещи выдающихся учёных и конструкторов.</p>

        <!-- Хронология -->
        <div class="timeline mt-4">
          <div class="timeline-item fade-in">
            <div class="timeline-year">1899</div>
            <div class="timeline-text">Основание Санкт-Петербургского политехнического института, давшего начало кораблестроительному образованию в России.</div>
          </div>
          <div class="timeline-item fade-in">
            <div class="timeline-year">1930</div>
            <div class="timeline-text">Создание Ленинградского кораблестроительного института (ЛКИ) как самостоятельного вуза на базе кораблестроительного факультета.</div>
          </div>
          <div class="timeline-item fade-in">
            <div class="timeline-year">1941</div>
            <div class="timeline-text">Основание музея. Первые коллекции сформированы из архивных материалов кафедр, личных вещей профессоров и моделей кораблей.</div>
          </div>
          <div class="timeline-item fade-in">
            <div class="timeline-year">1945–1960</div>
            <div class="timeline-text">Послевоенное расширение экспозиции: поступление документов, связанных с блокадой и участием выпускников в Великой Отечественной войне.</div>
          </div>
          <div class="timeline-item fade-in">
            <div class="timeline-year">1990-е</div>
            <div class="timeline-text">ЛКИ переименован в Санкт-Петербургский государственный морской технический университет (СПбГМТУ). Музей продолжает работу.</div>
          </div>
          <div class="timeline-item fade-in">
            <div class="timeline-year">Сегодня</div>
            <div class="timeline-text">Более 3000 экспонатов, 7 залов, активная просветительская деятельность, тысячи посетителей в год.</div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 fade-in">
        <div style="background:linear-gradient(135deg,var(--navy) 0%,var(--navy-mid) 100%);border-radius:12px;aspect-ratio:3/4;display:flex;align-items:center;justify-content:center;font-size:80px;opacity:0.3;color:white;">⚓</div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     НОРМАТИВНЫЕ ДОКУМЕНТЫ
═══════════════════════════════════════════ -->
<section id="documents" class="section-py bg-light-museum anchor-offset">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Правовая база</span>
      <h2 class="section-title">Нормативные документы</h2>
      <div class="section-divider"></div>
    </div>

    <?php
    $docs = new WP_Query([
        'post_type'      => 'museum_doc',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    if ($docs->have_posts()) :
        while ($docs->have_posts()) : $docs->the_post();
            $file_url = get_post_meta(get_the_ID(), '_doc_file_url', true);
            $date_str = get_post_meta(get_the_ID(), '_doc_date', true);
    ?>
        <div class="doc-item fade-in">
          <i class="bi bi-file-earmark-pdf-fill doc-icon" style="color:var(--gold)"></i>
          <div class="doc-info">
            <h6><?php the_title(); ?></h6>
            <?php if ($date_str) : ?>
              <small>Дата: <?php echo esc_html($date_str); ?></small>
            <?php endif; ?>
          </div>
          <?php if ($file_url) : ?>
            <a href="<?php echo esc_url($file_url); ?>" class="doc-download" target="_blank" rel="noopener" title="Скачать">
              <i class="bi bi-download"></i>
            </a>
          <?php else : ?>
            <span class="doc-download text-muted" title="Файл не загружен">
              <i class="bi bi-hourglass"></i>
            </span>
          <?php endif; ?>
        </div>
    <?php
        endwhile;
        wp_reset_postdata();
    else : ?>
      <!-- Плейсхолдеры — замените на реальные документы в разделе Документы в WP Admin -->
      <?php
      $placeholder_docs = [
          ['Устав музея СПбГМТУ', 'Утверждён приказом ректора № 123 от 01.09.2020'],
          ['Положение о музее', 'Последняя редакция от 15.03.2022'],
          ['Программа развития музея до 2030 года', 'Стратегический документ'],
          ['Политика обработки персональных данных', 'В соответствии с ФЗ-152'],
          ['Правила посещения (официальная редакция)', 'Утверждены 01.01.2023'],
      ];
      foreach ($placeholder_docs as $doc) : ?>
        <div class="doc-item fade-in">
          <i class="bi bi-file-earmark-text-fill doc-icon"></i>
          <div class="doc-info">
            <h6><?php echo esc_html($doc[0]); ?></h6>
            <small><?php echo esc_html($doc[1]); ?></small>
          </div>
          <span class="doc-download text-muted"><i class="bi bi-download"></i></span>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>


<!-- ═══════════════════════════════════════════
     АДМИНИСТРАЦИЯ
═══════════════════════════════════════════ -->
<section id="administration" class="section-py anchor-offset">
  <div class="container">
    <div class="section-header">
      <span class="section-label">Команда</span>
      <h2 class="section-title">Администрация музея</h2>
      <div class="section-divider"></div>
    </div>

    <div class="row g-4">
      <?php
      $staff = new WP_Query([
          'post_type'      => 'staff',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
      ]);

      if ($staff->have_posts()) :
          while ($staff->have_posts()) : $staff->the_post();
              $role  = get_post_meta(get_the_ID(), '_staff_role', true);
              $phone = get_post_meta(get_the_ID(), '_staff_phone', true);
              $email = get_post_meta(get_the_ID(), '_staff_email', true);
      ?>
          <div class="col-md-6 col-lg-4 fade-in">
            <div class="person-card">
              <div class="person-photo">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('thumbnail', ['class' => 'w-100 h-100', 'style' => 'object-fit:cover']); ?>
                <?php else : ?>
                  <i class="bi bi-person"></i>
                <?php endif; ?>
              </div>
              <h5><?php the_title(); ?></h5>
              <?php if ($role) : ?>
                <span class="role"><?php echo esc_html($role); ?></span>
              <?php endif; ?>
              <div class="contacts">
                <?php if ($phone) echo '<div><i class="bi bi-telephone me-1"></i>' . esc_html($phone) . '</div>'; ?>
                <?php if ($email) echo '<div><i class="bi bi-envelope me-1"></i><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></div>'; ?>
              </div>
            </div>
          </div>
      <?php
          endwhile;
          wp_reset_postdata();
      else : ?>
        <!-- Плейсхолдеры — добавьте сотрудников в разделе Администрация в WP Admin -->
        <?php
        $placeholder_staff = [
            ['Иванов Иван Иванович', 'Директор музея', 'ivanov@smtu.ru'],
            ['Петрова Мария Сергеевна', 'Главный хранитель', 'petrova@smtu.ru'],
            ['Сидоров Алексей Владимирович', 'Научный сотрудник', 'sidorov@smtu.ru'],
        ];
        foreach ($placeholder_staff as $s) : ?>
          <div class="col-md-6 col-lg-4 fade-in">
            <div class="person-card">
              <div class="person-photo"><i class="bi bi-person"></i></div>
              <h5><?php echo esc_html($s[0]); ?></h5>
              <span class="role"><?php echo esc_html($s[1]); ?></span>
              <div class="contacts">
                <div><i class="bi bi-envelope me-1"></i><a href="mailto:<?php echo esc_attr($s[2]); ?>"><?php echo esc_html($s[2]); ?></a></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
