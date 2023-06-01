<?php
// create custom plugin settings menu
// add_action('admin_menu', 'kc_create_menu');
function kc_create_menu()
{
    //create new top-level menu
    add_menu_page('Dan Slider Plugin Settings', 'Dan Slider', 'administrator', __FILE__, 'kc_settings_page', plugins_url('/images/icon.png', __FILE__));
    //call register settings function
    add_action('admin_init', 'register_mysettings');
}
function register_mysettings()
{
    //register our settings
    register_setting('kc-settings-group', 'kc_post_type');
    register_setting('kc-settings-group', 'kc_category_name');
    // register_setting('kc-settings-group', 'kc_custom_img');
    register_setting('kc-settings-group', 'kc_bg_color');
    register_setting('kc-settings-group', 'kc_background_type');
    register_setting('kc-settings-group', 'kc_text_color');
    register_setting('kc-settings-group', 'kc_tag');
    register_setting('kc-settings-group', 'kc_count');
}
function kc_settings_page()
{
    $kc_post_types = get_post_types(['public' => true]);
    unset($kc_post_types['attachment']);
    $kc_categories = get_categories([
        'taxonomy' => 'category'
    ]);
    // $kc_categories = get_categories();
    // $kc_categories["empty"]["name"] = "";
?>
    <div class="wrap">
        <h2>Dan slider</h2>
        <?php
        // if (wp_verify_nonce($_POST['fileup_nonce'], 'my_file_upload')) {

        //     if (!function_exists('wp_handle_upload'))
        //         require_once(ABSPATH . 'wp-admin/includes/file.php');

        //     $file = &$_FILES['my_file_upload'];

        //     $overrides = ['test_form' => false];

        //     $movefile = wp_handle_upload($file, $overrides);

        //     if ($movefile && empty($movefile['error'])) {
        //         echo "Файл был успешно загружен.\n";
        //         print_r($movefile);
        //     } else {
        //         echo "Возможны атаки при загрузке файла!\n";
        //     }
        // }
        ?>
        <form enctype="multipart/form-data" method="post" action="options.php">
            <?php settings_fields('kc-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Post Type</th>
                    <td>
                        <select name="kc_post_type" id="kc_post_type">
                            <?php foreach ($kc_post_types as $kc_post_type) {
                                echo '<option value="' . $kc_post_type . '" ' . selected(get_option('kc_post_type'), $kc_post_type) . '>' . $kc_post_type . '</option>';
                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Category Name</th>
                    <td>
                        <select name="kc_category_name" id="kc_category_name">
                            <?php
                            foreach ($kc_categories as $kc_category) {
                                echo '<option value="' . $kc_category->name . '" ' . selected(get_option('kc_category_name'), $kc_category->name) . '>' . ($kc_category->name ? $kc_category->name : "none") . '</option>';
                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Background type</th>
                    <td>
                        <select name="kc_background_type" id="kc_background_type">
                            <?php
                            echo '<option value="post_image" ' . selected(get_option('kc_background_type'), 'post_image') . '>Post image</option>';
                            // echo '<option value="custom_image" ' . selected(get_option('kc_background_type'), 'custom_image') . '>Custom image</option>';
                            echo '<option value="custom_color" ' . selected(get_option('kc_background_type'), 'custom_color') . '>Custom color</option>';
                            ?>
                        </select>

                    </td>
                </tr>
                <script>
                    jQuery(document).ready(function($) {
                        $('#kc_background_type').change(function() {
                            const option_val = $(this).val();
                            const options_arr = ['#custom_color'];
                            // const options_arr = ['#custom_image', '#custom_color'];
                            $.each(options_arr, function(index, value) {
                                $(value).hide();
                            });
                            // if (option_val === 'custom_image') $('#custom_image').show();
                            if (option_val === 'custom_color') $('#custom_color').show();
                            // if (option_val === 'custom_color') $('#custom_color').show();
                        });
                    });
                </script>
                <tr id="custom_color" style="display:none;" valign="top">
                    <th scope="row">Background color</th>
                    <td><input type="color" name="kc_bg_color" value="<?php echo get_option('kc_bg_color'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Text color</th>
                    <td><input type="color" name="kc_text_color" value="<?php echo get_option('kc_text_color'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tags</th>
                    <td><input type="text" name="kc_tag" value="<?php echo get_option('kc_tag'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Count</th>
                    <td><input type="number" name="kc_count" value="<?php echo get_option('kc_count'); ?>" min="1" max="12" /></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
        <!-- <form enctype="multipart/form-data" action="" method="POST">
            <?php
            // wp_nonce_field('my_file_upload', 'fileup_nonce'); 
            ?>
            <input name="my_file_upload" type="file" />
            <input type="submit" value="Загрузить файл" />
        </form> -->
    </div>
<?php
}
?>