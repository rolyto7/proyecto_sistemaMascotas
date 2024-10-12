<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetLover - Pet Care Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/tabla.css" rel="stylesheet">
    <style>
        .custom-select-reportitos {
            background-color: transparent;
            color: white;
            border: none;
            text-align: center;
            text-align-last: center;
            font-size: 20px;
            height: 100%;
            appearance: none;
            margin-top: 10px;
        }

        .custom-select-reportitos option {
            background-color: black;
            color: white;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form styling */
        form {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fafafa;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* No results message */
        p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">

        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Shop</h1>
                </a>
            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span
                        class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="<?php echo site_url('Welcome/admin'); ?>" class="nav-item nav-link">Usuarios</a>
                    <a href="<?php echo site_url('Welcome/adminProductos'); ?>" class="nav-item nav-link">Productos</a>
                    <a href="<?php echo site_url('Welcome/adminDetalles'); ?>" class="nav-item nav-link">Ventas</a>
                    <div class="nav-item">
                        <select class="custom-select-reportitos" onchange="location = this.value;">
                            <option value="" disabled selected>Reportes</option>
                            <option value="<?php echo site_url('Welcome/reporte_usuario'); ?>">Reportes de
                                Usuario</option>
                            <option value="<?php echo site_url('Welcome/reporte_por_producto_categoria'); ?>">Reporte
                                por Producto y Categoria</option>
                            <option value="<?php echo site_url('Welcome/reporte_producto_mas_vendido'); ?>">Producto Más
                                Vendido y Categoría</option>
                        </select>
                    </div>
                </div>
                <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>"
                    class="btn btn-lg btn-primary px-3 d-none d-lg-block">Cerrar Sesion</a>
            </div>
        </nav>
    </div>



    <!-- Navbar End -->


    <!-- Blog Start -->
    <div class="container pt-5">
        <h1>Generar Reporte por Usuario</h1>
        <?php echo form_open('Welcome/reporte_usuario'); ?>
        <label for="usuario">Seleccionar Empleado:</label>
        <select name="usuario_id" id="usuario">
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario->id; ?>"><?php echo $usuario->nombre; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required>

        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" required>

        <input type="submit" value="Generar Reporte">
        <?php echo form_close(); ?>

        <?php if (isset($reporte)): ?>
            <h2>Resultados del Reporte</h2>
            <?php if (!empty($reporte)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Empleado que entregó</th>
                            <th>Nombre del Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha de Entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reporte as $venta): ?>
                            <tr>
                                <td><?php echo $venta->nombre_usuario . ' ' . $venta->apellido_usuario; ?></td>
                                <td><?php echo $venta->nombre_cliente . ' ' . $venta->apellido_cliente; ?></td>
                                <td><?php echo $venta->total; ?></td>
                                <td>
                                    <?php
                                    if ($venta->estado == 1) {
                                        echo 'Pendiente';
                                    } elseif ($venta->estado == 2) {
                                        echo 'Cancelado';
                                    } elseif ($venta->estado == 3) {
                                        echo 'Entregado';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $venta->fechaVenta; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No se encontraron resultados.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>