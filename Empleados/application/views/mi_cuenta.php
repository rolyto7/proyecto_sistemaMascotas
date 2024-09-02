<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <style>
        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-info .user-name {
            margin-left: 10px;
            /* Reduce el margen entre el nombre de usuario y el logo */
        }

        .user-info img {
            margin-left: 5px;
            /* Reduce el margen entre el nombre y la imagen */
            width: 40px;
            height: 40px;
        }

        .navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            list-style: none;
        }

        .navigation li {
            margin: 0 0px;
            /* Reduce el margen entre los elementos de navegación */
        }

        .featured ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .featured li {
            text-align: center;
            width: 400px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .featured img {
            max-width: 100%;
            height: auto;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
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

    <div id="body">
        <?php if ($this->session->flashdata('error')): ?>
            <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <p class="success"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>

        <h2>Mi Cuenta</h2>

        <form action="<?php echo site_url('Welcome/actualizarCuenta'); ?>" method="post">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo set_value('nombre', $usuario->nombre); ?>" required><br>
            <label>Primer Apellido:</label>
            <input type="text" name="primerApellido"
                value="<?php echo set_value('primerApellido', $usuario->primerApellido); ?>" required><br>
            <label>Segundo Apellido:</label>
            <input type="text" name="segundoApellido"
                value="<?php echo set_value('segundoApellido', $usuario->segundoApellido); ?>" required><br>
            <label>Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario"
                value="<?php echo set_value('nombre_usuario', $usuario->nombre_usuario); ?>" required><br>
            <label>Teléfono:</label>
            <input type="number" name="telefono" value="<?php echo set_value('telefono', $usuario->telefono); ?>"
                required><br>
            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?php echo set_value('direccion', $usuario->direccion); ?>"
                required><br>
            <label>Contraseña Actual:</label>
            <input type="password" name="contrasena_actual" required><br>

            <label>Nueva Contraseña:</label>
            <input type="password" name="nueva_contrasena" required><br>

            <input type="submit" value="Actualizar">
        </form>

    </div>
</body>

</html>