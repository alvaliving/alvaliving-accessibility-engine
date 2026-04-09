<?php
/**
 * Plugin Name: Alvaliving Accessibility & SEO Engine
 * Description: Automated solution for Image Alt Text, WCAG Compliance, and Performance Optimization.
 * Version: 1.2
 * Author: Alvaliving Studio
 * Author URI: https://alvaliving.com
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. AUTOMATED IMAGE ATTRIBUTES
 * Generates descriptive Alt Text from filenames during upload.
 * Cleans hyphens, underscores and capitalizes for SEO and Screen Readers.
 */
add_action( 'add_attachment', 'alvaliving_set_image_alt_on_upload' );
function alvaliving_set_image_alt_on_upload( $post_id ) {
    if ( wp_attachment_is_image( $post_id ) ) {
        $file_name = get_post( $post_id )->post_title;
        $alt_text = str_replace( array( '-', '_' ), ' ', $file_name );
        $alt_text = ucwords( strtolower( $alt_text ) );

        update_post_meta( $post_id, '_wp_attachment_image_alt', $alt_text );
    }
}

/**
 * 2. VIEWPORT ACCESSIBILITY FIX
 * Overrides restrictive viewport meta tags to allow user-scaling (Zoom).
 * Essential for WCAG compliance and improving Lighthouse Accessibility scores.
 */
add_filter( 'get_header', 'alvaliving_fix_viewport_zoom' );
function alvaliving_fix_viewport_zoom() {
    ob_start( function( $buffer ) {
        $buffer = preg_replace(
            '/<meta name="viewport" content="[^"]*">/i',
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
            $buffer
        );
        return $buffer;
    });
}

/**
 * 3. DYNAMIC ACCESSIBILITY INJECTOR
 * Client-side fixes for semantic landmarks, aria-labels and link descriptions.
 */
add_action( 'wp_footer', 'alvaliving_accessibility_js_fixes' );
function alvaliving_accessibility_js_fixes() {
    ?>
    <script>
    (function() {
        /**
         * LANDMARK INJECTION
         * Ensures the document has a <main> landmark for screen reader navigation.
         */
        const content = document.querySelector('.dslc-modules-section-wrapper') || document.querySelector('#dslc-content');
        if (content && !document.querySelector('main')) {
            const main = document.createElement('main');
            main.setAttribute('role', 'main');
            content.parentNode.insertBefore(main, content);
            main.appendChild(content);
        }

        /**
         * ARIA-LABEL INJECTION
         * Fixes "Links do not have a discernible name" for Lightbox/Gallery elements.
         */
        document.querySelectorAll('a.dslc-lightbox-image').forEach(link => {
            if (!link.getAttribute('aria-label')) {
                link.setAttribute('aria-label', 'View full size image');
            }
        });

        /**
         * LINK CONTEXT OPTIMIZATION
         * Adds semantic context to repetitive "Read More" links using post titles.
         */
        document.querySelectorAll('a').forEach(link => {
            if (link.textContent.includes('Continuar a ler') || link.textContent.includes('Read more')) {
                const title = link.closest('.dslc-post')?.querySelector('h2')?.textContent || 'post content';
                link.setAttribute('aria-label', 'Read more about: ' + title);
            }
        });
    })();
    </script>
    <?php
}
