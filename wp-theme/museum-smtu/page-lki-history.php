<?php
/**
 * Template Name: История ЛКИ
 * Slug страницы: lki-history
 */
get_header();
museum_breadcrumbs(['Экспозиция' => home_url('/exposition/'), 'История создания ЛКИ' => null]);
?>

<div class="page-hero">
  <div class="container">
    <h1><?php echo museum_opt('page_lki_h1', 'История создания ЛКИ'); ?></h1>
    <p><?php echo museum_opt('page_lki_sub', 'От инженерного факультета 1899 года до одного из ведущих технических вузов России'); ?></p>
  </div>
</div>


<!-- ─── Блок 1: Предыстория ─────────────────────────────────────────────────── -->
<section class="section-py">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 fade-in">
        <span class="section-label">1899–1929</span>
        <h2 class="section-title">Предыстория: корни в Политехническом</h2>
        <div class="section-divider"></div>
        <p>В 1899 году в Санкт-Петербурге открылся Политехнический институт, в составе которого появился кораблестроительный факультет. Именно здесь впервые в России началась систематическая подготовка инженеров-кораблестроителей.</p>
        <p>За три десятилетия работы факультет воспитал несколько поколений специалистов, внёсших огромный вклад в строительство российского военно-морского и торгового флота.</p>
        <div class="timeline">
          <div class="timeline-item">
            <div class="timeline-year">1899</div>
            <div class="timeline-text">Открытие СПб Политехнического института. Основание кораблестроительного отделения.</div>
          </div>
          <div class="timeline-item">
            <div class="timeline-year">1902</div>
            <div class="timeline-text">Первые выпускники-кораблестроители. Начало активного взаимодействия с Адмиралтейскими верфями.</div>
          </div>
          <div class="timeline-item">
            <div class="timeline-year">1917–1920</div>
            <div class="timeline-text">Реорганизация высшей школы. Факультет продолжает работу в сложных условиях.</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 fade-in">
        <div style="background:linear-gradient(135deg,var(--navy) 0%,var(--navy-mid) 100%);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.2);">🏛️</div>
      </div>
    </div>
  </div>
</section>


<!-- ─── Блок 2: Основание ЛКИ ──────────────────────────────────────────────── -->
<section class="section-py bg-light-museum">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 order-lg-2 fade-in">
        <span class="section-label">1930</span>
        <h2 class="section-title">Основание ЛКИ</h2>
        <div class="section-divider"></div>
        <p>В 1930 году постановлением правительства на базе кораблестроительного факультета Политехнического института был создан <strong>Ленинградский кораблестроительный институт (ЛКИ)</strong> — первый в мире самостоятельный вуз, полностью посвящённый подготовке инженеров флота.</p>
        <p>Первым ректором стал видный учёный и общественный деятель. Институт разместился в историческом здании на Лоцманской улице, где располагается и сегодня.</p>
      </div>
      <div class="col-lg-6 order-lg-1 fade-in">
        <div style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.2);">🎓</div>
      </div>
    </div>
  </div>
</section>


<!-- ─── Блок 3: Советский период ───────────────────────────────────────────── -->
<section class="section-py">
  <div class="container">
    <div class="section-header text-center fade-in">
      <span class="section-label">1930–1991</span>
      <h2 class="section-title">Советский период</h2>
      <div class="section-divider mx-auto"></div>
      <p class="section-desc mx-auto">Восемь десятилетий научных достижений и подготовки специалистов высшего класса</p>
    </div>

    <div class="row g-4">
      <?php
      $periods = [
          ['1930–1940', 'Становление', 'Формирование научных школ, строительство учебно-лабораторной базы. Подготовка специалистов для строительства первых советских подводных лодок.'],
          ['1941–1945', 'Годы войны', 'Эвакуация части факультетов, оборонные заказы. Более 280 студентов и преподавателей погибли, защищая Родину.'],
          ['1945–1960', 'Послевоенное восстановление', 'Быстрое восстановление и расширение. ЛКИ становится главным вузом атомного подводного кораблестроения СССР.'],
          ['1960–1991', 'Расцвет', 'Более 20 000 выпускников, сотни научных открытий, крупнейшая в стране школа теории корабля.'],
      ];
      foreach ($periods as $p) : ?>
        <div class="col-md-6 fade-in">
          <div class="info-block h-100">
            <h5><span class="text-gold me-2"><?php echo esc_html($p[0]); ?></span><?php echo esc_html($p[1]); ?></h5>
            <p><?php echo esc_html($p[2]); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ─── Блок 4: Современный СПбГМТУ ───────────────────────────────────────── -->
<section class="section-py bg-navy">
  <div class="container">
    <div class="section-header text-center fade-in">
      <span class="section-label">С 1990 года</span>
      <h2 class="section-title section-title-white">Современный СПбГМТУ</h2>
      <div class="section-divider mx-auto"></div>
    </div>

    <div class="row g-4 text-center">
      <?php
      $stats = [
          ['1899', 'г.', 'Год основания'],
          ['95+',  '',   'Лет работы ЛКИ/СПбГМТУ'],
          ['60000+', '', 'Выпускников за всё время'],
          ['12',   '',   'Факультетов сегодня'],
      ];
      foreach ($stats as $s) : ?>
        <div class="col-6 col-md-3 fade-in">
          <div class="stat-item">
            <div class="stat-number"><?php echo esc_html($s[0] . $s[1]); ?></div>
            <div class="stat-label"><?php echo esc_html($s[2]); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row mt-5">
      <div class="col-lg-8 mx-auto fade-in">
        <p style="color:rgba(255,255,255,0.75);text-align:center;font-size:16px;">
          В 1992 году ЛКИ получил статус Санкт-Петербургского государственного морского технического университета (СПбГМТУ). Университет продолжает готовить ведущих инженеров России в сфере судостроения, морской техники и смежных областей.
        </p>
      </div>
    </div>
  </div>
</section>


<!-- ─── Блок 5: Смежные материалы ─────────────────────────────────────────── -->
<section class="section-py">
  <div class="container">
    <div class="section-header text-center fade-in">
      <span class="section-label">Узнайте больше</span>
      <h2 class="section-title">Связанные разделы</h2>
      <div class="section-divider mx-auto"></div>
    </div>

    <div class="row g-4">
      <div class="col-md-4 fade-in">
        <div class="section-card h-100">
          <div class="section-card-img-placeholder"><i class="bi bi-grid-3x3-gap"></i></div>
          <div class="section-card-body">
            <h4>Экспозиция музея</h4>
            <p>Семь залов, каждый из которых посвящён отдельной эпохе в истории кораблестроения.</p>
            <a href="<?php echo esc_url(home_url('/exposition/')); ?>">Перейти <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="section-card h-100">
          <div class="section-card-img-placeholder"><i class="bi bi-people"></i></div>
          <div class="section-card-body">
            <h4>Выдающиеся выпускники</h4>
            <p>Инженеры, адмиралы, учёные — люди, прославившие российский флот и науку.</p>
            <a href="<?php echo esc_url(home_url('/graduates/')); ?>">Перейти <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="section-card h-100">
          <div class="section-card-img-placeholder"><i class="bi bi-images"></i></div>
          <div class="section-card-body">
            <h4>Фотогалерея</h4>
            <p>Исторические фотографии, архивные снимки, фото залов и экспонатов.</p>
            <a href="<?php echo esc_url(home_url('/gallery/')); ?>">Перейти <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
