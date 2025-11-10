<?php
// Theme setup
function solar_energy_setup() {
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'solar_energy_setup');

// Enqueue fonts, Tailwind CDN, and React build assets
function solar_energy_scripts() {
  // Google Fonts for bilingual typography
  wp_enqueue_style(
    'solar-fonts',
    'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&family=Poppins:wght@300;400;500;700&display=swap',
    [],
    null
  );

  // Tailwind via CDN (as used by the template)
  wp_enqueue_script(
    'solar-tailwind',
    'https://cdn.tailwindcss.com',
    [],
    null,
    false
  );

  // Load built React assets from react-dist/assets
  $assets_dir = get_template_directory() . '/react-dist/assets';
  if (is_dir($assets_dir)) {
    // JS bundle
    $js_files = glob($assets_dir . '/index-*.js');
    if ($js_files) {
      usort($js_files, function($a, $b) {
        $ma = @filemtime($a);
        $mb = @filemtime($b);
        if ($ma === $mb) { return 0; }
        return ($ma < $mb) ? 1 : -1; // newest first
      });
      $js_file = basename($js_files[0]);
      wp_enqueue_script(
        'solar-react',
        get_template_directory_uri() . '/react-dist/assets/' . $js_file,
        [],
        null,
        true
      );
    }

    // CSS bundle (if present)
    $css_files = glob($assets_dir . '/index-*.css');
    if ($css_files) {
      usort($css_files, function($a, $b) {
        $ma = @filemtime($a);
        $mb = @filemtime($b);
        if ($ma === $mb) { return 0; }
        return ($ma < $mb) ? 1 : -1; // newest first
      });
      $css_file = basename($css_files[0]);
      wp_enqueue_style(
        'solar-react',
        get_template_directory_uri() . '/react-dist/assets/' . $css_file,
        [],
        null
      );
    }
  }
}
add_action('wp_enqueue_scripts', 'solar_energy_scripts');

// Admin options page to edit translations (EN/FA)
function solar_energy_add_admin_menu() {
  add_menu_page(
    'Solar Energy Settings',
    'Solar Energy',
    'manage_options',
    'solar-energy-settings',
    'solar_energy_options_page_render',
    'dashicons-admin-generic',
    61
  );
}
add_action('admin_menu', 'solar_energy_add_admin_menu');

