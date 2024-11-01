<?php
if (!defined('ABSPATH')) {
    exit;
}

class Tx_Post_Duplicator 
{
    public static function init()
    {
		add_filter( 'admin_action_duplicate_as_draft', array( __CLASS__, 'duplicate_as_draft' ) );
        add_filter( 'post_row_actions', array( __CLASS__, 'duplicate_actions' ), 10, 2 );
        add_filter( 'page_row_actions', array( __CLASS__, 'duplicate_actions' ), 10, 2 );
    }

    /**
     * "Ex Duplicator" added to the row action
     *
     * @param array $actions
     * @param WP_Post $post
     * @return array
     */
    public static function duplicate_actions( $actions, $post ) {

        if ( current_user_can( 'edit_posts' ) ) {
            $actions['duplicate'] = '<a href="' . wp_nonce_url(
                    'admin.php?action=duplicate_as_draft&post=' . $post->ID, basename( __FILE__ ),
                    'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
        }
        
        return $actions;
    }
    
    /**
     * Duplicate a post function
     * @return void
     */
    public static function duplicate_as_draft() {

        global $wpdb;
        if ( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] ) || ( isset( $_REQUEST['action'] ) && 'duplicate_as_draft' == $_REQUEST['action'] ) ) ) {
            wp_die( 'No post to duplicate has been supplied!' );
        }
        /*
         * Nonce verification
         */
        
        $pd_nonce = filter_input( INPUT_GET, 'duplicate_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        
        if ( ! isset( $pd_nonce ) || ! wp_verify_nonce( $pd_nonce, basename( __FILE__ ) ) ) {
            return;
        }
        /*
         * get the original post id
         */
        $post_id = ( isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
        /*
         * and all the original post data then
         */
        $post = get_post( $post_id );
        /*
         * if you don't want current user to be the new post author,
         * then change next couple of lines to this: $new_post_author = $post->post_author;
         */
        $current_user    = wp_get_current_user();
        $new_post_author = $current_user->ID;
        /*
         * if post data exists, create the post duplicate
         */
        if ( isset( $post ) && $post != null ) {
            /*
             * new post data array
             */
            $args = array(
                'comment_status' => $post->comment_status,
                'ping_status'    => $post->ping_status,
                'post_author'    => $new_post_author,
                'post_content'   => $post->post_content,
                'post_excerpt'   => $post->post_excerpt,
                'post_name'      => $post->post_name,
                'post_parent'    => $post->post_parent,
                'post_password'  => $post->post_password,
                'post_status'    => 'draft',
                'post_title'     => $post->post_title,
                'post_type'      => $post->post_type,
                'to_ping'        => $post->to_ping,
                'menu_order'     => $post->menu_order
            );
            
            // insert the post by wp_insert_post() function
            $new_post_id = wp_insert_post( $args );
            
            // get all current post terms ad set them to the new post draft
            $taxonomies = get_object_taxonomies(
                $post->post_type ); // returns array of taxonomy names for post type, ex array("category", "post_tag");
            
            foreach ( $taxonomies as $taxonomy ) {
                $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
                wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
            }
            
            // duplicate all post meta just in two SQL queries
            $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=%d", $post_id ) );
            if ( count( $post_meta_infos ) != 0 ) {
                $sql_query = "INSERT INTO `$wpdb->postmeta`(post_id, meta_key, meta_value) ";
                foreach ( $post_meta_infos as $meta_info ) {
                    $meta_key = $meta_info->meta_key;
                    if ( $meta_key == '_wp_old_slug' ) {
                        continue;
                    }
                    $meta_value      = addslashes( $meta_info->meta_value );
                    $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
                }
                $sql_query .= implode( " UNION ALL ", $sql_query_sel );
                $wpdb->query( $wpdb->prepare( $sql_query ) );
            }
            /*
             * finally, redirect to the edit post screen for the new draft
             */
            wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
            exit;
        } else {
            wp_die( 'Post creation failed, could not find original post: ' . esc_html( $post_id ) );
        }
    }
                  
}

Tx_Post_Duplicator::init();
