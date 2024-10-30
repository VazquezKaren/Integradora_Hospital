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