function solar_energy_options_page_render() {
  if (!current_user_can('manage_options')) return;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_admin_referer('solar_energy_options');
    $en_json = isset($_POST['solar_energy_translations_en']) ? wp_unslash($_POST['solar_energy_translations_en']) : '';
    $fa_json = isset($_POST['solar_energy_translations_fa']) ? wp_unslash($_POST['solar_energy_translations_fa']) : '';

    // Theme settings inputs
    $site_title_en = isset($_POST['solar_theme_site_title_en']) ? sanitize_text_field(wp_unslash($_POST['solar_theme_site_title_en'])) : '';
    $site_title_fa = isset($_POST['solar_theme_site_title_fa']) ? sanitize_text_field(wp_unslash($_POST['solar_theme_site_title_fa'])) : '';
    $address_en = isset($_POST['solar_theme_address_en']) ? sanitize_text_field(wp_unslash($_POST['solar_theme_address_en'])) : '';
    $address_fa = isset($_POST['solar_theme_address_fa']) ? sanitize_text_field(wp_unslash($_POST['solar_theme_address_fa'])) : '';
    $phone_opt = isset($_POST['solar_theme_phone']) ? sanitize_text_field(wp_unslash($_POST['solar_theme_phone'])) : '';
    $email_opt = isset($_POST['solar_theme_email']) ? sanitize_email(wp_unslash($_POST['solar_theme_email'])) : '';

    // Basic JSON validation
    $en_valid = json_decode($en_json, true);
    $fa_valid = json_decode($fa_json, true);

    if ($en_json === '' || $en_valid !== null) {
      update_option('solar_energy_translations_en', $en_json);
    }
    if ($fa_json === '' || $fa_valid !== null) {
      update_option('solar_energy_translations_fa', $fa_json);
    }

    // Save theme settings options
    update_option('solar_theme_site_title_en', $site_title_en);
    update_option('solar_theme_site_title_fa', $site_title_fa);
    update_option('solar_theme_address_en', $address_en);
    update_option('solar_theme_address_fa', $address_fa);
    if ($phone_opt) update_option('solar_theme_phone', $phone_opt);
    if ($email_opt) update_option('solar_theme_email', $email_opt);

    echo '<div class="updated"><p>Settings saved.</p></div>';
  }

  $en_current = get_option('solar_energy_translations_en', '');
  $fa_current = get_option('solar_energy_translations_fa', '');
  $site_title_en_cur = get_option('solar_theme_site_title_en', '');
  $site_title_fa_cur = get_option('solar_theme_site_title_fa', '');
  $address_en_cur = get_option('solar_theme_address_en', '');
  $address_fa_cur = get_option('solar_theme_address_fa', '');
  $phone_cur = get_option('solar_theme_phone', '');
  $email_cur = get_option('solar_theme_email', '');

  echo '<div class="wrap">';
  echo '<h1>Solar Energy Settings</h1>';
  echo '<p>Paste editable translations JSON for English and Persian (FA). These should match the structure used in the app.</p>';
  echo '<form method="post">';
  wp_nonce_field('solar_energy_options');
  echo '<h2>English (EN) Translations JSON</h2>';
  echo '<textarea name="solar_energy_translations_en" rows="18" style="width:100%;">' . esc_textarea($en_current) . '</textarea>';
  echo '<h2>Persian (FA) Translations JSON</h2>';
  echo '<textarea name="solar_energy_translations_fa" rows="18" style="width:100%;">' . esc_textarea($fa_current) . '</textarea>';
  echo '<hr />';
  echo '<h2>Theme Settings</h2>';
  echo '<table class="form-table">';
  echo '<tr><th scope="row"><label for="solar_theme_site_title_en">Site Title (EN)</label></th><td><input type="text" id="solar_theme_site_title_en" name="solar_theme_site_title_en" value="' . esc_attr($site_title_en_cur) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_theme_site_title_fa">Site Title (FA)</label></th><td><input type="text" id="solar_theme_site_title_fa" name="solar_theme_site_title_fa" value="' . esc_attr($site_title_fa_cur) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_theme_address_en">Address (EN)</label></th><td><input type="text" id="solar_theme_address_en" name="solar_theme_address_en" value="' . esc_attr($address_en_cur) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_theme_address_fa">Address (FA)</label></th><td><input type="text" id="solar_theme_address_fa" name="solar_theme_address_fa" value="' . esc_attr($address_fa_cur) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_theme_phone">Phone</label></th><td><input type="text" id="solar_theme_phone" name="solar_theme_phone" value="' . esc_attr($phone_cur) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_theme_email">Email</label></th><td><input type="email" id="solar_theme_email" name="solar_theme_email" value="' . esc_attr($email_cur) . '" class="regular-text" /></td></tr>';
  echo '</table>';
  echo '<p><input type="submit" class="button button-primary" value="Save Changes" /></p>';
  echo '</form>';
  echo '</div>';
}

