<div class="page-header">
	<h2>Editar Dados</h2>
</div>


	<div class="row">
		<?php if($erro): ?>
			<div class="alert-message error">
				<p><?php echo $erro; ?></p>
			</div>
		<?php endif; ?>
	</div>


	<form action="<?php echo base_url(); ?>usuarios/editar/<?php echo $usuario->login; ?>" method="post">

		<fieldset>

			<div class="clearfix">

				<label for="nome">Nome:</label>
				<div class="input">
					<input class="xlarge" id="nome" name="u[nome]" size="30" type="text" value="<?php echo ( strlen($post['nome']) > 0 ) ? $post['nome'] : $usuario->nome; ?>">
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="email">Email:</label>
				<div class="input">
					<input class="xlarge" id="email" name="u[email]" size="30" type="text" value="<?php echo ( strlen($post['email']) > 0 ) ? $post['email'] : $usuario->email; ?>">
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="login">Nome de usuário:</label>
				<div class="input">
					<input class="xlarge" id="login" name="u[login]" size="30" type="text" disabled="disabled" value="<?php echo ( strlen($post['login']) > 0 ) ? $post['login'] : $usuario->login; ?>">
					<span class="help-inline">Usado para login</span>
				</div>

		    </div> <!-- /clearfix -->

			<?php if( $usuario->login == $this->session->userdata('login') ): ?>
				
				<div class="clearfix">
				
					<label for="senha">Nova Senha:</label>
					<div class="input">
						<input class="xlarge" id="senha" name="u[senha]" size="30" type="password">
						<input class="xlarge" id="c_senha" name="u[c_senha]" size="30" type="password">
						<span class="help-inline">Confirme a senha</span>
					</div>
	
			    </div> <!-- /clearfix -->
				
			<?php endif; ?>

			<div class="clearfix">
				<label for="tipo">Tipo:</label>
				<div class="input">
					<select name="u[tipo]">
						<option value='v' <?php if($usuario->tipo == 'v'): ?>selected="selected"<?php endif; ?>>Vendedor</option>
						<option value='a' <?php if($usuario->tipo == 'a'): ?>selected="selected"<?php endif; ?>>Administrador</option>
					</select>
				</div>
			</div> <!-- /clearfix -->

		    <div class="actions">

		    	<button type="submit" class="btn primary" name="action" value="1">Editar Dados</button>
		    	<button type="button" class="btn danger" onclick="javascript:history.go(-1);">Cancelar</button>

		    </div>
		</fieldset>
	</form>

