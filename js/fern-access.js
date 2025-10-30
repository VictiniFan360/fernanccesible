document.addEventListener('DOMContentLoaded', function() {
    const icon = document.getElementById('own-icon');
    const menu = document.querySelector('div[name="own-menu"] > div[role="dialog"]');
    const closeBtn = menu ? menu.querySelector('button') : null; // Botón "X"

    if(icon && menu){
        // Mostrar/ocultar menú al hacer clic en el ícono
        icon.addEventListener('click', function() {
            if(menu.style.display === 'none' || menu.style.display === ''){
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });
    }

    // Cerrar menú al hacer clic en el botón "X"
    if(closeBtn){
        closeBtn.addEventListener('click', function() {
            menu.style.display = 'none';
        });
    }

    // Soporte de accesskey "m" para abrir/cerrar menú
    document.addEventListener('keydown', function(e) {
        if(e.altKey && e.key.toLowerCase() === 'm'){
            e.preventDefault();
            if(menu.style.display === 'none' || menu.style.display === ''){
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
    });
});