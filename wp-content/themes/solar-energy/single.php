<?php
/**
 * Single Post Template
 */
get_header();
?>

<div class="container mx-auto px-6 py-12">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="max-w-4xl mx-auto">
      <header class="mb-8">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-2"><?php the_title(); ?></h1>
        <p class="text-gray-500 text-sm">
          <?php echo get_the_date(); ?>
        </p>
      </header>
      <div class="prose lg:prose-xl max-w-none text-gray-700">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; else: ?>
    <p class="text-gray-600"><?php esc_html_e('Sorry, no posts matched your criteria.', 'solar-energy'); ?></p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>