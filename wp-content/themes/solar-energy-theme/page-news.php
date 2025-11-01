<?php
/*
 * Template Name: News
 */

get_header();
?>

<div class="animate-fadeIn py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto">
            <?php the_title( '<h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">', '</h1>' ); ?>
            <div class="prose lg:prose-lg max-w-none text-gray-600">
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        the_content();
                    }
                }
                ?>
            </div>
        </div>

        <div class="mt-16 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    ?>
                    <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2"><?php the_title(); ?></h3>
                            <div class="text-gray-600 mb-4">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:underline font-semibold"><?php echo 'بیشتر بخوانید'; ?></a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // no posts found
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
