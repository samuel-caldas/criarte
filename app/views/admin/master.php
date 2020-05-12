<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<title>Gerenciamento de Embarque</title>
		
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!-- Le styles -->
		<link href="<?php echo base_url(); ?>assets/css/bootstrap-1.1.0.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />

		<script src="<?php echo base_url(); ?>assets/js/jquery-1.6.2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/meio.mask.js"></script>
		<script src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	    <script src="<?php echo base_url(); ?>assets/js/application.js"></script>

	</head>

	<body>

		<div class="topbar">
			<div class="fill">
				<div class="container">
					<h3><a href="<?php echo base_url(); ?>">Gerenciamento de Embarque</a></h3>

					<?php if($this->session->userdata('tipo') == 'a'): ?>

						<ul class="nav">
							<li class="menu">
								<a href="#" class="menu">Usuários</a>
								<ul class="menu-dropdown">
									<li><a href="<?php echo base_url(); ?>usuarios">Listagem</a></li>
									<li class="divider"></li>
									<li><a href="<?php echo base_url(); ?>usuarios/adicionar">Adicionar</a></li>
								</ul>
							</li>
						</ul>
	
						<ul class="nav">
							<li class="menu">
								<a href="#" class="menu">Ônibus</a>
								<ul class="menu-dropdown">
									<li><a href="<?php echo base_url(); ?>onibus">Listagem</a></li>
									<li class="divider"></li>
									<li><a href="<?php echo base_url(); ?>onibus/adicionar">Adicionar</a></li>
								</ul>
							</li>
						</ul>
	
						<ul class="nav">
							<li class="menu">
								<a href="#" class="menu">Viagens</a>
								<ul class="menu-dropdown">
									<li><a href="<?php echo base_url(); ?>viagens">Listagem</a></li>
									<li class="divider"></li>
									<li><a href="<?php echo base_url(); ?>viagens/adicionar">Adicionar</a></li>
								</ul>
							</li>
						</ul>
						
					<?php endif; ?>

					<ul class="nav">
						<li>
							<a href="<?php echo base_url(); ?>consulta">Consulta</a>
						</li>
					</ul>
					
					<ul class="nav secondary-nav">
						<li class="menu">
							<a href="#" class="menu"><?php echo $this->session->userdata('nome'); ?></a>
							<ul class="menu-dropdown">
								<?php if($this->session->userdata('tipo') == 'a'): ?>
									<li><a href="<?php echo base_url(); ?>usuarios/editar/<?php echo $this->session->userdata('login'); ?>">Editar Meus Dados</a></li>
									<li class="divider"></li>
								<?php endif; ?>
								<li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>		
		
		<div class="container paddingTop80 containerConteudo">

			<div class="page-header">
				<h1><?php echo $titulo; ?> <small><?php echo $tagline; ?></small></h1>
			</div>

			<div class="row">

				<div class="span4 columns">

					<?php $this->load->view($side, $side_data); ?>

				</div>

				<div class="span12 columns">

					<?php $this->load->view($view, $data); ?>

				</div>

			</div>
			
		</div>
  	
	</body>
</html>