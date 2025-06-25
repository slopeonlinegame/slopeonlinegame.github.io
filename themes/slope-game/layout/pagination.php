<div class="col-12">
    <div class="pagination">
        <?php
        $paging = $paging_content['paging'];
        foreach ($paging as $page) {
            if ($page['selected']) {
                echo '<span class="active">' . $page['label'] . '</span>';
            } else {
                echo '<button aria-label="open page ' . $page['value'] . '" class="btn_classic" onclick=paging(' . $page["value"] . ')>' . $page['label'] . '</button>';
            }
        }
        ?>
    </div>
</div>