// Localize editable translations and latest posts into the React app
function solar_energy_localize_data() {
  // Attempt to decode saved translations
  $en_json = get_option('solar_energy_translations_en', '');
  $fa_json = get_option('solar_energy_translations_fa', '');
  $en = $en_json ? json_decode($en_json, true) : null;
  $fa = $fa_json ? json_decode($fa_json, true) : null;

  // Latest posts by language (3 each)
  $posts = [];
  $posts_en = [];
  $posts_fa = [];
  // Resolve language categories if present (names: انگلیسی for EN, فارسی for FA)
  $cat_en = get_term_by('name', 'انگلیسی', 'category');
  $cat_fa = get_term_by('name', 'فارسی', 'category');
  $cat_en_id = $cat_en ? intval($cat_en->term_id) : 0;
  $cat_fa_id = $cat_fa ? intval($cat_fa->term_id) : 0;
  // All recent
  $recent_all = get_posts([
    'numberposts' => 3,
    'post_status' => 'publish',
  ]);
  foreach ($recent_all as $post_item) {
    $img = get_the_post_thumbnail_url($post_item->ID, 'medium');
    $posts[] = [
      'title' => get_the_title($post_item->ID),
      'excerpt' => wp_strip_all_tags(get_the_excerpt($post_item->ID)),
      'link' => get_permalink($post_item->ID),
      'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
    ];
  }
  // Language-specific posts via categories if available; otherwise fall back to solar_language taxonomy
  if ($cat_en_id || $cat_fa_id) {
    // English posts: in "انگلیسی" category
    if ($cat_en_id) {
      $recent_en_lang = get_posts([
        'numberposts' => -1,
        'post_status' => 'publish',
        'category__in' => [$cat_en_id],
      ]);
      foreach ($recent_en_lang as $post_item) {
        $img = get_the_post_thumbnail_url($post_item->ID, 'medium');
        $posts_en[] = [
          'title' => get_the_title($post_item->ID),
          'excerpt' => wp_strip_all_tags(get_the_excerpt($post_item->ID)),
          'link' => get_permalink($post_item->ID),
          'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
        ];
      }
    }
    // Persian posts: in "فارسی" category
    if ($cat_fa_id) {
      $recent_fa_lang = get_posts([
        'numberposts' => -1,
        'post_status' => 'publish',
        'category__in' => [$cat_fa_id],
      ]);
      foreach ($recent_fa_lang as $post_item) {
        $img = get_the_post_thumbnail_url($post_item->ID, 'medium');
        $posts_fa[] = [
          'title' => get_the_title($post_item->ID),
          'excerpt' => wp_strip_all_tags(get_the_excerpt($post_item->ID)),
          'link' => get_permalink($post_item->ID),
          'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
        ];
      }
    }
    // Other categories: include in both languages
    $exclude_ids = array_values(array_filter([$cat_en_id, $cat_fa_id]));
    if (!empty($exclude_ids)) {
      $recent_other = get_posts([
        'numberposts' => -1,
        'post_status' => 'publish',
        'category__not_in' => $exclude_ids,
      ]);
      foreach ($recent_other as $post_item) {
        $img = get_the_post_thumbnail_url($post_item->ID, 'medium');
        $common = [
          'title' => get_the_title($post_item->ID),
          'excerpt' => wp_strip_all_tags(get_the_excerpt($post_item->ID)),
          'link' => get_permalink($post_item->ID),
          'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
        ];
        $posts_en[] = $common;
        $posts_fa[] = $common;
      }
    }
  } else {
    // Fallback to solar_language taxonomy if the specified categories are not found
    // EN
    $recent_en = get_posts([
      'numberposts' => 3,
      'post_status' => 'publish',
      'tax_query' => [
        [
          'taxonomy' => 'solar_language',
          'field' => 'slug',
          'terms' => ['en'],
        ]
      ]
    ]);
    foreach ($recent_en as $post_item) {
      $img = get_the_post_thumbnail_url($post_item->ID, 'medium');
      $posts_en[] = [
        'title' => get_the_title($post_item->ID),
        'excerpt' => wp_strip_all_tags(get_the_excerpt($post_item->ID)),
        'link' => get_permalink($post_item->ID),
        'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
      ];
    }
    // FA
    $recent_fa = get_posts([
      'numberposts' => 3,
      'post_status' => 'publish',
      'tax_query' => [
        [
          'taxonomy' => 'solar_language',
          'field' => 'slug',
          'terms' => ['fa'],
        ]
      ]
    ]);
    foreach ($recent_fa as $post_item) {
      $img = get_the_post_thumbnail_url($post_item->ID, 'medium');
      $posts_fa[] = [
        'title' => get_the_title($post_item->ID),
        'excerpt' => wp_strip_all_tags(get_the_excerpt($post_item->ID)),
        'link' => get_permalink($post_item->ID),
        'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
      ];
    }
  }

  // Activities CPT (if available), with language filtering
  $activities = [];
  $activities_en = [];
  $activities_fa = [];
  $activities_all = get_posts([
    'post_type' => 'activity',
    'numberposts' => -1,
    'post_status' => 'publish',
  ]);
  foreach ($activities_all as $ap) {
    $imgA = get_the_post_thumbnail_url($ap->ID, 'medium');
    $activities[] = [
      'title' => get_the_title($ap->ID),
      'text' => wp_strip_all_tags(has_excerpt($ap->ID) ? get_the_excerpt($ap->ID) : wp_trim_words($ap->post_content, 30)),
      'imageUrl' => $imgA ? $imgA : null,
    ];
  }
  $activities_en_posts = get_posts([
    'post_type' => 'activity',
    'numberposts' => -1,
    'post_status' => 'publish',
    'tax_query' => [
      [
        'taxonomy' => 'solar_language',
        'field' => 'slug',
        'terms' => ['en'],
      ]
    ]
  ]);
  foreach ($activities_en_posts as $ap) {
    $imgA = get_the_post_thumbnail_url($ap->ID, 'medium');
    $activities_en[] = [
      'title' => get_the_title($ap->ID),
      'text' => wp_strip_all_tags(has_excerpt($ap->ID) ? get_the_excerpt($ap->ID) : wp_trim_words($ap->post_content, 30)),
      'imageUrl' => $imgA ? $imgA : null,
    ];
  }
  $activities_fa_posts = get_posts([
    'post_type' => 'activity',
    'numberposts' => -1,
    'post_status' => 'publish',
    'tax_query' => [
      [
        'taxonomy' => 'solar_language',
        'field' => 'slug',
        'terms' => ['fa'],
      ]
    ]
  ]);
  foreach ($activities_fa_posts as $ap) {
    $imgA = get_the_post_thumbnail_url($ap->ID, 'medium');
    $activities_fa[] = [
      'title' => get_the_title($ap->ID),
      'text' => wp_strip_all_tags(has_excerpt($ap->ID) ? get_the_excerpt($ap->ID) : wp_trim_words($ap->post_content, 30)),
      'imageUrl' => $imgA ? $imgA : null,
    ];
  }

  // Ensure the React bundle is registered before localization
  $handle = 'solar-react';
  if (wp_script_is($handle, 'enqueued')) {
    wp_localize_script($handle, '__SOLAR_TRANSLATIONS__', [
      'en' => $en ?: null,
      'fa' => $fa ?: null,
    ]);
    wp_localize_script($handle, '__SOLAR_POSTS__', $posts);
    wp_localize_script($handle, '__SOLAR_POSTS_EN__', $posts_en);
    wp_localize_script($handle, '__SOLAR_POSTS_FA__', $posts_fa);
    wp_localize_script($handle, '__SOLAR_ACTIVITIES__', $activities);
    wp_localize_script($handle, '__SOLAR_ACTIVITIES_EN__', $activities_en);
    wp_localize_script($handle, '__SOLAR_ACTIVITIES_FA__', $activities_fa);

    // Site info from WordPress general settings and theme settings overrides
    $site_title_en_opt = get_option('solar_theme_site_title_en', '');
    $site_title_fa_opt = get_option('solar_theme_site_title_fa', '');
    $address_en_opt = get_option('solar_theme_address_en', '');
    $address_fa_opt = get_option('solar_theme_address_fa', '');
    $phone_opt = get_option('solar_theme_phone', '');
    $email_opt = get_option('solar_theme_email', '');
    $site_info = [
      'title' => get_bloginfo('name'),
      'title_en' => $site_title_en_opt ?: null,
      'title_fa' => $site_title_fa_opt ?: null,
      'description' => get_bloginfo('description'),
      'homeUrl' => home_url('/'),
      'siteUrl' => site_url('/'),
      'adminEmail' => get_option('admin_email'),
      'language' => get_locale(),
      'address_en' => $address_en_opt ?: null,
      'address_fa' => $address_fa_opt ?: null,
      'phone' => $phone_opt ?: null,
      'email' => $email_opt ?: null,
    ];
    wp_localize_script($handle, '__SOLAR_SITE__', $site_info);

    // Contact info overrides from plugin options, with sane fallbacks
    $company_name = get_option('solar_company_name', '');
    if (!$company_name) { $company_name = get_bloginfo('name'); }
    $email_override = get_option('solar_email', '');
    if (!$email_override) { $email_override = get_option('admin_email'); }
    $contact_info = [
      'companyName' => $company_name,
      'address' => get_option('solar_address', ''),
      'phone' => get_option('solar_phone', ''),
      'email' => $email_override,
      // Bilingual overrides from theme settings
      'companyNameEn' => get_option('solar_theme_site_title_en', ''),
      'companyNameFa' => get_option('solar_theme_site_title_fa', ''),
      'addressEn' => get_option('solar_theme_address_en', ''),
      'addressFa' => get_option('solar_theme_address_fa', ''),
    ];
    wp_localize_script($handle, '__SOLAR_CONTACT_INFO__', $contact_info);
  }
}
add_action('wp_enqueue_scripts', 'solar_energy_localize_data', 20);