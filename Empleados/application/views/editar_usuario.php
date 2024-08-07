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
                    <a href="<?php echo site_url('login/admin'); ?>" class="nav-item nav-link">Usuarios</a>
                    <a href="<?php echo site_url('login/adminProductos'); ?>" class="nav-item nav-link">Productos</a>
                    <a href="<?php echo site_url('login/adminDetalles'); ?>" class="nav-item nav-link">Detalles</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Blog Start -->
    <div class="container pt-5">
        <h4 class="text-secondary mb-3">Pet Detalles</h4>
        <h2>Editar Usuario</h2>
        <?php echo form_open('Welcome/update_usuario'); ?>
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo set_value('nombre', $usuario['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label>Primer Apellido:</label>
            <input type="text" class="form-control" name="primerApellido" value="<?php echo set_value('primerApellido', $usuario['primerApellido']); ?>" required>
        </div>
        <div class="form-group">
            <label>Segundo Apellido:</label>
            <input type="text" class="form-control" name="segundoApellido" value="<?php echo set_value('segundoApellido', $usuario['segundoApellido']); ?>">
        </div>
        <div class="form-group">
            <label>Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo set_value('fechaNacimiento', $usuario['fechaNacimiento']); ?>">
        </div>
        <div class="form-group">
            <label>Dirección:</label>
            <input type="text" class="form-control" name="direccion" value="<?php echo set_value('direccion', $usuario['direccion']); ?>">
        </div>
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" class="form-control" name="telefono" value="<?php echo set_value('telefono', $usuario['telefono']); ?>">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo set_value('email', $usuario['email']); ?>">
        </div>
        <div class="form-group">
            <label>Nombre de Usuario:</label>
            <input type="text" class="form-control" name="nombre_usuario" value="<?php echo set_value('nombre_usuario', $usuario['nombre_usuario']); ?>" required>
        </div>
        <div class="form-group">
            <label>Estado Usuario:</label>
            <input type="number" class="form-control" name="estadoUsuario" value="<?php echo set_value('estadoUsuario', $usuario['estadoUsuario']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <?php echo form_close(); ?>
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
