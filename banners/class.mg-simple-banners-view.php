<?php

if (! class_exists('MG_SIMPLE_BANNERS_VIEW')) {
    class MG_SIMPLE_BANNERS_VIEW
    {
        public function __construct()
        {
            add_action('wp_head',  array($this, 'mg_simple_banners_add_paragraph_to_header'));
        }

        public function mg_simple_banners_add_paragraph_to_header()
        {
            require(MG_SIMPLE_BANNERS_PATH . 'views/mg-simple-banners-banner.php');
            wp_enqueue_style('mg-simple-banners-frontend');
            wp_enqueue_script('mg-simple-banners-script');

            $background = isset(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_style_background']) ? MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_style_background'] : '#000000';

            $color = isset(MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_style_color']) ? MG_SIMPLE_BANNERS_SETTINGS::$options['mg_simple_banners_style_color'] : '#ffffff';

            wp_localize_script(
                'mg-simple-banners-script',
                'MG_SIMPLE_BANNERS_OPTIONS',
                array(
                    'background' => $background,
                    'color' => $color
                )
            );
        }
    }
}
