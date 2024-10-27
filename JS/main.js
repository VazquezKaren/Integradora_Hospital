// JavaScript para controlar el loader
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.loader-container');
    
    function hideLoader() {
        loader.classList.add('loader-hidden');
    }

    window.addEventListener('load', hideLoader);

    setTimeout(hideLoader, 5000);
});