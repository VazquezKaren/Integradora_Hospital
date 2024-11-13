// JavaScript para controlar el loader
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.loader-container');
    
    function hideLoader() {
        loader.classList.add('loader-hidden');
    }

    window.addEventListener('load', hideLoader);

    setTimeout(hideLoader, 5000);
});

function toggleMenu() {
    document.body.classList.toggle('menu-closed');
}

document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.remove('menu-closed');
});




document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.list_item--click').forEach(item => {
        item.addEventListener('click', function() {
            const listShow = item.querySelector('.list_show');
            const arrow = item.querySelector('.arrow');

            // Alternar el estado del menú actual
            if (listShow.classList.contains('show')) {
                listShow.style.maxHeight = null;
            } else {
                listShow.style.maxHeight = listShow.scrollHeight + "px";
            }

            // Alternar clases para animación
            listShow.classList.toggle('show');
            arrow.classList.toggle('rotate');
        });
    });
});

