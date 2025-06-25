<?php
$site_name = \helper\options::options_by_key_type('site_name');
$title = "Online games blog on " . $site_name;
$meta_description = 'Blog page, where you want to learn and share gaming knowledge at ' . $site_name;
$site_keywords = strtolower('blog page on ' . $site_name);

$domain_url = rtrim(\helper\options::options_by_key_type('base_url'), "/");
$url = $domain_url . '/blog';

$thumb = \helper\options::options_by_key_type('favicon');
$banner = \helper\options::options_by_key_type('logo');
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$favicon512 = \helper\image::get_thumbnail($thumb, 512, 512, 'm');
$data = array(
    'site_title' => $title,
    'site_description' => $meta_description,
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
