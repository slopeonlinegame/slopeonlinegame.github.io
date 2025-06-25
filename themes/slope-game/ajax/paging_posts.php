<?php

$page = load_request()->request('page');
if ($page == null) {
    $page = 1;
}
$limit = load_request()->request('limit');
if (!$limit) {
    $limit = 10;
}
$category_id = load_request()->request('category_id');
$keywords = load_request()->request('keywords');
if (!$keywords) {
    $keywords = null;
}
$order_by = load_request()->request('order_by');
if (!$order_by) {
    $order_by = "id";
}
$order_type = load_request()->request('order_type');
if (!$order_type) {
    $order_type = "DESC";
}
$tag_id = load_request()->request('tag_id');
$is_hot = load_request()->request('is_hot');
if (!$is_hot) {
    $is_hot = null;
}


if ($tag_id) {
    $posts = \helper\posts::paging_by_tag($page, $limit, $tag_id, $order_by, $order_type, $not_equal);
    $paging_content = \helper\posts::paginglink_by_tag($tag_id, $page, $limit);
} else {
    $posts = \helper\posts::paging($page, $limit, $category_id, $keywords, $is_hot, $order_by, $order_type, $not_equal, $format);
    $paging_content = \helper\posts::paginglink($page, $limit, $category_id, $keywords, $is_hot, $not_equal, $format);
}


echo \helper\themes::get_layout('post_item_ajax', array('page' => $page, 'posts' => $posts, 'paging_content' => $paging_content));
