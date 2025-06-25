<?php
$title = 'Trending Game';
$description = 'Play Trending Game at ' . \helper\options::options_by_key_type('site_name');

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_trending');
echo \helper\themes::get_layout('header', array('custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads));
echo \helper\themes::get_layout('game_item', array('title' => $title, 'description' => $description, 'trending' => true, 'top' => 'MONTH', 'limit3' => 12, 'page' => 1, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');
