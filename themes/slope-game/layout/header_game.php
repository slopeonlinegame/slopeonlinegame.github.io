<div class="header-game">
    <div class="box-header">
        <div class="game-full-rate">
            <h1 class="" style="font-size: 24px; font-weight: 400; margin: 8px 0; text-transform: capitalize; white-space: unset;"><?php echo $game_name ?></h1>
        </div>
        <div class="header-game-extend">
            <button class="share-btn" id="view-share_modal" onclick='scrollToDiv(".share_footer")' aria-label="Scroll down to see share" title="Share">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                    <path d="M13.803 5.33333C13.803 3.49238 15.3022 2 17.1515 2C19.0008 2 20.5 3.49238 20.5 5.33333C20.5 7.17428 19.0008 8.66667 17.1515 8.66667C16.2177 8.66667 15.3738 8.28596 14.7671 7.67347L10.1317 10.8295C10.1745 11.0425 10.197 11.2625 10.197 11.4872C10.197 11.9322 10.109 12.3576 9.94959 12.7464L15.0323 16.0858C15.6092 15.6161 16.3473 15.3333 17.1515 15.3333C19.0008 15.3333 20.5 16.8257 20.5 18.6667C20.5 20.5076 19.0008 22 17.1515 22C15.3022 22 13.803 20.5076 13.803 18.6667C13.803 18.1845 13.9062 17.7255 14.0917 17.3111L9.05007 13.9987C8.46196 14.5098 7.6916 14.8205 6.84848 14.8205C4.99917 14.8205 3.5 13.3281 3.5 11.4872C3.5 9.64623 4.99917 8.15385 6.84848 8.15385C7.9119 8.15385 8.85853 8.64725 9.47145 9.41518L13.9639 6.35642C13.8594 6.03359 13.803 5.6896 13.803 5.33333Z"></path>
                </svg>
            </button>
            <button class="comment-btn" id="comment-focus" onclick='scrollToDiv(".comment-company")' aria-label="Scroll down to see comments and reviews" title="Comment">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="23px" height="21px" viewBox="0 0 24 24" fill="none">
                    <path fill="transparent" stroke="currentColor" stroke-width="2.5" d="M19 4H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.188c1 0 1.812.811 1.812 1.812 0 .808.976 1.212 1.547.641l1.867-1.867A2 2 0 0 1 14.828 18H19a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path>
                </svg>
            </button>
            <button class="theatemode" onclick="theaterMode()" aria-label="open theater mode" title="Theatemode">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" class="Controls_fullScreen__A4M8P" title="theatemode">>
                    <mask id="theatre-mode_svg__a" fill="#fff">
                        <rect x="0.833" y="3.332" width="18.333" height="13.333" rx="1"></rect>
                    </mask>
                    <rect x="0.833" y="3.332" width="18.333" height="13.333" rx="1" stroke="currentColor" stroke-width="2" fill="transparent"></rect>
                </svg>
            </button>
            <button class="expand-btn" id="expand" aria-label="open full screen" title="FullScreen">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
                    <path stroke="currentColor" stroke-width="0.9" d="M7 16L2 16C1.44772 16 1 15.5523 1 15C1 14.4477 1.44772 14 2 14L7 14C8.65685 14 10 15.3431 10 17V22C10 22.5523 9.55228 23 9 23C8.44772 23 8 22.5523 8 22V17C8 16.4477 7.55228 16 7 16Z"></path>
                    <path stroke="currentColor" stroke-width="0.9" d="M10 2C10 1.44772 9.55229 1 9 1C8.44772 1 8 1.44772 8 2L8 7C8 7.55228 7.55228 8 7 8L2 8C1.44772 8 1 8.44771 1 9C1 9.55228 1.44772 10 2 10L7 10C8.65685 10 10 8.65685 10 7L10 2Z"></path>
                    <path stroke="currentColor" stroke-width="0.9" d="M14 22C14 22.5523 14.4477 23 15 23C15.5523 23 16 22.5523 16 22V17C16 16.4477 16.4477 16 17 16H22C22.5523 16 23 15.5523 23 15C23 14.4477 22.5523 14 22 14H17C15.3431 14 14 15.3431 14 17V22Z"></path>
                    <path stroke="currentColor" stroke-width="0.9" d="M14 7C14 8.65686 15.3431 10 17 10L22 10C22.5523 10 23 9.55228 23 9C23 8.44772 22.5523 8 22 8L17 8C16.4477 8 16 7.55229 16 7L16 2C16 1.44772 15.5523 1 15 1C14.4477 1 14 1.44772 14 2L14 7Z"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<span class="exit-fullscreen hidden" id="_exit_full_screen">✕</span>

