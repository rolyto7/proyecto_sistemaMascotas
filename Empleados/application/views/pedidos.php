<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/formularios.css">
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

        .btn-action {
            display: inline-flex;
            gap: 5px;
        }

        .btn-action button {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div id="header">
        <a href="<?= site_url('Welcome/empleado') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
                alt="Logo"></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Productos</a></li>
            <li><a href="<?= site_url('Welcome/ver_pedidos') ?>">Pedidos</a></li>
            <li><a href="<?= site_url('Welcome/carrito') ?>">Carrito</a></li>
            <?php if (isset($nombre)): ?>
                <li class="user-info">
                    <span class="user-name">Empleado <?= $nombre; ?></span>
                    <img src="<?= base_url() ?>assets/images/empleado.png" alt="User Icon">
                </li>
            <?php endif; ?>
            <li>
                <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Cerrar Sesión" class="btn-exit-system">
                    <img src="<?= base_url() ?>assets/images/apagar.png" alt="Cerrar sesión" class="logout-img">
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <form method="GET" action="<?= site_url('Welcome/ver_pedidos') ?>" class="pedido">
            <h1>Lista de Pedidos</h1>
            <div class="form-group">
                <label for="search_ci">Buscar por CI:</label>
                <input type="text" id="search_ci" name="search_ci" class="form-control" placeholder="Ingrese CI">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>CI del Cliente</th>
                        <th>Nombre del Producto</th>
                        <th>Precio U.</th>
                        <th>Cantidad</th>
                        <th>Fecha del Pedido</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= htmlspecialchars($pedido['cliente_nombre']); ?></td>
                            <td><?= htmlspecialchars($pedido['cliente_ci']); ?></td>
                            <td><?= htmlspecialchars($pedido['producto_nombre']); ?></td>
                            <td><?= htmlspecialchars(number_format($pedido['precio'], 2)); ?> Bs.</td>
                            <td><?= htmlspecialchars($pedido['cantidad']); ?></td>
                            <td><?= htmlspecialchars(date('d-m-Y H:i:s', strtotime($pedido['fecha_pedido']))); ?></td>
                            <td><?= htmlspecialchars(number_format($pedido['total'], 2)); ?> Bs.</td>
                            <td><?= htmlspecialchars($pedido['estado']); ?></td>
                            <td class="btn-action">
                                <?php if (isset($pedido['pedido_id'])): ?>
                                    <form method="POST"
                                        action="<?= site_url('Welcome/cancelar_pedido/' . $pedido['pedido_id']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                    </form>
                                    <form method="POST"
                                        action="<?= site_url('Welcome/entregar_pedido/' . $pedido['pedido_id']); ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Entregar</button>
                                    </form>
                                <?php else: ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>

</body>

</html>