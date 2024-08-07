<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <style>
        #body {
            display: flex;
            margin-top: 20px;
        }

        .container {
            flex: 3;
            padding: 10px;
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
            gap: 15px;
            /* Ajusta el espacio entre los cards */
            justify-content: space-between;
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 250px;
            /* Ancho máximo reducido para hacer los cards más pequeños */
            min-height: 350px;
            /* Altura mínima ajustada para los cards más pequeños */
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            width: 100%;
            /* Asegura que la imagen se ajuste al ancho del card */
            height: 150px;
            /* Ajusta la altura de la imagen */
            object-fit: cover;
            /* Ajusta la imagen para que se ajuste al card sin deformarse */
        }

        .card-body {
            padding: 10px;
            /* Reducido padding */
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
    </style>
</head>

<body>
    <div id="header">
        <a href="#" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif" alt=""></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Productos</a></li>
            <li><a href="<?= site_url('Welcome/productos') ?>">Pedidos</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Detalles</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Carrito</a></li>
            <?php if (isset($nombre)) : ?>
                <li class="user-info">
                    <span class="user-name">Empleado <?= $nombre; ?></span>
                    <img src="<?= base_url() ?>assets/images/empleado.png" width="20" height="20" alt="User Icon">
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div id="body">
        <div class="container">
            <div class="products">
                <?php if (!empty($productos)) : ?>
                    <?php foreach ($productos as $row) : ?>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $row->imagen_url; ?>" alt="<?php echo $row->nombre; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row->nombre; ?></h5>
                                <?php
                                $isEven = $row->producto_id % 2 == 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<span><i class="bi bi-star-fill" style="padding: 0px 2px; color:' . ($isEven ? '#ffb90c' : ($i <= 3 ? '#ffb90c' : '')) . ';"></i></span>';
                                }
                                ?>
                                <hr>
                                <p class="card-text">Bs. <?php echo $row->precio; ?></p>
                                <a href="detallesArticulo.php?idProd=<?php echo $row->producto_id; ?>" class="btn btn-primary" title="Ver <?php echo $row->nombre; ?>">
                                    Ver Producto
                                    <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No se encontraron productos.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Nueva sección adicional -->
        <div class="sidebar">
            <div class="section">
                <div class="aside">
                    <ul>
                        <li><a href="#">Alimento Seco</a></li>
                        <li><a href="#">Alimento Humedo</a></li>
                        <li><a href="#">Casas Camas y Frazadas</a></li>
                        <li><a href="#">Collares Correas y Percheras</a></li>
                        <li><a href="#">Platos y Dispensadores</a></li>
                        <li><a href="#">Transportadores y Jaulas</a></li>
                        <li><a href="#">Juguetes</a></li>
                        <li><a href="#">Shampoo y Aseo</a></li>
                        <li><a href="#">Peines Cepillos y Cortadoras</a></li>
                        <li><a href="#">Vitaminas y Suplementos</a></li>
                        <li><a href="#">Torres y Rascadores</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>

</html>