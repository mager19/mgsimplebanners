<?php
$banner_text = get_post_meta($post->ID, "mg_simple_banners_text", true);
$link_url = get_post_meta($post->ID, "mg_simple_banners_url", true);
$link_text  = get_post_meta($post->ID, "mg_simple_banners_link_text", true);
?>

<table class="form-table mg_simple_banners_meta_box">
    <input type="hidden" name="mg_simplebanners_nonce" value="<?php echo wp_create_nonce("mg_simplebanners_nonce"); ?>">
    <tr>
        <th>
            <label for="mv_slider_link_text">Banner Text</label>
        </th>
        <td>
            <input type="text" name="mg_simple_banners_text" id="mg_simple_banners_text" class="regular-text link-text" value="<?php echo isset($banner_text) ? esc_html($banner_text) : ""; ?>" required>
        </td>
    </tr>
    <tr>
        <th>
            <label for="mg_simple_banners_link_text">Banner Link Text</label>
        </th>
        <td>
            <input type="text" name="mg_simple_banners_link_text" id="mg_simple_banners_link_text" class="regular-text mg_simple_banners_link_text" value="<?php echo isset($link_text) ? esc_html($link_text) : ""; ?>">
        </td>
    </tr>
    <tr>
        <th>
            <label for="mg_simple_banners_url">Banner Link</label>
        </th>
        <td>
            <input type="url" name="mg_simple_banners_url" id="mg_simple_banners_url" class="regular-text link-url" value="<?php echo isset($link_url) ? esc_url($link_url) : ""; ?>">
        </td>
    </tr>
</table>