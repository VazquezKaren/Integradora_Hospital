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

function habilitarEdicionEmpleado() {
    try {
        const inputs = document.querySelectorAll('#informacion input, #informacion select');
        if (inputs.length === 0) {
            console.error('No se encontraron campos para habilitar.');
            Swal.fire('Error', 'No se encontraron campos para habilitar.', 'error');
            return;
        }
        inputs.forEach(input => {
            if (!input.dataset.originalValue) {
                input.dataset.originalValue = input.value || "";
            }
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });
        const guardarBtn = document.getElementById('guardar-btn');
        const descartarBtn = document.getElementById('descartar-btn');
        const modificarBtn = document.getElementById('modificar-btn');
        if (guardarBtn && descartarBtn && modificarBtn) {
            guardarBtn.style.display = 'inline';
            descartarBtn.style.display = 'inline';
            modificarBtn.style.display = 'none';
        } else {
            console.error('No se encontraron uno o más botones para actualizar su estado.');
            Swal.fire('Error', 'No se pudieron actualizar los botones de acción.', 'error');
        }
        // Llamar a toggleEspecialidad para actualizar la visibilidad del campo de especialidad
        toggleEspecialidad();
    } catch (error) {
        console.error('Error al habilitar edición:', error);
        Swal.fire('Error', 'Ocurrió un error al habilitar la edición.', 'error');
    }
}
function deshabilitarEdicionEmpleado() {
    try {
        const inputs = document.querySelectorAll('#informacion input, #informacion select');
        if (inputs.length === 0) {
            console.error('No se encontraron campos para deshabilitar.');
            Swal.fire('Error', 'No se encontraron campos para deshabilitar.', 'error');
            return;
        }
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
        const guardarBtn = document.getElementById('guardar-btn');
        const descartarBtn = document.getElementById('descartar-btn');
        const modificarBtn = document.getElementById('modificar-btn');
        if (guardarBtn && descartarBtn && modificarBtn) {
            guardarBtn.style.display = 'none';
            descartarBtn.style.display = 'none';
            modificarBtn.style.display = 'inline';
        } else {
            console.error('No se encontraron uno o más botones para actualizar su estado.');
            Swal.fire('Error', 'No se pudieron actualizar los botones de acción.', 'error');
        }
    } catch (error) {
        console.error('Error al deshabilitar edición:', error);
        Swal.fire('Error', 'Ocurrió un error al deshabilitar la edición.', 'error');
    }
}
function confirmarCambiosEmpleado(event) {
    event.preventDefault();
    try {
        let cambios = [];
        const inputs = document.querySelectorAll('#informacion input, #informacion select');
        if (inputs.length === 0) {
            Swal.fire('Error', 'No se encontraron campos para verificar cambios.', 'error');
            return;
        }
        inputs.forEach((input) => {
            const valorOriginal = input.dataset.originalValue;
            const valorActual = input.value;
            if (valorOriginal !== valorActual) {
                const nombreCampo = input.dataset.nombreCampo || input.name || 'Campo desconocido';
                cambios.push({
                    nombreCampo: nombreCampo,
                    valorOriginal: valorOriginal,
                    valorNuevo: valorActual
                });
            }
        });
        if (cambios.length > 0) {
            let mensaje = '';
            cambios.forEach((cambio) => {
                mensaje += `<p><strong>${cambio.nombreCampo}:</strong><br>Anterior: ${cambio.valorOriginal}<br>Nuevo: ${cambio.valorNuevo}</p>`;
            });
            Swal.fire({
                title: 'Confirmar cambios',
                html: mensaje,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    guardarCambiosEmpleado();
                }
            });
        } else {
            Swal.fire('Sin cambios', 'No se han realizado cambios.', 'info');
        }
    } catch (error) {
        console.error('Error al confirmar cambios:', error);
        Swal.fire('Error', 'Ocurrió un error al confirmar los cambios.', 'error');
    }
}
function guardarCambiosEmpleado() {
    try {
        const datosEmpleado = new FormData();
        // Agregar idEmpleado manualmente si no está dentro de #informacion
        const idEmpleadoInput = document.querySelector('input[name="idEmpleado"]');
        if (idEmpleadoInput) {
            datosEmpleado.append('idEmpleado', idEmpleadoInput.value);
        } else {
            Swal.fire('Error', 'No se encontró el ID del empleado.', 'error');
            return;
        }
        const inputs = document.querySelectorAll('#informacion input, #informacion select');
        if (inputs.length === 0) {
            Swal.fire('Error', 'No se encontraron campos para enviar.', 'error');
            return;
        }
        inputs.forEach(input => {
            if (input.name) {
                datosEmpleado.append(input.name, input.value);
            }
        });
        fetch('../controladores/actualizar_empleado.php', {
            method: 'POST',
            body: datosEmpleado
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire('Éxito', data.message || 'Los cambios se han guardado exitosamente.', 'success')
                        .then(() => {
                            // Opcionalmente, recarga la página o actualiza los valores originales
                            window.location.reload();
                        });
                } else {
                    let errorMsg = data.message || 'Error al guardar los cambios.';
                    if (data.errors && data.errors.length > 0) {
                        errorMsg += '<ul>';
                        data.errors.forEach(error => {
                            errorMsg += `<li>${error}</li>`;
                        });
                        errorMsg += '</ul>';
                    }
                    Swal.fire('Error', errorMsg, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Ocurrió un error al guardar los cambios. Inténtelo de nuevo más tarde.', 'error');
            });
    } catch (error) {
        console.error('Error al guardar cambios:', error);
        Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
    }
}
function confirmarEliminacion(idEmpleado) {
    if (!idEmpleado) {
        Swal.fire('Error', 'ID de empleado no válido.', 'error');
        return;
    }
    Swal.fire({
        title: '¿Está seguro?',
        text: 'Esta acción eliminará al empleado de forma permanente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarEmpleado(idEmpleado);
        }
    });
}
function eliminarEmpleado(idEmpleado) {
    fetch('../controladores/eliminar_empleado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'idEmpleado=' + encodeURIComponent(idEmpleado)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Eliminado', data.message, 'success').then(() => {
                    // Redirigir o actualizar la página
                    window.location.href = '../views/consultarEmpleado.php';
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Ocurrió un error al eliminar el empleado.', 'error');
        });
}

