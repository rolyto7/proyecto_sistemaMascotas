<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <style>
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

        .navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            list-style: none;
        }

        .navigation li {
            margin: 0 10px;
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
        <a href="#" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif" width="310" height="114" alt=""></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/index') ?>">Inicio</a></li>
            <li><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Contacto</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="featured">
            <h1 style="text-align: center;">Seleccione su Mascota</h1>
            <ul>
                <li><a href="<?= site_url('Welcome/TiendaGatos') ?>"><img src="<?= base_url() ?>assets/images/TiendaGatos.png" alt="Tienda Gatos"></a></li>
                <li><a href="<?= site_url('Welcome/TiendaPerros') ?>"><img src="<?= base_url() ?>assets/images/TiendaPerros.png" alt="Tienda Perros"></a></li>
            </ul>
            <h1 style="text-align: center;">Explora nuestras ofertas</h1>
            <ul>
                <li><a href="<?= site_url('Welcome/productos') ?>"><img src="<?= base_url() ?>assets/images/novedades.png" alt="Novedades"></a></li>
                <li><a href="<?= site_url('Welcome/productos') ?>"><img src="<?= base_url() ?>assets/images/ofertas.png" alt="Ofertas"></a></li>
            </ul>
        </div>
    </div>

</body>

</html>