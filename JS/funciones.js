document.addEventListener("DOMContentLoaded", function () {
    let data;
    fetch("/Integradora_Hospital/JS/estados-municipios.json")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error al cargar el archivo JSON");
            }
            return response.json();
        })
        .then((jsonData) => {
            data = jsonData;
        })
        .catch((error) => {
            console.error("Error al cargar los datos JSON:", error);
        });

    // Actualizar estados
    window.actualizarEstados = function (prefix) {
        const paisSelect = document.getElementById(`${prefix}_pais`);
        const estadoSelect = document.getElementById(`${prefix}_estado`);
        const municipioSelect = document.getElementById(`${prefix}_municipio`);

        const paisSeleccionado = paisSelect.value;

        estadoSelect.innerHTML = '<option value="" disabled selected>Seleccione un estado</option>';
        municipioSelect.innerHTML = '<option value="" disabled selected>Seleccione un municipio</option>';

        if (paisSeleccionado === "Mexico") {
            estadoSelect.disabled = false;
            municipioSelect.disabled = true;

            for (const estado in data) {
                const option = document.createElement("option");
                option.value = estado;
                option.textContent = estado;
                estadoSelect.appendChild(option);
            }
        } else if (paisSeleccionado === "Extranjero") {
            estadoSelect.innerHTML = '<option value="Extranjero" selected>Extranjero</option>';
            municipioSelect.innerHTML = '<option value="Extranjero" selected>Extranjero</option>';
            estadoSelect.disabled = true;
            municipioSelect.disabled = true;
        }
    };

    // Actualizar municipios
    window.actualizarMunicipios = function (prefix) {
        const estadoSelect = document.getElementById(`${prefix}_estado`);
        const municipioSelect = document.getElementById(`${prefix}_municipio`);

        const estadoSeleccionado = estadoSelect.value;

        municipioSelect.innerHTML = '<option value="" disabled selected>Seleccione un municipio</option>';

        if (estadoSeleccionado && data[estadoSeleccionado]) {
            municipioSelect.disabled = false;

            for (const municipio of data[estadoSeleccionado]) {
                const option = document.createElement("option");
                option.value = municipio;
                option.textContent = municipio;
                municipioSelect.appendChild(option);
            }
        } else {
            municipioSelect.disabled = true;
        }
    };
});



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
    const contextos = ['paciente', 'responsable'];
    contextos.forEach(contexto => {
        const inputs = document.querySelectorAll(`#${contexto} input, #${contexto} select, #${contexto} textarea`);
        inputs.forEach(input => {
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });

        document.getElementById(`guardar-btn-${contexto}`).style.display = 'inline';
        document.getElementById(`descartar-btn-${contexto}`).style.display = 'inline';
        document.getElementById(`modificar-btn-${contexto}`).style.display = 'none';
    });
}

function deshabilitarEdicion() {
    // Selecciona ambos contextos
    const contextos = ['paciente', 'responsable'];
    contextos.forEach(contexto => {
        const inputs = document.querySelectorAll(`#${contexto} input:not([name="busqueda"]), #${contexto} select, #${contexto} textarea`);
        inputs.forEach(input => {
            input.setAttribute('readonly', true);
            input.setAttribute('disabled', true);
        });

        document.getElementById(`guardar-btn-${contexto}`).style.display = 'none';
        document.getElementById(`descartar-btn-${contexto}`).style.display = 'none';
        document.getElementById(`modificar-btn-${contexto}`).style.display = 'inline';
    });
}


function guardarCambios(contexto) {
const datosPaciente = new FormData();  

const idPaciente = document.getElementById('busqueda').value;
if (idPaciente) {
    datosPaciente.append('idPaciente', idPaciente);
} else {
    alert('ID del paciente no encontrado.');
    return; 
}

const campos = [
    'nombre', 'apellido_p', 'apellido_m', 'fecha_nacimiento', 'paciente_edad', 'sexo',
    'paciente_pais', 'paciente_estado', 'paciente_municipio', 'calle', 'numero', 'colonia',
    'derechoHabiente', 'dx', 'observaciones', 'hoja_frontal', 'hoja_compromiso',
    'nombre_responsable', 'apellido_p_responsable', 'apellido_m_responsable',
    'parentesco', 'telefono', 'ocupacion', 'tutor_pais', 'tutor_estado',
    'tutor_municipio', 'calle_responsable', 'numero_responsable', 'colonia_responsable',
    'personas_hogar', 'personas_apoyo', 'derechohabiente', 'ingresos', 'egresos',
    'indice_economico'
];

campos.forEach(campo => {
    const elemento = document.getElementById(campo);
    if (elemento) {
        datosPaciente.append(campo, elemento.value);
    }
});

fetch('../controladores/modificar_paciente.php', {
method: 'POST',
body: datosPaciente
})
.then(response => response.json().catch(() => ({ success: false, message: 'Respuesta inválida del servidor' })))
.then(data => {
    if (data.success) {
        alert(data.message);
        deshabilitarEdicion(contexto);
    } else {
        alert(data.message || 'Error al actualizar los datos.');
        console.error('Error:', data.message);
    }
    })
    .catch(error => {
    console.error('Error al guardar los cambios:', error);
    alert("Ocurrió un error al guardar los cambios. Por favor, intenta de nuevo.");
    });

    }