<?php
/**
 * Template Name: Правовая информация
 * Slug страницы: legal
 * Разделы: Политика конфиденциальности, Пользовательское соглашение, Новости
 */
get_header();
museum_breadcrumbs(['Правовая информация' => null]);
?>

<div class="page-hero">
  <div class="container">
    <h1>Правовая информация</h1>
    <p>Политика конфиденциальности, пользовательское соглашение и новости музея</p>
  </div>
</div>


<section class="section-py">
  <div class="container">
    <div class="row g-5">

      <!-- Основной контент -->
      <div class="col-lg-9">

        <!-- ─── Политика конфиденциальности ───────────────────────────────── -->
        <div id="privacy" class="anchor-offset mb-5">
          <div class="section-header">
            <span class="section-label">Правовой документ</span>
            <h2 class="section-title">Политика конфиденциальности</h2>
            <div class="section-divider"></div>
          </div>

          <div style="font-size:15px;line-height:1.8;color:var(--text-main);">
            <p><strong>Последнее обновление:</strong> 1 января <?php echo date('Y'); ?> г.</p>

            <h5>1. Общие положения</h5>
            <p>Настоящая Политика конфиденциальности (далее — Политика) определяет порядок обработки и защиты персональных данных физических лиц (далее — Пользователи), которые используют сайт Музея СПбГМТУ.</p>

            <h5>2. Перечень обрабатываемых данных</h5>
            <p>Музей может обрабатывать следующие персональные данные: имя и фамилия, адрес электронной почты, номер телефона, дата запланированного визита. Данные собираются только при добровольной отправке формы обратной связи или записи на экскурсию.</p>

            <h5>3. Цели обработки</h5>
            <ul>
              <li>Организация экскурсионного обслуживания;</li>
              <li>Ответы на обращения пользователей;</li>
              <li>Информирование о мероприятиях музея (с согласия пользователя).</li>
            </ul>

            <h5>4. Хранение и защита данных</h5>
            <p>Персональные данные хранятся на защищённых серверах и не передаются третьим лицам без согласия субъекта данных, за исключением случаев, предусмотренных законодательством Российской Федерации (ФЗ-152).</p>

            <h5>5. Права пользователей</h5>
            <p>Пользователь вправе запросить уточнение, изменение или удаление своих персональных данных, направив запрос на электронный адрес музея: <a href="mailto:<?php echo esc_attr(museum_opt('email', 'museum@smtu.ru')); ?>"><?php echo museum_opt('email', 'museum@smtu.ru'); ?></a>.</p>

            <h5>6. Изменение Политики</h5>
            <p>Музей оставляет за собой право вносить изменения в настоящую Политику. Актуальная версия всегда доступна на данной странице.</p>
          </div>
        </div>

        <hr class="my-5">

        <!-- ─── Пользовательское соглашение ──────────────────────────────── -->
        <div id="agreement" class="anchor-offset mb-5">
          <div class="section-header">
            <span class="section-label">Правовой документ</span>
            <h2 class="section-title">Пользовательское соглашение</h2>
            <div class="section-divider"></div>
          </div>

          <div style="font-size:15px;line-height:1.8;color:var(--text-main);">
            <p><strong>Последнее обновление:</strong> 1 января <?php echo date('Y'); ?> г.</p>

            <h5>1. Принятие условий</h5>
            <p>Использование сайта Музея СПбГМТУ означает полное и безоговорочное принятие настоящего Соглашения. Если вы не согласны с условиями, пожалуйста, прекратите использование сайта.</p>

            <h5>2. Интеллектуальная собственность</h5>
            <p>Все материалы сайта (тексты, фотографии, дизайн, логотипы) являются собственностью Музея СПбГМТУ или размещены с разрешения правообладателей. Копирование и распространение без письменного согласия запрещено.</p>

            <h5>3. Ограничение ответственности</h5>
            <p>Музей не несёт ответственности за возможную недостоверность, неточность или устаревание информации на сайте. Сведения об экспонатах и часах работы могут изменяться.</p>

            <h5>4. Внешние ссылки</h5>
            <p>Сайт может содержать ссылки на внешние ресурсы. Музей не несёт ответственности за содержание и политику конфиденциальности таких ресурсов.</p>

            <h5>5. Применимое право</h5>
            <p>Настоящее Соглашение регулируется законодательством Российской Федерации.</p>
          </div>
        </div>

        <hr class="my-5">

        <!-- ─── Новости ────────────────────────────────────────────────────── -->
        <div id="news" class="anchor-offset">
          <div class="section-header">
            <span class="section-label">Последние события</span>
            <h2 class="section-title">Новости музея</h2>
            <div class="section-divider"></div>
          </div>

          <?php
          // Последние 5 записей WordPress (новости)
          $news = new WP_Query([
              'post_type'      => 'post',
              'posts_per_page' => 5,
              'orderby'        => 'date',
              'order'          => 'DESC',
          ]);

          if ($news->have_posts()) :
              while ($news->have_posts()) : $news->the_post(); ?>
                <div class="doc-item fade-in">
                  <i class="bi bi-newspaper doc-icon" style="color:var(--navy);"></i>
                  <div class="doc-info">
                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                    <small><?php echo get_the_date('d.m.Y'); ?></small>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="doc-download" title="Читать">
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              <?php endwhile;
              wp_reset_postdata();
          else : ?>
            <!-- Плейсхолдеры новостей — добавьте записи через Записи → Добавить новую -->
            <?php
            $demo_news = [
                ['Обновление экспозиции «Годы войны»',    '15.05.' . date('Y')],
                ['Открытие лекционного зала после ремонта', '01.04.' . date('Y')],
                ['Музей отмечает 83-летие со дня основания', '12.03.' . date('Y')],
                ['Выставка к юбилею выпускника А.Н. Крылова', '28.01.' . date('Y')],
            ];
            foreach ($demo_news as $n) : ?>
              <div class="doc-item fade-in">
                <i class="bi bi-newspaper doc-icon"></i>
                <div class="doc-info">
                  <h6><?php echo esc_html($n[0]); ?></h6>
                  <small><?php echo esc_html($n[1]); ?></small>
                </div>
                <span class="doc-download text-muted"><i class="bi bi-arrow-right"></i></span>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div><!-- /col-lg-9 -->

      <!-- Боковое оглавление (sticky) -->
      <div class="col-lg-3 d-none d-lg-block">
        <div class="contact-card" style="position:sticky;top:80px;">
          <h5 style="font-size:14px;margin-bottom:12px;">Содержание</h5>
          <ul class="list-unstyled" style="font-size:14px;">
            <li class="mb-2"><a href="#privacy"><i class="bi bi-shield-check me-1 text-gold"></i>Политика конфиденциальности</a></li>
            <li class="mb-2"><a href="#agreement"><i class="bi bi-file-earmark-check me-1 text-gold"></i>Пользовательское соглашение</a></li>
            <li class="mb-2"><a href="#news"><i class="bi bi-newspaper me-1 text-gold"></i>Новости музея</a></li>
          </ul>
          <hr>
          <p style="font-size:13px;color:var(--text-muted);">По вопросам конфиденциальности:</p>
          <p style="font-size:13px;">
            <a href="mailto:<?php echo esc_attr(museum_opt('email', 'museum@smtu.ru')); ?>">
              <i class="bi bi-envelope me-1"></i><?php echo museum_opt('email', 'museum@smtu.ru'); ?>
            </a>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
