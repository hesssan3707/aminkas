<?php get_header(); ?>

<div class="container mx-auto px-6 py-12">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-12' ); ?>>
                <header class="entry-header mb-4">
                    <?php the_title( sprintf( '<h2 class="entry-title text-3xl font-bold leading-tight mb-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail mb-4">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'rounded-lg shadow-lg' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content prose lg:prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;

        the_posts_pagination(
            array(
                'prev_text' => __( 'قبلی', 'solarenergy' ),
                'next_text' => __( 'بعدی', 'solarenergy' ),
            )
        );

    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
</div>

<?php get_footer(); ?>
