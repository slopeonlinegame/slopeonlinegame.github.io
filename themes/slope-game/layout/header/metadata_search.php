<?php
$site_title = 'Search result with keywords: ' . $keywords;
if (empty($meta_description)) {
    $field_order = 'views';
    $order_type = 'DESC';
    $list_games = \helper\game::get_paging(1, 5, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id);
    $count = count($list_games);
    $meta_description = 'Search result with keywords "' . $keywords . '":';
    foreach ($list_games as $key => $game) {
        if ($key == 4 || $key == ($count - 1)) {
            $meta_description .= ' ' . $game->name . '... ';
            break;
        }
        if ($key < 4) {
            $meta_description .= ' ' . $game->name . ',';
        }
    }
}
$site_description = $meta_description;
$site_keywords = strtolower('search result with keywords: ' . $keywords);
$base_url = rtrim(\helper\options::options_by_key_type('base_url'), "/") . load_url()->uri();

$thumb = \helper\options::options_by_key_type('favicon');
$banner = \helper\options::options_by_key_type('logo');
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$favicon512 = \helper\image::get_thumbnail($thumb, 512, 512, 'm');

$data = array(
    'site_title' => $site_title,
    'site_description' => $site_description,
    'site_keywords' => $site_keywords,
    'base_url' => $base_url,
    'banner' => $banner,
    'favicon' => $favicon,
    'favicon57' => $favicon57,
    'favicon72' => $favicon72,
    'favicon114' => $favicon114,
    'favicon512' => $favicon512
);
echo \helper\themes::get_layout('header/metadata', $data);
