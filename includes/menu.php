<?php
// FernandCcesible - Menú de accesibilidad final
?>
<div id="fernandccessible-wrapper">
  <button accesskey="m" id="own-icon" title="Accesibilidad"
     style="position: fixed; bottom: 20px; right: 20px; z-index: 100000; cursor:pointer; border:none; background:transparent; padding:0;">
    <img width="60" height="60"
         src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/cuerpo.png'); ?>"
         alt="Accesibilidad">
  </button>

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
      <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:8px;">
        <button id="btn-tts" class="own-btn-primary" type="button"><i class="fa-solid fa-volume-high"></i> Texto a voz</button>
        <button id="btn-tts-stop" class="own-btn-secondary" type="button"><i class="fa-solid fa-volume-xmark"></i> Silenciar</button>
        <button id="btn-font-inc" class="own-btn-primary" type="button"><i class="fa-solid fa-magnifying-glass-plus"></i> Aumentar texto</button>
        <button id="btn-font-dec" class="own-btn-primary" type="button"><i class="fa-solid fa-magnifying-glass-minus"></i> Reducir texto</button>
        <button id="btn-contrast" class="own-btn-primary" type="button"><i class="fa-solid fa-circle-half-stroke"></i> Contraste alto</button>
        <button id="btn-saturate" class="own-btn-primary" type="button"><i class="fa-solid fa-droplet-slash"></i> Desaturar</button>
        <button id="btn-reset" class="own-btn-secondary" type="button"><i class="fa-solid fa-rotate"></i> Restablecer</button>
      </div>

      <h3 style="margin-top:16px;"><i class="fa-solid fa-eye"></i> Simulación de daltonismo</h3>
      <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:8px;">
        <button id="btn-protanopia" class="own-btn-primary" type="button"><i class="fa-solid fa-eye"></i> Protanopía</button>
        <button id="btn-deuteranopia" class="own-btn-primary" type="button"><i class="fa-solid fa-eye-dropper"></i> Deuteranopía</button>
        <button id="btn-tritanopia" class="own-btn-primary" type="button"><i class="fa-solid fa-eye-slash"></i> Tritanopía</button>
        <button id="btn-dalton-reset" class="own-btn-secondary" type="button"><i class="fa-solid fa-rotate"></i> Restablecer</button>
      </div>

      <h3 style="margin-top:16px;"><i class="fa-solid fa-palette"></i> Colores del sitio</h3>
      <label for="bg-color"><i class="fa-solid fa-fill-drip"></i> Color de fondo:</label>
      <input type="color" id="bg-color" name="bg-color" style="width:100%;height:40px;" value="#ffffff">
      <label for="text-color"><i class="fa-solid fa-font"></i> Color del texto:</label>
      <input type="color" id="text-color" name="text-color" style="width:100%;height:40px;" value="#000000">

      <p style="margin-top:12px; font-size:0.9em;">
        <em>FernandCcesible: alternativa libre a los menús de accesibilidad privativos.</em>
      </p>
    </section>
  </div>
</div>

<script>
let ttsUtterance = null;
const icon = document.getElementById("own-icon");

// Abrir/Cerrar menú
document.addEventListener("click", function(e){
  const menu = document.getElementById("own-menu");

  if(e.target.closest("#own-icon")){
    if(menu.style.display === "none" || menu.style.display === ""){
      menu.style.display = "block";
      menu.setAttribute("aria-hidden","false");
    } else {
      menu.style.display = "none";
      menu.setAttribute("aria-hidden","true");
    }
  }

  if(e.target.closest("#close-menu")){
    menu.style.display = "none";
    menu.setAttribute("aria-hidden","true");
  }

  // Texto a voz
  if(e.target.closest("#btn-tts")){
    if('speechSynthesis' in window){
      window.speechSynthesis.cancel();
      ttsUtterance = new SpeechSynthesisUtterance(document.body.innerText);
      window.speechSynthesis.speak(ttsUtterance);
    } else {
      alert("Tu navegador no soporta texto a voz");
    }
  }

  // Silenciar TTS
  if(e.target.closest("#btn-tts-stop")){
    window.speechSynthesis.cancel();
    ttsUtterance = null;
  }

  // Tamaño de texto
  if(e.target.closest("#btn-font-inc")){
    document.body.style.fontSize = (parseFloat(getComputedStyle(document.body).fontSize)+2)+"px";
  }
  if(e.target.closest("#btn-font-dec")){
    document.body.style.fontSize = (parseFloat(getComputedStyle(document.body).fontSize)-2)+"px";
  }

  // Contraste y desaturado
  if(e.target.closest("#btn-contrast")){
    document.body.classList.toggle("fernand-contrast");
  }
  if(e.target.closest("#btn-saturate")){
    document.body.classList.toggle("fernand-desaturate");
  }

  // Daltonismo
  if(e.target.closest("#btn-protanopia")){
    document.body.classList.add("fernand-protanopia");
    document.body.classList.remove("fernand-deuteranopia","fernand-tritanopia");
    icon.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
  if(e.target.closest("#btn-deuteranopia")){
    document.body.classList.add("fernand-deuteranopia");
    document.body.classList.remove("fernand-protanopia","fernand-tritanopia");
    icon.innerHTML = '<i class="fa-solid fa-eye-dropper"></i>';
  }
  if(e.target.closest("#btn-tritanopia")){
    document.body.classList.add("fernand-tritanopia");
    document.body.classList.remove("fernand-protanopia","fernand-deuteranopia");
    icon.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  }
  if(e.target.closest("#btn-dalton-reset")){
    document.body.classList.remove("fernand-protanopia","fernand-deuteranopia","fernand-tritanopia");
    icon.innerHTML = '<img width="60" height="60" src="<?php echo esc_url(plugin_dir_url(__FILE__)."../assets/cuerpo.png"); ?>" alt="Accesibilidad">';
  }

  // Reset general
  if(e.target.closest("#btn-reset")){
    document.body.style.fontSize = "";
    document.body.style.backgroundColor = "";
    document.body.style.color = "";
    document.body.classList.remove(
      "fernand-contrast","fernand-desaturate",
      "fernand-protanopia","fernand-deuteranopia","fernand-tritanopia"
    );
    window.speechSynthesis.cancel();
    ttsUtterance = null;
    icon.innerHTML = '<img width="60" height="60" src="<?php echo esc_url(plugin_dir_url(__FILE__)."../assets/cuerpo.png"); ?>" alt="Accesibilidad">';
    document.getElementById("bg-color").value = "#ffffff";
    document.getElementById("text-color").value = "#000000";
  }
});

// Colores aplicados al instante
document.getElementById("bg-color").addEventListener("input", function(e){
  document.body.style.backgroundColor = e.target.value;
});
document.getElementById("text-color").addEventListener("input", function(e){
  document.body.style.color = e.target.value;
});

// Cerrar menú con ESC
document.addEventListener("keydown", function(e){
  if(e.key === "Escape"){
    const menu = document.getElementById("own-menu");
    menu.style.display = "none";
    menu.setAttribute("aria-hidden","true");
  }
});
</script>
