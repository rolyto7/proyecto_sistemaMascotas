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
            margin-top: 5px;
        }

        .custom-select-reportitos option {
            background-color: black;
            color: white;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

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
    <div class="container-fluid">
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Shop</h1>
                </a>
            </div>
        </div>
    </div>
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
                            <option value="<?php echo site_url('Welcome/reporte_usuario'); ?>">Reportes de Usuario
                            </option>
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
    <div class="container pt-5">
        <h1>10 Productos Más Vendidos</h1>

        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <!-- Sección de los inputs a la izquierda -->
            <div style="flex: 1;">
                <!-- Formulario para seleccionar fecha de inicio y fin -->
                <?php echo form_open('Welcome/reporte_producto_mas_vendido'); ?>
                <div style="margin-bottom: 15px;">
                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" required>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" required>
                </div>

                <input type="submit" value="Generar Reporte">
                <?php echo form_close(); ?>
            </div>

            <!-- Sección del gráfico a la derecha -->
            <div style="flex: 1; text-align: center;">
                <?php if (!empty($productos)): ?>
                    <div style="width: 400px; height: 400px; margin: 0 auto;">
                        <canvas id="productosMasVendidosChart"></canvas>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        var ctx = document.getElementById('productosMasVendidosChart').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'pie', // Tipo de gráfico
                            data: {
                                labels: [
                                    <?php foreach ($productos as $producto) {
                                        echo '"' . htmlspecialchars($producto['nombre']) . '",';
                                    } ?>
                                ],
                                datasets: [{
                                    label: 'Total Vendido',
                                    data: [
                                        <?php foreach ($productos as $producto) {
                                            echo $producto['total_vendida'] . ',';
                                        } ?>
                                    ],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)',
                                        'rgba(255, 159, 64, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)'
                                    ],
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                }
                            }
                        });
                    </script>
                <?php else: ?>
                    <p>No se encontraron productos vendidos en el rango seleccionado.</p>
                <?php endif; ?>
            </div>
        </div>

        <h2 class="mt-5">Detalles de los 10 Productos Más Vendidos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad Vendida</th>
                    <th>Fecha de Entrega</th>
                </tr>
            </thead>

        </table>


    </div>

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