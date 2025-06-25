<?php
$games = \helper\game::get_paging(null, null, '', '', 'yes', '', '', 'id', 'asc');
$category = \helper\category::find_by_taxonomy('game');
$tags = \helper\tag::find_tag_by_taxonomy('game');

$posts = \helper\posts::paging(null, null, '', '', '', 'id', 'asc', '', '');
$category_list = [];
$tags_list = [];
foreach ($posts as $item) {
  $cate = \helper\posts::find_related_category($item->id);
  if (count($cate)) {
    foreach ($cate as $c) {
      $category_list[] = $c;
    }
  }
  $tagz = \helper\posts::find_related_tag($item->id);
  if (count($tagz)) {
    foreach ($tagz as $t) {
      $tags_list[] = $t;
    }
  }
}
$category_posts = count($category_list) ? \helper\game::remove_duplicate_game($category_list) : null;
$tag_posts = count($tags_list) ? \helper\game::remove_duplicate_game($tags_list) : null;

$domain_url = \helper\options::options_by_key_type('base_url');
$domain_url = preg_replace('/([\/]+)$/', '', $domain_url);
$arr_footer = ["about-us", "copyright-infringement-notice-procedure", "contact-us", "privacy-policy", "term-of-use"];
header("Content-type: text/xml");

$str = "";
$str_head = '<?xml version="1.0" encoding="UTF-8"?> 
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
  <url> 
    <loc>' . $domain_url . '</loc>
    <changefreq>daily</changefreq>
    <priority>1.00</priority>
  </url>

  <url> 
  <loc>' . $domain_url . '/new-games' . '</loc>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
  </url>

  <url> 
  <loc>' . $domain_url . '/hot-games' . '</loc>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
  </url>
';
$str_content = '';
foreach ($games as $game) {
  $str_content .= '<url> 
    <loc>' . $domain_url . '/' . $game->slug . '</loc> 
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>';
}
foreach ($category as $ct) {
  if (\helper\game::get_count('', '', 'yes', '', '', $ct->id)) {
    $str_content .= '<url> 
      <loc>' . $domain_url . '/games/' . $ct->slug . '</loc> 
      <changefreq>daily</changefreq>
      <priority>0.9</priority>
    </url>';
  }
}
foreach ($tags as $tag) {
  if (\helper\game::count_by_tag($tag->id)) {
    $str_content .= '<url> 
      <loc>' . $domain_url . '/tag/' . $tag->slug . '</loc> 
      <changefreq>daily</changefreq>
      <priority>0.9</priority>
    </url>';
  }
}

foreach ($posts as $post) {
  $str_content .= '<url> 
    <loc>' . $domain_url . '/blog/' . $post->slug . '</loc> 
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>';
}
$str_content .= '<url> 
  <loc>' . $domain_url . '/blog' . '</loc>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
  </url>';
foreach ($category_posts as $cp) {
  $str_content .= '<url> 
      <loc>' . $domain_url . '/blog/category/' . $cp->slug . '</loc> 
      <changefreq>daily</changefreq>
      <priority>0.9</priority>
    </url>';
}
foreach ($tag_posts as $tp) {
  $str_content .= '<url> 
      <loc>' . $domain_url . '/blog/tag/' . $tp->slug . '</loc> 
      <changefreq>daily</changefreq>
      <priority>0.9</priority>
    </url>';
}

if (count($arr_footer)) {
  foreach ($arr_footer as $foobot) {
    $str_content .= '<url> 
    <loc>' . $domain_url . '/' . $foobot . '</loc> 
    <changefreq>daily</changefreq>
    <priority>0.5</priority>
  </url>';
  }
}
$str_last = '</urlset>';
$str = $str_head . $str_content . $str_last;
echo $str;
