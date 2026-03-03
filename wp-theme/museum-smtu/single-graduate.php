<?php
/**
 * Страница одного выпускника (single post для CPT "graduate")
 */
get_header();

$year      = get_post_meta(get_the_ID(), '_graduate_year', true);
$specialty = get_post_meta(get_the_ID(), '_graduate_specialty', true);

museum_breadcrumbs([
    'Выдающиеся выпускники' => home_url('/graduates/'),
    get_the_title()         => null,
]);
?>

<div class="page-hero">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <?php if ($year || $specialty) : ?>
      <p>
        <?php if ($year) echo 'Выпуск ' . esc_html($year) . ' г.'; ?>
        <?php if ($year && $specialty) echo ' &nbsp;·&nbsp; '; ?>
        <?php if ($specialty) echo esc_html($specialty); ?>
      </p>
    <?php endif; ?>
  </div>
</div>


<section class="section-py">
  <div class="container">
    <div class="row g-5">

      <!-- Портрет и краткие данные -->
      <div class="col-lg-3">
        <div class="person-card" style="position:sticky;top:80px;">
          <div class="person-photo" style="width:140px;height:140px;font-size:56px;">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', ['class' => 'w-100 h-100', 'style' => 'object-fit:cover;border-radius:50%']); ?>
            <?php else : ?>
              <i class="bi bi-person"></i>
            <?php endif; ?>
          </div>
          <h5 style="margin-top:16px;"><?php the_title(); ?></h5>
          <?php if ($specialty) : ?>
            <span class="role"><?php echo esc_html($specialty); ?></span>
          <?php endif; ?>
          <?php if ($year) : ?>
            <p style="font-size:13px;color:var(--text-muted);margin-top:8px;">
              <i class="bi bi-mortarboard me-1 text-gold"></i>Год выпуска: <strong><?php echo esc_html($year); ?></strong>
            </p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Биография -->
      <div class="col-lg-9">
        <div class="section-header">
          <span class="section-label">Биография</span>
          <h2 class="section-title"><?php the_title(); ?></h2>
          <div class="section-divider"></div>
        </div>

        <div class="entry-content" style="font-size:16px;line-height:1.85;color:var(--text-main);">
          <?php the_content(); ?>
        </div>

        <div class="mt-5">
          <a href="<?php echo esc_url(home_url('/graduates/')); ?>" class="btn-navy">
            <i class="bi bi-arrow-left"></i> Все выпускники
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>
