<section class="section section--green">
    <div class="container">
        <?php if ($enable_ads) : ?>
            <div class="ads-slot ">
                <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
            </div>
            <br><br>
        <?php endif ?>

        <div class="wordle-text">
            <h1 class="info_text title_block">Search « <span class="search-target"><?php echo $keywords ?> </span> »</h1>
        </div>
</section>

<section class="section">
    <div class="container">
        <div class="wordle-text">
            <div style="text-align: center;">Your search - Did not match any documents.</div><br>
            <p><b>Suggestions:</b></p>
            <ul style="padding-left: 24px;">
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
            </ul>
        </div>
        <?php if ($enable_ads) : ?><br>
            <div class="ads-slot ">
                <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
            </div>
            <br>
        <?php endif ?>
    </div>
</section>