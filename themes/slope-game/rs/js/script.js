$("#expand").on('click', function () {
    $("#iframehtml5").addClass("force_full_screen");
    $("#_exit_full_screen").removeClass('hidden');
    requestFullScreen(document.body);
});

$("#_exit_full_screen").on('click', cancelFullScreen);

function requestFullScreen(element) {
    $(".header-game").removeClass("header_game_enable_half_full_screen");
    $("#iframehtml5").removeClass("force_half_full_screen");
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
    if (requestMethod) { // Native full screen.
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

function cancelFullScreen() {
    $("#_exit_full_screen").addClass('hidden');
    $("#iframehtml5").removeClass("force_full_screen");
    $(".header-game").removeClass("force_full_screen header_game_enable_half_full_screen");
    $("#iframehtml5").removeClass("force_half_full_screen");
    var requestMethod = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || document.exitFullScreenBtn;
    if (requestMethod) { // cancel full screen.
        requestMethod.call(document);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}
if (document.addEventListener) {
    document.addEventListener('webkitfullscreenchange', exitHandler, false);
    document.addEventListener('mozfullscreenchange', exitHandler, false);
    document.addEventListener('fullscreenchange', exitHandler, false);
    document.addEventListener('MSFullscreenChange', exitHandler, false);
}

function exitHandler() {
    if (document.webkitIsFullScreen === false ||
        document.mozFullScreen === false ||
        document.msFullscreenElement === false) {
        cancelFullScreen();
    }
}

function theaterMode() {
    let iframe = document.querySelector("#iframehtml5");
    if (iframe.classList.contains("force_half_full_screen")) {
        iframe.classList.remove("force_half_full_screen")
        document.querySelector(".header-game").classList.remove("header_game_enable_half_full_screen")
        return;
    }
    let above = 0;
    let left = 0;
    let below = $(".header-game").outerHeight();
    // let right = 0;
    // let width = window.innerWidth;
    // let height = window.innerHeight;
    if (!document.querySelector("#style-append")) {
        let styleElement = document.createElement("style");
        styleElement.type = "text/css";
        styleElement.setAttribute('id', "style-append");
        let cssCode = `
    .force_half_full_screen{
    position: fixed!important;
    top: 0!important;
    left: 0!important;
    z-index: 887!important;
    top:${above}px!important;
    left:${left}px!important;
    width:calc(100% - ${left}px)!important;
    height:calc(100% - ${above + below}px)!important;
    background-color:#000;
    }
    .header_game_enable_half_full_screen{
        position:fixed;
        left:${left}px!important;
        bottom:0!important;
        right:0!important;
        z-index:887!important;
        width:calc(100% - ${left}px)!important;
        padding-left:10px;
        padding-right:10px;
        border-radius:0!important;
    }
    @media (max-width: 1364px){
        .force_half_full_screen{
            left:0!important;
            width:100%!important;
        }
        .header_game_enable_half_full_screen{
            width:100%!important;
            left:0!important;
        }
    }`
        styleElement.innerHTML = cssCode;
        document.querySelector('head').appendChild(styleElement);
    }
    iframe.classList.add("force_half_full_screen")
    document.querySelector(".header-game").classList.add("header_game_enable_half_full_screen")
}

// ============================ sidebar.php ================================= 
// $('.navbar-menu-li-dropdown').click(function () {
//     let id = $(this).attr('data-id');
//     for (let div of $(".navbar-menu-list")) {
//         let divid = [];
//         divid = div.id;
//         if (divid != id) {
//             $(div).animate({ height: 'hide' }, 250); //show/hide/toggle
//         }
//     }
//     $(`.navbar-menu-list[id="${id}"]`).slideToggle(250);
// })


// btnroot: Open/Close sidebar
// $(".btnroot").click(function () {
//     let display = $('.navbar-game').css('display');
//     if (display == 'none') {
//         $('.navbar-game').animate({ width: 'toggle' }, 140);
//         $(this).html('<svg class="btnroot-icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true"><path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" d="M19 4C19.5523 4 20 3.55229 20 3C20 2.44772 19.5523 2 19 2L3 2C2.44772 2 2 2.44772 2 3C2 3.55228 2.44772 4 3 4L19 4ZM20.47 7.95628L15.3568 11.152C14.7301 11.5437 14.7301 12.4564 15.3568 12.848L20.47 16.0438C21.136 16.4601 22 15.9812 22 15.1958V8.80427C22 8.01884 21.136 7.54 20.47 7.95628ZM11 13C11.5523 13 12 12.5523 12 12C12 11.4477 11.5523 11 11 11L3 11C2.44771 11 2 11.4477 2 12C2 12.5523 2.44771 13 3 13L11 13ZM20 21C20 21.5523 19.5523 22 19 22L3 22C2.44771 22 2 21.5523 2 21C2 20.4477 2.44771 20 3 20L19 20C19.5523 20 20 20.4477 20 21Z"></path></svg>');
//     } else if (display == 'block') {
//         $('.navbar-game').animate({ width: 'toggle' }, 140);
//         $(this).html('<svg class="btnroot-icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true"><path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" d="M21 4C21.5523 4 22 3.55229 22 3C22 2.44772 21.5523 2 21 2L5 2C4.44772 2 4 2.44772 4 3C4 3.55228 4.44772 4 5 4L21 4ZM3.53 16.0438L8.6432 12.848C9.26987 12.4563 9.26987 11.5437 8.6432 11.152L3.53 7.95625C2.86395 7.53997 2 8.01881 2 8.80425V15.1958C2 15.9812 2.86395 16.46 3.53 16.0438ZM21 13C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11L13 11C12.4477 11 12 11.4477 12 12C12 12.5523 12.4477 13 13 13L21 13ZM22 21C22 21.5523 21.5523 22 21 22L5 22C4.44771 22 4 21.5523 4 21C4 20.4477 4.44771 20 5 20L21 20C21.5523 20 22 20.4477 22 21Z"></path></svg>');
//     }
// })

// ============================ Header ================================= 
// btn menu mobile
$(".navbar .bx-menu").click(function (e) {
    $(".nav-links").toggleClass("show_mobile");
    // e.stopPropagation();
})

// sidebar submenu open close js code
$(".menu_more").click(function (e) {
    $(".nav-links").toggleClass("show1");
})

function toggle_saerch() {
    $(".navbar").toggleClass("showInput");
    $(".btn_close").toggleClass("hidden_btn_close");
    $(".btn_open").toggleClass("hidden_btn_close");
}
// search-box open close js code
$(".search-box .bx-search").click(function (e) {
    toggle_saerch()
})
// th: When clicking outside the search game: hidden #game-search
$('body').on('click', function (event) {
    if ($(event.target).closest('.search-box').length === 0) {
        if ($(".navbar").hasClass("showInput")) {
            // console.log(1111111)
            toggle_saerch()
        }
    }
});

$('.btn_get_search').on('click', function () {
    gameSearch()
})

$('.input_search').on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        gameSearch()
    }
})
function gameSearch() {
    let keywords = $(".input_search").val();
    let rex_rule = /[ \`\-\.?:\\\/\_\'\*]+/g;
    var value1 = keywords.replace(rex_rule, " ").trim().toLowerCase();
    value1 = value1.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    var url = '/search/' + value1;
    if (value1 && oldValue != value1) {
        oldValue = value1;
        window.location.href = url;
    }
}

// ============================ click pagination.php + show gif loading 
function paging(p) {
    $(".loading_mask").removeClass("hidden-load");
    if (!p) {
        p = 1;
    }
    let url = "/paging.ajax";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            p: p,
            keywords: keywords,
            field_order: field_order,
            order_type: order_type,
            category_id: category_id,
            is_hot: is_hot,
            is_new: is_new,
            tag_id: tag_id,
            limit: limit,
        },
        success: function (response) {
            $(".loading_mask").addClass("hidden-load");
            $('html, body').animate({
                scrollTop: $(".scroll-top").offset().top
            }, 1000);
            if (response) {
                $("#ajax-append").html(response);

                let lazyLoadImg = document.querySelectorAll(".lazy");
                if (lazyLoadImg.length) {
                    lazyload(lazyLoadImg);
                }
            }
        }
    })
}

function paging_posts(p) {
    $(".loading_mask").removeClass("hidden-load");
    if (!p) {
        p = 1;
    }
    let url = '/paging_posts.ajax';
    $.ajax({
        url: url,
        type: "POST",
        data: {
            page: p,
            keywords: keywords,
            order_by: order_by,
            order_type: order_type,
            tag_id: tag_id,
            category_id: category_id,
            limit: limit
        },
        success: function (response) {
            $(".loading_mask").addClass("hidden-load");
            if (response !== '') {
                // document.getElementById("post_item_ajax").innerHTML = (response);
                $("#post_item_ajax").html(response);

                let lazyLoadImg = document.querySelectorAll(".lazy");
                if (lazyLoadImg.length) {
                    lazyload(lazyLoadImg);
                }
            }
            $('html, body').animate({
                scrollTop: $(".scroll-top").offset().top
            }, 1000);
        }
    })
    // var url = '/paging_posts.ajax';
    // var data = {
    //     page: p,
    //     keywords: keywords,
    //     order_by: order_by,
    //     order_type: order_type,
    //     limit: limit
    // };
    // ajax.get(url, data, function (xxxx) {
    //     if (xxxx !== '') {
    //         document.getElementById("post_item_ajax").innerHTML = (xxxx);
    //     }
    // });
}

$(document).ready(function () {
    if (!ads_cached_html) {
        addPlugin(); // ajax full_rate + comment
    }

})

// ajax full_rate + comment
function addPlugin() {
    if (!id_game && !url_game) {
        return
    }
    let url = "/add-plugin.ajax";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            id_game: id_game,
            url_game: url_game,
        },
        success: function (response) {
            if (response) {
                let data = JSON.parse(response);
                $("#append-rate").html(data.rate);
                $("#append-comment").html(data.comment);
            }
        }
    })
}

// ================================= back-to-top 
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    $("#back-to-top").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 300);
    });
})

// ========================================================
// Lazy Load
$(document).ready(function () {
    "use strict";
    let lazyLoadImg = document.querySelectorAll(".lazy");
    if (lazyLoadImg.length) {
        lazyload(lazyLoadImg);
    }
});