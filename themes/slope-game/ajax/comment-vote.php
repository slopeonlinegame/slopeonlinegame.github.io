<?php
if (load_request()->post_value('comment_id') != null) {
    $comment_id = load_request()->post_value('comment_id');
    $vote = load_request()->post_value('vote');
}
if (load_request()->get_value('comment_id') != null) {
    $comment_id = load_request()->get_value('comment_id');
    $vote = load_request()->get_value('vote');
}

if ($comment_id != null) {
    $up_down = ($vote != null && in_array($vote, array('up', 'down'))) ? $vote : "vote";
    $result = \helper\comment::comment_vote($comment_id, $up_down);
    echo json_encode($result);
} else {
    echo "";
}
