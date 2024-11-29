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
function habilitarEdicion(contexto) {
    const inputs = document.querySelectorAll(`#${contexto} input, #${contexto} select, #${contexto} textarea`);

    inputs.forEach(input => {
        if (!input.dataset.originalValue) {
            input.dataset.originalValue = input.value || ""; // Guarda el valor original
        }
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
    });

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
}


function deshabilitarEdicion(contexto) {
    const inputs = document.querySelectorAll(`#${contexto} input, #${contexto} select, #${contexto} textarea`);

    inputs.forEach(input => {
        if (input.dataset.originalValue !== undefined) {
            input.value = input.dataset.originalValue; 
            if (input.tagName === "SELECT") {
                const options = Array.from(input.options);
                options.forEach(option => {
                    option.selected = option.value === input.dataset.originalValue;
                });
            }
        }
        input.setAttribute('readonly', true);
        input.setAttribute('disabled', true);
    });

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

    // Ocultar los botones 
    document.getElementById(`guardar-btn-${contexto}`).style.display = 'none';
    document.getElementById(`descartar-btn-${contexto}`).style.display = 'none';
    document.getElementById(`modificar-btn-${contexto}`).style.display = 'inline';
}
function guardarCambios(contexto) {
    const datos = new FormData();  

    const curp = document.getElementById('busqueda').value;
    if (curp) {
        datos.append('curp', curp);
    } else {
        alert('No. de registro del paciente no encontrado.');
        return; 
    }

    const camposPaciente = [
        'nombre', 'apellido_p', 'apellido_m', 'fecha_nacimiento', 'paciente_edad', 'sexo',
        'paciente_pais', 'paciente_estado', 'paciente_municipio', 'calle', 'numero', 'colonia',
        'derechoHabiente', 'dx', 'observaciones'
    ];

    const camposResponsable = [
        'nombre_responsable', 'apellido_p_responsable', 'apellido_m_responsable',
        'parentesco', 'telefono', 'ocupacion', 'tutor_pais', 'tutor_estado',
        'tutor_municipio', 'calle_responsable', 'numero_responsable', 'colonia_responsable',
        'personas_hogar', 'personas_apoyo', 'indice_economico', 'ingresos', 'egresos'
    ];

    const campos = contexto === 'paciente' ? camposPaciente : camposResponsable;

 campos.forEach(campo => {
        const elemento = document.getElementById(campo);
        if (elemento) {
            datos.append(campo, elemento.value);
        }
    });

    const controlador = contexto === 'paciente' ? '../controladores/modificar_paciente.php' : '../controladores/modificar_responsable.php';

    fetch(controlador, {
        method: 'POST',
        body: datos
    })
    .then(response => response.json().catch(() => ({ success: false, message: 'Respuesta inválida del servidor' })))
    .then(data => {
        if (data.success) {
            alert(data.message);
            deshabilitarEdicion(contexto); 

            window.location.reload();
        } else {
            alert(data.message || 'Error al actualizar los datos.');
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error(`Error al guardar los cambios (${contexto}):`, error);
        alert("Ocurrió un error al guardar los cambios. Por favor, intenta de nuevo.");
    });
}

function confirmarCambio(event) {
    event.preventDefault(); 
    const confirmacion = confirm("¿Está seguro de que desea cambiar la contraseña?");
    if (confirmacion) {
        document.getElementById('form-cambiar-contrasena').submit();
    } else {
        window.location.href = "empleado.php";
    }
}


function toggleEspecialidad() {
const rol = document.getElementById("rol").value;
const especialidadGroup = document.getElementById("especialidad-group");

if (rol === "DOCTOR" || rol === "ENFERMERO") {
    especialidadGroup.style.display = "block"; // Muestra el campo
    document.getElementById("especialidad").setAttribute("required", "true");
} else {
    especialidadGroup.style.display = "none"; // Oculta el campo
    document.getElementById("especialidad").removeAttribute("required");
}


}
//validar la contraseña del empleado
function validarContrasenas() {
    const nuevaContrasena = document.getElementById('nueva_contrasena').value;
    const confirmarContrasena = document.getElementById('confirmar_contrasena').value;
    const errorMensaje = document.getElementById('error-contrasena');
    const botonActualizar = document.getElementById('btn-actualizar');

    if (nuevaContrasena && confirmarContrasena && nuevaContrasena !== confirmarContrasena) {
        errorMensaje.style.display = "block";
        botonActualizar.disabled = true;
    } else {
        errorMensaje.style.display = "none";
        botonActualizar.disabled = false;
    }
}

//  cancelar cambio de contraseña
function cancelarCambio() {
    window.location.href = "empleado.php";
}