<script>
    function scrollToDiv(element) {
        if ($(element).length) {
            $('html,body').animate({
                scrollTop: $(element).offset().top - 100
            }, 'slow');
        }
    }
</script>

<style>
    .css-wl8sln {
        position: fixed;
        padding: 32px;
        z-index: 1300;
        inset: 0px;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        font-size: 16px;
    }

    .css-l8b4om {
        z-index: -1;
        position: fixed;
        inset: 0px;
        background-color: rgba(0, 0, 0, 0.5);
        transition: background-color 225ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        -webkit-tap-highlight-color: transparent;
    }

    .css-1rh4j88 {
        position: relative;
        padding: 8px;
        max-height: calc(100% - 64px);
        max-width: 100%;
        display: flex;
        flex-direction: column;
        outline: none;
    }

    .css-osmupm {
        scrollbar-width: thin;
        overflow-y: auto;
        background-color: #fff;
        color: rgb(102, 106, 127);
        border-radius: 20px;
        max-width: 600px;
        padding: 24px;
    }

    .css-d8hoyy {
        position: absolute;
        top: 16px;
        right: 12px;
        width: 44px;
        height: 44px;
        z-index: 1;
    }

    .btn-close-share {
        border-radius: 30px;
        border: none;
        padding: 0px;
        width: 44px;
        min-width: 44px;
        height: 44px;
        cursor: pointer;
        background-color: transparent;
        color: rgb(102, 106, 127);
        transition: all 250ms ease 0s;
    }

    .btn-close-share:hover {
        color: #000;
    }

    .btn-close-share svg {
        display: inline-block;
        fill: currentcolor;
        height: 24px;
        width: 24px;
    }

    .title-share {
        margin-bottom: 16px;
        text-align: center;
        color: #000;
        font-weight: bold;
        font-size: 24px;
        line-height: 31px;
        margin-block: 0;
        margin-bottom: 16px;
        text-transform: capitalize;
    }

    .btn-share {
        margin: 4px;
        transition: opacity 0.2s ease 0s;
        opacity: 0.89;
        background-color: transparent;
        border: none;
        padding: 0px;
        font: inherit;
        color: inherit;
        cursor: pointer;
    }

    .btn-share:hover {
        z-index: 2;
        opacity: 1;
    }

    .btn-css {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        background: rgb(44, 100, 246);
    }

    .css-1wtz2hp {
        background: black;
    }

    .css-1whad9x {
        background: rgb(236, 101, 61);
    }

    .css-jbkb4 {
        background: #cb2027;
    }

    .css-jbkb3 {
        background: rgb(88, 190, 85);
    }

    .css-17l7bn3 {
        background: #08c;
    }

    .svg-css {
        display: inline-block;
        fill: currentcolor;
        color: white;
        width: 30px;
        height: 30px;
    }

    .css-3uwb56 {
        display: inline-block;
        fill: currentcolor;
        color: white;
        width: 28px;
        height: 28px;
    }

    .css-chxnnc {
        display: flex;
        margin-bottom: 8px;
        margin-top: 16px;
        width: 100%;
        position: relative;
        -webkit-box-align: center;
        align-items: center;
    }

    .btn-copy {
        border-radius: 30px;
        transition: all 250ms ease 0s;
        border: none;
        cursor: pointer;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        font-family: Nunito;
        font-weight: 800;
        box-sizing: border-box;
        padding: 8px 16px;
        background: linear-gradient(45deg, #518ee7 0, #2c48a4 100%);
        color: rgb(249, 250, 255);
        height: 34px;
        position: absolute;
        right: 16px;
    }

    .btn-copy:hover {
        background: rgb(44, 100, 246);
    }

    .css-1kgmm81 {
        padding: 12px 96px 12px 14px;
        border: 2px solid #ddd;
        color: rgb(249, 250, 255);
        border-radius: 8px;
        width: 100%;
    }

    .css-1kgmm81 .MuiInput-input {
        outline: 0px;
        width: 100%;
        font-weight: 700;
        resize: none;
        padding: 0px;
        border: 0px;
        background: none;
        color: rgb(135, 138, 158);
    }

    .hide-share {
        display: none;
    }
</style>