<?php

function solarenergy_setup() {
    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'solarenergy' ),
    ) );
}
add_action( 'after_setup_theme', 'solarenergy_setup' );

function solarenergy_scripts() {
    wp_enqueue_script( 'solarenergy-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'solarenergy_scripts' );

/**
 * Import sample content when the theme is activated.
 */
function solarenergy_import_sample_content() {
    // Check if the content has already been imported
    if ( get_option( 'solarenergy_content_imported' ) ) {
        return;
    }

    // --- Create Pages ---
    $pages = array(
        'خانه' => array(
            'content' => '<!-- wp:paragraph --><p>به شرکت انرژی خورشیدی ما خوش آمدید. ما پیشرو در ارائه راهکارهای انرژی پاک و پایدار هستیم.</p><!-- /wp:paragraph -->',
        ),
        'درباره ما' => array(
            'content' => '<!-- wp:paragraph --><p>ما تیمی از متخصصان هستیم که به آینده‌ای سبزتر متعهدیم. درباره ماموریت و چشم‌انداز ما بیشتر بدانید.</p><!-- /wp:paragraph -->',
        ),
        'فعالیت‌ها' => array(
            'content' => '<!-- wp:paragraph --><p>ما طیف گسترده‌ای از خدمات، از جمله نصب پنل‌های خورشیدی، مشاوره و نگهداری را ارائه می‌دهیم.</p><!-- /wp:paragraph -->',
        ),
        'اخبار' => array(
            'content' => '<!-- wp:paragraph --><p>آخرین اخبار و مقالات درباره انرژی‌های تجدیدپذیر را در این بخش دنبال کنید.</p><!-- /wp:paragraph -->',
        ),
        'تماس با ما' => array(
            'content' => '<!-- wp:paragraph --><p>برای دریافت مشاوره رایگان یا کسب اطلاعات بیشتر با ما در تماس باشید.</p><!-- /wp:paragraph -->',
        ),
    );

    foreach ( $pages as $title => $page_data ) {
        $page = get_page_by_title( $title );
        if ( ! $page ) {
            wp_insert_post( array(
                'post_title'   => $title,
                'post_content' => $page_data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
        }
    }

    // --- Create Sample Posts ---
    $posts = array(
        'مزایای استفاده از انرژی خورشیدی' => array(
            'content' => '<!-- wp:paragraph --><p>انرژی خورشیدی یکی از پاک‌ترین منابع انرژی است که به کاهش آلودگی هوا و مقابله با تغییرات اقلیمی کمک می‌کند.</p><!-- /wp:paragraph -->',
        ),
        'چگونه پنل‌های خورشیدی کار می‌کنند؟' => array(
            'content' => '<!-- wp:paragraph --><p>در این مقاله به بررسی فرآیند تبدیل نور خورشید به الکتریسیته توسط سلول‌های فتوولتائیک می‌پردازیم.</p><!-- /wp:paragraph -->',
        ),
        'آینده انرژی‌های تجدیدپذیر' => array(
            'content' => '<!-- wp:paragraph --><p>با پیشرفت تکنولوژی، هزینه‌های تولید انرژی‌های تجدیدپذیر به سرعت در حال کاهش است و آینده‌ای روشن در انتظار ماست.</p><!-- /wp:paragraph -->',
        ),
    );

    foreach ( $posts as $title => $post_data ) {
        $post = get_page_by_title( $title, OBJECT, 'post' );
        if ( ! $post ) {
            wp_insert_post( array(
                'post_title'   => $title,
                'post_content' => $post_data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
            ) );
        }
    }

    // --- Upload and Attach Images ---
    if ( ! function_exists( 'media_handle_upload' ) ) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
    }

    $image_dir = get_template_directory() . '/assets/images/';
    $images = array(
        'hero.svg' => 'خانه',
        'placeholder-1.svg' => 'مزایای استفاده از انرژی خورشیدی',
        'placeholder-2.svg' => 'چگونه پنل‌های خورشیدی کار می‌کنند؟',
    );

    foreach ( $images as $filename => $parent_title ) {
        $parent_post = get_page_by_title( $parent_title, OBJECT, 'page' );
        if ( ! $parent_post ) {
            $parent_post = get_page_by_title( $parent_title, OBJECT, 'post' );
        }

        if ( $parent_post && ! has_post_thumbnail( $parent_post->ID ) ) {
            $filepath = $image_dir . $filename;
            if ( file_exists( $filepath ) ) {
                $file_array = array(
                    'name'     => basename( $filepath ),
                    'tmp_name' => $filepath,
                );

                // Need to upload the file to the uploads directory first.
                $upload = wp_upload_bits( $file_array['name'], null, file_get_contents( $filepath ) );
                if ( ! $upload['error'] ) {
                    $file_path = $upload['file'];
                    $file_name = basename( $file_path );
                    $file_type = wp_check_filetype( $file_name, null );
                    $attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
                    $wp_upload_dir = wp_upload_dir();

                    $post_info = array(
                        'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
                        'post_mime_type' => $file_type['type'],
                        'post_title'     => $attachment_title,
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    // Create the attachment
                    $attach_id = wp_insert_attachment( $post_info, $file_path, $parent_post->ID );
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                    set_post_thumbnail( $parent_post->ID, $attach_id );
                }
            }
        }
    }

    // --- Set Front Page and Posts Page ---
    $front_page = get_page_by_title( 'خانه' );
    $blog_page  = get_page_by_title( 'اخبار' );

    if ( $front_page && $blog_page ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
        update_option( 'page_for_posts', $blog_page->ID );
    }

    // Set a flag to prevent duplicate imports
    update_option( 'solarenergy_content_imported', true );
}
add_action( 'after_switch_theme', 'solarenergy_import_sample_content' );

?>
