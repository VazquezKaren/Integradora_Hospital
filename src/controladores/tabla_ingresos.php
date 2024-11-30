<?php
include_once('../config.php');

try {
    $conn = new conn();
    $pdo = $conn->connect();

    // Variables de búsqueda obtenidas desde $_GET
    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
    $buscarfechadesdeingreso = isset($_GET['buscarfechadesdeingreso']) ? $_GET['buscarfechadesdeingreso'] : '';
    $buscarfechahastaingreso = isset($_GET['buscarfechahastaingreso']) ? $_GET['buscarfechahastaingreso'] : '';
    $buscarfechadesdeegreso = isset($_GET['buscarfechadesdeegreso']) ? $_GET['buscarfechadesdeegreso'] : '';
    $buscarfechahastaegreso = isset($_GET['buscarfechahastaegreso']) ? $_GET['buscarfechahastaegreso'] : '';
    $estadoingreso = isset($_GET['estadoingreso']) ? $_GET['estadoingreso'] : '';
    $orden = isset($_GET['orden']) ? $_GET['orden'] : '';
    $buscarempleado = isset($_GET['buscarempleado']) ? $_GET['buscarempleado'] : '';
    $turnoingreso = isset($_GET['turnoingreso']) ? $_GET['turnoingreso'] : '';

    // Paginación
    $registros_por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($pagina - 1) * $registros_por_pagina;

    // Consulta base
    $query = "
        SELECT ingresos.*, 
            paciente.nombres AS nombrePaciente,
            paciente.apellidoPaterno AS apellidoPaternoPaciente,
            paciente.apellidoMaterno AS apellidoMaternoPaciente,
            empleado.nombres AS nombreEmpleado,
            empleado.apellidoPaterno AS apellidoPaternoEmpleado,
            empleado.telefono AS idEmpleado
        FROM ingresos
        JOIN paciente ON ingresos.fkIdPaciente = paciente.idPaciente
        JOIN usuarios ON ingresos.fkIdUsuario = usuarios.idUsuario
        JOIN empleado ON usuarios.fkIdEmpleado = empleado.idEmpleado
        WHERE 1=1
    ";

    // Condiciones y parámetros
    $conditions = [];
    $params = [];

    // Búsqueda por nombre del paciente
    if (!empty($buscar)) {
        $akeyword = explode(" ", $buscar);
        $nameConditions = [];
        foreach ($akeyword as $index => $keyword) {
            $keyword = trim($keyword);
            if (!empty($keyword)) {
                $nameParam = ":keyword{$index}";
                $nameConditions[] = "(LOWER(paciente.nombres) LIKE LOWER($nameParam) OR LOWER(paciente.apellidoPaterno) LIKE LOWER($nameParam) OR LOWER(paciente.apellidoMaterno) LIKE LOWER($nameParam))";
                $params[$nameParam] = "%{$keyword}%";
            }
        }
        if (!empty($nameConditions)) {
            $conditions[] = '(' . implode(' OR ', $nameConditions) . ')';
        }
    }

    // Filtro por estado de ingreso
    if ($estadoingreso !== '') {
        $conditions[] = 'egreso = :estadoingreso';
        $params[':estadoingreso'] = $estadoingreso;
    }

    // Filtro por turno de ingreso
    if ($turnoingreso !== '') {
        $conditions[] = 'turno = :turnoingreso';
        $params[':turnoingreso'] = $turnoingreso;
    }

    // Filtro por fecha desde ingreso
    if (!empty($buscarfechadesdeingreso) && !empty($buscarfechahastaingreso)) {
        $conditions[] = 'fechaIngreso BETWEEN :fechadesdeingreso AND :fechahastaingreso';
        $params[':fechadesdeingreso'] = $buscarfechadesdeingreso;
        $params[':fechahastaingreso'] = $buscarfechahastaingreso;
    } elseif (!empty($buscarfechadesdeingreso)) {
        $conditions[] = 'fechaIngreso >= :fechadesdeingreso';
        $params[':fechadesdeingreso'] = $buscarfechadesdeingreso;
    } elseif (!empty($buscarfechahastaingreso)) {
        $conditions[] = 'fechaIngreso <= :fechahastaingreso';
        $params[':fechahastaingreso'] = $buscarfechahastaingreso;
    }

    // Filtro por fecha desde egreso
    if (!empty($buscarfechadesdeegreso) && !empty($buscarfechahastaegreso)) {
        $conditions[] = 'fechaEgreso BETWEEN :fechadesdeegreso AND :fechahastaegreso';
        $params[':fechadesdeegreso'] = $buscarfechadesdeegreso;
        $params[':fechahastaegreso'] = $buscarfechahastaegreso;
    } elseif (!empty($buscarfechadesdeegreso)) {
        $conditions[] = 'fechaEgreso >= :fechadesdeegreso';
        $params[':fechadesdeegreso'] = $buscarfechadesdeegreso;
    } elseif (!empty($buscarfechahastaegreso)) {
        $conditions[] = 'fechaEgreso <= :fechahastaegreso';
        $params[':fechahastaegreso'] = $buscarfechahastaegreso;
    }

    // Filtro por número de empleado
    if ($buscarempleado !== '') {
        $conditions[] = 'empleado.telefono = :buscarempleado';
        $params[':buscarempleado'] = $buscarempleado;
    }

    // Combinar condiciones
    if (!empty($conditions)) {
        $query .= ' AND ' . implode(' AND ', $conditions);
    }

    // Ordenamiento
    if (!empty($orden)) {
        switch ($orden) {
            case '1':
                $query .= " ORDER BY nombrePaciente ASC";
                break;
            case '2':
                $query .= " ORDER BY fechaIngreso DESC";
                break;
            case '3':
                $query .= " ORDER BY fechaIngreso ASC";
                break;
            case '4':
                $query .= " ORDER BY horaIngreso DESC";
                break;
            case '5':
                $query .= " ORDER BY horaIngreso ASC";
                break;
            case '6':
                $query .= " ORDER BY fechaEgreso DESC";
                break;
            case '7':
                $query .= " ORDER BY fechaEgreso ASC";
                break;
            case '8':
                $query .= " ORDER BY horaEgreso DESC";
                break;
            case '9':
                $query .= " ORDER BY horaEgreso ASC";
                break;
            case '10':
                $query .= " ORDER BY servicioSolicitado ASC";
                break;
            default:
                // Sin orden
                break;
        }
    }

    // Agregar LIMIT y OFFSET
    $query .= " LIMIT :limit OFFSET :offset";

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($query);

    // Vincular parámetros
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', (int)$registros_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();
    $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para contar el total de registros
    $countQuery = "
        SELECT COUNT(*) 
        FROM ingresos
        JOIN paciente ON ingresos.fkIdPaciente = paciente.idPaciente
        JOIN usuarios ON ingresos.fkIdUsuario = usuarios.idUsuario
        JOIN empleado ON usuarios.fkIdEmpleado = empleado.idEmpleado
        WHERE 1=1
    ";

    // Reutilizar las mismas condiciones
    if (!empty($conditions)) {
        $countQuery .= ' AND ' . implode(' AND ', $conditions);
    }

    // Preparar y ejecutar la consulta de conteo
    $stmtCount = $pdo->prepare($countQuery);

    // Vincular los mismos parámetros
    foreach ($params as $key => $value) {
        if ($key !== ':limit' && $key !== ':offset') {
            $stmtCount->bindValue($key, $value);
        }
    }

    $stmtCount->execute();
    $rowCount = $stmtCount->fetchColumn();

    // Calcular el total de páginas
    $paginas_totales = ceil($rowCount / $registros_por_pagina);

} catch (\Throwable $th) {
    // Manejo de error con SweetAlert2
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Error en la obtención de los registros',
                  text: '" . addslashes($th->getMessage()) . "',
                  confirmButtonText: 'OK'
              }).then(() => {
                  window.location.href = '../views/ingresos.php';
              });
          </script>";
    exit();
}

// Mostrar datos
foreach ($ingresos as $ingreso) {
    echo "Nombre: " . htmlspecialchars($ingreso['nombrePaciente']);
    // Aquí agregar más información de cada ingreso
}
?>
