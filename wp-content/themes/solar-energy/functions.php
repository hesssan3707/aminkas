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

    // Basic JSON validation
    $en_valid = json_decode($en_json, true);
    $fa_valid = json_decode($fa_json, true);

    if ($en_json === '' || $en_valid !== null) {
      update_option('solar_energy_translations_en', $en_json);
    }
    if ($fa_json === '' || $fa_valid !== null) {
      update_option('solar_energy_translations_fa', $fa_json);
    }

    echo '<div class="updated"><p>Settings saved.</p></div>';
  }

  $en_current = get_option('solar_energy_translations_en', '');
  $fa_current = get_option('solar_energy_translations_fa', '');

  echo '<div class="wrap">';
  echo '<h1>Solar Energy Settings</h1>';
  echo '<p>Paste editable translations JSON for English and Persian (FA). These should match the structure used in the app.</p>';
  echo '<form method="post">';
  wp_nonce_field('solar_energy_options');
  echo '<h2>English (EN) Translations JSON</h2>';
  echo '<textarea name="solar_energy_translations_en" rows="18" style="width:100%;">' . esc_textarea($en_current) . '</textarea>';
  echo '<h2>Persian (FA) Translations JSON</h2>';
  echo '<textarea name="solar_energy_translations_fa" rows="18" style="width:100%;">' . esc_textarea($fa_current) . '</textarea>';
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

  // Latest posts (3)
  $recent = get_posts([
    'numberposts' => 3,
    'post_status' => 'publish',
  ]);
  $posts = [];
  foreach ($recent as $post) {
    $img = get_the_post_thumbnail_url($post->ID, 'medium');
    $posts[] = [
      'title' => get_the_title($post->ID),
      'excerpt' => wp_strip_all_tags(get_the_excerpt($post->ID)),
      'link' => get_permalink($post->ID),
      'imageUrl' => $img ? $img : 'https://picsum.photos/seed/newsfallback/600/400',
    ];
  }

  // Activities CPT (if available)
  $activities_posts = get_posts([
    'post_type' => 'activity',
    'numberposts' => -1,
    'post_status' => 'publish',
  ]);
  $activities = [];
  foreach ($activities_posts as $ap) {
    $imgA = get_the_post_thumbnail_url($ap->ID, 'medium');
    $activities[] = [
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
    wp_localize_script($handle, '__SOLAR_ACTIVITIES__', $activities);

    // Contact info overrides from plugin options, if set
    $contact_info = [
      'companyName' => get_option('solar_company_name', ''),
      'address' => get_option('solar_address', ''),
      'phone' => get_option('solar_phone', ''),
      'email' => get_option('solar_email', ''),
    ];
    wp_localize_script($handle, '__SOLAR_CONTACT_INFO__', $contact_info);
  }
}
add_action('wp_enqueue_scripts', 'solar_energy_localize_data', 20);