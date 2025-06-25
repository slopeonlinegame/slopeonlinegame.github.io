<?php

$site_title = \helper\options::options_by_key_type('site_title');
switch ($slug) {
    case 'about-us':
        $title = 'About Us';
        break;
    case 'copyright-infringement-notice-procedure':
        $title = 'Copyright Infringement Notice Procedure';
        break;
    case 'contact-us':
        $title = 'Contact Us';
        break;
    case 'privacy-policy':
        $title = 'privacy policy';
        break;
    case 'term-of-use':
        $title = 'Tearm Of Use';
        break;
    default:
        load_response()->redirect('/404');
        break;
}
$site_name = \helper\options::options_by_key_type('site_name');
$meta_title = ucwords($title . ' - ' . $site_name);
$meta_description = 'The information ' . $title . ' at ' . $site_name;
$meta_keyword = strtolower($title . ' ' . $site_name);
$domain_url = rtrim(\helper\options::options_by_key_type('base_url'), '/');
$url = $domain_url . '/' . $slug;
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
echo '<meta name="robots" content="noindex">';
