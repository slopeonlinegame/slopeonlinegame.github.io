<?php
$keywords = $slug;
if (!$keywords) {
    load_response()->redirect('/new-games');
}

// $title = "Search Results: <em class='fw-bolder'>$keywords</em>";
$title = ' Search « <span class="search-target">' . $keywords . ' </span> »';
// $arr_bread = array(
//     array(
//         "name" => "Search",
//     ),
// );
$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_search', array('keywords' => $keywords));
echo \helper\themes::get_layout('header', array('slug' => $slug, 'custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('keywords' => $keywords, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('game_item', array('keywords' => $keywords, 'title' => $title, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');
