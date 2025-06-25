<?php
$meta_title = 'Play Hot Games On ' . \helper\options::options_by_key_type('site_name');
if (empty($meta_description)) {
    $list_games = \helper\game::get_paging(1, 5, $keywords, $type, $display, $is_hot, $is_new, 'views', 'DESC');
    $count = count($list_games);
    $meta_description = 'Come and enjoy the best Hot Games:';
    foreach ($list_games as $key => $game) {
        if ($key == 4 || $key == ($count - 1)) {
            $meta_description .= ' ' . ucwords($game->name) . '... ';
            break;
        }
        if ($key < 4) {
            $meta_description .= ' ' . ucwords($game->name) . ',';
        }
    }
    $remove_http_desc = str_replace('http://', '', rtrim(\helper\options::options_by_key_type('base_url'), "/"));
    $remove_https_desc = str_replace('https://', '', $remove_http_desc);
    $meta_description .= 'at ' . $remove_https_desc;
}
$meta_keyword = 'hot games';
$domain_url = rtrim(\helper\options::options_by_key_type('base_url'), '/');
$url = $domain_url . '/hot-games';
$thumb = \helper\options::options_by_key_type('favicon');
$banner = \helper\options::options_by_key_type('logo');
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$favicon512 = \helper\image::get_thumbnail($thumb, 512, 512, 'm');

$data = array(
    'site_title' => $meta_title,
    'site_description' => $meta_description,
    'site_keywords' => $meta_keyword,
    'base_url' => $url,
    'banner' => $banner,
    'favicon' => $favicon,
    'favicon57' => $favicon57,
    'favicon72' => $favicon72,
    'favicon114' => $favicon114,
    'favicon512' => $favicon512
);
echo \helper\themes::get_layout('header/metadata', $data);
