<?php
$domain_url = rtrim(\helper\options::options_by_key_type('base_url'), "/");
if (!$favicon) {
    $favicon = \helper\options::options_by_key_type('favicon');
}
$base_url = preg_replace('/(\w+)\/\/+/', '$1/', $base_url);
if (strpos($base_url, '//') === 0) {
    $base_url = preg_replace('/^\\//', '', $base_url);
}
if (empty($banner) || $banner == '/') {
    $banner = \helper\options::options_by_key_type('logo');
}
$banner = preg_replace('/(\w+)\/\/+/', '$1/', $banner);
if (strpos($banner, '//') === 0) {
    $banner = preg_replace('/^\\//', '', $banner);
}
if (empty($site_name)) {
    $site_name = \helper\options::options_by_key_type('site_name');
}
$site_title = ucwords($site_title);
?>
<title><?= $site_title; ?></title>
<meta name="title" content="<?php echo $site_title ?>">
<meta name="description" content="<?= $site_description ?>">
<?php if (!empty($site_keywords)) : ?>
    <meta name="keywords" content="<?= strtolower($site_keywords); ?>">
    <meta name="news_keywords" content="<?= strtolower($site_keywords); ?>">
<?php endif; ?>
<link rel="canonical" href="<?= $base_url ?>">
<link rel="icon" type="image/x-icon" href="<?php echo $domain_url . $favicon; ?>" />
<link rel="apple-touch-icon" href="<?php echo $domain_url . $favicon ?>" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $domain_url . $favicon57; ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $domain_url . $favicon72; ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $domain_url . $favicon114; ?>">
<link rel="apple-touch-icon" sizes="512x512" href="<?php echo $domain_url . $favicon512; ?>">
<link rel="shortcut icon" sizes="512x512" href="<?php echo $domain_url . $favicon512; ?>">
<meta property="og:title" content="<?= $site_title; ?>" itemprop="headline" />
<meta property="og:type" content="website" />
<meta property="og:url" itemprop="url" content="<?= $base_url ?>" />
<meta property="og:image" itemprop="thumbnailUrl" content="<?= $domain_url . $banner ?>" />
<meta property="og:description" content="<?= $site_description ?>" itemprop="description" />
<meta property="og:site_name" content="<?= $site_name ?>" />
<meta name="twitter:title" content="<?= $site_title; ?>" />
<meta name="twitter:url" content="<?= $base_url ?>" />
<meta name="twitter:image" content="<?= $domain_url . $banner ?>" />
<meta name="twitter:description" content="<?= $site_description ?>">
<meta name="twitter:card" content="summary" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="<?= $site_title; ?>">
<meta name="HandheldFriendly" content="true">
<meta name="mobile-web-app-capable" content="yes">