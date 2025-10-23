<?php
/**
 * Plugin Name: FernandCcesible
 * Plugin URI:  https://example.com/fernandccessible
 * Description: Menú de accesibilidad libre. Alternativa a los menús de accesibilidad de Big Tech, inspirada en el difunto software libre Sienna.
 * Version:     1.1.0
 * Author:      Alejo Fernández
 * Text Domain: fernandccessible
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FernandCcesible {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'wp_footer', [ $this, 'insert_menu' ], 100 );
        add_action( 'admin_menu', [ $this, 'register_admin_page' ] );
        add_shortcode( 'fernandccessible_menu', [ $this, 'shortcode_menu' ] );
    }

    public function enqueue_assets() {
        // CSS
        wp_enqueue_style(
            'fernandccessible-css',
            plugin_dir_url( __FILE__ ) . 'assets/fernandccessible.css',
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . 'assets/fernandccessible.css' )
        );

        // accessibility script (user-provided)
        wp_enqueue_script(
            'fernandccessible-js',
            plugin_dir_url( __FILE__ ) . 'assets/accessibility.min.js',
            array( 'jquery' ),
            file_exists( plugin_dir_path( __FILE__ ) . 'assets/accessibility.min.js' ) ? filemtime( plugin_dir_path( __FILE__ ) . 'assets/accessibility.min.js' ) : null,
            true
        );

        // tiny inline helper to ensure the floating icon toggles #own-menu if the script doesn't
        $inline = "(function(){ document.addEventListener('click', function(e){ var icon = document.getElementById('own-icon'); var menu = document.getElementById('own-menu'); if(!icon || !menu) return; if(icon.contains(e.target)){ if(menu.style.display === 'none' || getComputedStyle(menu).display === 'none'){ menu.style.display = 'block'; } else { menu.style.display = 'none'; } } }, false);})();";
        wp_add_inline_script( 'fernandccessible-js', $inline );
    }

    public function insert_menu() {
        // Auto-inject the menu on every frontend page (user requested)
        include plugin_dir_path( __FILE__ ) . 'includes/menu.php';
    }

    public function register_admin_page() {
        add_menu_page(
            'FernandCcesible',
            'FernandCcesible',
            'manage_options',
            'fernandccessible',
            [ $this, 'render_admin_page' ],
            'dashicons-universal-access-alt'
        );
    }

    public function render_admin_page() {
        ?>
        <div class="wrap" style="max-width:700px;">
            <h1>FernandCcesible</h1>
            <p style="font-size:1.1em; line-height:1.6;">
                <strong>Alternativa libre y gratuita</strong> a los menús de accesibilidad de <em>Big Tech</em>,<br>
                y al difunto software libre <strong>Sienna</strong>.
            </p>
            <p>Este plugin incorpora un menú de accesibilidad simple en el frontend de tu sitio.</p>
            <hr>
            <p><em>Gracias por apoyar la accesibilidad y el software libre.</em></p>
        </div>
        <?php
    }

    public function shortcode_menu() {
        ob_start();
        include plugin_dir_path( __FILE__ ) . 'includes/menu.php';
        return ob_get_clean();
    }
}

new FernandCcesible();
