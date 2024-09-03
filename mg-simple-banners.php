<?php

/**
 *
 * Plugin Name: MG Simple Banners
 * Description: A simple plugin to display banners on your website.
 * Plugin URI: https://wordpress.org
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Mario Reyes
 * Author URI: https://www.linkedin.com/in/mager19/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mg-simple-banners
 * Domain Path: /languages
 */

/*
/*
MG Simple Banners is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

MG Simple Banners is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with MG Simple Banners. If not, see {URI to Plugin License}.
*/

if (!defined("ABSPATH")) {
    die("Hey, you can't access this file, you silly human!");
    exit();
}

if (!class_exists("MG_Simple_Banners")) {
    class MG_Simple_Banners
    {
        public function __construct()
        {
            $this->define_constants();

            require_once(MG_SIMPLE_BANNERS_PATH . 'functions/functions.php');

            require_once(MG_SIMPLE_BANNERS_PATH . "post-types/mg-simple-banners-cpt.php");
            $MG_Simple_Banners = new MG_Simple_Banners_Post_Type();

            add_action('admin_menu', array($this, 'mg_simple_banners_menu'));

            require_once(MG_SIMPLE_BANNERS_PATH . "class.mg-simple-banners-settings.php");
            $MG_Simple_Banners_Settings = new MG_SIMPLE_BANNERS_SETTINGS();

            require_once(MG_SIMPLE_BANNERS_PATH . "banners/class.mg-simple-banners-view.php");
            $MG_Simple_Banners_view = new MG_SIMPLE_BANNERS_VIEW();

            add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 999);
        }

        public function define_constants()
        {
            define("MG_SIMPLE_BANNERS_VERSION", "1.0");
            define("MG_SIMPLE_BANNERS_PATH", plugin_dir_path(__FILE__));
            define("MG_SIMPLE_BANNERS_URL", plugin_dir_url(__FILE__));
        }

        public static function activate()
        {
            //rewrite permalinks
            update_option("rewrites_rules", "");
        }

        public static function deactivate()
        {
            flush_rewrite_rules();
            unregister_post_type("mg-simple-banners");
        }

        public static function uninstall() {}

        public function mg_simple_banners_menu()
        {
            add_menu_page(
                "MG Simple Banners Options",
                "Simple Banners",
                "manage_options",
                "mg-simple-banners-admin",
                array($this, "mg_simple_banners_settings_page"),
                "data:image/svg+xml;base64," .
                    base64_encode(
                        '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 61 61" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon style="fill:#000;" points="8.5,37 8.5,34.5 8.5,26 0,26 6,34 0,42 14.5,42 14.5,37 10.5,37 "></polygon> <polygon style="fill:#000;" points="61,26 52.5,26 52.5,34.5 52.5,37 50.5,37 45.5,37 45.5,42 61,42 55,34 "></polygon> <rect x="10.5" y="19" style="fill:#000;" width="40" height="16"></rect> </g> </g> </g></svg>
                        '
                    ),
                20
            );

            add_submenu_page(
                "mg-simple-banners-admin",
                "Manage Banners",
                "All Banners",
                "manage_options",
                "edit.php?post_type=mg-simple-banners",
                null,
                null
            );

            add_submenu_page(
                "mg-simple-banners-admin",
                "Add New Banner",
                "Add New Banner",
                "manage_options",
                "post-new.php?post_type=mg-simple-banners",
                null,
                null
            );
        }

        public function mg_simple_banners_settings_page()
        {
            //check if the user has the right permissions
            if (! current_user_can("manage_options")) {
                return;
            }

            //add error/update messages
            if (isset($_GET["settings-updated"])) {
                add_settings_error("mg_simple_banners_options", "mg_simple_banners_message", "Settings Saved", "success");
            }
            settings_errors('mg_simple_banners_options');

            require(MG_SIMPLE_BANNERS_PATH . "views/settings-page.php");
        }

        public function register_scripts()
        {
            wp_register_script(
                'mg-simple-banners-script',
                MG_SIMPLE_BANNERS_URL . 'assets/js/frontend.js',
                null,
                MG_SIMPLE_BANNERS_VERSION,
                true
            );
            wp_register_style(
                'mg-simple-banners-frontend',
                MG_SIMPLE_BANNERS_URL . 'assets/css/frontend.css',
                array(),
                MG_SIMPLE_BANNERS_VERSION,
                'all'
            );
        }
    }
}

if (class_exists("MG_Simple_Banners")) {
    register_activation_hook(__FILE__, ["MG_Simple_Banners", "activate"]);
    register_deactivation_hook(__FILE__, ["MG_Simple_Banners", "deactivate"]);
    register_uninstall_hook(__FILE__, ["MG_Simple_Banners", "uninstall"]);
    $mv_slider = new MG_Simple_Banners();
}