function confirmarDesactivacionEmpleado() {
    Swal.fire({
        title: '¿Está seguro?',
        text: 'Esta acción eliminará al empleado y no podrá acceder al sistema.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            desactivarEmpleado();
        }
    });
}

function desactivarEmpleado() {
    const idEmpleado = document.querySelector('input[name="idEmpleado"]').value;
    if (!idEmpleado) {
        Swal.fire('Error', 'No se encontró el ID del empleado.', 'error');
        return;
    }

    fetch('../controladores/eliminar_empleado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'idEmpleado=' + encodeURIComponent(idEmpleado)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Eliminado', data.message, 'success').then(() => {
                    // Redirigir o actualizar la página
                    window.location.href = 'consultarEmpleado.php';
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Ocurrió un error al desactivar el empleado.', 'error');
        });
}


function guardarCambios(contexto) {
    const datos = new FormData();

    const curp = document.getElementById('paciente_CURP').value;
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

function confirmarEliminacionPaciente() {
    Swal.fire({
        title: '¿Está seguro?',
        text: 'Esta acción eliminará al paciente de forma permanente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarPaciente();
        }
    });
}

function eliminarPaciente() {
    const curp = document.getElementById('paciente_CURP').value;
    if (!curp) {
        Swal.fire('Error', 'No se encontró el CURP del paciente.', 'error');
        return;
    }

    fetch('../controladores/eliminar_paciente.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'curp=' + encodeURIComponent(curp)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Eliminado', data.message, 'success').then(() => {
                    // Redirigir o actualizar la página
                    window.location.href = 'pacientes.php';
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Ocurrió un error al eliminar el paciente.', 'error');
        });
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
    try {
        const rolSelect = document.getElementById("rol");
        const especialidadGroup = document.getElementById("especialidad-group");
        const especialidadSelect = document.getElementById("especialidad");
        if (!rolSelect || !especialidadGroup || !especialidadSelect) {
            console.error('No se encontraron los elementos para manejar la especialidad.');
            return;
        }

        const rol = rolSelect.value;

        if (rol === "DOCTOR" || rol === "ENFERMERA") {
            especialidadGroup.style.display = "block"; // Muestra el campo
            especialidadSelect.setAttribute("required", "true");
        } else {
            especialidadGroup.style.display = "none"; // Oculta el campo
            especialidadSelect.removeAttribute("required");
        }
    } catch (error) {
        console.error('Error en toggleEspecialidad:', error);
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

function handleFormSubmission(event) {
    event.preventDefault(); // Prevenir el envío por defecto del formulario

    const form = event.target; // Obtener el formulario
    const formData = new FormData(form); // Recopilar los datos del formulario

    // Enviar los datos del formulario mediante fetch
    fetch(form.action, {
        method: form.method,
        body: formData
    })
        .then(response => response.json()) // Asumimos que el servidor devuelve JSON
        .then(data => {
            if (data.success) {
                // Mostrar alerta de éxito
                Swal.fire({
                    title: 'Éxito',
                    text: data.message,
                    icon: 'success'
                }).then(() => {
                    // Opcional: redirigir o resetear el formulario
                    form.reset();
                });
            } else {
                // Mostrar alerta de error
                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            // Manejar errores de red u otros
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al enviar el formulario. Por favor, inténtalo de nuevo más tarde.',
                icon: 'error'
            });
        });

    return false; // Prevenir el envío por defecto del formulario
}
