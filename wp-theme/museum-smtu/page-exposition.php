<?php
/**
 * Template Name: Экспозиция
 * Slug страницы: exposition
 */
get_header();
museum_breadcrumbs(['Экспозиция' => null]);
?>

<div class="page-hero">
  <div class="container">
    <h1><?php echo museum_opt('page_exposition_h1', 'Экспозиция'); ?></h1>
    <p><?php echo museum_opt('page_exposition_sub', 'Семь тематических залов, охватывающих всю историю отечественного кораблестроения'); ?></p>
  </div>
</div>

<!-- Быстрая навигация по залам -->
<div class="bg-light-museum border-bottom py-2 sticky-top" style="top:64px;z-index:100;">
  <div class="container">
    <div class="d-flex gap-3 flex-wrap" style="font-size:13px;">
      <a href="#shipbuilding" class="text-navy fw-bold">История кораблестроения</a>
      <a href="#underwater"   class="text-navy fw-bold">Подводное оборудование</a>
      <a href="#war"          class="text-navy fw-bold">Годы войны</a>
      <a href="#office"       class="text-navy fw-bold">Кабинет профессора</a>
      <a href="#diploma"      class="text-navy fw-bold">Дипломный зал</a>
    </div>
  </div>
</div>


<!-- ═══════════════════════════════════════════
     ЗАЛ 1: История кораблестроения
═══════════════════════════════════════════ -->
<section id="shipbuilding" class="section-py anchor-offset">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 fade-in">
        <span class="section-label">Зал 1</span>
        <h2 class="section-title">История кораблестроения</h2>
        <div class="section-divider"></div>
        <p>Экспозиция первого зала раскрывает путь российского кораблестроения от петровских верфей XVIII века до современных атомных ледоколов и подводных лодок.</p>
        <p>В витринах — масштабные модели исторических кораблей, навигационные приборы, чертежи и документы, рассказывающие о выдающихся кораблестроителях России.</p>
        <div class="d-flex gap-3 flex-wrap mt-3">
          <div class="info-block" style="flex:1;min-width:180px;">
            <h5>Экспонатов</h5>
            <p>Более 600 предметов</p>
          </div>
          <div class="info-block" style="flex:1;min-width:180px;">
            <h5>Период</h5>
            <p>XVIII–XXI вв.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 fade-in">
        <div style="background:linear-gradient(135deg,#0D1B33,#243558);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.15);">⛵</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     ЗАЛ 2: Подводное оборудование
═══════════════════════════════════════════ -->
<section id="underwater" class="section-py bg-light-museum anchor-offset">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 order-lg-2 fade-in">
        <span class="section-label">Зал 2</span>
        <h2 class="section-title">Подводное оборудование</h2>
        <div class="section-divider"></div>
        <p>Уникальная коллекция оборудования для подводных исследований и кораблестроения. Водолазные костюмы, оборудование для погружений, модели подводных лодок различных эпох.</p>
        <p>Многие экспонаты этого зала — рабочие образцы, прошедшие реальные испытания в Балтийском и Северном морях.</p>
      </div>
      <div class="col-lg-6 order-lg-1 fade-in">
        <div style="background:linear-gradient(135deg,#122040,#1B2A4A);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.15);">🤿</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     ЗАЛ 3: Годы войны
═══════════════════════════════════════════ -->
<section id="war" class="section-py anchor-offset">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 fade-in">
        <span class="section-label">Зал 3</span>
        <h2 class="section-title">Годы войны</h2>
        <div class="section-divider"></div>
        <p>Этот зал посвящён вкладу Ленинградского кораблестроительного института и его выпускников в победу в Великой Отечественной войне 1941–1945 гг.</p>
        <p>Документы, фотографии, личные вещи преподавателей и студентов, ушедших на фронт или работавших в осаждённом Ленинграде над созданием кораблей и подводных лодок.</p>
        <div class="info-block">
          <h5>Памятная доска</h5>
          <p>На ней перечислены имена 280 студентов и преподавателей ЛКИ, погибших в годы войны.</p>
        </div>
      </div>
      <div class="col-lg-6 fade-in">
        <div style="background:linear-gradient(135deg,#1c1a2e,#2d2558);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.15);">🎖️</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     ЗАЛ 4: Кабинет профессора
═══════════════════════════════════════════ -->
<section id="office" class="section-py bg-light-museum anchor-offset">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 order-lg-2 fade-in">
        <span class="section-label">Зал 4</span>
        <h2 class="section-title">Кабинет профессора</h2>
        <div class="section-divider"></div>
        <p>Воссозданная рабочая обстановка профессора кораблестроительного института 1950-х годов. Письменный стол, чертёжные инструменты, научные труды, личные вещи.</p>
        <p>Экспозиция рассказывает о научной деятельности выдающихся учёных, чьи открытия стали основой современного кораблестроения.</p>
      </div>
      <div class="col-lg-6 order-lg-1 fade-in">
        <div style="background:linear-gradient(135deg,#1a2e1a,#1B2A4A);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.15);">📐</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     ЗАЛ 5: Дипломный зал
═══════════════════════════════════════════ -->
<section id="diploma" class="section-py anchor-offset">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 fade-in">
        <span class="section-label">Зал 5</span>
        <h2 class="section-title">Дипломный зал</h2>
        <div class="section-divider"></div>
        <p>Постоянная выставка лучших дипломных проектов выпускников разных лет. Здесь хранятся макеты кораблей, разработанных студентами, ставших впоследствии ведущими инженерами отрасли.</p>
        <p>Часть дипломных проектов была реализована в натуральную величину и составляет гордость российского флота.</p>
      </div>
      <div class="col-lg-6 fade-in">
        <div style="background:linear-gradient(135deg,#2a1a0d,#1B2A4A);border-radius:12px;aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(255,255,255,0.15);">🏆</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section-py bg-navy">
  <div class="container text-center">
    <h2 class="section-title section-title-white mb-3">Посетите музей лично</h2>
    <p style="color:rgba(255,255,255,0.7);max-width:540px;margin:0 auto 32px;">Никакое фото не заменит живого впечатления от экспонатов. Приходите сами или записывайтесь на экскурсию.</p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
      <a href="<?php echo esc_url(home_url('/visit-rules/')); ?>" class="btn-museum">
        <i class="bi bi-list-check"></i> Правила посещения
      </a>
      <a href="<?php echo esc_url(home_url('/contacts/')); ?>" class="btn-outline-museum">
        <i class="bi bi-map"></i> Как добраться
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
