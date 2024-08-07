<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop | Productos</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <!-- Asegúrate de incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div id="header">
        <a href="#" id="logo"><img src="<?php echo base_url(); ?>assets/images/logo.gif" width="310" height="114" alt=""></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/index') ?>">Inicio</a></li>
            <li><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Contacto</a></li>
        </ul>
    </div>

    <div id="body">
        <div class="container">
            <div class="row">
                <!-- Sección de productos -->
                <div class="col-md-9">
                    <div class="row" style="margin-top: 50px;">
                        <?php foreach ($productos->result() as $row) { ?>
                            <div class="col-6 col-md-4 mt-4 text-center">
                                <div class="card" style="max-height: 400px !important; min-height: 400px !important;">
                                    <img class="card-img-top" src="<?php echo $row->imagen_url; ?>" alt="<?php echo $row->nombre; ?>" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo $row->nombre; ?></h5>
                                        <?php
                                        $isEven = $row->producto_id % 2 == 0;
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<span><i class="bi bi-star-fill" style="padding: 0px 2px; color:' . ($isEven ? '#ffb90c' : ($i <= 3 ? '#ffb90c' : '')) . ';"></i></span>';
                                        }
                                        ?>
                                        <hr>
                                        <p class="card-text">Bs. <?php echo $row->precio; ?></p>
                                    </div>
                                    <a href="detallesArticulo.php?idProd=<?php echo $row->producto_id; ?>" class="btn btn-primary" title="Ver <?php echo $row->nombre; ?>">
                                        Ver Producto
                                        <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Nueva sección adicional -->
                <div class="col-md-3">
                    <div id="sidebar">
                        <div class="section">
                            <div class="aside">
                                <div>
                                    <div>
                                        <ul>
                                            <li><a href="#">Alimento Seco</a></li>
                                            <li><a href="#">Alimento Humedo</a></li>
                                            <li><a href="#">Casas Camas y Frazadas</a></li>
                                            <li><a href="#">Collares Correas y Percheras</a></li>
                                            <li><a href="#">Platos y Dispensadores</a></li>
                                            <li><a href="#">Transportadores y Jaulas</a></li>
                                            <li><a href="#">Juguetes</a></li>
                                            <li><a href="#">Shampoo y Aseo</a></li>
                                            <li><a href="#">Peines Cepillos y Cortadoras</a>
                                            <li><a href="#">Vitaminas y Suplementos</a>
                                            <li><a href="#">Torres y Rascadores</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Asegúrate de incluir Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
</body>

</html>