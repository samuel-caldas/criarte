<div class="page-header">
	<h2>Adicionar tipo de ônibus</h2>
</div>


	<div class="row">
		<?php if($erro): ?>
			<div class="alert-message error">
				<p><?php echo $erro; ?></p>
			</div>
		<?php endif; ?>
	</div>


	<form action="<?php echo base_url(); ?>onibus/adicionar/attempt" method="post" enctype="multipart/form-data">

		<fieldset>

			<div class="clearfix">

				<label for="tipo">Número:</label>
				<div class="input">
					<input class="xlarge" id="numero" name="numero" size="30" type="text" value="<?php echo $post['numero']; ?>">
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="login">Poltronas - 1x Andar</label>
				<div class="input">
					<div class="input-prepend">
						<label class="add-on"><input type="checkbox" checked="checked" id="cbPrimeiroAndar" disabled></label>
						<input class="mini" id="primeiroAndar" name="primeiro_andar" size="16" type="text" alt="num" value="00">
					</div>
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="login">Poltronas - 2x Andar</label>
				<div class="input">
					<div class="input-prepend">
						<label class="add-on"><input class="disabled" type="checkbox" id="cbSegundoAndar"></label>
						<input class="mini" id="segundoAndar" name="segundo_andar" class="disabled" size="16" type="text" alt="num" disabled value="00">
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
		    	
		    	<button type="submit" name="action" value="1" class="btn primary">Adicionar ônibus</button>
		    	
		    </div>
		</fieldset>
	</form>

