<?php
$post  = \helper\posts::find_by_slug($slug);
// in($post);die;
if (!$post) {
    load_response()->redirect('/blog');
}

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_blog_post', array('post' => $post));
echo \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('enable_ads' => $enable_ads));

// ==========================================================================================
// will get from page table and helper\posts
if (!$limit) {
    $limit = \helper\options::options_by_key_type('game_related_limit', 'display');
    if (!$limit) {
        $limit = 10;
    }
}

$page = 1;
$display = 'yes';
$order_by = 'views';
$order_type = 'DESC';
$not_equal['id'] = $post->id;

// btn category/tag vs id
$list_cate = \helper\posts::find_related_category($post->id);
$list_tags = \helper\posts::find_related_tag($post->id);

// breadcrumb down + category + (posts(category) + >tag>index.php)
if (count($list_cate)) {
    $arr_bread = array(
        array(
            'name' => $list_cate[0]->name,
            'slug' => $list_cate[0]->slug,
            'source' => 'blog/category/' . $list_cate[0]->slug,
        ),
        array(
            'name' => $post->title,
        )
    );
    $category_id = $list_cate[0]->id;
} elseif (count($list_tags)) {
    $arr_bread = array(
        array(
            'name' => $list_tags[0]->name,
            'slug' => $list_tags[0]->slug,
            'source' => 'blog/tag/' . $list_tags[0]->slug,
        ),
        array(
            'name' => $post->title,
        )
    );
} else {
    $arr_bread = array((array(
        'name' => $post->title,
    )
    ));
}
// in(count($list_cate));
// in($arr_bread);
// die;

if ($category_id) {
    // foreach => Avoid duplicate cate + tag: stt cate->tag
    foreach ($list_cate as $cate_id) {
        // $category_id =>  $cate_id->id 
        $g = \helper\posts::paging($page, $limit, $cate_id->id, $keywords, $is_hot, $order_by, $order_type, $not_equal, $format);
        foreach ($g as $g1) {
            $g2[] = $g1;
        }
    }
    //filter game same same + resset arr 
    $posts_category2 = \helper\game::remove_duplicate_game($g2);
    $posts_category2 = array_values($posts_category2);
    // let it get and display according to $limit; because above it reindexes all game categories
    $posts_category = [];
    foreach ($posts_category2 as $k => $item_cate) {
        if ($k < $limit) {
            $posts_category[] = $item_cate;
        }
    }
} else {
    $category_id = '';
    $posts_category = \helper\posts::paging($page, $limit, $category_id, $keywords, $is_hot, $order_by, $order_type, $not_equal, $format);
}
// in($posts_category2);die;

// $limit_cate = \helper\options::options_by_key_type('game_category_limit', 'display');
// if (!$limit_cate) {
//     $limit_cate = 12;
// }
// $order_by2 = "publish_date";
// $posts_news = \helper\posts::paging($page, $limit_cate, $category_id, $keywords, $is_hot, $order_by2, $order_type, $not_equal, $format);


// $post_featured = \helper\posts::get_top('WEEk', 4, 'series');
// if (!$post_featured) {
//     $post_featured = \helper\posts::paging(1, 4, $category_id, $keywords, $is_hot, "views", $order_type, $not_equal, $format);
// }
// when accessing url -> update_views($post->id);
// \helper\posts::tracking_view($post->id);
?>

<section class="section section--green">
    <div class="container">
        <?php if ($enable_ads) : ?>
            <div class="ads-slot ">
                <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
            </div>
            <br><br>
        <?php endif ?>

        <!-- breadcrumb -->
        <div class="breadcrumbs_blog">
            <span class="breadcrumbs_blog__item">
                <a href="/"><span title="Home">Home</span></a>
            </span>
            <span class="breadcrumbs_blog__item breadcrumbs_blog__delimiter"> » </span>
            <span class="breadcrumbs_blog__item">
                <a href="/blog"><span title="Blog">Blog</span></a>
            </span>
            <?php foreach ($arr_bread as $breadnew) : ?>
                <?php if ($breadnew['source']) : ?>
                    <span class="breadcrumbs_blog__item breadcrumbs_blog__delimiter"> » </span>
                    <span class="breadcrumbs_blog__item">
                        <a href="/<?php echo $breadnew['source']; ?>" title="<?php echo $breadnew['name'] ?>">
                            <span><?php echo $breadnew['name'] ?></span>
                        </a>
                    </span>
                <?php else : ?>
                    <span class="breadcrumbs_blog__item breadcrumbs_blog__delimiter"> » </span>
                    <span class="breadcrumbs_blog__item breadcrumbs_blog__current"><?php echo $breadnew['name']; ?> Blog</span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="headline">
            <h1 class="headline__title"><?php echo ($post->title) ?> Blog</h1>
            <!-- <div class="headline__text"><?php // echo $description 
                                                ?></div> -->
            <div class="headline__text">
                <p style="text-align: right;"><?php echo \helper\datetime::convert_date($post->publish_date, "Y-m-d H:i:s", "F d, Y"); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="wordle-text">
            <!-- <div class="game__content"> -->
            <?php if ($post->content) : ?>
                <?php echo html_entity_decode($post->content); ?>
            <?php else : ?>
                <p><?php echo $post->excerpt; ?></p>
            <?php endif; ?>
            <!-- </div> -->
        </div>
    </div>
</section>

<?php if (count($list_cate) || count($list_tags)) : ?>
    <section class="section section--green">
        <div class="container">
            <div class="headline">
                <div class="wordle-text">
                    <div class="info_text title_block">Relates Tags</div>
                </div><br><br>

                <div class="links">
                    <?php foreach ($list_cate as $cate) : ?>
                        <a class="links__link letters" href="/blog/category/<?php echo $cate->slug; ?>" title="<?php echo $cate->name; ?>"><?php echo $cate->name; ?></a>
                    <?php endforeach; ?>
                    <?php foreach ($list_tags as $tag) : ?>
                        <a class="links__link letters" href="/blog/tag/<?php echo $tag->slug; ?>" title="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section scroll-top">
    <div class="container">

        <?php if ($enable_ads) : ?>
            <div class="ads-slot ">
                <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
            </div><br><br>
        <?php endif ?>

        <div class="Blog_container__6GCXk">
            <div class="wordle-text">
                <div class="info_text title_block">Relates Blogs</div>
            </div><br><br>
            <div id="post_item_ajax">
                <?php echo \helper\themes::get_layout('post_item_ajax', array('posts' => $posts_category, 'paging_content' => $paging_content)); ?>
            </div>
        </div>
    </div>
</section>

<section class="section section--rate">
</section>


<?php echo \helper\themes::get_layout('footer'); ?>