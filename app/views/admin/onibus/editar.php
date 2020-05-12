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

<form action="<?php echo base_url(); ?>onibus/editar/<?php echo $onibus->id; ?>" method="post" enctype="multipart/form-data">

	<fieldset>

		<div class="clearfix">

			<label for="numero">Número:</label>
			<div class="input">
				<input class="xlarge" id="numero" name="numero" size="30" type="text" value="<?php echo ( strlen($post['numero']) > 0 ) ? $post['numero'] : $onibus->numero; ?>">
			</div>

	    </div> <!-- /clearfix -->

		<div class="clearfix">

			<label for="login">Poltronas - 1x Andar</label>
			<div class="input">
				<div class="input-prepend">
					<label class="add-on"><input type="checkbox" checked="checked" id="cbPrimeiroAndar" disabled></label>
					<input class="mini" name="primeiroAndar" size="16" type="text" alt="num" value="<?php echo ( strlen($post['primeiro_andar']) > 0 ) ? $post['primeiro_andar'] : $onibus->primeiro_andar; ?>">
				</div>
			</div>

	    </div> <!-- /clearfix -->

		<div class="clearfix">

			<label for="login">Poltronas - 2x Andar</label>
			<div class="input">
				<div class="input-prepend">
					<label class="add-on"><input type="checkbox" id="cbSegundoAndar" <?php echo ( strlen($post['segundo_andar']) > 0 || strlen($onibus->segundo_andar) > 0 ) ? 'checked="checked"' : ''; ?> /></label>
					<input class="mini" id="segundoAndarEdit" name="segundoAndar" size="16" type="text" alt="num" value="<?php echo ( strlen($post['segundo_andar']) > 0 ) ? $post['segundo_andar'] : $onibus->segundo_andar; ?>">
				</div>
			</div>

	    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="tipo">Tipo</label>
				<div class="input">
					<select name="tipo">
						<option value="0" selected="selected">Semi-leito</option>
						<option value="1">Leito</option>
					</select>
				</div>

		    </div> <!-- /clearfix -->

	    <div class="actions">

	    	<button type="submit" class="btn primary" name="action" value="1">Editar Dados</button>
	    	<button type="button" class="btn danger" onclick="javascript:history.go(-1);">Cancelar</button>

	    </div>
	</fieldset>
</form>

