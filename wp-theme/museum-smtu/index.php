<?php
/**
 * Fallback template — используется когда нет более специфичного шаблона.
 * Отображает последние записи блога (новости).
 */
get_header();
?>

<div class="page-hero">
  <div class="container">
    <h1><?php the_archive_title(); ?></h1>
    <p><?php the_archive_description(); ?></p>
  </div>
</div>

<section class="section-py">
  <div class="container">
    <?php if (have_posts()) : ?>
      <div class="row g-4">
        <?php while (have_posts()) : the_post(); ?>
          <div class="col-md-6 col-lg-4">
            <div class="section-card h-100">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>" class="section-card-img">
              <?php else : ?>
                <div class="section-card-img-placeholder"><i class="bi bi-newspaper"></i></div>
              <?php endif; ?>
              <div class="section-card-body">
                <h4><?php the_title(); ?></h4>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>">Читать далее <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <div class="mt-5 d-flex justify-content-center">
        <?php the_posts_pagination(['mid_size' => 2]); ?>
      </div>

    <?php else : ?>
      <p class="text-muted text-center py-5">Записи не найдены.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
