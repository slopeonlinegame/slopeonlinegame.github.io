<?php
if (!$page) {
	$page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
}
// $limit = \helper\options::options_by_key_type('game_home_limit', 'display');
if (!$limit) {
	$limit = 10;
}
// $limit = 2;
$order_by = "id";
$order_type = 'DESC';

if ($tag_id) {
	$posts = \helper\posts::paging_by_tag($page, $limit, $tag_id, $order_by, $order_type, $not_equal);
	$paging_content = \helper\posts::paginglink_by_tag($tag_id, $page, $limit);
} else {
	$posts = \helper\posts::paging($page, $limit, $category_id, $keywords, $is_hot, $order_by, $order_type, $not_equal, $format);
	$paging_content = \helper\posts::paginglink($page, $limit, $category_id, $keywords, $is_hot, $not_equal, $format);
}
// in($posts);

?>
<?Php if (count($posts)) : ?>
	<section class="section section--green">
		<div class="container">
			<?php if ($enable_ads) : ?>
				<div class="ads-slot ">
					<?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
				</div>
				<br>
			<?php endif ?>

			<div class="headline">
				<h1 class="headline__title"><?php echo ($title) ?></h1>
				<div class="headline__text"><?php echo html_entity_decode($description) ?></div>
			</div>
		</div>
	</section>

	<section class="section scroll-top">
		<div class="container">
			<div class="Blog_container__6GCXk">
				<div id="post_item_ajax">
					<?php echo \helper\themes::get_layout('post_item_ajax', array('posts' => $posts, 'paging_content' => $paging_content)); ?>
				</div>
			</div>

			<?php if ($enable_ads) : ?>
				<div class="ads-slot ">
					<?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
				</div><br><br>
			<?php endif ?>
		</div>
	</section>
	<section class="section section--rate">
	</section>

<?php else :
	load_response()->redirect('/new-games'); ?>
<?php endif; ?>

<script>
	page = "<?php echo $page; ?>";
	order_by = "<?php echo $order_by; ?>";
	order_type = "<?php echo $order_type; ?>";
	limit = "<?php echo $limit; ?>";
	category_id = "<?php echo $category_id ?>";
	tag_id = "<?php echo $tag_id ?>";
	keywords = "<?php echo $keywords; ?>";
</script>