<?php

if (! class_exists('MG_SIMPLE_BANNERS_SETTINGS')) {
    class MG_SIMPLE_BANNERS_SETTINGS
    {
        public static $options;

        public function __construct()
        {
            self::$options = get_option('mg_simple_banners_options');

            add_action('admin_init', array($this, 'admin_init'));
        }

        public function admin_init()
        {
            //Create a group to join all settings together
            register_setting('mg_simple_banners_group', 'mg_simple_banners_options');

            //First Section
            add_settings_section(
                'mg_simple_banners_main_section', //id for the section
                'Simple Banners', //Section title,
                null, //callback functions
                'mg_simple_banners_page1' //page to add this section                  
            );

            add_settings_field(
                'mg_simple_banners_show_banner',
                'Show Banner',
                array($this, 'mg_simple_banners_show_banner_callback'),
                'mg_simple_banners_page1',
                'mg_simple_banners_main_section'
            );

            $checked = (isset(self::$options['mg_simple_banners_show_banner']) && self::$options['mg_simple_banners_show_banner'] == 1) ? 'checked' : '';

            if ($checked == 'checked') {
                add_settings_field(
                    'mg_simple_banners_item_to_show', //id for the field
                    'Select a Banner', //Title of the field
                    array($this, 'mg_simple_banners_item_to_show_callback'), //callback function
                    'mg_simple_banners_page1', //page to add this field,
                    'mg_simple_banners_main_section', //section to add this field
                );
            }
        }

        public function mg_simple_banners_show_banner_callback()
        {
            $checked = (isset(self::$options['mg_simple_banners_show_banner']) && self::$options['mg_simple_banners_show_banner'] == 1) ? 'checked' : '';

?>
            <input type="checkbox" name="mg_simple_banners_options[mg_simple_banners_show_banner]" id="mg_simple_banners_show_banner" value="1" <?php echo esc_attr($checked); ?>>
            <?php

            if ($checked !== 'checked') {
                echo '<p>Check this box to show a banner on your website</p>';
            }
        }

        public function mg_simple_banners_item_to_show_callback()
        {
            $items = get_posts(array(
                'post_type' => 'mg-simple-banners',
                'numberposts' => -1,
                'post_status' => 'publish'
            ));

            $checked = (isset(self::$options['mg_simple_banners_show_banner']) && self::$options['mg_simple_banners_show_banner'] == 1) ? 'checked' : '';

            // Si no hay ítems, establecer el valor como cadena vacía
            if (empty($items)) {
                self::$options['mg_simple_banners_item_to_show'] = '';
                echo '<p>' . __('No banners available. Please create a new Banner.', 'mg_simple_banners') . '</p>';
            }

            // Si hay ítems y la opción de mostrar el banner está marcada
            if (!empty($items) && $checked == 'checked') { ?>
                <select
                    id="mv_slider_style"
                    name="mg_simple_banners_options[mg_simple_banners_item_to_show]">
                    <?php
                    foreach ($items as $item) {
                        $selected = isset(self::$options['mg_simple_banners_item_to_show']) ? esc_attr(self::$options['mg_simple_banners_item_to_show']) : '';
                        $selected = selected($selected, $item->ID, false);
                        echo "<option value='{$item->ID}' {$selected}>{$item->post_title}</option>";
                    }
                    ?>
                </select>
            <?php
            } else if (!empty($items)) { ?>
                <p><?php echo __('Please check the box to show a banner.', 'mg_simple_banners'); ?></p>
<?php
            }
        }
    }
}
