<?php
$limit = 20;
// check sum all game vs limit
$get_count = \helper\game::get_count();
if ($limit > $get_count) {
    $limit = $get_count;
}
// get array all games vs $limit
$games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);

// Random: get 1 int(0 -> $limit-1) because array key first == 0
// redirection web == slug_game
$ran = rand(0, $limit - 1);
$slug_game = $games[$ran]->slug;
// in(\helper\datetime::current_date());
// in($limit);
// in($slug_game);
// in($games[$ran]);
// in($games); 
// die;

$slug = header("Location: /$slug_game");
exit(); // prevent any other PHP code from executing on the page.