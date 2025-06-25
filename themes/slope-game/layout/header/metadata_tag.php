<?php
$site_title = ucwords($tag->name);
$metadata = json_decode($tag->metadata);
$meta_description = html_entity_decode($metadata->description);
if (empty($meta_description)) {
    $list_games = \helper\game::paging_by_tag($tag->id, 1, 5, 'publish_date', 'desc');
    $count = count($list_games);
    $meta_description = 'Come and enjoy the best ' . $tag->name . ':';
    foreach ($list_games as $key => $game) {
        if ($key == 4 || $key == ($count - 1)) {
            $meta_description .= ' ' . $game->name . '... ';
            break;
        }
        if ($key < 4) {
            $meta_description .= ' ' . $game->name . ',';
        }
    }
    $remove_http_desc = str_replace('http://', '', rtrim(\helper\options::options_by_key_type('base_url'), "/"));
    $remove_https_desc = str_replace('https://', '', $remove_http_desc);
    $meta_description .= 'at ' . $remove_https_desc;
}
$site_description = $meta_description;
$site_keywords = strtolower($tag->name);
$domain_url = rtrim(\helper\options::options_by_key_type('base_url'), "/");
$url = $domain_url . '/tag/' . $tag->slug;
$thumb = $tag->image;
$banner = '/' . $thumb;
if (empty($thumb)) {
    $thumb = \helper\options::options_by_key_type('favicon');
    $banner = \helper\options::options_by_key_type('logo');
}
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$favicon512 = \helper\image::get_thumbnail($thumb, 512, 512, 'm');

$data = array(
    'site_title' => $site_title,
    'site_description' => $site_description,
    'site_keywords' => $site_keywords,
    'base_url' => $url,
    'banner' => $banner,
    'favicon' => $favicon,
    'favicon57' => $favicon57,
    'favicon72' => $favicon72,
    'favicon114' => $favicon114,
    'favicon512' => $favicon512
);
echo \helper\themes::get_layout('header/metadata', $data);
