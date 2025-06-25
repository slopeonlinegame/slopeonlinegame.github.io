<?php
$domain_url = \helper\options::options_by_key_type('base_url');
$domain_url = rtrim($domain_url, '/');
$site_name = \helper\options::options_by_key_type('site_name');
$theme_url = '/' . DIR_THEME;
$game = \helper\game::find_by_slug($slug);

if ($game->source_html != '') {
    if (strpos($game->source_html, 'gamedistribution')) {
        $domain_url = preg_replace('/([\/]+)$/', '', $domain_url);
        if (strpos($game->source_html, 'gd_sdk_referrer_url')) {
            $array_source = explode("gd_sdk_referrer_url", "$game->source_html");
            if (count($array_source) > 1) {
                $array_source[1] = 'gd_sdk_referrer_url=' . $domain_url . '/' . $game->slug . '.embed';
                $game->source_html = $array_source[0] . $array_source[1];
            }
        } else {
            $game->source_html = $game->source_html . '?gd_sdk_referrer_url=' . $domain_url . '/' . $game->slug . '.embed';
        }
    }
}
// most standard version
?>
<?php if ($game) : ?>
    <html lang="en">

    <head>
        <title>Play <?php echo $game->name; ?> Game Online !</title>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow, noodp, noydir" />
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no, minimal-ui" />
        <!-- <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
        <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true,IE=Edge,chrome=1" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="<?php echo $site_name; ?>">
        <meta http-equiv="Content-Language" content="en-US" />
        <meta property="og:type" content="game">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Helvetica Neue", "Calibri Light", Roboto, sans-serif;
            }

            html,
            body {
                background-color: #000;
            }
        </style>
    </head>

    <body>

        <?php if ($game->type == 'IFRAME_HTML') : ?>
            <?php if (strpos($game->source_html, 'suika-game') !== false) : ?>
                <style>
                    .before-playing {
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: #000
                    }

                    .blur-background {
                        background-image: url('<?php echo \helper\image::get_thumbnail($game->image, 180, 135, 'h'); ?>');
                        z-index: -1;
                        position: absolute;
                        top: 0;
                        left: 0;
                        opacity: .7;
                        width: 100%;
                        height: 100%;
                        transform: scale(1.3);
                        background-position: 50% !important;
                        background-repeat: no-repeat !important;
                        background-size: cover !important;
                        -webkit-filter: blur(20px);
                        filter: blur(20px);
                        -webkit-backdrop-filter: blur(20px)
                    }

                    .preload-before-playing {
                        padding: 20px 30px;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        flex-wrap: wrap;
                        width: 100%;
                        height: 100%;
                        box-sizing: border-box;
                        max-width: 800px;
                        margin: 0 auto
                    }

                    .play-title,
                    .title-game-playing span {
                        display: block;
                        font-weight: 700;
                        text-align: center
                    }

                    .image-thumbnail-playing {
                        cursor: pointer
                    }

                    .image-thumbnail-playing img {
                        border-radius: 70px;
                        box-shadow: 0 0 5px 2px rgb(0 0 0 / 20%);
                        width: 135px;
                        height: 135px;
                        background-size: cover;
                        box-shadow: 0 2px 15px 0 rgba(6, 29, 98, .7), inset 0 5px 2px 0 hsla(0, 0%, 96%, .5)
                    }

                    .play-title {
                        color: #fff;
                        margin: 35px auto 15px;
                        text-transform: capitalize;
                        font-size: 24px;
                        text-shadow: -1px 0 7px rgba(6, 29, 98, .3), 0 1px 7px rgba(6, 29, 98, .3), 1px 0 7px rgba(6, 29, 98, .3), 0 -1px 7px rgba(6, 29, 98, .3)
                    }

                    .title-game-playing {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center
                    }

                    .title-game-playing span {
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                        margin: 0;
                        width: 200px;
                        height: 50px;
                        border-radius: 10px;
                        background-color: #429cd6;
                        font-size: 18px;
                        color: #fff;
                        text-transform: uppercase;
                        border: none;
                        cursor: pointer;
                        padding: 12px 0;
                        transition: .4s ease-out
                    }

                    .title-game-playing span:hover {
                        transform: scale(1.125)
                    }

                    @keyframes crunch {
                        0% {
                            transform: rotate(-2deg) scale(.98)
                        }

                        50% {
                            transform: rotate(2deg) scale(1.02)
                        }

                        100% {
                            transform: rotate(-2deg) scale(1)
                        }
                    }
                </style>
                <div class="before-playing" id="preloading-game">
                    <div class="blur-background"></div>
                    <div class="preload-before-playing">
                        <div class="image-thumbnail-playing" onclick="start_game_frame()">
                            <img width="135px" height="135px" src="<?php echo \helper\image::get_thumbnail($game->image, 135, 135, 'm'); ?>" alt="<?php echo $game->name; ?>" title="<?php echo $game->name; ?>" />
                        </div>
                        <div class="play-title"><?php echo $game->name ?></div>
                        <div class="title-game-playing">
                            <span onclick="start_game_frame()">PLAY NOW!</span>
                        </div>
                    </div>
                </div>
                <script>
                    let url_game = "<?php echo $game->source_html ?>";
                    let is_game_layer = url_game.includes("gamedistribution") || url_game.includes("crazygame");
                    if (is_game_layer) {
                        start_game_frame();
                    }

                    function start_game_frame() {
                        let frame_game = document.createElement('iframe');
                        frame_game.setAttribute('id', 'iframehtml5');
                        frame_game.setAttribute('width', '100%');
                        frame_game.setAttribute('height', '100%');
                        frame_game.setAttribute('frameborder', '0');
                        frame_game.setAttribute('border', '0');
                        frame_game.setAttribute('scrolling', 'auto');
                        frame_game.setAttribute('class', 'iframe-default');
                        frame_game.setAttribute('allowfullscreen', 'true');
                        frame_game.setAttribute('src', "<?php echo $game->source_html ?>");
                        frame_game.setAttribute('title', "<?php echo $game->name ?>");
                        if (document.getElementById("preloading-game")) {
                            document.getElementById("preloading-game").remove();
                        }
                        document.body.append(frame_game);
                    }
                </script>
            <?php else : ?>
                <iframe id="iframehtml5" class="iframe-default" name="GAME FRAME" style="background-color:#fff" width="100%" height="100%" src="<?php echo $game->source_html ?>" title="<?php echo $game->name ?>" frameborder="0" border="0" scrolling="auto" allowfullscreen></iframe>
            <?php endif; ?>

        <?php elseif ($game->type == 'IN_GAME') : ?>
            <style>
                .before-playing {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #000
                }

                .blur-background {
                    background-image: url('<?php echo \helper\image::get_thumbnail($game->image, 180, 135, 'h'); ?>');
                    z-index: -1;
                    position: absolute;
                    top: 0;
                    left: 0;
                    opacity: .7;
                    width: 100%;
                    height: 100%;
                    transform: scale(1.3);
                    background-position: 50% !important;
                    background-repeat: no-repeat !important;
                    background-size: cover !important;
                    -webkit-filter: blur(20px);
                    filter: blur(20px);
                    -webkit-backdrop-filter: blur(20px)
                }

                .preload-before-playing {
                    padding: 20px 30px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    flex-wrap: wrap;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    max-width: 800px;
                    margin: 0 auto
                }

                .play-title,
                .title-game-playing span {
                    display: block;
                    font-weight: 700;
                    text-align: center
                }

                .image-thumbnail-playing {
                    cursor: pointer
                }

                .image-thumbnail-playing img {
                    border-radius: 70px;
                    box-shadow: 0 0 5px 2px rgb(0 0 0 / 20%);
                    width: 135px;
                    height: 135px;
                    background-size: cover;
                    box-shadow: 0 2px 15px 0 rgba(6, 29, 98, .7), inset 0 5px 2px 0 hsla(0, 0%, 96%, .5)
                }

                .play-title {
                    color: #fff;
                    margin: 35px auto 15px;
                    text-transform: capitalize;
                    font-size: 24px;
                    text-shadow: -1px 0 7px rgba(6, 29, 98, .3), 0 1px 7px rgba(6, 29, 98, .3), 1px 0 7px rgba(6, 29, 98, .3), 0 -1px 7px rgba(6, 29, 98, .3)
                }

                .title-game-playing {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center
                }

                .title-game-playing span {
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    margin: 0;
                    width: 200px;
                    height: 50px;
                    border-radius: 10px;
                    background-color: #429cd6;
                    font-size: 18px;
                    color: #fff;
                    text-transform: uppercase;
                    border: none;
                    cursor: pointer;
                    padding: 12px 0;
                    transition: .4s ease-out
                }

                .title-game-playing span:hover {
                    transform: scale(1.125)
                }

                @keyframes crunch {
                    0% {
                        transform: rotate(-2deg) scale(.98)
                    }

                    50% {
                        transform: rotate(2deg) scale(1.02)
                    }

                    100% {
                        transform: rotate(-2deg) scale(1)
                    }
                }
            </style>
            <div class="before-playing" id="preloading-game">
                <div class="blur-background"></div>
                <div class="preload-before-playing">
                    <div class="image-thumbnail-playing" onclick="start_game_frame()">
                        <img width="135px" height="135px" src="<?php echo \helper\image::get_thumbnail($game->image, 135, 135, 'm'); ?>" alt="<?php echo $game->name; ?>" title="<?php echo $game->name; ?>" />
                    </div>
                    <div class="play-title"><?php echo $game->name ?></div>
                    <div class="title-game-playing">
                        <span onclick="start_game_frame()">Ok, PLAY NOW!</span>
                    </div>
                </div>
            </div>
            <script>
                let url_game2 = "<?php echo $game->source_html ?>";
                let is_game_layer2 = url_game2.includes("gamedistribution") || url_game2.includes("crazygame");
                if (is_game_layer2) {
                    start_game_frame();
                }

                function start_game_frame() {
                    let frame_game = document.createElement('iframe');
                    frame_game.setAttribute('id', 'iframehtml5');
                    frame_game.setAttribute('width', '100%');
                    frame_game.setAttribute('height', '100%');
                    frame_game.setAttribute('frameborder', '0');
                    frame_game.setAttribute('border', '0');
                    frame_game.setAttribute('scrolling', 'auto');
                    frame_game.setAttribute('class', 'iframe-default');
                    frame_game.setAttribute('allowfullscreen', 'true');
                    frame_game.setAttribute('src', "<?php echo $game->source_html ?>");
                    frame_game.setAttribute('title', "<?php echo $game->name ?>");
                    if (document.getElementById("preloading-game")) {
                        document.getElementById("preloading-game").remove();
                    }
                    document.body.append(frame_game);
                }
            </script>

        <?php else : ?>
            <style>
                .before-playing {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #000
                }

                .blur-background {
                    background-image: url('<?php echo \helper\image::get_thumbnail($game->image, 180, 135, 'h'); ?>');
                    z-index: -1;
                    position: absolute;
                    top: 0;
                    left: 0;
                    opacity: .7;
                    width: 100%;
                    height: 100%;
                    transform: scale(1.3);
                    background-position: 50% !important;
                    background-repeat: no-repeat !important;
                    background-size: cover !important;
                    -webkit-filter: blur(20px);
                    filter: blur(20px);
                    -webkit-backdrop-filter: blur(20px)
                }

                .preload-before-playing {
                    padding: 20px 30px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    flex-wrap: wrap;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    max-width: 800px;
                    margin: 0 auto
                }

                .play-title,
                .title-game-playing span {
                    display: block;
                    font-weight: 700;
                    text-align: center
                }

                .image-thumbnail-playing {
                    cursor: pointer
                }

                .image-thumbnail-playing img {
                    border-radius: 70px;
                    box-shadow: 0 0 5px 2px rgb(0 0 0 / 20%);
                    width: 135px;
                    height: 135px;
                    background-size: cover;
                    box-shadow: 0 2px 15px 0 rgba(6, 29, 98, .7), inset 0 5px 2px 0 hsla(0, 0%, 96%, .5)
                }

                .play-title {
                    color: #fff;
                    margin: 35px auto 15px;
                    text-transform: capitalize;
                    font-size: 24px;
                    text-shadow: -1px 0 7px rgba(6, 29, 98, .3), 0 1px 7px rgba(6, 29, 98, .3), 1px 0 7px rgba(6, 29, 98, .3), 0 -1px 7px rgba(6, 29, 98, .3)
                }

                .title-game-playing {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center
                }

                .title-game-playing span {
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    margin: 0;
                    width: 200px;
                    height: 50px;
                    border-radius: 10px;
                    background-color: #429cd6;
                    font-size: 18px;
                    color: #fff;
                    text-transform: uppercase;
                    border: none;
                    cursor: pointer;
                    padding: 12px 0;
                    transition: .4s ease-out
                }

                .title-game-playing span:hover {
                    transform: scale(1.125)
                }

                @keyframes crunch {
                    0% {
                        transform: rotate(-2deg) scale(.98)
                    }

                    50% {
                        transform: rotate(2deg) scale(1.02)
                    }

                    100% {
                        transform: rotate(-2deg) scale(1)
                    }
                }
            </style>
            <div class="before-playing" id="preloading-game">
                <div class="blur-background"></div>
                <div class="preload-before-playing">
                    <div class="image-thumbnail-playing" onclick="openInNewWindow()">
                        <img width="135px" height="135px" src="<?php echo \helper\image::get_thumbnail($game->image, 135, 135, 'm'); ?>" alt="<?php echo $game->name; ?>" title="<?php echo $game->name; ?>" />
                    </div>
                    <div class="play-title"><?php echo $game->name ?></div>
                    <div class="title-game-playing">
                        <span onclick="openInNewWindow()">PLAY NOW!</span>
                    </div>
                </div>
            </div>
            <script>
                let height2 = window.innerHeight || 600;
                let width2 = window.innerWidth || 600;

                function openInNewWindow() {
                    const myWindow = window.open("<?php echo $game->source_html ?>", "", "width=" + width2 + ",height=" + height2);
                }
            </script>

        <?php endif; ?>
    </body>

    </html>
<?php endif; ?>