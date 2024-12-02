<div class="modal-body">
    <form id="nueva_admision" action="../controladores/registrar_ingreso.php" method="POST">
        <section class="main-content">
            <div class="content-grid" style="margin-top: 0px;">
                <div class="contentbox patient-info">
                    <h4>Registrar nuevo ingreso</h4>
                    <p>Ingrese la CURP del paciente que desea ingresar</p>
                        <!-- Campo de CURP -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="curp">CURP:</label>
                                <input
                                    type="text"
                                    name="curp"
                                    id="curp"
                                    class="form-control"
                                    value="<?php echo $_POST['curp'] ?? ''; ?>"
                                    placeholder="Ingrese la CURP"
                                    required />
                            </div>
                        </div>

                        <!-- Campo de Motivo -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="motivo">Motivo:</label>
                                <textarea
                                    name="motivo"
                                    id="motivo"
                                    class="form-control"
                                    placeholder="Ingrese el motivo de ingreso"
                                    rows="3"
                                    required><?php echo $_POST['motivo'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <!-- Campo de Servicio Solicitado -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="servicio_solicitado">Servicio que solicita:</label>
                                <input
                                    type="text"
                                    name="servicio_solicitado"
                                    id="servicio_solicitado"
                                    class="form-control"
                                    value="<?php echo $_POST['servicio_solicitado'] ?? ''; ?>"
                                    placeholder="Servicio solicitado"
                                    required />
                            </div>
                        </div>

                        <!-- Campo de Turno (Automático) -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="turno">Turno:</label>
                                <input
                                    type="text"
                                    name="turno"
                                    id="turno"
                                    class="form-control"
                                    value="<?php
                                            // Obtener hora actual
                                            date_default_timezone_set('America/Mexico_City'); // Ajusta según tu zona horaria
                                            $horaActual = date('H:i');
                                            $turno = '';

                                            // Asignar turno según la hora
                                            if ($horaActual >= '06:00' && $horaActual <= '11:59') {
                                                $turno = 'MATUTINO';
                                            } elseif ($horaActual >= '12:00' && $horaActual <= '19:59') {
                                                $turno = 'VESPERTINO';
                                            } else {
                                                $turno = 'NOCTURNO';
                                            }
                                            echo $turno;
                                            ?>"
                                    readonly />
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <div class="form-row mt-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Ingresar paciente</button>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </form>
</div>