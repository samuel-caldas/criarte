<div class="page-header">
	<h2>Adicionar usuário</h2>
</div>


	<div class="row">
		<?php if($erro): ?>
			<div class="alert-message error">
				<p><?php echo $erro; ?></p>
			</div>
		<?php endif; ?>
	</div>


	<form action="<?php echo base_url(); ?>usuarios/adicionar/attempt" method="post">

		<fieldset>

			<div class="clearfix">

				<label for="nome">Nome:</label>
				<div class="input">
					<input class="xlarge" id="nome" name="u[nome]" size="30" type="text" value="<?php echo $post['nome']; ?>">
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="email">Email:</label>
				<div class="input">
					<input class="xlarge" id="email" name="u[email]" size="30" type="text" value="<?php echo $post['email']; ?>">
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="login">Nome de usuário:</label>
				<div class="input">
					<input class="xlarge" id="login" name="u[login]" size="30" type="text" value="<?php echo $post['login']; ?>">
					<span class="help-inline">Usado para login</span>
				</div>

		    </div> <!-- /clearfix -->
		    
		    <div class="clearfix">
				
				<label for="senha">Senha:</label>
				<div class="input">
					<input class="xlarge" id="senha" name="u[senha]" size="30" type="password">
					<input class="xlarge" id="c_senha" name="u[c_senha]" size="30" type="password">
					<span class="help-inline">Confirme a senha</span>
				</div>

		    </div> <!-- /clearfix -->
		    
			<div class="clearfix">
				<label for="tipo">Tipo:</label>
				<div class="input">
					<select name="u[tipo]">
						<option value='v'>Vendedor</option>
						<option value='a'>Administrador</option>
					</select>
				</div>
			</div> <!-- /clearfix -->
		    
		    <div class="actions">
		    	
		    	<button type="submit" name="action" value="1" class="btn primary">Criar Usuário</button>
		    	
		    </div>
		</fieldset>
	</form>

