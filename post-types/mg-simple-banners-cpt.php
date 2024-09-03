<?php

if (!class_exists("MG_Simple_Banners_Post_Type")) {
    class MG_Simple_Banners_Post_Type
    {
        function __construct()
        {
            add_action("init", [$this, "create_post_type"]);
            add_action("add_meta_boxes", [$this, "add_meta_boxes"]);
            add_action("save_post", [$this, "save_post"], 10, 2);
        }

        public function create_post_type()
        {
            register_post_type("mg-simple-banners", [
                "label" => "Simple Banners",
                "description" => "Simple Banners post",
                "labels" => [
                    "name" => "Simple Banners",
                    "singular_name" => "Simple Banner",
                ],
                "public" => true,
                "supports" => ["title"],
                "hierarchical" => false,
                "show_ui" => true,
                "show_in_menu" => false,
                "menu_position" => 5,
                "show_in_admin_bar" => true,
                "show_in_nav_menus" => true,
                "can_export" => true,
                "has_archive" => false,
                "exclude_from_search" => false,
                "publicly_queryable" => true,
                "show_in_rest" => true,
                "menu_icon" =>
                "data:image/svg+xml;base64," .
                    base64_encode(
                        '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 61 61" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon style="fill:#000;" points="8.5,37 8.5,34.5 8.5,26 0,26 6,34 0,42 14.5,42 14.5,37 10.5,37 "></polygon> <polygon style="fill:#000;" points="61,26 52.5,26 52.5,34.5 52.5,37 50.5,37 45.5,37 45.5,42 61,42 55,34 "></polygon> <rect x="10.5" y="19" style="fill:#000;" width="40" height="16"></rect> </g> </g> </g></svg>
                        '
                    ),
            ]);
        }

        public function add_meta_boxes()
        {
            add_meta_box(
                "mg_simple_banners_meta_box",
                "Banner Options",
                [$this, "add_inner_meta_boxes"],
                "mg-simple-banners",
                "normal",
                "high"
            );
        }

        public function add_inner_meta_boxes($post)
        {
            require_once MG_SIMPLE_BANNERS_PATH .
                "views/mg-simple-banners_metabox.php";
        }

        public function save_post($post_id)
        {
            if (isset($_POST['mg_simplebanners_nonce'])) {
                if (! wp_verify_nonce($_POST['mg_simplebanners_nonce'], 'mg_simplebanners_nonce')) {
                    return;
                }
            }

            //verificamos el auto save
            if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
                return;
            }

            //verificamos el cpt
            if (isset($_POST["post_type"]) && $_POST["post_type"] == "mg_simple_banners") {
                if (!current_user_can("edit_page", $post_id)) {
                    return;
                } elseif (!current_user_can("edit_post", $post_id)) {
                    return;
                }
            }

            if (isset($_POST["action"]) && $_POST["action"] == "editpost") {
                $old_link_text = get_post_meta(
                    $post_id,
                    "mg_simple_banners_text",
                    true
                );
                $new_link_text = sanitize_text_field(
                    $_POST["mg_simple_banners_text"]
                );
                $old_link_url = get_post_meta(
                    $post_id,
                    "mg_simple_banners_url",
                    true
                );
                $new_link_url = $_POST["mg_simple_banners_url"];

                if (empty($new_link_text)) {
                    update_post_meta(
                        $post_id,
                        "mg_simple_banners_text",
                        "Add some text"
                    );
                } else {
                    update_post_meta(
                        $post_id,
                        "mg_simple_banners_text",
                        $new_link_text,
                        $old_link_text
                    );
                }

                if (empty($new_link_url)) {
                    update_post_meta($post_id, "mg_simple_banners_url", "#");
                } else {
                    update_post_meta(
                        $post_id,
                        "mg_simple_banners_url",
                        esc_url_raw($new_link_url),
                        $old_link_url
                    );
                }
            }
        }
    }
}
