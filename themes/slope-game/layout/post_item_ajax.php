<div class="Blog_containerCards___90OW">
	<?php foreach ($posts as $p) :
		$list_cate = \helper\posts::find_related_category($p->id);
		if ($list_cate) {
			$name_cate = $list_cate[0]->name;
			// $slug_cate = $list_cate[0]->slug;
		} ?>
		<a class="BlogCard_container__ZX_XY" href="/blog/<?php echo $p->slug ?>" title="<?php echo $p->title ?>">
			<div class="BlogCard_cardImageContainer__MmMKQ">
				<img placeholder="blur" class="BlogCard_cardImage__vldTL lazy" src="<?php echo '/' . DIR_THEME ?>rs/imgs/pixel.png" data-src="<?php echo \helper\image::get_thumbnail($p->image, 323, 157, 'm') ?>" width="323" height="157" title="<?php echo $p->title ?>" alt="<?php echo $p->title ?> img" />
			</div>
			<div class="BlogCard_description__3k1q6">
				<div class="BlogCard_infoBlock___Wxns">
					<?php if ($name_cate) : ?>
						<p class="Category_category__Bqrlq" style="text-transform: capitalize;"><?php echo $name_cate; ?></p>
					<?php endif; ?>
					<p class="Date_date__lzJ0M"><?php echo \helper\datetime::convert_date($p->publish_date, "Y-m-d H:i:s", "F d, Y"); ?></p>
				</div>
				<div>
					<h2 class="BlogCard_title__NmJ1k"><?php echo $p->title ?></h2>
					<p class="BlogCard_text__MMLoe"><?php echo $p->excerpt; ?></p>
				</div>
			</div>
		</a>
	<?Php endforeach; ?>
</div>

<?Php if ($paging_content) : ?>
	<div class="pagination" style="justify-content: center;">
		<?php
		$paging = $paging_content['paging'];
		foreach ($paging as $k => $page) {
			if ($page['selected']) {
				echo '<span class="active">' . $page['label'] . '</span>';
			} else {
				echo '<button aria-label="open page ' . $page['value'] . '" class="btn_classic" onclick=paging_posts(' . $page["value"] . ')>' . $page['label'] . '</button>';
			}
		}
		?>
	</div>
<?php endif; ?>