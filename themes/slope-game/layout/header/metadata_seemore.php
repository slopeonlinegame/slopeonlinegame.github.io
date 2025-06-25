<?php
$domain_url = \helper\options::options_by_key_type('base_url');
$domain_url = preg_replace('/([\/]+)$/', '', $domain_url);
$thumb = $cat_game->image;
if (empty($thumb)) {
    $thumb = \helper\options::options_by_key_type('logo');
}
$meta_title = "More games at " . \helper\options::options_by_key_type('site_title');
$meta_description = 'Pick group to play on' . $domain_url;
$meta_keyword = 'see more';
$favicon = \helper\image::get_thumbnail($thumb, 60, 60, 'm');
$favicon57 = \helper\image::get_thumbnail($thumb, 57, 57, 'm');
$favicon72 = \helper\image::get_thumbnail($thumb, 72, 72, 'm');
$favicon114 = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$url = $domain_url . '/seemore';
$title = $meta_title;
$description = $meta_description;
$keywords = $meta_keyword;
$titlefacebook = $meta_title;
$thumbfacebook = $thumb;
$urlfacebook = $url;
$desfacebook = $meta_description;
?>
<title><?php echo $title ?></title>
<meta name="title" content="<?php echo $title ?>">
<meta name="description" content="<?php echo $description ?>">
<meta name="external" content="true">
<meta name="keywords" content="<?php echo $keywords ?>">
<meta http-equiv="content-language" content="en" />
<meta name="news_keywords" content="<?php echo $keywords ?>">
<?php if (\helper\options::options_by_key_type('facebook_appid', 'general') != ''): ?>
    <meta property="fb:app_id" content="<?php echo \helper\options::options_by_key_type('facebook_appid', 'general'); ?>">
<?php endif; ?>
<meta name="distribution" content="Global" />
<meta http-equiv="audience" content="General" />
<meta name="author" content="<?php echo $title ?>" />
<meta property="og:url" content="<?php echo $urlfacebook ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta name="resource-type" content="Document" />
<meta property="og:image" content="<?php echo $thumbfacebook ?>" />
<meta property="og:title" content="<?php echo $titlefacebook ?>">
<meta property="og:site_name" content="<?php echo \helper\options::options_by_key_type('site_name', 'general'); ?>">
<link rel="image_src" href="<?php echo $thumbfacebook ?>" />
<meta property="og:type" content="article" />
<?php if (\helper\options::options_by_key_type('facebook_fanpage', 'general') != ''): ?>
    <meta property="article:author" content="<?php echo \helper\options::options_by_key_type('facebook_fanpage', 'general'); ?>" />
    <meta property="article:publisher" content="<?php echo \helper\options::options_by_key_type('facebook_fanpage', 'general'); ?>" />
<?php endif; ?>
<meta property="twitter:url" content="<?php echo $urlfacebook ?>" />
<link rel="apple-touch-icon" href="<?php echo $thumbfacebook ?>"/>
<link rel="canonical" href="<?php echo \helper\files::get_canonical($urlfacebook); ?>" />
<link rel="icon" href="<?php echo $favicon ?>"/>
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $favicon57 ?>"/>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $favicon72 ?>"/>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $favicon114 ?>"/>
<?php echo $link ?>