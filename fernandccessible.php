<?php
/**
 * Plugin Name: FernandCcesible
 * Plugin URI: https://fernanccesible.ar.nf
 * Description: Alternativa libre y gratuita a los menús de accesibilidad de Big Tech, y al difunto software libre Sienna.
 * Version: 3.1
 * Author: Alejo Fernández
 * Author URI: https://alejofernandez.es.ht
 * License: GPLv3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Cargar scripts y estilos
 */
add_action('wp_enqueue_scripts', function(){
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
    
    // Archivos del plugin
    wp_enqueue_script('fernandccessible-js', plugin_dir_url(__FILE__) . 'assets/accessibility.min.js', array(), null, true);
    wp_enqueue_style('fernandccessible-css', plugin_dir_url(__FILE__) . 'assets/fernandccessible.css');
});

/**
 * Insertar el menú de accesibilidad en el pie del sitio
 */
add_action('wp_footer', function(){
    include plugin_dir_path(__FILE__) . 'includes/menu.php';
});

/**
 * Página del plugin en el panel de administración
 */
add_action('admin_menu', function(){
    add_menu_page('FernandCcesible', 'FernandCcesible', 'manage_options', 'fernandccessible', function(){
        echo '<div class="wrap"><h1>FernandCcesible</h1>
        <p>Alternativa libre y gratuita a los menús de accesibilidad de Big Tech, y al difunto software libre Sienna.</p>
        <p>Visita <a href="https://fernanccesible.ar.nf" target="_blank">fernanccesible.ar.nf</a> para más información.</p>
        </div>';
    }, 'dashicons-universal-access-alt');
});

/**
 * Mensaje azul en la lista de plugins
 */
add_filter('plugin_row_meta', function($links, $file){
    if (plugin_basename(__FILE__) === $file) {
        $extra_link = '<a href="https://fernanccesible.ar.nf" target="_blank" style="color:#0073aa;font-weight:bold;">Gracias por apoyar a la accesibilidad y al software libre</a>';
        $links[] = $extra_link;
    }
    return $links;
}, 10, 2);
