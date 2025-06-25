<?php

$domain_url = \helper\options::options_by_key_type('base_url');
$domain_url = preg_replace('/([\/]+)$/', '', $domain_url) . '/blog/' . $post_read->slug;
$metadata = json_decode($post_read->metadata);
$thumb = $post_read->image;
if (!$thumb) {
    $thumb = \helper\options::options_by_key_type('favicon');
}
$title = "Blog | " . $metadata->title;
$site_name = \helper\options::options_by_key_type('site_name');
$banner = \helper\options::options_by_key_type('banner');
$meta_description = $metadata->description;
$site_keywords = strtolower($metadata->keywords);
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$data = array(
    'site_title' => $title,
    'site_name' => $site_name,
    'site_description' => $meta_description,
    'site_keywords' => $site_keywords,
    'base_url' => $domain_url,
    'banner' => $banner,
    'favicon' => $favicon,
    'twitter_appid' => $twitter_appid,
    'facebook_appid' => $facebook_appid,
);
echo \helper\themes::get_layout('header/metadata', $data);
?>
