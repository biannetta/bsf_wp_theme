<?php
/**
 * capacious sidebar layout options
 *
 * @since capacious  1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('capacious_sidebar_layout_options') ) :
    function capacious_sidebar_layout_options() {
        $capacious_sidebar_layout_options = array(
            'default-sidebar' => array(
                'value'     => 'default-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/default-sidebar.png'
            ),
            'left-sidebar' => array(
                'value'     => 'left-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/left-sidebar.png'
            ),
            'right-sidebar' => array(
                'value' => 'right-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/right-sidebar.png'
            ),
           'no-sidebar' => array(
                'value'     => 'no-sidebar',
                'thumbnail' => get_template_directory_uri() . '/inc/metabox/images/no-sidebar.png'
            )
        );
        return apply_filters( 'capacious_sidebar_layout_options', $capacious_sidebar_layout_options );
    }
endif;

/**
 * Custom Metabox
 *
 * @since capacious 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'capacious_add_metabox' )):
    function capacious_add_metabox() {
        add_meta_box(
            'capacious_sidebar_layout', // $id
            __( 'Sidebar Layout', 'capacious' ), // $title
            'capacious_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'high'
        ); // $priority

        add_meta_box(
            'capacious_sidebar_layout', // $id
            __( 'Sidebar Layout', 'capacious' ), // $title
            'capacious_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'high'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'capacious_add_metabox');



/**
 * Callback function for metabox
 *
 * @since capacious 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('capacious_sidebar_layout_callback') ) :
    function capacious_sidebar_layout_callback(){
        global $post;
        $capacious_sidebar_layout_options = capacious_sidebar_layout_options();
        $capacious_sidebar_layout = 'default-sidebar';
        $capacious_sidebar_meta_layout = get_post_meta( $post->ID, 'capacious_sidebar_layout', true );
        if( !empty($capacious_sidebar_meta_layout) ){
            $capacious_sidebar_layout = $capacious_sidebar_meta_layout;
        }
        wp_nonce_field( basename( __FILE__ ), 'capacious_sidebar_layout_nonce' );
        ?>
        <style>
            .hide-radio{
                position: relative;
                margin-bottom: 6px;
            }

            .hide-radio img, .hide-radio label{
                display: block;
            }

            .hide-radio input[type="radio"]{
                position: absolute;
                left: 50%;
                top: 50%;
                opacity: 0;
            }

            .hide-radio input[type=radio] + label {
                border: 3px solid #F1F1F1;
            }

            .hide-radio input[type=radio]:checked + label {
                border: 3px solid #0095E6;
            }
        </style>
        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php _e( 'Choose Sidebar Template', 'capacious' ); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($capacious_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="capacious_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $capacious_sidebar_layout ); ?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" />
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td><em class="f13"><?php _e( 'You can set up the sidebar content', 'capacious' ); ?> <a href="<?php echo admin_url('/widgets.php'); ?>"><?php _e( 'here', 'capacious' ); ?></a></em></td>
            </tr>

        </table>

    <?php }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since capacious 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('capacious_save_sidebar_layout') ) :
    function capacious_save_sidebar_layout( $post_id ) {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset( $_POST[ 'capacious_sidebar_layout_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'capacious_sidebar_layout_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }

        //Execute this saving function
        if(isset($_POST['capacious_sidebar_layout'])){
            $old = get_post_meta( $post_id, 'capacious_sidebar_layout', true);
            $new = sanitize_text_field($_POST['capacious_sidebar_layout']);
            if ($new && $new != $old) {
                update_post_meta($post_id, 'capacious_sidebar_layout', $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id,'capacious_sidebar_layout', $old);
            }
        }
    }

endif;
add_action('save_post', 'capacious_save_sidebar_layout');

