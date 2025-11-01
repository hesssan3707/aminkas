<?php
/*
 * Template Name: About Us
 */

get_header();
?>

<div class="animate-fadeIn py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-6">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header text-center mb-12">
                    <?php the_title( '<h1 class="text-4xl lg:text-5xl font-bold text-gray-800">', '</h1>' ); ?>
                </header>

                <div class="entry-content prose lg:prose-xl max-w-4xl mx-auto text-gray-600 leading-relaxed text-justify">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</div>

<?php
get_footer();
