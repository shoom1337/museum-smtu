<?php
/**
 * Template Name: Выдающиеся выпускники
 * Slug страницы: graduates
 *
 * Данные берутся из CPT "graduate".
 * Поля: _graduate_year (год окончания), _graduate_specialty (специальность).
 * Миниатюра поста — фотография выпускника.
 * Описание — excerpt или первые строки content.
 */
get_header();
museum_breadcrumbs(['Выдающиеся выпускники' => null]);

// Запрашиваем ВСЕХ выпускников (client-side фильтрация JS-ом)
$graduates = new WP_Query([
    'post_type'      => 'graduate',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value_num',
    'meta_key'       => '_graduate_year',
    'order'          => 'ASC',
]);

// Декады для табов — собираем динамически из существующих данных
$decades = [];
if ($graduates->have_posts()) {
    $tmp = clone $graduates;
    while ($tmp->have_posts()) {
        $tmp->the_post();
        $year = (int) get_post_meta(get_the_ID(), '_graduate_year', true);
        if ($year > 0) {
            $decade = (int) floor($year / 10) * 10;
            $decades[$decade] = true;
        }
    }
    wp_reset_postdata();
    ksort($decades);
}
$decades = array_keys($decades);

// Fallback-декады если CPT пустой
if (empty($decades)) {
    $decades = [1930, 1940, 1950, 1960, 1970, 1980, 1990, 2000];
}
?>

<div class="page-hero">
  <div class="container">
    <h1>Выдающиеся выпускники</h1>
    <p>База данных известных выпускников СПбГМТУ — инженеры, учёные, адмиралы, конструкторы</p>
  </div>
</div>


