<?php
if (load_request()->is_get()) {
    // in("is_get");
    $game_id = load_request()->get_value('game_id');
    $score = load_request()->get_value('score');
}
if (load_request()->is_post()) {
    // in("is_post");
    $game_id = load_request()->post_value('game_id');
    $score = load_request()->post_value('score');
}

if (intval($score) <= 3) {
    $score = 3;
}
$data = \helper\game::rate($game_id, $score);
echo json_encode($data);
