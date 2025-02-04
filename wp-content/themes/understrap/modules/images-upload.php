<?php

class ImagesField {
    private $screen = array(
        'post',
        'page',
        'real-estate'
    );

    private $meta_fields = array(
        array(
            'label' => 'Images field',
            'id' => 'images',
            'type' => 'media',
            'returnvalue' => 'URL',
        )
    );

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('admin_footer', array($this, 'media_fields'));
        add_action('save_post', array($this, 'save_fields'));
    }

    public function add_meta_boxes() {
        foreach ($this->screen as $single_screen) {
            add_meta_box(
                'images',
                __('Real estate images', 'text-domain'),
                array($this, 'meta_box_callback'),
                $single_screen,
                'normal',
                'default'
            );
        }
    }

    public function meta_box_callback($post) {
        wp_nonce_field('images_data', 'images_nonce');
        $this->field_generator($post);
    }
    public function media_fields() { ?>
        <script>
            jQuery(document).ready(function($) {
                if (typeof wp.media !== 'undefined') {
                    var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                    $('.new-media').click(function(e) {
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(this);
                        var id = button.attr('id').replace('_button', '');
                        _custom_media = true;
                        wp.media.editor.send.attachment = function(props, attachment) {
                            if (_custom_media) {
                                if ($('input#' + id).data('return') == 'url') {
                                    $('input#' + id).val(attachment.url);
                                } else {
                                    $('input#' + id).val(attachment.id);
                                }
                                $('div#preview' + id).css('background-image', 'url(' + attachment.url + ')');
                            } else {
                                return _orig_send_attachment.apply(this, [props, attachment]);
                            };
                        }
                        wp.media.editor.open(button);
                        return false;
                    });
                    $('.add_media').on('click', function() {
                        _custom_media = false;
                    });
                    $('.remove-media').on('click', function() {
                        var parent = $(this).parents('td');
                        parent.find('input[type="text"]').val('');
                        parent.find('div').css('background-image', 'url()');
                    });
                }
            });
        </script>
        <?php
    }

    public function field_generator($post) {
        $output = '';
        foreach ($this->meta_fields as $meta_field) {
            $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta($post->ID, $meta_field['id'], true);
            if (empty($meta_value)) {
                if (isset($meta_field['default'])) {
                    $meta_value = $meta_field['default'];
                }
            }
            switch ($meta_field['type']) {

                case 'media':
                    $meta_type = '';
                    if ($meta_value) {
                        if ($meta_field['returnvalue'] == 'URL') {
                            $meta_type = $meta_value;
                        } else {
                            $meta_type = wp_get_attachment_url($meta_value);
                        }
                    }
                    $input = sprintf(
                        '<input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s"><div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 19%%;margin-right:5px;" class="button new-media" id="%s_button" name="%s_button" type="button" value="Select" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Clear" />',
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_value,
                        $meta_field['returnvalue'],
                        $meta_field['id'],
                        $meta_type,
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_field['id']
                    );
                    break;
            }
            $output .= $this->format_rows($label, $input);
        }
        //echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';

        ?>
        <ul class="misha-gallery" style="display: flex; gap: 24px;">
            <?php
            $post_id = get_the_ID();

            $image_ids = get_post_meta( $post_id, 'images', true );
            $image_ids = explode(',', $image_ids);

            foreach( $image_ids as $i => &$id ) {
                $url = wp_get_attachment_image_url( $id, array( 80, 80 ) );
                if( $url ) {
                    ?>
                    <li data-id="<?php echo $id ?>">
                        <span style="display: block;width: 100px;height: 100px;background-size: cover; background-image:url('<?php echo $url ?>')"></span>
                        <a href="#" class="misha-gallery-remove">&times;</a>
                    </li>
                    <?php
                } else {
                    unset( $image_ids[ $i ] );
                }
            }
            ?>
        </ul>
        <input type="hidden" name="images" value="<?php echo join( ',', $image_ids ) ?>" />
        <a href="#" class="button misha-upload-button">Add Images</a>
        <?php

    }

    public function format_rows($label, $input) {
        return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
    }

    public function save_fields($post_id) {
        if (!isset($_POST['images_nonce']))
            return $post_id;
        $nonce = $_POST['images_nonce'];
        if (!wp_verify_nonce($nonce, 'images_data'))
            return $post_id;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
        foreach ($this->meta_fields as $meta_field) {
            if (isset($_POST[$meta_field['id']])) {
                switch ($meta_field['type']) {
                    case 'email':
                        $_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
                        break;
                    case 'text':
                        $_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
                        break;
                }
                update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
            } else if ($meta_field['type'] === 'checkbox') {
                update_post_meta($post_id, $meta_field['id'], '0');
            }
        }
    }
}

if (class_exists('ImagesField')) {
    new ImagesField;
};