<section class="section-py">
  <div class="container">

    <!-- Фильтры поиска -->
    <div class="graduates-filters fade-in">
      <div class="row g-3 align-items-end">
        <div class="col-md-6">
          <label for="graduateSearch" style="font-size:13px;font-weight:600;color:var(--navy);display:block;margin-bottom:6px;">
            Поиск по имени
          </label>
          <div class="position-relative">
            <input type="text" id="graduateSearch" class="form-control"
                   placeholder="Начните вводить фамилию или имя…"
                   autocomplete="off">
            <i class="bi bi-search position-absolute" style="right:12px;top:50%;transform:translateY(-50%);color:var(--text-muted);pointer-events:none;"></i>
          </div>
        </div>
        <div class="col-md-6">
          <div style="font-size:13px;font-weight:600;color:var(--navy);margin-bottom:6px;">Период выпуска</div>
          <div class="d-flex year-tabs">
            <div class="year-tab active" data-year="all">Все годы</div>
            <?php foreach ($decades as $decade) : ?>
              <div class="year-tab" data-year="<?php echo esc_attr($decade); ?>">
                <?php echo esc_html($decade . '–' . ($decade + 9)); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Счётчик результатов -->
    <div class="d-flex justify-content-between align-items-center mb-3 fade-in">
      <p class="text-muted mb-0" style="font-size:14px;">
        Найдено: <strong id="graduatesCount"><?php echo $graduates->found_posts; ?></strong> выпускников
      </p>
      <p class="text-muted mb-0" style="font-size:13px;">
        Добавьте новых выпускников через <a href="<?php echo esc_url(admin_url('post-new.php?post_type=graduate')); ?>">панель управления</a>
      </p>
    </div>

    <!-- Список выпускников -->
    <div id="graduatesList">
      <?php if ($graduates->have_posts()) : ?>
        <?php while ($graduates->have_posts()) : $graduates->the_post(); ?>
          <?php
            $year      = (int) get_post_meta(get_the_ID(), '_graduate_year', true);
            $specialty = get_post_meta(get_the_ID(), '_graduate_specialty', true);
            $decade    = $year > 0 ? (int) floor($year / 10) * 10 : 0;
            $name_attr = mb_strtolower(get_the_title(), 'UTF-8');
          ?>
          <div class="graduate-card"
               data-name="<?php echo esc_attr($name_attr); ?>"
               data-year="<?php echo esc_attr($decade); ?>">

            <div class="graduate-avatar">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail', ['class' => 'w-100 h-100', 'style' => 'object-fit:cover;border-radius:50%']); ?>
              <?php else : ?>
                <i class="bi bi-person"></i>
              <?php endif; ?>
            </div>

            <div class="graduate-info flex-grow-1">
              <h5><?php the_title(); ?></h5>
              <?php if ($year > 0) : ?>
                <div class="graduate-year">
                  Выпуск <?php echo esc_html($year); ?> г.
                  <?php if ($specialty) : ?>
                    &nbsp;·&nbsp; <?php echo esc_html($specialty); ?>
                  <?php endif; ?>
                </div>
              <?php elseif ($specialty) : ?>
                <div class="graduate-year"><?php echo esc_html($specialty); ?></div>
              <?php endif; ?>
              <p><?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 20, '…'); ?></p>
            </div>

            <a href="<?php the_permalink(); ?>" class="btn-navy ms-auto align-self-center" style="flex-shrink:0;white-space:nowrap;font-size:13px;">
              <i class="bi bi-person-lines-fill"></i> Подробнее
            </a>

          </div>
        <?php endwhile; wp_reset_postdata(); ?>

      <?php else : ?>
        <!-- Плейсхолдеры — до наполнения базы данными выпускников -->
        <?php
        $placeholder_graduates = [
            ['Крылов Алексей Николаевич',   1900, 1950, 'Корабельный инженер', 'Выдающийся математик и механик, академик, основоположник теории корабля в России. Генерал флота, лауреат Государственной премии.'],
            ['Берг Аксель Иванович',        1904, 1950, 'Инженер флота', 'Адмирал-инженер, радиофизик, академик АН СССР. Основатель советской радиолокации, один из организаторов кибернетики в СССР.'],
            ['Руберовский Николай Петрович', 1920, 1920, 'Кораблестроитель', 'Выдающийся инженер-кораблестроитель, внёсший значительный вклад в развитие отечественного флота.'],
            ['Исанин Николай Никитич',      1935, 1930, 'Подводное кораблестроение', 'Главный конструктор ряда атомных подводных лодок первого поколения, Герой Социалистического Труда.'],
            ['Ковалёв Сергей Никитич',      1949, 1940, 'Подводное кораблестроение', 'Генеральный конструктор стратегических подводных ракетоносцев, дважды Герой Социалистического Труда.'],
            ['Перегудов Владимир Николаевич', 1937, 1930, 'Подводные лодки', 'Главный конструктор первой советской атомной подводной лодки К-3 «Ленинский комсомол».'],
        ];
        foreach ($placeholder_graduates as $g) :
            $decade = (int) floor($g[2] / 10) * 10;
        ?>
          <div class="graduate-card"
               data-name="<?php echo esc_attr(mb_strtolower($g[0], 'UTF-8')); ?>"
               data-year="<?php echo esc_attr($decade); ?>">
            <div class="graduate-avatar"><i class="bi bi-person"></i></div>
            <div class="graduate-info flex-grow-1">
              <h5><?php echo esc_html($g[0]); ?></h5>
              <div class="graduate-year">
                Выпуск <?php echo esc_html($g[1]); ?> г. &nbsp;·&nbsp; <?php echo esc_html($g[3]); ?>
              </div>
              <p><?php echo esc_html($g[4]); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Нет результатов -->
    <div id="noResults" style="display:none;" class="text-center py-5">
      <i class="bi bi-search" style="font-size:48px;color:var(--text-muted);"></i>
      <h4 class="mt-3 text-muted">Выпускник не найден</h4>
      <p class="text-muted">Попробуйте другой запрос или выберите другой период</p>
    </div>

    <!-- CTA — добавить выпускника (только для залогиненных) -->
    <?php if (current_user_can('edit_posts')) : ?>
      <div class="text-center mt-5 pt-3 border-top fade-in">
        <p class="text-muted mb-3">Вы вошли как администратор</p>
        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=graduate')); ?>" class="btn-navy">
          <i class="bi bi-plus-circle"></i> Добавить выпускника
        </a>
      </div>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
