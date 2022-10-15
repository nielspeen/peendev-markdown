<?php
/*
Plugin Name: Peen.dev Markdown Editor for ClassicPress
Plugin URI: https://peen.dev/classicpress/markdown
Description: Replaces the Visual and Text editors with a Markdown editor. You must also install azurecurve/azrcrv-markdown to render the Markdown on the front-end.
Version: 1.0.0
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

/*
 * Load EasyMDE stylesheet
 */
function peendev_markdown_head() {
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">';
}

add_action( 'admin_head', 'peendev_markdown_head' );

/*
 * Load EasyMDE Javascript and hide Quicktags styling
 */
function peendev_markdown_footer() {
    echo '<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>';

    $script = file_get_contents( plugin_dir_path( __FILE__ ) . 'markdown.js');
    $css    = file_get_contents( plugin_dir_path( __FILE__ ) . 'markdown.css');

    echo "<script>{$script}</script>";
    echo "<style>{$css}</style>";
}

add_action( 'admin_footer', 'peendev_markdown_footer', 999 );

/*
 * Disable TinyMCE Visual editor
 */
add_filter( 'user_can_richedit', '__return_false', 50 );

/*
 * Disable Quicktags HTML editor
 */
function peendev_markdown_dequeue_scripts() {
    wp_deregister_script( 'quicktags' );
}

add_action( 'wp_print_scripts', 'peendev_markdown_dequeue_scripts', 100);

function peendev_markdown_dequeue_styles() {
	wp_dequeue_style( 'code-editor' );

}
add_action( 'wp_enqueue_scripts', 'peendev_markdown_dequeue_styles', 100 );
