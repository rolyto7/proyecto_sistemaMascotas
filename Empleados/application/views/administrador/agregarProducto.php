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

    <div class="container pt-5">
        <div id="addProductForm" class="mt-5">
            <h4 class="text-secondary mb-3">Agregar Nuevo Producto</h4>
            <form action="<?php echo site_url('Welcome/agregarProducto'); ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select class="form-control" id="categoria" name="categoria">
                        <option value="Alimento">Alimentos</option>
                        <option value="Accesorios">Accesorios</option>
                        <option value="Higiene">Higiene</option>
                        <option value="Juguetes">Juguetes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mascota">Mascota</label>
                    <select class="form-control" id="mascota" name="mascota">
                        <option value="perro">Perro</option>
                        <option value="gato">Gato</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select class="form-control" id="tipo" name="tipo">
                    </select>
                </div>
                <div class="form-group">
                    <label for="categoria">Url de Imagen</label>
                    <input type="text" class="form-control" id="imagen_url" name="imagen_url">
                </div>
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </form>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>


    <script src="js/main.js"></script>
    <script>

        const opcionesGato = {
            Alimento: ['Alimento Seco Especial', 'Alimento Seco', 'Snacks y Premios'],
            Accesorios: ['Casas Camas y Frazadas', 'Torres y Rascadores', 'Platos y Dispensadores', 'Transportadores y Jaulas', 'Collares Correas y Pecheras'],
            Higiene: ['Arenas Sanitarias', 'Areneros y Palas', 'Limpieza de Hogar', 'Shampoo y Aseo', 'Peines Cepillos y Cortadoras'],
            Juguetes: ['Catnip Hierba Gatera', 'Juguetes Gato']
        };

        const opcionesPerro = {
            Alimento: ['Alimento Seco Especial', 'Alimento Seco', 'Snacks y Premios'],
            Accesorios: ['Casas Camas y Frazadas', 'Limpieza de Hogar', 'Collares Correas y Pecheras', 'Platos y Dispensadores', 'Ropa', 'Transportadores y Jaulas'],
            Juguetes: ['Juguetes Goma y Cuerda', 'Pelotas y Otros', 'Peluches'],
            Higiene: ['Bolsas de Heces y Dispensadores', 'Cuidado de Uñas', 'Cuidado Dental', 'Peines Cepillos y Cortadoras', 'Shampoo y Aseo']
        };

        function actualizarTipos() {
            var mascota = document.getElementById('mascota').value;
            var categoria = document.getElementById('categoria').value;
            var tipoSelect = document.getElementById('tipo');

            tipoSelect.innerHTML = '';

            var opciones = (mascota === 'gato') ? opcionesGato[categoria] : opcionesPerro[categoria];

            if (opciones) {
                opciones.forEach(function (opcion) {
                    var optionElement = document.createElement('option');
                    optionElement.value = opcion;
                    optionElement.textContent = opcion;
                    tipoSelect.appendChild(optionElement);
                });
            }
        }

        document.getElementById('mascota').addEventListener('change', actualizarTipos);
        document.getElementById('categoria').addEventListener('change', actualizarTipos);

        window.onload = actualizarTipos;
    </script>
</body>

</html>