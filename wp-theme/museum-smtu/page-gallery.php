<?php
/**
 * Template Name: Фотогалерея
 * Slug страницы: gallery
 *
 * Данные берутся из CPT "gallery_item" с таксономией "gallery_cat".
 * Добавляйте фото через WP Admin → Фотогалерея → Добавить фото.
 * Для каждого фото: заголовок, миниатюра (основное фото), категория галереи.
 */
get_header();
museum_breadcrumbs(['Фотогалерея' => null]);

// Получаем все категории галереи
$gallery_cats = get_terms([
    'taxonomy'   => 'gallery_cat',
    'hide_empty' => true,
    'orderby'    => 'menu_order',
]);

// Если категорий нет — показываем все фото без группировки
$has_cats = !is_wp_error($gallery_cats) && !empty($gallery_cats);
?>

<div class="page-hero">
  <div class="container">
    <h1>Фотогалерея</h1>
    <p>Фотографии экспонатов, залов музея, исторические снимки и архивные материалы</p>
  </div>
</div>


<section class="section-py">
  <div class="container">

    <?php if ($has_cats) : ?>

      <!-- Галерея по категориям -->
      <?php foreach ($gallery_cats as $cat) : ?>
        <?php
        $items = new WP_Query([
            'post_type'      => 'gallery_item',
            'posts_per_page' => -1,
            'tax_query'      => [[
                'taxonomy' => 'gallery_cat',
                'field'    => 'term_id',
                'terms'    => $cat->term_id,
            ]],
        ]);
        if (!$items->have_posts()) continue;
        ?>

        <div class="mb-5 fade-in">
          <div class="section-header">
            <span class="section-label">Раздел</span>
            <h2 class="section-title"><?php echo esc_html($cat->name); ?></h2>
            <div class="section-divider"></div>
            <?php if ($cat->description) : ?>
              <p class="section-desc"><?php echo esc_html($cat->description); ?></p>
            <?php endif; ?>
          </div>

          <div class="gallery-grid">
            <?php while ($items->have_posts()) : $items->the_post(); ?>
              <div class="gallery-item" data-caption="<?php echo esc_attr(get_the_title()); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <img src="<?php the_post_thumbnail_url('large'); ?>"
                       alt="<?php the_title_attribute(); ?>"
                       loading="lazy">
                <?php else : ?>
                  <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--navy),var(--navy-mid));display:flex;align-items:center;justify-content:center;font-size:48px;color:rgba(255,255,255,0.2);">🖼️</div>
                <?php endif; ?>
                <div class="gallery-item-overlay">
                  <i class="bi bi-zoom-in"></i>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        </div>

      <?php endforeach; ?>

    <?php else : ?>

      <!-- Категорий нет — выводим все фото сразу -->
      <?php
      $all_items = new WP_Query([
          'post_type'      => 'gallery_item',
          'posts_per_page' => -1,
      ]);
      ?>

      <?php if ($all_items->have_posts()) : ?>
        <div class="gallery-grid fade-in">
          <?php while ($all_items->have_posts()) : $all_items->the_post(); ?>
            <div class="gallery-item" data-caption="<?php echo esc_attr(get_the_title()); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>"
                     alt="<?php the_title_attribute(); ?>"
                     loading="lazy">
              <?php else : ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--navy),var(--navy-mid));display:flex;align-items:center;justify-content:center;font-size:48px;color:rgba(255,255,255,0.2);">🖼️</div>
              <?php endif; ?>
              <div class="gallery-item-overlay">
                <i class="bi bi-zoom-in"></i>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

      <?php else : ?>
        <!-- Плейсхолдер — пока галерея пустая -->
        <div class="text-center py-5 fade-in">
          <i class="bi bi-images" style="font-size:64px;color:var(--text-muted);"></i>
          <h3 class="mt-3 text-muted">Галерея пока пустая</h3>
          <p class="text-muted mb-4">Добавляйте фотографии через панель управления.</p>
          <?php if (current_user_can('edit_posts')) : ?>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
              <a href="<?php echo esc_url(admin_url('post-new.php?post_type=gallery_item')); ?>" class="btn-navy">
                <i class="bi bi-plus-circle"></i> Добавить фото
              </a>
              <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=gallery_cat&post_type=gallery_item')); ?>" class="btn-navy">
                <i class="bi bi-folder-plus"></i> Создать категории
              </a>
            </div>
          <?php endif; ?>
        </div>

        <!-- Demo-секция с плейсхолдерами -->
        <div class="mt-4">
          <?php
          $demo_sections = [
              ['Экспонаты', 6],
              ['Исторические фотографии', 4],
              ['Залы музея', 3],
              ['Мероприятия', 4],
          ];
          $colors = ['#0D1B33', '#1a2f52', '#1B2A4A', '#122040'];
          $i = 0;
          foreach ($demo_sections as $section) : ?>
            <div class="mb-5 fade-in">
              <div class="section-header">
                <span class="section-label">Раздел</span>
                <h2 class="section-title"><?php echo esc_html($section[0]); ?></h2>
                <div class="section-divider"></div>
              </div>
              <div class="gallery-grid">
                <?php for ($j = 0; $j < $section[1]; $j++) : ?>
                  <div class="gallery-item">
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,<?php echo $colors[$i % 4]; ?>,<?php echo $colors[($i+1) % 4]; ?>);display:flex;align-items:center;justify-content:center;font-size:48px;color:rgba(255,255,255,0.15);">🖼️</div>
                    <div class="gallery-item-overlay"><i class="bi bi-zoom-in"></i></div>
                  </div>
                <?php endfor; $i++; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
