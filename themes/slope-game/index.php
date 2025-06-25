<?php
$slug = \helper\options::options_by_key_type('slug_home');
$game = \helper\game::find_by_slug($slug);
if ($game == null) {
    load_response()->redirect('/new-games');
}
$post = \helper\posts::find_by_slug($slug);
if ($post != null) {
    $game->content = $post->content;
    $game->excerpt = $post->excerpt;
}
$metadata = json_decode($game->metadata);
if ($metadata->external == 'yes') {
    $external = \helper\menu::find_menu_by_menugroup('external');
}
$enable_ads = \helper\game::get_ads_control();

$is_blog = false;
if ($is_blog) {
    $title_blog = '<h2 class="info_text title_block"><a title="How to Craft" href="/blog/category/crafting-guide" target="_blank">Blog section</a></h2>';
    $page_blog = 1;
    $limit_blog = 6;
    $category_id_blog = null;
    $keywords_blog = 'How to';
    $order_by_blog = "id";
    $order_type_blog = 'DESC';
    $posts = \helper\posts::paging($page_blog, $limit_blog, $category_id_blog, $keywords_blog, $is_hot_blog, $order_by_blog, $order_type_blog, $not_equal_blog, $format_blog);
}

$custom = \helper\themes::get_layout('header/metadata_home');
echo \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => $is_blog, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads, 'external' => $external));
echo \helper\themes::get_layout('game_play', array('game' => $game, 'enable_ads' => $enable_ads, 'title_blog' => $title_blog, 'posts' => $posts));
echo \helper\themes::get_layout('header/richtext_home', array('game' => $game));
echo \helper\themes::get_layout('footer', array('is_game_play' => true));
