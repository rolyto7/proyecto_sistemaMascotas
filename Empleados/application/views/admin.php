<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetLover - Pet Care Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">
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
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="<?php echo site_url('Welcome/admin'); ?>" class="nav-item nav-link">Usuarios</a>
                    <a href="<?php echo site_url('Welcome/adminProductos'); ?>" class="nav-item nav-link">Productos</a>
                    <a href="<?php echo site_url('Welcome/adminDetalles'); ?>" class="nav-item nav-link">Detalles</a>
                </div>
                <a href="<?php echo site_url('Welcome/login'); ?>" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Cerrar Sesion</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Blog Start -->
    <div class="container pt-5">
        <h4 class="text-secondary mb-3">Pet Usuarios</h4>
        <a href="<?php echo site_url('Welcome/guardarUsuario'); ?>" class="btn btn-primary mb-3">Agregar Usuario</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Nombre de Usuario</th>
                    <th>Estado Usuario</th>
                    <th>Fecha Actualización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)) : ?>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nombre']; ?></td>
                            <td><?php echo $usuario['primerApellido']; ?></td>
                            <td><?php echo $usuario['segundoApellido']; ?></td>
                            <td><?php echo $usuario['fechaNacimiento']; ?></td>
                            <td><?php echo $usuario['direccion']; ?></td>
                            <td><?php echo $usuario['telefono']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php echo $usuario['nombre_usuario']; ?></td>
                            <td><?php echo $usuario['estadoUsuario']; ?></td>
                            <td><?php echo $usuario['fechaActualizacionUsuario']; ?></td>
                            <td>
                                <a href="<?php echo site_url('Welcome/editar_usuario/' . $usuario['id']); ?>" class="btn btn-warning">Editar</a>
                                <a href="<?php echo site_url('Welcome/eliminar_usuario/' . $usuario['id']); ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="13">No hay usuarios disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


        <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


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