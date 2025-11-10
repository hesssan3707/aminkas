<?php
/**
 * Plugin Name: Solar Content
 * Description: Registers custom content for the Solar Energy theme (Activities CPT), seeds sample posts, and provides simple settings for company/contact info.
 * Version: 1.0.0
 * Author: Your Company
 */

if (!defined('ABSPATH')) { exit; }

// Register Activities custom post type
function solar_content_register_cpt() {
  $labels = [
    'name' => 'Activities',
    'singular_name' => 'Activity',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Activity',
    'edit_item' => 'Edit Activity',
    'new_item' => 'New Activity',
    'view_item' => 'View Activity',
    'search_items' => 'Search Activities',
    'not_found' => 'No activities found',
    'not_found_in_trash' => 'No activities found in Trash',
    'all_items' => 'All Activities'
  ];

  register_post_type('activity', [
    'labels' => $labels,
    'public' => true,
    'has_archive' => false,
    'rewrite' => ['slug' => 'activities'],
    'show_in_rest' => true,
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    'menu_icon' => 'dashicons-solar',
  ]);
}
add_action('init', 'solar_content_register_cpt');

// Register "Language" taxonomy for posts and activities
function solar_content_register_language_taxonomy() {
  $labels = [
    'name' => 'Languages',
    'singular_name' => 'Language',
    'search_items' => 'Search Languages',
    'all_items' => 'All Languages',
    'edit_item' => 'Edit Language',
    'update_item' => 'Update Language',
    'add_new_item' => 'Add New Language',
    'new_item_name' => 'New Language Name',
    'menu_name' => 'Language',
  ];
  register_taxonomy('solar_language', ['post', 'activity'], [
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => ['slug' => 'lang'],
  ]);
}
add_action('init', 'solar_content_register_language_taxonomy', 11);

// Seed sample posts and activities
function solar_content_seed_content() {
  // Seed sample news posts (if not present)
  $samples = [
    [
      'post_title' => 'Company Completes First 100MW Solar Park',
      'post_content' => 'We are proud to announce the successful commissioning of our flagship solar park, a major milestone in our green energy journey.',
      'post_excerpt' => 'Flagship 100MW solar park commissioned.',
    ],
    [
      'post_title' => 'The Future of Solar Technology',
      'post_content' => 'An in-depth look at the upcoming innovations in photovoltaic cells and energy storage that will shape our future.',
      'post_excerpt' => 'Upcoming innovations in PV and storage.',
    ],
    [
      'post_title' => 'Making the Switch: A Guide for Businesses',
      'post_content' => 'Discover the financial and environmental benefits for businesses transitioning to solar energy with our comprehensive guide.',
      'post_excerpt' => 'Guide for businesses transitioning to solar.',
    ],
  ];

  foreach ($samples as $s) {
    $exists = get_page_by_title($s['post_title'], OBJECT, 'post');
    if (!$exists) {
      $post_id = wp_insert_post([
        'post_type' => 'post',
        'post_status' => 'publish',
        'post_title' => $s['post_title'],
        'post_content' => $s['post_content'],
        'post_excerpt' => $s['post_excerpt'],
      ]);
      if (!is_wp_error($post_id)) {
        wp_set_object_terms($post_id, ['en'], 'solar_language', false);
      }
    }
  }

  // Seed sample activities (if not present)
  $activities = [
    ['title' => 'Solar Farm Development', 'excerpt' => 'End-to-end development of utility-scale solar farms (EPC).'],
    ['title' => 'Commercial & Industrial Solutions', 'excerpt' => 'Customized solar solutions to reduce costs and boost ESG.'],
    ['title' => 'Residential Solar Systems', 'excerpt' => 'High-efficiency solar panel systems for homeowners.'],
    ['title' => 'Energy Consulting & Audits', 'excerpt' => 'Expert analysis to optimize energy consumption and integrate renewables.'],
  ];
  foreach ($activities as $a) {
    $exists = get_page_by_title($a['title'], OBJECT, 'activity');
    if (!$exists) {
      $act_id = wp_insert_post([
        'post_type' => 'activity',
        'post_status' => 'publish',
        'post_title' => $a['title'],
        'post_content' => $a['excerpt'],
        'post_excerpt' => $a['excerpt'],
      ]);
      if (!is_wp_error($act_id)) {
        wp_set_object_terms($act_id, ['en'], 'solar_language', false);
      }
    }
  }
}

// Activation hook seeds content
function solar_content_activate() {
  // Ensure CPT exists before seeding
  solar_content_register_cpt();
  solar_content_register_language_taxonomy();
  // Ensure language terms exist
  if (!term_exists('en', 'solar_language')) { wp_insert_term('en', 'solar_language'); }
  if (!term_exists('fa', 'solar_language')) { wp_insert_term('fa', 'solar_language'); }
  solar_content_seed_content();
}
register_activation_hook(__FILE__, 'solar_content_activate');

// Admin settings page for company/contact info
function solar_content_admin_menu() {
  add_menu_page(
    'Solar Content',
    'Solar Content',
    'manage_options',
    'solar-content-settings',
    'solar_content_settings_render',
    'dashicons-admin-site',
    62
  );
}
add_action('admin_menu', 'solar_content_admin_menu');

function solar_content_settings_render() {
  if (!current_user_can('manage_options')) return;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_admin_referer('solar_content_settings');
    if (isset($_POST['solar_company_name'])) update_option('solar_company_name', sanitize_text_field(wp_unslash($_POST['solar_company_name'])));
    if (isset($_POST['solar_address'])) update_option('solar_address', sanitize_text_field(wp_unslash($_POST['solar_address'])));
    if (isset($_POST['solar_phone'])) update_option('solar_phone', sanitize_text_field(wp_unslash($_POST['solar_phone'])));
    if (isset($_POST['solar_email'])) update_option('solar_email', sanitize_email(wp_unslash($_POST['solar_email'])));
    if (isset($_POST['solar_seed']) && $_POST['solar_seed'] === '1') {
      solar_content_seed_content();
    }
    echo '<div class="updated"><p>Settings saved.</p></div>';
  }

  $company = get_option('solar_company_name', 'Solar Transition Co.');
  $address = get_option('solar_address', '123 Energy Lane, Tehran, Iran');
  $phone = get_option('solar_phone', '+98 21 1234 5678');
  $email = get_option('solar_email', 'info@solartransition.com');

  echo '<div class="wrap">';
  echo '<h1>Solar Content Settings</h1>';
  echo '<form method="post">';
  wp_nonce_field('solar_content_settings');
  echo '<table class="form-table">';
  echo '<tr><th scope="row"><label for="solar_company_name">Company Name</label></th><td><input type="text" id="solar_company_name" name="solar_company_name" value="' . esc_attr($company) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_address">Address</label></th><td><input type="text" id="solar_address" name="solar_address" value="' . esc_attr($address) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_phone">Phone</label></th><td><input type="text" id="solar_phone" name="solar_phone" value="' . esc_attr($phone) . '" class="regular-text" /></td></tr>';
  echo '<tr><th scope="row"><label for="solar_email">Email</label></th><td><input type="email" id="solar_email" name="solar_email" value="' . esc_attr($email) . '" class="regular-text" /></td></tr>';
  echo '</table>';
  echo '<p><button type="submit" class="button button-primary">Save Changes</button></p>';
  echo '<h2>Seed Sample Content</h2>';
  echo '<p>This will insert example posts and activities if they don\'t exist.</p>';
  echo '<input type="hidden" name="solar_seed" value="1" />';
  echo '<p><button type="submit" class="button">Seed Content</button></p>';
  echo '</form>';
  echo '</div>';
}