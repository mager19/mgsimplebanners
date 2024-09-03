<?php

$show = isset(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_show_banner']);
$itemSelected = isset(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_item_to_show']);

if ($show == 1 && !empty($itemSelected)) {
    $bannerText = get_post_meta(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_item_to_show'], "mg_simple_banners_text", true);
?>
    <div class="mg_simple_banners_container mg-simple-banners-style-1">
        <?php
        echo $bannerText;

        ?>
        <div class="mg_single_banners_close">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g id="Menu / Close_MD">
                        <path id="Vector" d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>

<?php
}
?>