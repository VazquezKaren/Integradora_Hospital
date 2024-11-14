//Actualizacion de listas de paises, estados y municipios

const estadosMexico = {
    "Durango": ["Durango", "Canatlán", "Gómez Palacio"],
    "Nuevo León": ["Monterrey", "San Pedro", "Santa Catarina"],
    "Jalisco": ["Guadalajara", "Zapopan", "Puerto Vallarta"]
};

function actualizarEstados(prefix) {
    const pais = document.getElementById(`${prefix}_pais`).value;
    const estadoSelect = document.getElementById(`${prefix}_estado`);
    const municipioSelect = document.getElementById(`${prefix}_municipio`);

    estadoSelect.innerHTML = '<option value="">Seleccione un estado</option>';
    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';

    if (pais === "Mexico") {
        estadoSelect.disabled = false;
        municipioSelect.disabled = false;

        for (const estado in estadosMexico) {
            const option = document.createElement("option");
            option.value = estado;
            option.textContent = estado;
            estadoSelect.appendChild(option);
        }
    } else {
        estadoSelect.disabled = true;
        municipioSelect.disabled = true;
        estadoSelect.innerHTML = '<option value="Extranjero">Extranjero</option>';
        municipioSelect.innerHTML = '<option value="Extranjero">Extranjero</option>';
    }
}

function actualizarMunicipios(prefix) {
    const estado = document.getElementById(`${prefix}_estado`).value;
    const municipioSelect = document.getElementById(`${prefix}_municipio`);

    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';

    if (estadosMexico[estado]) {
        estadosMexico[estado].forEach(municipio => {
            const option = document.createElement("option");
            option.value = municipio;
            option.textContent = municipio;
            municipioSelect.appendChild(option);
        });
    }
}


// Selector de tabs dentro de una pagina 

function showTab(tabName) {
    var tabs = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }
    document.getElementById(tabName).style.display = "block";
    
    var buttons = document.getElementsByClassName("tab-btn");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("active");
    }
    event.currentTarget.classList.add("active");
}

function habilitarEdicion() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.removeAttribute('readonly');  
        input.removeAttribute('disabled');  
    });

    document.getElementById('guardar-btn').style.display = 'inline';
    document.getElementById('descartar-btn').style.display = 'inline';
    document.getElementById('modificar-btn').style.display = 'none';
}

function deshabilitarEdicion() {
 
    const inputs = document.querySelectorAll('input:not([name="busqueda"]), select, textarea');
    inputs.forEach(input => {
        input.setAttribute('readonly', true);  
        input.setAttribute('disabled', true);  
    });

    document.getElementById('guardar-btn').style.display = 'none';
    document.getElementById('descartar-btn').style.display = 'none';
    document.getElementById('modificar-btn').style.display = 'inline';
}