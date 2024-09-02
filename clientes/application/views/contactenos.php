<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop | Contact</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--[if IE 6]><link href="css/ie6.css" rel="stylesheet" type="text/css"><![endif]-->
    <!--[if IE 7]><link href="css/ie7.css" rel="stylesheet" type="text/css"><![endif]-->
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
    <div id="body">
        <div id="content">
            <div class="content">
                <h2>Contáctenos</h2>
                <div>
                    <p>Estamos para ayudarlo con lo que requiera solo escribamos a nuestros numeros que estan a
                        continuacion</p>
                </div>
                <ul class="connect">
                    <li>
                        <h2>Ventas y servicio al cliente</h2>
                        <p> <span>E-mail: <a href="#">info@domain.com</a></span> <span>Llámenos o envíenos un correo
                                electrónico para obtener ayuda.</span> </p>
                        <p> <span>Llamada gratuita: 877 000 0000</span> <span>Llamada gratuita: 866 000 0000</span>
                            <span>Llamada gratuita: 877 000 0000</span>
                        </p>
                    </li>
                    <li>
                        <h2>Horario de la tienda</h2>
                        <p> <span>De lunes a viernes de 9:00 a 19:00 EST (GMT -05000)</span> <span>Cerrado sábado y
                                domingo</span> </p>
                    </li>
                    <li>
                        <h2>Dirección de envio</h2>
                        <p> <span>Petshop</span> <span>Calle Lorem Ipsum 250</span> <span>4to piso</span>
                            <span>jaonfanr, Caknan 109935</span> <span>Kiangab</span>
                        </p>
                    </li>
                </ul>
            </div>
            <div id="sidebar">
                <div class="connect">
                    <h2>Siganos en nuestras Redes</h2>
                    <ul>
                        <li><a class="facebook" href="#">Facebook</a></li>
                        <li><a class="subscribe" href="#">Suscribase</a></li>
                        <li><a class="twitter" href="#">Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</body>

</html>