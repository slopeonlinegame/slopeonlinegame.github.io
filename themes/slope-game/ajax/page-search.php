<?php
$keywords = $_REQUEST['keywords'];

if ($keywords) {
    $page = 1;
    $limit = 15;
    $display = "yes";
    $games = \helper\game::get_paging($page, $limit, $keywords, null, $display, null, null, "views", "DESC", null, null);
    $data = [];
    if ($games) {
        // echo "here";
        $html = '<div class="HeaderSearchField_resultsWrapper__wqnfg">';
        foreach ($games as $item) {
            $html .= '<a class="NavLink_link__TbASG SearchGameCard_linkStyle__2lRdr" target="_self" data-text="[object Object]" href="/' . $item->slug . '" title="' . $item->name . '">';
            $html .= '<div class="SearchGameCard_gameItem__FiKPR">';
            $html .= '<img loading="eager" decoding="async" data-nimg="1" class="SearchGameCard_gameItemImage__SDQuz" src="' . \helper\image::get_thumbnail($item->image, 62, 37, 'm') . '" width="56" height="33" style="color: transparent;" alt="' . $item->name . '" title="' . $item->name . '">';
            $html .= '<p class="SearchGameCard_gameItemTitle__lY33n">' . $item->name . '</p>';
            $html .= '</div>';
            $html .= '</a>';
        }
        $html .= '</div>';

        $data['html'] = $html;
        $data['flag'] = true;
    } else {
        $html = '<div class="HeaderSearchField_resultsWrapper__wqnfg">';
        $html .= '<a class="NavLink_link__TbASG HeaderSearchField_searchAll__iv3l9" target="_self" data-text="[object Object],[object Object]" href="/search/' . $keywords . ' " title="Search all"><p>Search All</p><svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" class="HeaderSearchField_arrowAll__xX18V"><path d="M5.667 12.667 10.334 8 5.667 3.333" stroke="#1B181E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></a></div>';
        $data['html'] = $html;
        $data['flag'] = false;
    }
    echo json_encode($data);
}
