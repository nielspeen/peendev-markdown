This plug-in replaces the default ClassicPress editor with the EasyMDE Markdown editor.

## Changelog

v1.0.3
 * Fix issue where EasyMDE did not show up on post-new.php.
 * Add readme.txt with PHP 8.1 requirement.

v1.0.2
 * Bundle EasyMDE and highlight.js, allowing for offline use.
 * Various small fixes.

v1.0.1 
 * Use built-in Markdown renderer. (You should remove the azrcrv-markdown plug-in).
 * Support Markdown in comments.

v1.0.0 Initial release.
 * Support Markdown in Posts and Pages.

## Requirements

 * ClassicPress >= 1.4.3
 * PHP >= 8.1.0

## Installation

No special instructions. Install & activate [nielspeen/peendev-markdown](https://github.com/nielspeen/peendev-markdown/releases). There is no settings page.

## Upgrading

If you're upgrading from v1.0.0, you should remove the azrcrv-markdown plug-in. Peendev-markdown now comes with a built-in markdown renderer (CommonMark).
