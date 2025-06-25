<?php
$meta_title = ucwords($tag->name);
$title = "Blog about the " . $meta_title . " tag on " . \helper\options::options_by_key_type('site_name');
$metadata = json_decode($tag->metadata);
$meta_description = html_entity_decode($metadata->description);
if (empty($meta_description)) {
    $meta_description = 'Blog about the ' . $tag->name . ' tag';
}
$meta_keyword = strtolower($tag->name);
$domain_url = rtrim(\helper\options::options_by_key_type('base_url'), "/");
$url = $domain_url . '/blog/tag/' . $tag->slug;

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
    'site_title' => $title,
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
