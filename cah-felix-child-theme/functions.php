<?php

/**
 * Include style theme-child
 */

function cahfelix_setup() {
  // CSS
  wp_enqueue_style( 'prism-css', 'https://cdn.jsdelivr.net/npm/prismjs@1.14.0/themes/prism-okaidia.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/src/css/style-child.min.css?06'  );
  // JS
  wp_enqueue_script( 'prism-js', 'https://cdn.jsdelivr.net/npm/prismjs@1.14.0/prism.min.js', array('jquery'), '2.0.5', true );
}
add_action( 'wp_enqueue_scripts', 'cahfelix_setup', 11);


/**
 * Custom post class
 * Custom taxonomy course
 * Development for channel of class
 */

require_once('custom-posts/custom-post-aulas.php' );
require_once('custom-posts/custom-post-idiomas.php' );
require_once('custom-taxonomy/custom-taxonomy-cursos.php' );


/**
 * Embed Gists with a URL
 *
 * Usage:
 * Paste a gist link into a blog post or page and it will be embedded eg:
 * https://gist.github.com/2926827
 *
 * If a gist has multiple files you can select one using a url in the following format:
 * https://gist.github.com/2926827?file=embed-gist.php
 *
 * Updated this code on June 14, 2014 to work with new(er) Gist URLs
 */
 
wp_embed_register_handler( 'gist', '/https?:\/\/gist\.github\.com\/([a-z0-9]+)(\?file=.*)?/i', 'bhww_embed_handler_gist' );

function bhww_embed_handler_gist( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
			'<script src="https://gist.github.com/%1$s.js%2$s"></script>',
			esc_attr($matches[1]),
			esc_attr($matches[2])
			);

	return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
	
}


/**
 * Remove emojis
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
    

/**
 * Implementing AMP Pages
 */
define( 'AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );
add_image_size( 'amp_img', 640, 420, true );
add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
add_filter( 'template_include', 'amp_page_template', 99 );

function amp_page_template( $template ) {
	if( get_query_var( AMP_QUERY_VAR, false ) !== false ) {
		if ( is_single()) { 
			$template = get_template_directory() .  '/amp-single.php';
		} 
	}	
	return $template;
}

/**
 * Define canonical no amp
 */
function amp_seo() {
	if( is_single() ){
    ?>
    <link rel="amphtml" href="<?php echo esc_url( get_the_permalink().'amp' ); ?>" />
    <?php
	}
}
add_action('wp_head', 'amp_seo');    



/**
 * TN - Remove Query String from Static Resources
 */
function remove_css_js_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
	$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_css_js_ver', 10, 2 );



/**
 * Recaptcha Comentario
 *
 */

function cahfelix_comment_check($comment_id) {
    global $wpdb, $user_ID, $comment_count_cache;

    if ($user_ID) {
        return;
    }

    $hash = $_POST['challenge_hash'];
    $challenge = md5($_POST['challenge']);
    $post_id = $_POST['comment_post_ID'];

    if ($hash != $challenge) {
        $wpdb->query("DELETE FROM {$wpdb->comments} WHERE comment_ID = {$comment_id}");
        $count = $wpdb->get_var("select count(*) from $wpdb->comments where comment_post_id = {$post_id} and comment_approved = '1'");
        $wpdb->query("update $wpdb->posts set comment_count = {$count} where ID = {$post_id}");
        wp_die(__('Desculpe, mas seu calculo está incorreto...'));
    }
}

function cahfelix_comment_form() {
    global $user_ID;

    if ($user_ID) {
        return;
    }

    $nums = array(rand(1,4), rand(1,4));
    $n1 = max($nums[0], $nums[1]);
    $n2 = min($nums[0], $nums[1]);
    $challenge = ($n1 + $n2);
    $hash = md5($challenge);

    $question = "Quanto é {$n1} + {$n2}?";
    $field = sprintf('<p><label for="challenge">%s</label> <input type="hidden" name="challenge_hash" value="%s" /> <input type="text" name="challenge" id="challenge" size="2" /></p><p class="submit-alter-jquery"></p>', $question, $hash);
    echo $field;
}

add_action('comment_post', 'cahfelix_comment_check');
add_action('comment_form', 'cahfelix_comment_form');


