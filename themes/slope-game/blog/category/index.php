<?php
$category = \helper\category::find_category_by_slug($slug, 'posts');
if ($category == null) {
    load_response()->redirect('/blog');
}
$category_id = $category->id;
$title = 'Blog - ' . $category->name;
$description = $category->description;

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_blog_cate', array('category' => $category));
echo \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads));
echo \helper\themes::get_layout('posts', array('category_id' => $category_id, 'title' => $title, 'description' => $description, 'category' => $category, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');
