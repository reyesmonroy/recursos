<?php
// Incluir la clase Database
require_once 'Database.php';

// Configurar la conexión a la base de datos
$host = 'localhost';
$db = 'ejercicio';
$user = 'root';
$pass = '';

// Instancia de la clase Database
$database = new Database($host, $db, $user, $pass);

// Crear un nuevo empleado
function createEmpleado($nombre, $telefono, $estado) {
    global $database;
    $data = [
        'nombre' => $nombre,
        'telefono' => $telefono,
        'estado' => $estado,
    ];
    return $database->create('empleados', $data);
}

// Leer empleados
function readEmpleados($id = null) {
    global $database;
    $where = $id ? 'id = ?' : '';
    $params = $id ? [$id] : [];
    return $database->read('empleados', '*', $where, $params);
}

// Actualizar empleado
function updateEmpleado($id, $nombre = null, $telefono = null, $estado = null) {
    global $database;
    $data = [];
    if ($nombre) $data['nombre'] = $nombre;
    if ($telefono) $data['telefono'] = $telefono;
    if ($estado) $data['estado'] = $estado;

    return $database->update('empleados', $data, 'id = ?', [$id]);
}

// Eliminar empleado
function deleteEmpleado($id) {
    global $database;
    return $database->delete('empleados', 'id = ?', [$id]);
}

/* // Ejemplos de uso
try {
    // Crear un nuevo empleado
    $nuevoId = createEmpleado('Juan Perez', '1234567890', 'activo');
    echo "Empleado creado con ID: $nuevoId\n";

    // Leer todos los empleados
    $empleados = readEmpleados();
    foreach ($empleados as $empleado) {
        echo "Empleado: {$empleado['nombre']} - Teléfono: {$empleado['telefono']} - Estado: {$empleado['estado']}\n";
    }

    // Actualizar un empleado
    updateEmpleado($nuevoId, 'Juan Gonzalez', '0987654321', 'inactivo');

    // Eliminar un empleado
    deleteEmpleado($nuevoId);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} */


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
      rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Empleados</h1>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Telefono</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
            $empleados = readEmpleados();
            foreach ($empleados as $empleado) {
              echo '<tr>';
              echo "<td>{$empleado['id']}</td>";
              echo "<td>{$empleado['nombre']}</td>";
              echo "<td>{$empleado['telefono']}</td>";
              echo "<td>{$empleado['estado']}</td>";
              echo '</tr>';
            }
        ?>
      </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

