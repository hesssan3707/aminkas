<?php
/**
 * Theme Header
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
  <style>
    body { font-family: 'Poppins','Vazirmatn',sans-serif; }
    .font-fa { font-family: 'Vazirmatn', sans-serif; }
    .font-en { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body <?php body_class('bg-gray-50 text-gray-800'); ?>>
<div id="react-header"></div>