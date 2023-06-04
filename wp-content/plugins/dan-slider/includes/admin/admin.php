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
    register_setting('kc-settings-group', 'kc_bg_color');
    register_setting('kc-settings-group', 'kc_bg_img');
    register_setting('kc-settings-group', 'image_attachment_id');
    register_setting('kc-settings-group', 'kc_background_type');
    register_setting('kc-settings-group', 'kc_text_color');
    register_setting('kc-settings-group', 'kc_tag');
    register_setting('kc-settings-group', 'kc_count');

    add_settings_section('bg_settings', 'Background settings', '', 'bg_settings_page');
    add_settings_field('kc_background_type', 'Background type', 'kc_background_type', 'bg_settings_page', 'bg_settings');
    add_settings_field('custom_img_field', 'Background custom image', 'kc_bg_custom_img', 'bg_settings_page', 'bg_settings');
    add_settings_field('custom_color_field', 'Background custom color', 'kc_bg_custom_color', 'bg_settings_page', 'bg_settings');

    add_settings_section('settings_id1', 'Other settings', '', 'settings_page1');
?>
<?php
}
function kc_background_type()
{
?>
    <select name="kc_background_type" id="kc_background_type">
        <?php
        echo '<option value="post_image" ' . selected(get_option('kc_background_type'), 'post_image') . '>Post image</option>';
        echo '<option value="custom_image" ' . selected(get_option('kc_background_type'), 'custom_image') . '>Custom image</option>';
        echo '<option value="custom_color" ' . selected(get_option('kc_background_type'), 'custom_color') . '>Custom color</option>';
        ?>
    </select>
    <script>
        jQuery(document).ready(function($) {
            function disable_img() {
                $('.custom_image').each(function(disabled_img_index, disabled_img_value) {
                    $(disabled_img_value).prop('disabled', true);
                    $(disabled_img_value).css('opacity', '0.5');
                });
            }

            function disable_color() {
                $('#custom_color').prop('disabled', true);
                $('#custom_color').css('opacity', '0.5');
            }

            function unable_img() {
                $('.custom_image').each(function(unabled_img_index, unabled_img_value) {
                    $(unabled_img_value).prop('disabled', false);
                    $(unabled_img_value).css('opacity', '1');
                });
            }

            function unable_color() {
                $('#custom_color').prop('disabled', false);
                $('#custom_color').css('opacity', '1');
            }
        });
    </script>
    <?php
    if (get_option('kc_background_type') === 'custom_color') {
    ?>
        <script>
            jQuery(document).ready(function($) {
                $('#custom_color').prop('disabled', false);
                $('#custom_color').css('opacity', '1');
                $('.custom_image').each(function(disabled_img_value, disabled_img_value) {
                    $(disabled_img_value).prop('disabled', true);
                    $(disabled_img_value).css('opacity', '0.5');
                });
            });
        </script>
    <?php
    }
    if (get_option('kc_background_type') === 'custom_image') {
    ?>
        <script>
            jQuery(document).ready(function($) {
                $('.custom_image').each(function(unabled_img_index, unabled_img_value) {
                    $(unabled_img_value).prop('disabled', false);
                    $(unabled_img_value).css('opacity', '1');
                });
                $('#custom_color').prop('disabled', true);
                $('#custom_color').css('opacity', '0.5');
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            jQuery(document).ready(function($) {
                $('.custom_image').each(function(disabled_img_value, disabled_img_value) {
                    $(disabled_img_value).prop('disabled', true);
                    $(disabled_img_value).css('opacity', '0.5');
                });
                $('#custom_color').prop('disabled', true);
                $('#custom_color').css('opacity', '0.5');
            });
        </script>
    <?php
    }
}
function kc_bg_custom_color()
{
    ?>
    <input id="custom_color" disabled style="opacity: 0.2;" type="color" name="kc_bg_color" value="<?php echo get_option('kc_bg_color'); ?>" />
<?php
}
function kc_bg_custom_img()
{
?>
    <input id="image_attachment_id" name="image_attachment_id" value="<?php echo get_option('image_attachment_id'); ?>" type="hidden" />
    <input id="HIDDEN_TEXT_INPUT_ID" name="HIDDEN_TEXT_INPUT_NAME" value="HIDDEN_TEXT_INPUT_VALUE" type="hidden" />
    <div id="IMAGE_PLACEHOLDER_ID">
        <?php echo wp_get_attachment_image(get_option('image_attachment_id'), 'thumbnail', false, array('class' => 'custom_image')); ?>

    </div>
    <p>
        <button class="custom_image button button-secondary YOUR_OPEN_MEDIA_LIBRARY_BUTTON_CLASS" type="button" aria-label="<?php _e('Select'); ?>"><?php _e('Select'); ?></button>
        <button id="delete-link" class="custom_image button button-link button-link-delete YOUR_DELETE_BUTTON_CLASS" type="button" aria-label="<?php _e('Remove'); ?>"><?php _e('Remove'); ?></button>
    </p>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('YOUR_OPEN_MEDIA_LIBRARY_BUTTON_CLASS')) {
                const uploader = wp.media({
                        multiple: false
                    })
                    .on('select', function() {
                        const attachment = uploader.state().get('selection').first().toJSON();

                        document.getElementById('image_attachment_id').value = attachment.id;
                        document.getElementById('HIDDEN_TEXT_INPUT_ID').value = attachment.id;
                        document.getElementById('IMAGE_PLACEHOLDER_ID').innerHTML = '<img src="' + attachment.url + '" />';
                    })
                    .open(event.target);
            }

            if (event.target.classList.contains('YOUR_DELETE_BUTTON_CLASS')) {
                document.getElementById('HIDDEN_TEXT_INPUT_ID').value = 0;
                document.getElementById('IMAGE_PLACEHOLDER_ID').innerHTML = '';
            }
        }, false);
    </script>
<?php
}
function kc_settings_page()
{
    $kc_post_types = get_post_types(['public' => true]);
    unset($kc_post_types['attachment']);
    $kc_categories = get_categories([
        'taxonomy' => 'category'
    ]);
    $nonce = wp_create_nonce('my_action');
?>
    <div class="wrap">
        <h2>Dan slider</h2>
        <form enctype="multipart/form-data" method="post" action="options.php">
            <?php
            settings_fields('kc-settings-group');
            do_settings_sections('bg_settings_page');
            do_settings_sections('settings_page1');
            submit_button();

            wp_nonce_field('my_action', 'my_nonce');
            ?>
            <script>
                jQuery(document).ready(function($) {
                    $('#kc_background_type').change(function() {
                        const option_val = $(this).val();
                        const options_arr = ['.custom_image', '#custom_color'];
                        $.each(options_arr, function(index, value) {
                            if (value[0] === '.') {
                                $('.custom_image').each(function(disabled_img_index, disabled_img_value) {
                                    $(disabled_img_value).prop('disabled', true);
                                    $(disabled_img_value).css('opacity', '0.5');
                                });
                            } else {
                                $(value).prop('disabled', true);
                                $(value).css('opacity', '0.5');
                            }
                        });
                        if (option_val === 'custom_image') {
                            $('.custom_image').each(function(unabled_img_index, unabled_img_value) {
                                $(unabled_img_value).prop('disabled', false);
                                $(unabled_img_value).css('opacity', '1');
                            });
                        }
                        if (option_val === 'custom_color') {
                            $('#custom_color').prop('disabled', false);
                            $('#custom_color').css('opacity', '1');
                        }
                    });
                });
            </script>
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
        </form>
    </div>
<?php
}
?>