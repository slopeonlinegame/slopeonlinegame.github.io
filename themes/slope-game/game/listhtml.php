<?php
if (isset($_REQUEST['base_url'])) {
    $base_url = $_REQUEST['base_url'];
    if (strpos($base_url, 'https://') === 0) {
        $base_url = str_replace('https://', '', $base_url);
    } elseif (strpos($base_url, 'http://') === 0) {
        $base_url = str_replace('http://', '', $base_url);
    }
    $base_url = rtrim(str_replace('/', '', $base_url));
}

if (!is_dir("htmlsource/$base_url")) {
    mkdir("htmlsource/$base_url", 0777, true);
}
$enable_ads= false;


// Homepage -> index.html
$slug = \helper\options::options_by_key_type('slug_home');
$game = \helper\game::find_by_slug($slug);
if ($game == null) {
    load_response()->redirect('/new-games');
}
$post = \helper\posts::find_by_slug($slug);
if ($post != null) {
    $game->content = $post->content;
    $game->excerpt = $post->excerpt;
}

$custom = \helper\themes::get_layout('header/metadata_home');
$layout = '';
$layout .= \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => $is_blog, 'enable_ads' => $enable_ads));
$layout .= \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads, 'external' => $external));
$layout .= \helper\themes::get_layout('game_play', array('game' => $game, 'enable_ads' => $enable_ads, 'title_blog' => $title_blog, 'posts' => $posts));
$layout .= \helper\themes::get_layout('header/richtext_home', array('game' => $game));
$layout .= \helper\themes::get_layout('footer', array('is_game_play' => true));
$layout = str_replace('://slope76.io', "://$base_url", $layout);

$destination_file = "htmlsource/$base_url/index.html";
if (($destination_file & 0xC000) !== 0xC000) {
    chmod($destination_file, 0755);
}
// in($destination_file);

$r = file_put_contents($destination_file, $layout);
if ($r) {
    echo "<br>$destination_file  has saved";
} else {
    echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
}


// * New Games + Hot Games
$title = 'New Games';
$custom = \helper\themes::get_layout('header/metadata_newgame');
$layout = '';
$layout .= \helper\themes::get_layout('header', array('custom' => $custom));
$layout .= \helper\themes::get_layout('menu');
$layout .= \helper\themes::get_layout('game_item', array('title' => $title, 'field_order' => 'publish_date'));
$layout .= \helper\themes::get_layout('footer');
$layout = str_replace('://slope76.io', "://$base_url", $layout);

$destination_file = "htmlsource/$base_url/new-games.html";
if (($destination_file & 0xC000) !== 0xC000) {
    chmod($destination_file, 0755);
}
// in($destination_file);

$r = file_put_contents($destination_file, $layout);
if ($r) {
    echo "<br>$destination_file  has saved";
} else {
    echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
}


$title = 'Hot Games';
$custom = \helper\themes::get_layout('header/metadata_hotgame');
$layout = '';
$layout .= \helper\themes::get_layout('header', array('custom' => $custom));
$layout .= \helper\themes::get_layout('menu');
$layout .= \helper\themes::get_layout('game_item', array('title' => $title, 'field_order' => 'views'));
$layout .= \helper\themes::get_layout('footer');
$layout = str_replace('://slope76.io', "://$base_url", $layout);

$destination_file = "htmlsource/$base_url/hot-games.html";
if (($destination_file & 0xC000) !== 0xC000) {
    chmod($destination_file, 0755);
}
// in($destination_file);

$r = file_put_contents($destination_file, $layout);
if ($r) {
    echo "<br>$destination_file  has saved";
} else {
    echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
}


// * All categories
$categories = \helper\category::find_by_taxonomy('game');
// in($categories);
if (count($categories)) {
    if (!is_dir("htmlsource/$base_url/games")) {
        mkdir("htmlsource/$base_url/games", 0777, true);
    }
    foreach ($categories as $ct) {
        if (\helper\game::get_count('', '', 'yes', '', '', $ct->id)) {
            $category = \helper\category::find_category($ct->id);
            $category_id = $category->id;
            $title = strtolower($category->name) . " games"; //action games games
            $title = str_replace("games games", "games", ($title));
            $title = ucwords($title);
            $category->name = $title;
            $description = $category->description;

            $custom = \helper\themes::get_layout('header/metadata_category', array('category' => $category));
            $layout = '';
            $layout .= \helper\themes::get_layout('header', array('custom' => $custom));
            $layout .= \helper\themes::get_layout('menu');
            $layout .= \helper\themes::get_layout('game_item', array('category_id' => $category_id, 'slug' => $category->slug, 'title' => $title));
            $layout .= \helper\themes::get_layout('footer');
            $layout = str_replace('://slope76.io', "://$base_url", $layout);

            $destination_file = "htmlsource/$base_url/games/$category->slug.html";
            if (($destination_file & 0xC000) !== 0xC000) {
                chmod($destination_file, 0755);
            }
            // in($destination_file);

            $r = file_put_contents($destination_file, $layout);
            if ($r) {
                echo "<br>$destination_file  has saved";
            } else {
                echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
            }
        }
    }
}


// * All games
$limit = 999;
$page = 1;
$games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, 'id', 'desc', $category_id2, $not_equal);
foreach ($games as $game) {
    $slug = $game->slug;

    $data['custom'] = \helper\themes::get_layout('header/metadata_game', array('game' => $game));
    $h = '';
    $h .=  \helper\themes::get_layout('header', $data);
    $h .= \helper\themes::get_layout('menu', array('slug' => $slug));
    $h .= \helper\themes::get_layout('game_play', array('game' => $game));
    $h .= \helper\themes::get_layout('header/richtext', array('game' => $game));
    $h .= \helper\themes::get_layout('footer');
    $h = str_replace('://slope76.io', "://$base_url", $h);

    $destination_file = "htmlsource/$base_url/$slug.html";
    if (($destination_file & 0xC000) !== 0xC000) {
        chmod($destination_file, 0755);
    }
    // in($destination_file);

    $r = file_put_contents($destination_file, $h);
    if ($r) {
        echo "<br>$destination_file  has saved";
    } else {
        echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
    }
}


// All footer
$footer_array = ["about-us", "copyright-infringement-notice-procedure", "contact-us", "privacy-policy", "term-of-use"];
foreach ($footer_array as $item) {
    $data['custom'] = \helper\themes::get_layout('header/metadata_information', array('slug' => $item));
    $layout = '';
    $layout .= \helper\themes::get_header($data);
    $layout .= \helper\themes::get_layout('menu');
    $layout .= \helper\themes::get_layout('information', array('slug' => $item));
    $layout .= \helper\themes::get_layout('footer');
    $layout = str_replace('://slope76.io', "://$base_url", $layout);

    $destination_file = "htmlsource/$base_url/$item.html";
    if (($destination_file & 0xC000) !== 0xC000) {
        chmod($destination_file, 0755);
    }
    // in($destination_file);

    $r = file_put_contents($destination_file, $layout);
    if ($r) {
        echo "<br>$destination_file  has saved";
    } else {
        echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
    }
}
