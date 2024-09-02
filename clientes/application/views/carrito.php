<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link href="<?php echo base_url(); ?>assets/css/tabla.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #body {
            display: flex;
            margin-top: 20px;
        }

        .container {
            flex: 3;
            padding: 10px;
            margin-top: 50px;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-info .user-name {
            margin-left: 10px;
        }

        .user-info img {
            margin-left: 10px;
            width: 40px;
            height: 40px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 200px;
            min-height: 300px;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f0f0f0;
            ;
        }

        .card-body {
            padding: 10px;
            flex: 1;
        }

        .sidebar {
            flex: 1;
            padding: 10px;
            border-left: 1px solid #ddd;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
        }

        .btn-icon i {
            margin-left: 5px;
        }

        .banner {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 42px;
            background: transparent;
        }

        .logout-img {
            width: 30px;
            height: 25px;
        }

        ul.navigation {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-start;
        }

        ul.navigation li {
            margin: 0;
            padding: 0;
        }

        ul.navigation li a {
            text-decoration: none;
            text-align: center;
            color: #333;
            padding: 0px;
            display: inline-block;
        }

        ul.navigation li a:hover {
            background-color: #f0f0f0;
        }

        .discount {
            color: red;
            font-weight: bold;
        }

        .original-price {
            text-decoration: line-through;
            color: #888;
        }

        /* Estilos para los diálogos */
        #ciDialog,
        #clienteDialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #ciDialog label,
        #clienteDialog label {
            display: block;
            margin-bottom: 10px;
        }

        #ciDialog input,
        #clienteDialog input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #ciDialog button,
        #clienteDialog button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="header">
        <a href="<?= site_url('Welcome/index') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
                width="310" height="114" alt=""></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
            <li><a href="<?= site_url('Welcome/carrito') ?>">Carrito <i class="fas fa-shopping-cart"></i></a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Contacto</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="titulo">Productos a adquirir</h1>
                    <table class="table carrito-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Mascota</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productos)): ?>
                                <?php
                                $total = 0;
                                foreach ($productos as $producto):
                                    $precioTotal = $producto['precio_con_descuento'] * $producto['cantidad'];
                                    $total += $precioTotal;
                                    ?>
                                    <tr>
                                        <td><?php echo $producto['nombre']; ?></td>
                                        <td><?php echo $producto['tipo']; ?></td>
                                        <td><?php echo $producto['mascota']; ?></td>
                                        <td>Bs. <?php echo number_format($producto['precio_con_descuento'], 2); ?></td>
                                        <td><?php echo $producto['cantidad']; ?></td>
                                        <td>Bs. <?php echo number_format($precioTotal, 2); ?></td>
                                        <td><a href="<?php echo site_url('Welcome/eliminar_producto/' . $producto['producto_id']); ?>"
                                                class="btn btn-danger">Eliminar</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">El carrito está vacío.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4" id="pagar">
                    <h1 style="text-align: center;">Total del Carrito</h1>
                    <table class="table">
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total a Pagar:</strong></td>
                            <td><strong>Bs. <?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </table>
                    <a href="javascript:void(0);" onclick="finalizarCompra()" class="button">
                        <svg class="cartIcon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6H21L20 12H8L6 6Z" />
                        </svg>
                        Finalizar Compra
                    </a>
                </div>
            </div>
        </div>

        <a href="<?php echo site_url('Welcome/vaciar_carrito'); ?>" class="btn btn-danger btn-vaciar"
            style="color: white;">Vaciar Carrito</a>
    </div>

    <!-- Diálogo para ingresar CI -->
    <div id="ciDialog">
        <form id="ciForm">
            <label for="ci">Ingrese su CI:</label>
            <input type="text" id="ci" name="ci" required>
            <button type="button" onclick="submitCi()">Confirmar</button>
        </form>
    </div>

    <!-- Diálogo para ingresar datos del cliente -->
    <div id="clienteDialog">
        <form id="clienteForm">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="primerApellido">Primer Apellido:</label>
            <input type="text" id="primerApellido" name="primerApellido" required>
            <label for="segundoApellido">Segundo Apellido:</label>
            <input type="text" id="segundoApellido" name="segundoApellido">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular">
            <button type="button" onclick="submitCliente()">Confirmar Pedido</button>
        </form>
    </div>

    <script>
        function finalizarCompra() {
            // Mostrar el diálogo para ingresar CI
            document.getElementById('ciDialog').style.display = 'block';
        }

        function submitCi() {
            const ci = document.getElementById('ci').value;

            // Realizar la petición AJAX para buscar el cliente por CI
            fetch("<?php echo site_url('Welcome/buscar_cliente'); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: JSON.stringify({ ci })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Completar el formulario con los datos del cliente
                        const cliente = data.cliente;
                        document.getElementById('nombre').value = cliente.nombre || '';
                        document.getElementById('primerApellido').value = cliente.primerApellido || '';
                        document.getElementById('segundoApellido').value = cliente.segundoApellido || '';
                        document.getElementById('celular').value = cliente.celular || '';

                        // Ocultar el diálogo del CI y mostrar el formulario de cliente
                        document.getElementById('ciDialog').style.display = 'none';
                        document.getElementById('clienteDialog').style.display = 'block';
                    } else {
                        // CI no encontrado, mostrar el formulario de cliente vacío
                        document.getElementById('nombre').value = '';
                        document.getElementById('primerApellido').value = '';
                        document.getElementById('segundoApellido').value = '';
                        document.getElementById('celular').value = '';

                        // Ocultar el diálogo del CI y mostrar el formulario de cliente
                        document.getElementById('ciDialog').style.display = 'none';
                        document.getElementById('clienteDialog').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error("Error al buscar el cliente:", error);
                    alert("Hubo un error al buscar el cliente.");
                });
        }

        function submitCliente() {
            const nombre = document.getElementById('nombre').value;
            const primerApellido = document.getElementById('primerApellido').value;
            const segundoApellido = document.getElementById('segundoApellido').value;
            const celular = document.getElementById('celular').value;
            const ci = document.getElementById('ci').value;

            // Realizar la petición AJAX para guardar los datos del cliente y el pedido
            fetch("<?php echo site_url('Welcome/guardar_pedido'); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: JSON.stringify({ ci, nombre, primerApellido, segundoApellido, celular })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert("¡Pedido realizado con éxito!");
                        // Limpiar el carrito en el servidor y redirigir a la página del carrito vacío
                        window.location.href = "<?php echo site_url('Welcome/vaciar_carrito'); ?>";
                    } else {
                        alert("Hubo un error al realizar el pedido.");
                    }
                })
                .catch(error => {
                    console.error("Error al realizar el pedido:", error);
                    alert("Hubo un error al realizar el pedido.");
                });
        }
    </script>
</body>

</html>