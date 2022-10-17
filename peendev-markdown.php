<?php
/*
Plugin Name: Peen.dev Markdown Editor for ClassicPress
Plugin URI: https://peen.dev/classicpress/markdown
Description: Replaces the Visual and Text editors with a Markdown editor. You must also install azurecurve/azrcrv-markdown to render the Markdown on the front-end.
Version: 1.0.2
Author: Niels Peen
Author URI: https://peen.dev/
License: GPLv2 or later
Text Domain: peendev-markdown
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/

require( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' );

use League\CommonMark\GithubFlavoredMarkdownConverter;

function peendev_markdown_is_relevant() {

    global $pagenow;

    if( $pagenow == 'post.php' || $pagenow == 'page.php' || $pagenow == 'comment.php' )
        return true;

    return false;
    
}

/*
 * Load EasyMDE stylesheet
 */
add_action( 'admin_head', 'peendev_markdown_head' );
function peendev_markdown_head() {

    $url = plugins_url('markdown.css', __FILE__);

    echo "<link rel=\"stylesheet\" href=\"{$url}\">";

}


/*
 * Load EasyMDE Javascript and hide Quicktags styling
 */
add_action( 'admin_footer', 'peendev_markdown_footer', 999 );
function peendev_markdown_footer() {

    if( peendev_markdown_is_relevant() !== true ) 
        return;

    $url = plugins_url('markdown.js', __FILE__);
    echo "<script src=\"{$url}\"></script>";

}


/*
 * Disable TinyMCE Visual editor
 */
add_filter( 'user_can_richedit', '__return_false', 50 );

/*
 * Disable Quicktags HTML editor
 */
add_action( 'wp_print_scripts', 'peendev_markdown_dequeue_scripts', 100);
function peendev_markdown_dequeue_scripts() {

    if( peendev_markdown_is_relevant() !== true ) 
        return;

    wp_deregister_script( 'quicktags' );

}

add_action( 'wp_enqueue_scripts', 'peendev_markdown_dequeue_styles', 100 );
function peendev_markdown_dequeue_styles() {

    if( peendev_markdown_is_relevant() !== true ) 
        return;

    wp_dequeue_style( 'code-editor' );

}

add_filter( 'the_content', 'peendev_markdown_content_render', 1, 1);
function peendev_markdown_content_render( $content ) {
    $converter = new GithubFlavoredMarkdownConverter([
    ]);

    return $converter->convert(do_shortcode($content));
}

add_filter( 'comment_text', 'peendev_markdown_comment_render', 8, 3 );
function peendev_markdown_comment_render( $comment_text, $comment, $args ) {
    $converter = new GithubFlavoredMarkdownConverter([
    ]);

    if( null !== $comment )
        return $converter->convert($comment_text);
    else
        return $comment_text;
}

