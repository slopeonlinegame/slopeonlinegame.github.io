<?php

$domain_url = \helper\options::options_by_key_type('base_url');
$domain_url = preg_replace('/([\/]+)$/', '', $domain_url);
$thumb = \helper\options::options_by_key_type('favicon');
if (empty($thumb)) {
    $thumb = \helper\options::options_by_key_type('logo');
}
$site_name = \helper\options::options_by_key_type('site_name');
$banner = \helper\options::options_by_key_type('banner');
$meta_title = 'Most player - ' . $site_name;
$meta_description = 'See most player game at ' . \helper\options::options_by_key_type('site_title');
$meta_keyword = 'most player, most player game';
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$base_url = $domain_url . '/most-players';
$title = $meta_title;
$description = $meta_description;
$site_keywords = $meta_keyword;
$titlefacebook = $meta_title;
$thumbfacebook = $thumb;
$urlfacebook = $url;
$desfacebook = $meta_description;
$data = array(
    'site_title' => $meta_title,
    'site_name' => $site_name,
    'site_description' => $meta_description,
    'site_keywords' => $site_keywords,
    'base_url' => $base_url,
    'banner' => $banner,
    'favicon' => $favicon,
    'twitter_appid' => $twitter_appid,
    'facebook_appid' => $facebook_appid,
);
echo \helper\themes::get_layout('header/metadata', $data);
?>
