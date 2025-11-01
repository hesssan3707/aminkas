<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF--8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Vazirmatn', sans-serif;
      }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class("bg-gray-50 text-gray-800"); ?>>
    <header class="bg-white shadow-md sticky top-0 z-50">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
          <div class="flex items-center cursor-pointer" onclick="location.href='<?php echo home_url(); ?>';">
            <svg class="h-8 w-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-6.364-.386 1.591-1.591M3 12h2.25m.386-6.364 1.591 1.591M12 12a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" /></svg>
            <h1 class="ms-2 text-xl font-bold text-gray-800"><?php bloginfo('name'); ?></h1>
          </div>

          <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => 'div',
                'container_class' => 'hidden md:flex items-center space-x-4 lg:space-x-8',
                'menu_class'     => '',
                'items_wrap'     => '%3$s', // Outputs only the <li> items
                'depth'          => 1,
                // A custom walker will be needed to style the a tags correctly with tailwind
            ) );
          ?>

          <div class="md:hidden flex items-center">
            <button id="mobile-menu-button">
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </button>
          </div>
        </div>
      </div>

      <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <?php
          wp_nav_menu( array(
              'theme_location' => 'primary',
              'container'      => 'div',
              'container_class' => 'px-2 pt-2 pb-3 space-y-1 sm:px-3',
              'menu_class'     => '',
              'items_wrap'     => '%3$s', // Outputs only the <li> items
              'depth'          => 1,
              // A custom walker will be needed to style the a tags correctly with tailwind
          ) );
        ?>
      </div>
    </header>
    <main class="min-h-screen">
