<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Crear Nuevo Usuario</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
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

    <!-- Form Start -->
    <div class="container pt-5">
        <h4 class="text-secondary mb-3">Crear Nuevo Usuario</h4>
        <form action="<?php echo site_url('Welcome/guardarUsuario'); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="primerApellido">Primer Apellido:</label>
                <input type="text" class="form-control" id="primerApellido" name="primerApellido" required>
            </div>
            <div class="form-group">
                <label for="segundoApellido">Segundo Apellido:</label>
                <input type="text" class="form-control" id="segundoApellido" name="segundoApellido">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </form>

    </div>
    <!-- Form End -->

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