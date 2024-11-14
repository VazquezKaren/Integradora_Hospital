document.getElementById('toggle-button').addEventListener('click', function() {
    const manualContent = document.getElementById('manual-content');
    
    // Alterna la visibilidad de la sección
    if (manualContent.style.display === 'none' || manualContent.style.display === '') {
        manualContent.style.display = 'block';
        this.textContent = 'Ocultar sección';
    } else {
        manualContent.style.display = 'none';
        this.textContent = 'Mostrar sección';
    }
});
