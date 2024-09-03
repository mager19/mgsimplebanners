<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('mg_simple_banners_group'); //name of group
        do_settings_sections('mg_simple_banners_page1'); //name of page
        // Output save settings button.
        submit_button('Save Settings');
        ?>
    </form>
</div>