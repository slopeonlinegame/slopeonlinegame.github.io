<div class="games">
    <?php
    foreach ($games as $k => $item) :
        $list_cate = \helper\game::find_related_category($item->id);
        $arr_cate = [];
        foreach ($list_cate as $cate) {
            $arr_cate[] = $cate->name;
        }
        $cate = implode(", ", $arr_cate); ?>

        <a class="game-item" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>">
            <div class="game-item__img">
                <img class="lazy" src="<?php echo '/' . DIR_THEME ?>rs/imgs/pixel.png" data-src="<?php echo \helper\image::get_thumbnail($item->image, 200, 134, 'm'); ?>" width="200px" height="134px" title="<?php echo $item->name; ?>" alt="<?php echo $item->name; ?> img">
            </div>
            <div class="game-item__info">
                <div class="game-item__title"><?php echo $item->name; ?></div>
                <div class="game-item__text text"><?php echo $cate; ?></div>
            </div>
            <div class="game-item__bottom">
                <div class="game-item__play">Play</div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<div class=""><br>
    <?php if ($paging_content) {
        echo \helper\themes::get_layout('pagination', array('paging_content' => $paging_content));
    }
    ?>
</div>