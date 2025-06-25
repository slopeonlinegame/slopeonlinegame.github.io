<?php
if (load_request()->is_get()) {
    // in("is_get");
    $content = load_request()->get_value('content');
    $email = load_request()->get_value('email');
    $author = load_request()->get_value('author');
    $related_url = load_request()->get_value('related_url');
    $related_id = load_request()->get_value('related_id');
    $website = load_request()->get_value('website');
    $parent_id = load_request()->get_value('parent_id');
}

if (load_request()->is_post()) {
    // in("is_post");
    $content = load_request()->post_value('content');
    $email = load_request()->post_value('email');
    $author = load_request()->post_value('author');
    $related_url = load_request()->post_value('related_url');
    $related_id = load_request()->post_value('related_id');
    $website = load_request()->post_value('website');
    $parent_id = load_request()->post_value('parent_id');
}

if ($content != null && $email != null && $author != null && $related_url != null && $related_id != null) {
    $parent_id = ($parent_id != null && (int)$parent_id > 0) ? (int)$parent_id : 0;

    $result = \helper\comment::comment_save($related_url, $related_id, $content, $author, $email, $parent_id, $website);
    if ($result['author']) {
        $result['author'] = htmlspecialchars($result['author'], ENT_QUOTES, 'UTF-8');
    }
    if ($result['content']) {
        $result['content'] = htmlspecialchars($result['content'], ENT_QUOTES, 'UTF-8');
    }
    echo json_encode($result);
} else {
    echo 'rong';
}
