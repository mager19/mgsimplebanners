<?php
$show = isset(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_show_banner']);
$itemSelected = isset(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_item_to_show']) ? MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_item_to_show'] : null;

if ($show == 1 && !empty($itemSelected)) {
    $idPost = MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_item_to_show'];
    $bannerText = get_post_meta($idPost, "mg_simple_banners_text", true);
    $bannerLinkText = get_post_meta($idPost, "mg_simple_banners_link_text", true);
    $bannerLinkUrl = get_post_meta($idPost, "mg_simple_banners_url", true);
    if ($bannerLinkText && $bannerLinkUrl) {
        $bannerText .= ' <a class="mg_single_banners_link" href="' . esc_url($bannerLinkUrl) . '">'  . esc_html($bannerLinkText) . '</a>';
    }


?>
    <div class="mg_simple_banners_container mg-simple-banners-style-1">
        <span>
            <?php echo $bannerText; ?>
        </span>
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