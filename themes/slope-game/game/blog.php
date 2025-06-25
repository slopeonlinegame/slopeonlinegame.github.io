<?php
$title = 'Blog';
$description = "Blog games at <strong>" . \helper\options::options_by_key_type('site_name') . "</strong>";

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_blog');
echo \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads));
echo \helper\themes::get_layout('posts', array('field_order' => 'publish_date', 'title' => $title, 'description' => $description, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');
