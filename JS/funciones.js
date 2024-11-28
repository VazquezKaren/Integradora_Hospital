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

window.actualizarEstados = function (prefix) {
    const paisSelect = document.getElementById(`${prefix}_pais`);
    const estadoSelect = document.getElementById(`${prefix}_estado`);
    const municipioSelect = document.getElementById(`${prefix}_municipio`);

    const paisSeleccionado = paisSelect.value;

    estadoSelect.innerHTML = '<option value="" disabled selected>Seleccione un estado</option>';
    municipioSelect.innerHTML = '<option value="" disabled selected>Seleccione un municipio</option>';

    if (paisSeleccionado === "Mexico") {
        estadoSelect.disabled = false;
        municipioSelect.disabled = false; // Mantener habilitado

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

        // Almacenar el valor original de cada campo en un atributo `data-original-value`
        inputs.forEach(input => {
            if (!input.dataset.originalValue) {
                input.dataset.originalValue = input.value || ""; // Guarda el valor original
            }
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });

        // Almacenar valores originales de los select de estado y municipio
        const estadoSelect = document.getElementById(`${contexto}_estado`);
        const municipioSelect = document.getElementById(`${contexto}_municipio`);
        if (estadoSelect && !estadoSelect.dataset.originalValue) {
            estadoSelect.dataset.originalValue = estadoSelect.value || "";
        }
        if (municipioSelect && !municipioSelect.dataset.originalValue) {
            municipioSelect.dataset.originalValue = municipioSelect.value || "";
        }

        document.getElementById(`guardar-btn-${contexto}`).style.display = 'inline';
        document.getElementById(`descartar-btn-${contexto}`).style.display = 'inline';
        document.getElementById(`modificar-btn-${contexto}`).style.display = 'none';
    });
}


function deshabilitarEdicion() {
    const contextos = ['paciente', 'responsable'];
    contextos.forEach(contexto => {
        const inputs = document.querySelectorAll(`#${contexto} input, #${contexto} select, #${contexto} textarea`);

        // Restaurar el valor original desde `data-original-value`
        inputs.forEach(input => {
            if (input.dataset.originalValue !== undefined) {
                input.value = input.dataset.originalValue; // Restaurar el valor original
                if (input.tagName === "SELECT") {
                    // Ajustar la selección para los dropdowns
                    const options = Array.from(input.options);
                    options.forEach(option => {
                        option.selected = option.value === input.dataset.originalValue;
                    });
                }
            }
            input.setAttribute('readonly', true);
            input.setAttribute('disabled', true);
        });

        // Asegurar que los select de estado y municipio también se actualicen
        const estadoSelect = document.getElementById(`${contexto}_estado`);
        const municipioSelect = document.getElementById(`${contexto}_municipio`);
        if (estadoSelect && municipioSelect) {
            if (estadoSelect.dataset.originalValue) {
                estadoSelect.innerHTML = `<option value="${estadoSelect.dataset.originalValue}" selected>${estadoSelect.dataset.originalValue}</option>`;
            }
            if (municipioSelect.dataset.originalValue) {
                municipioSelect.innerHTML = `<option value="${municipioSelect.dataset.originalValue}" selected>${municipioSelect.dataset.originalValue}</option>`;
            }
        }

        document.getElementById(`guardar-btn-${contexto}`).style.display = 'none';
        document.getElementById(`descartar-btn-${contexto}`).style.display = 'none';
        document.getElementById(`modificar-btn-${contexto}`).style.display = 'inline';
    });
}



function guardarCambios(contexto) {
    const datosPaciente = new FormData();  

    const noRegistro = document.getElementById('busqueda').value;
    if (noRegistro) {
        datosPaciente.append('noRegistro', noRegistro);
    } else {
        alert('No. de registro del paciente no encontrado.');
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

            window.location.reload();
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


    // Función para redirigir al cancelar
    function cancelarCambio() {
        window.location.href = "empleado.php";
    }

function toggleEspecialidad() {
    const rol = document.getElementById("rol").value;
    const especialidadGroup = document.getElementById("especialidad-group");

    if (rol === "DOCTOR" || rol === "ENFERMERO") {
        especialidadGroup.style.display = "block"; 
        document.getElementById("especialidad").setAttribute("required", "true");
    } else {
        especialidadGroup.style.display = "none"; 
        document.getElementById("especialidad").removeAttribute("required");
    }
}