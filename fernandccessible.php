<?php
/**
 * Plugin Name: FernandCcesible
 * Plugin URI:  https://example.com/fernandccessible
 * Description: Menú de accesibilidad libre. Alternativa a los menús de accesibilidad de Big Tech, inspirada en el difunto software libre Sienna.
 * Version:     1.0.0
 * Author:      Alejo Fernández
 * Text Domain: fernandccessible
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FernandCcesible {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'wp_footer', [ $this, 'insert_menu' ] );
        add_action( 'admin_menu', [ $this, 'register_admin_page' ] );
    }

    public function enqueue_assets() {
        wp_enqueue_style(
            'fernandccessible-css',
            plugin_dir_url( __FILE__ ) . 'assets/fernandccessible.css'
        );

        wp_enqueue_script(
            'fernandccessible-js',
            plugin_dir_url( __FILE__ ) . 'assets/accessibility.min.js',
            [ 'jquery' ],
            false,
            true
        );
    }

    public function insert_menu() {
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
}

new FernandCcesible();