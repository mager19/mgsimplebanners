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
            require_once MG_SIMPLE_BANNERS_PATH .
                "post-types/mg-simple-banners-cpt.php";
            $MG_Simple_Banners = new MG_Simple_Banners_Post_Type();
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
    }
}

if (class_exists("MG_Simple_Banners")) {
    register_activation_hook(__FILE__, ["MG_Simple_Banners", "activate"]);
    register_deactivation_hook(__FILE__, ["MG_Simple_Banners", "deactivate"]);
    register_uninstall_hook(__FILE__, ["MG_Simple_Banners", "uninstall"]);
    $mv_slider = new MG_Simple_Banners();
}
