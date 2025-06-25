<?php
if (load_request()->is_get()) {
    // in("is_get");
    $page = (int)(load_request()->get_value('page'));
    $limit = (int)(load_request()->get_value('limit'));
    $sort = load_request()->get_value('sort');
    $url = load_request()->get_value('url');
}
if (load_request()->is_post()) {
    // in("is_post");
    $page = (int)(load_request()->post_value('page'));
    $limit = (int)(load_request()->post_value('limit'));
    $sort = load_request()->post_value('sort');
    $url = load_request()->post_value('url');
}

$datacontent = \helper\themes::get_layout('comment_paging', array('page' => $page, 'limit' => $limit, 'url' => $url, 'sort' => $sort));
echo $datacontent;
