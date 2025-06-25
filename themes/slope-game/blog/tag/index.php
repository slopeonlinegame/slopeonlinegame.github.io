<?php
$tag = \helper\tag::find_tag_by_slug($slug, 'posts');
if ($tag == null) {
    load_response()->redirect('/blog');
}
$tag_id = $tag->id;
$title = 'Blog - ' . $tag->name;
$description = $tag->description;

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_blog_tag', array('tag' => $tag));
echo \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads));
echo \helper\themes::get_layout('posts', array('tag_id' => $tag_id, 'title' => $title, 'description' => $description, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');
