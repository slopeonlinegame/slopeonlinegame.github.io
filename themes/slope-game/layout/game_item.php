<?php
if (!$limit) {
    $limit = \helper\options::options_by_key_type('game_home_limit', 'display') ? $limit = \helper\options::options_by_key_type('game_home_limit', 'display') : 20;
}
if (!$page) {
    $page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
}
if (!$field_order) {
    $field_order = \helper\options::options_by_key_type('field_order', 'display') ? \helper\options::options_by_key_type('field_order', 'display') : "publish_date";
}
$display = "yes";
$order_type = "DESC";
$num_link = 3;

if ($tag_id != '') {
    $games = \helper\game::paging_by_tag($tag_id, $page, $limit);
    $count = \helper\game::count_by_tag($tag_id);
    $paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);
} else {
    if ($trending) {
        $games = \helper\game::get_top($top, $page, $limit3, $type);
        $count = $limit;
    } else {
        $games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
        $count = \helper\game::get_count($keywords, $type, $display, $is_hot, $is_new, $category_id, $not_equal);
    }
    $paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);
}
?>

<?php
if (!count($games)) {
    echo \helper\themes::get_layout('error', array('keywords' => $keywords, 'enable_ads' => $enable_ads));
} else {
?>
    <section class="section section--green">
        <div class="container">
            <?php if ($enable_ads) : ?>
                <div class="ads-slot ">
                    <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                </div>
                <br>
            <?php endif ?>

            <div class="headline">
                <?php if ($is_home) : ?>
                    <h2 class="headline__title">All games</h2>
                <?php else : ?>
                    <h1 class="headline__title"><?php echo ($title) ?></h1>
                <?php endif; ?>
                <div class="headline__text"><?php echo html_entity_decode($description) ?></div>
            </div>
        </div>
    </section>

    <section class="section section--grey scroll-top">
        <div class="container">
            <!-- <div class="wordle-text">
                <div class="info_text title_block">Play Other Games</div>
            </div> -->
            <div class="" id="ajax-append">
                <?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games, 'paging_content' => $paging_content)); ?>
            </div>

            <?php if ($enable_ads) : ?>
                <br>
                <div class="ads-slot ">
                    <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                </div>
            <?php endif ?>
        </div>
    </section>

    <?php if ($post || $slogan) : ?>
        <section class="section">
            <div class="container">
                <div class="wordle-text">
                    <?php if ($post) : ?>
                        <h1 class="title-option"><?php echo $post->title; ?></h1>
                        <?php if ($post->content) : ?>
                            <div><?php echo html_entity_decode($post->content); ?></div>
                        <?php else : ?>
                            <div><?php echo html_entity_decode($post->excerpt); ?></div>
                        <?php endif; ?>
                    <?php else : ?>
                        <h1 class="title-option"><?php echo $title; ?></h1>
                        <div><?php echo html_entity_decode($slogan); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="section section--rate">
    </section>
<?php } ?>

<script>
    keywords = "<?php echo $keywords; ?>";
    field_order = "<?php echo $field_order ?>";
    order_type = "<?php echo $order_type ?>";
    category_id = "<?php echo $category_id ?>";
    is_hot = "<?php echo $is_hot ?>";
    is_new = "<?php echo $is_new ?>";
    tag_id = "<?php echo $tag_id ?>";
    limit = "<?php echo $limit ?>";
</script>