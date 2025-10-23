<?php
// FernandCcesible - Menú de accesibilidad funcional y limpio.
?>
<div id="fernandccessible-wrapper">
  <i accesskey="m" data-tooltip="alt + m" id="own-icon" class="own-icon" title="Accesibilidad"
     style="position: fixed; bottom: 20px; right: 20px; z-index: 100000; cursor: pointer; pointer-events:auto;">
    <img width="60" height="60" 
         src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../assets/cuerpo.png' ); ?>" 
         alt="Accesibilidad" class="own-visible">
  </i>

  <div id="own-menu" class="own-menu" role="dialog" aria-modal="true" aria-hidden="true" tabindex="-1"
       style="display:none; position:fixed; bottom:90px; right:20px; z-index:100001; width:340px; max-height:72vh; overflow:auto; background:#fff; border-radius:12px; padding:14px; box-shadow:0 20px 40px rgba(0,0,0,.12);">
    <header class="own-offcanvas-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
      <h2 id="menuTitle" class="menu-title" style="margin:0; font-size:1.1rem;">Menú de Accesibilidad</h2>
      <button type="button" class="own-btn-close" aria-label="Cerrar menú" style="background:transparent;border:none;font-size:18px;cursor:pointer;">✕</button>
    </header>

    <section class="own-card-body">
      <p>Activa o desactiva las siguientes funciones:</p>
      <div class="own-controls" style="display:flex;flex-wrap:wrap;gap:8px;">
        <button id="btn-tts" class="own-btn own-btn-primary" type="button"> Texto a voz</button>
        <button id="btn-font-inc" class="own-btn own-btn-primary" type="button"> Aumentar texto</button>
        <button id="btn-font-dec" class="own-btn own-btn-primary" type="button"> Reducir texto</button>
        <button id="btn-contrast" class="own-btn own-btn-primary" type="button"> Contraste alto</button>
        <button id="btn-saturate" class="own-btn own-btn-primary" type="button"> Desaturar</button>
        <button id="btn-reset" class="own-btn own-btn-secondary" type="button"> Restablecer</button>
      </div>
      <p style="margin-top:12px; font-size:0.9em;">
        <em>FernandCcesible: alternativa libre a los menús de accesibilidad privativos.</em>
      </p>
    </section>
  </div>
</div>

<script>
(function(){
  // Ensure code runs after DOM is ready
  function ready(fn){
    if(document.readyState !== 'loading'){
      fn();
    } else {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }

  ready(function(){
    const icon = document.getElementById('own-icon');
    const menu = document.getElementById('own-menu');

    if(!icon || !menu){
      console.warn('FernandCcesible: icon or menu not found.');
      return;
    }

    // Use a helper to show/hide
    function showMenu(){
      menu.setAttribute('aria-hidden','false');
      menu.style.display = 'block';
      // trap focus minimally
      menu.setAttribute('tabindex','-1');
      menu.focus();
    }
    function hideMenu(){
      menu.setAttribute('aria-hidden','true');
      menu.style.display = 'none';
    }
    function toggleMenu(){
      if(menu.getAttribute('aria-hidden') === 'true' || getComputedStyle(menu).display === 'none'){
        showMenu();
      } else {
        hideMenu();
      }
    }

    // Click on icon toggles menu
    icon.addEventListener('click', function(e){
      e.preventDefault();
      toggleMenu();
    }, false);

    // Close button inside menu
    const closeBtn = menu.querySelector('.own-btn-close');
    if(closeBtn){
      closeBtn.addEventListener('click', function(e){
        e.preventDefault();
        hideMenu();
      }, false);
    }

    // Click outside closes menu
    document.addEventListener('click', function(e){
      if(menu.getAttribute('aria-hidden') === 'false'){
        if(!menu.contains(e.target) && !icon.contains(e.target)){
          hideMenu();
        }
      }
    }, false);

    // Keyboard: ESC closes menu, M toggles (Alt+M already handled by accesskey in browser)
    document.addEventListener('keydown', function(e){
      if(e.key === 'Escape' || e.key === 'Esc'){
        if(menu.getAttribute('aria-hidden') === 'false') hideMenu();
      }
      // Allow keyboard toggle with Ctrl+M (as extra)
      if((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'm'){
        e.preventDefault();
        toggleMenu();
      }
    }, false);

    // Accessibility functions
    const ttsBtn = document.getElementById('btn-tts');
    const incBtn = document.getElementById('btn-font-inc');
    const decBtn = document.getElementById('btn-font-dec');
    const contrastBtn = document.getElementById('btn-contrast');
    const satBtn = document.getElementById('btn-saturate');
    const resetBtn = document.getElementById('btn-reset');
    const html = document.documentElement;

    let fontScale = 1;
    let contrastActive = false;
    let desaturated = false;

    if(ttsBtn){
      ttsBtn.addEventListener('click', function(){
        const text = window.getSelection().toString() || document.body.innerText;
        if('speechSynthesis' in window){
          const utter = new SpeechSynthesisUtterance(text.substring(0, 3000));
          utter.lang = document.documentElement.lang || 'es-ES';
          speechSynthesis.cancel();
          speechSynthesis.speak(utter);
        } else {
          alert("Tu navegador no soporta texto a voz (SpeechSynthesis).");
        }
      });
    }
    if(incBtn){
      incBtn.addEventListener('click', function(){
        fontScale += 0.1;
        // prefer changing root font-size instead of transform for accessibility
        const current = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--fc-base-scale') || '1');
        document.documentElement.style.setProperty('--fc-base-scale', (current + 0.1).toString());
        document.documentElement.style.fontSize = (100 * (current + 0.1)) + '%';
      });
    }
    if(decBtn){
      decBtn.addEventListener('click', function(){
        const current = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--fc-base-scale') || '1');
        const next = Math.max(0.8, current - 0.1);
        document.documentElement.style.setProperty('--fc-base-scale', next.toString());
        document.documentElement.style.fontSize = (100 * next) + '%';
      });
    }
    if(contrastBtn){
      contrastBtn.addEventListener('click', function(){
        contrastActive = !contrastActive;
        document.documentElement.classList.toggle('fc-contrast', contrastActive);
      });
    }
    if(satBtn){
      satBtn.addEventListener('click', function(){
        desaturated = !desaturated;
        document.documentElement.classList.toggle('fc-desaturated', desaturated);
      });
    }
    if(resetBtn){
      resetBtn.addEventListener('click', function(){
        if('speechSynthesis' in window) speechSynthesis.cancel();
        document.documentElement.style.fontSize = '';
        document.documentElement.style.removeProperty('--fc-base-scale');
        document.documentElement.classList.remove('fc-contrast','fc-desaturated');
      });
    }

  }); // ready end
})(); // IIFE end
</script>
