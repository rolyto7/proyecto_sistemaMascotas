<!DOCTYPE html>
<html>

<head>
	<title>Pet Shop</title>
	<meta charset="iso-8859-1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>
	<div id="header">
		<a href="#" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif" width="310" height="114" alt=""></a>
		<ul class="navigation">
			<li class="active"><a href="<?= site_url('Welcome/index') ?>">Inicio</a></li>
			<li><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
			<li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
			<li><a href="<?= site_url('Welcome/contacto') ?>">Blog</a></li>
			<li><a href="<?= site_url('Welcome/contacto') ?>">PetGuide</a></li>
			<li><a href="<?= site_url('Welcome/contacto') ?>">Login</a></li>
		</ul>
	</div>
	</div>

	<div id="body">
		<div class="banner">&nbsp;</div>
		<div id="content">
			<div class="content">
				<ul>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/puppy.jpg" width="114" height="160" alt=""></a>
						<h2>What they need</h2>
						<p>Mirum est notare quam littera gothica, quam nunc putamus parum clara m, ant epo suerit li tterar. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/cat.jpg" width="114" height="160" alt=""></a>
						<h2>Something good</h2>
						<p>Gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humani tatis per seacula. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/koi.jpg" width="114" height="160" alt=""></a>
						<h2>Kinds of Fish</h2>
						<p>Quam nunc putamus parum claram, anteposuerit litter arum formas humanitatis per seacula quarta. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/bird.jpg" width="114" height="160" alt=""></a>
						<h2>Fun birds</h2>
						<p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit. <a class="more" href="#">View all</a></p>
					</li>
				</ul>
			</div>
			<div id="sidebar">
				<div class="search">
					<input type="text" name="s" value="Find">
					<button>&nbsp;</button>
					<label for="articles">
						<input type="radio" id="articles">
						Articles
					</label>
					<label for="products">
						<input type="radio" id="products" checked>
						PetMart Products
					</label>
				</div>
				<div class="section">
					<ul class="navigation">
						<li class="active"><a href="#">Shopping Guides</a></li>
						<li><a href="#">Discounted Items</a></li>
					</ul>
					<div class="aside">
						<div>
							<div>
								<ul>
									<li><a href="#">Pet Accessories</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Bath Essentials</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Pet Food</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Pet Vitamins</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Pet Needs</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Pet Toy and Treats</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Pet Supplies</a> <a class="more" href="#">see all</a></li>
									<li><a href="#">Pet Emergency Kit</a> <a class="more" href="#">see all</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>