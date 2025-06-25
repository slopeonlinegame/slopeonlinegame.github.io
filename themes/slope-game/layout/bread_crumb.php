<?php if ($arr_bread) : ?>
    <!-- <div class="text"> -->
    <div>
        <ul class="my-breadcrumb">
            <li>
                <a class="my-breadcrumb_name" href="/" title="Home">Home</a>
            </li>
            <?php foreach ($arr_bread as $breadnew) : ?>
                <?php if ($breadnew['source']) : ?>
                    <li>
                        <a class="my-breadcrumb_name" href="/<?php echo $breadnew['source']; ?>" title="<?php echo $breadnew['name'] ?>"><?php echo $breadnew['name'] ?></a>
                    </li>
                <?php else : ?>
                    <li><span class="my-breadcrumb_name"><?php echo $breadnew['name']; ?></span></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>