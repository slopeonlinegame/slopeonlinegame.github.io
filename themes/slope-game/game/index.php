<?php
$game = \helper\game::find_by_slug($slug);
if (!$game) {
    load_response()->redirect('/new-games');
}
$metadata = json_decode($game->metadata);
if ($metadata->external == 'yes') {
    $external = \helper\menu::find_menu_by_menugroup('external');
}
$enable_ads = \helper\game::get_ads_control();


$custom = \helper\themes::get_layout('header/metadata_game', array('game' => $game));
echo \helper\themes::get_layout('header', array('custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads, 'external' => $external));
echo \helper\themes::get_layout('game_play', array('game' => $game, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('header/richtext', array('game' => $game)); //schema
echo \helper\themes::get_layout('footer', array('is_game_play' => true));
