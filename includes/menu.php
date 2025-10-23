<?php
// FernandCcesible - Menú de accesibilidad con Font Awesome
?>
<div id="fernandccessible-wrapper">
  <i accesskey="m" id="own-icon" title="Accesibilidad"
     style="position: fixed; bottom: 20px; right: 20px; z-index: 100000; cursor: pointer;">
    <img width="60" height="60"
         src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../assets/cuerpo.png' ); ?>"
         alt="Accesibilidad">
  </i>

  <div id="own-menu" role="dialog" aria-modal="true" aria-hidden="true" tabindex="-1"
       style="display:none; position:fixed; bottom:90px; right:20px; z-index:100001; width:340px; max-height:72vh; overflow:auto; background:#fff; border-radius:12px; padding:14px; box-shadow:0 20px 40px rgba(0,0,0,.12);">
    <header style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
      <h2 style="margin:0; font-size:1.1rem;"><i class="fa-solid fa-universal-access"></i> Menú de Accesibilidad</h2>
      <button type="button" id="close-menu" aria-label="Cerrar menú" style="background:transparent;border:none;font-size:18px;cursor:pointer;">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </header>

    <section>
      <p>Activa o desactiva las siguientes funciones:</p>
      <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <button id="btn-tts" class="own-btn-primary" type="button"><i class="fa-solid fa-volume-high"></i> Texto a voz</button>
        <button id="btn-font-inc" class="own-btn-primary" type="button"><i class="fa-solid fa-magnifying-glass-plus"></i> Aumentar texto</button>
        <button id="btn-font-dec" class="own-btn-primary" type="button"><i class="fa-solid fa-magnifying-glass-minus"></i> Reducir texto</button>
        <button id="btn-contrast" class="own-btn-primary" type="button"><i class="fa-solid fa-circle-half-stroke"></i> Contraste alto</button>
        <button id="btn-saturate" class="own-btn-primary" type="button"><i class="fa-solid fa-droplet-slash"></i> Desaturar</button>
        <button id="btn-reset" class="own-btn-secondary" type="button"><i class="fa-solid fa-rotate"></i> Restablecer</button>
      </div>

      <h3 style="margin-top:16px;"><i class="fa-solid fa-palette"></i> Colores del sitio</h3>
      <label for="bg-color"><i class="fa-solid fa-fill-drip"></i> Color de fondo:</label>
      <input type="color" id="bg-color" name="bg-color" style="width:100%;height:40px;">
      <label for="text-color"><i class="fa-solid fa-font"></i> Color del texto:</label>
      <input type="color" id="text-color" name="text-color" style="width:100%;height:40px;">

      <p style="margin-top:12px; font-size:0.9em;">
        <em>FernandCcesible: alternativa libre a los menús de accesibilidad privativos.</em>
      </p>
    </section>
  </div>
</div>
