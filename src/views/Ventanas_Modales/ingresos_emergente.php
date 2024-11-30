<div class="modal-body">
    <form id="nueva_adminsion">
        <section class="main-content">
            <div class="content-grid" style="margin-top: 0px;">
                <div class="contentbox patient-info">
                    <h4>Registara nuevo ingreso</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $data['paciente_nombres'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_p">Apellido paterno:</label>
                            <input type="text" name="apellido_p" id="apellido_p" value="<?php echo $data['paciente_apellidoPaterno'] ?? ''; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="apellido_m">Apellido materno:</label>
                            <input type="text" name="apellido_m" id="apellido_m" value="<?php echo $data['paciente_apellidoMaterno'] ?? ''; ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>

<!-- 
                    <div class="mb-3">
                                <label for="patientId" class="form-label">ID del Paciente</label>
                                <input type="text" class="form-control" id="patientId" required>
                            </div>
                            <div class="mb-3">
                                <label for="admissionDate" class="form-label">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="admissionDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="admissionTime" class="form-label">Hora de Ingreso</label>
                                <input type="time" class="form-control" id="admissionTime" required>
                            </div>
                            <div class="mb-3">
                                <label for="requestedService" class="form-label">Servicio Solicitado</label>
                                <input type="text" class="form-control" id="requestedService" required>
                            </div>
                            <div class="mb-3">
                                <label for="admissionReason" class="form-label">Motivo de Ingreso</label>
                                <textarea class="form-control" id="admissionReason" rows="3" required></textarea>
                            </div> -->