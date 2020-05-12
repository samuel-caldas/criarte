<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<title>Reservas 0.1</title>
		
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!-- Le styles -->
		<link href="<?php echo base_url(); ?>assets/css/bootstrap-1.1.0.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />

	</head>

	<body>

		<div class="topbar">
			<div class="fill">
				<div class="container">
					<h3><a href="<?php echo base_url(); ?>">Gerenciamento de Embarque</a></h3>
				</div>
			</div>
		</div>		
		
		<div class="container containerConteudo paddingTop80">

			<div class="row">

				<div class="span8 columns formLogin offset4">

					<form action="<?php echo base_url(); ?>login/attempt" method="post">

						<fieldset>
							<legend class="paddingLeft150">Efetue Login</legend>

							<div class="clearfix">

								<label for="username">Nome de usuário:</label>
								<div class="input">
									<input class="xlarge" id="username" name="username" size="30" type="text">
								</div>

						    </div> <!-- /clearfix -->
						    
						    <div class="clearfix">
								
								<label for="username">Senha:</label>
								<div class="input">
									<input class="xlarge" id="password" name="password" size="30" type="password">
								</div>

						    </div> <!-- /clearfix -->
						    
						    <div class="actions">
						    	
						    	<button type="submit" class="btn primary">Login</button>
						    	
						    </div>
						</fieldset>
					</form>
					
					<?php if( $error == true ): ?>
						
						<div class="alert-message error">
							<a class="close" href="#">×</a>
							<p><strong>Oh não!</strong> Login/senha não conferem.</p>
						</div>
						
					<?php endif; ?>

				</div>

			</div>

		</div>
  	
	</body>
</html>