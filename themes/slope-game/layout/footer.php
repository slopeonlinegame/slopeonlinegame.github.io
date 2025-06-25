<?php
$theme_url = '/' . DIR_THEME;
$title = \helper\options::options_by_key_type('site_name');
?>

</div>
<footer>
    <div class="container">
        <div class="flex-center">
            <!-- <div><?php //echo $title . " © " . date("Y") 
                        ?></div> -->
            <div class="footer__copir">Disclaimer: <strong><a title="<?php echo \helper\options::options_by_key_type('site_name') ?>" href="/"> <?php echo \helper\options::options_by_key_type('site_name') ?> </a></strong> is an independent website and is not affiliated with any organizations.</div>

            <div class="infor">
                <a class="link" href="/about-us" target="_blank" title="About Us">About Us</a>
                <a class="link" href="/copyright-infringement-notice-procedure" target="_blank" title="Copyright">Copyright Infringement Notice Procedure</a>
                <a class="link" href="/contact-us" target="_blank" title="Contact Us">Contact Us</a>
                <a class="link" href="/term-of-use" target="_blank" title="Term Of Use">Term Of Use</a>
                <a class="link" href="/privacy-policy" target="_blank" title="Privacy Policy">Privacy Policy</a>
            </div>
        </div>
</footer>
</div>

<button id="back-to-top" title="Back to top" class="btn-top" aria-hidden="true">▲</button>

<div class="loading_mask hidden-load">
    <svg width="80px" height="80px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-pacman">
        <g ng-attr-style="display:{{config.showBean}}" style="display:block">
            <circle cx="66.05" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#abbd81">
                <animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="0.8" begin="-0.536s" repeatCount="indefinite"></animate>
                <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="0.8" begin="-0.536s" repeatCount="indefinite"></animate>
            </circle>
            <circle cx="86.45" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#abbd81">
                <animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="0.8" begin="-0.264s" repeatCount="indefinite"></animate>
                <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="0.8" begin="-0.264s" repeatCount="indefinite"></animate>
            </circle>
            <circle cx="46.25" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#abbd81">
                <animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="0.8" begin="0s" repeatCount="indefinite"></animate>
                <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="0.8" begin="0s" repeatCount="indefinite"></animate>
            </circle>
        </g>
        <g ng-attr-transform="translate({{config.showBeanOffset}} 0)" transform="translate(-15 0)">
            <path d="M50 50L20 50A30 30 0 0 0 80 50Z" ng-attr-fill="{{config.c1}}" fill="#f19924" transform="rotate(16.875 50 50)">
                <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;45 50 50;0 50 50" keyTimes="0;0.5;1" dur="0.8s" begin="0s" repeatCount="indefinite"></animateTransform>
            </path>
            <path d="M50 50L20 50A30 30 0 0 1 80 50Z" ng-attr-fill="{{config.c1}}" fill="#f19924" transform="rotate(-16.875 50 50)">
                <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-45 50 50;0 50 50" keyTimes="0;0.5;1" dur="0.8s" begin="0s" repeatCount="indefinite"></animateTransform>
            </path>
        </g>
    </svg>
</div>

<?php
// true false;
$ads_cached_html = (class_exists('\helper\game') && method_exists('\helper\game', 'get_html_cached')) ? \helper\game::get_html_cached() : false;
if (!$ads_cached_html) {
    $ads_cached_html = 0;
}
echo "<script>let ads_cached_html = $ads_cached_html</script>";

// General: when ads + cached_html are not enabled, it appears. But when enabled, it is already in game_play so it is not needed anymore
if ($ads_cached_html == false || !$is_game_play) {
    echo '<script src="' . $theme_url . 'rs/js/jquery-3.4.1.min.js"></script>';
}
// Rate + Comment
if (($ads_cached_html == false && $is_game_play)) {
    echo '<script defer src="' . $theme_url . 'rs/js/jquery.validate.min.js"></script>';
    echo '<script defer src="' . $theme_url . 'rs/plugins/raty/jquery.raty.js"></script>';
}
if ($is_contact_us) {
    echo '<script defer src="' . $theme_url . 'rs/js/jquery.validate.min.js"></script>';
}
?>

<script src="<?php echo $theme_url; ?>rs/js/lazyload.min.js"></script>
<script src="<?php echo $theme_url; ?>rs/js/script.js"></script>
</body>

</html>