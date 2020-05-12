<div class="page-header">
	<h2>Editar viagem</h2>
</div>

	<?php

		$options_est = '<option>Estado</option>';
		foreach($data['estados'] as $estado){
			$options_est .= '<option value="' . $estado->id . '">' . $estado->sigla . '</option>';
		}
		
		#print_r($viagem);
	?>

	<div class="row">
		<?php if($erro): ?>
			<div class="alert-message error">
				<p><?php echo $erro; ?></p>
			</div>
		<?php endif; ?>
	</div>

	<form action="<?php echo base_url(); ?>viagens/editar/<?php echo $viagem[0]->id; ?>" method="post">

		<fieldset>

			<input type="hidden" value="<?php echo $viagem[0]->id; ?>" name="id" />

			<div class="clearfix">

				<label for="nome">Partida - Local:</label>
				
				<div class="input">

					<a href="#" class="btn small" id="btEditarPartida"><?php echo $viagem[0]->cidade_partida; ?> / <?php echo $viagem[0]->estado_partida; ?> ( Clique para editar )</a>
					<input type="hidden" value="0" name="v[editar_partida]" id="editarPartida" />

				</div>
				<div class="input" style="display: none;" id="camposPartida">
					<input class="" id="n_partida" name="v[n_partida]" size="30" type="text" value="<?php echo ( strlen($post['n_partida']) > 0) ? $post['n_partida'] : 'Criar nova cidade...' ; ?>">

					<select class="small" name="v[n_estado_partida]">
						<?php echo $options_est; ?>
					</select>

					<span class="help-inline">ou</span>

					<br /><br />

					<select class="small" name="v[estado_partida]" id="estadoPartida">
						<?php echo $options_est; ?>
					</select>

					<select name="v[partida]" id="cidadePartida">
						<option>Selecione uma estado...</option>
					</select>
				</div>

		    </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="nome">Partida - Data:</label>
				<div class="input">
					<input class="small" id="data_partida" name="v[data_partida]" size="30" type="text" value="<?php echo date( 'd-m-Y' , strtotime($viagem[0]->data_partida)); ?>">
				</div>

		   </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="nome">Destino - Local:</label>
				
				<div class="input">

					<a href="#" class="btn small" id="btEditarDestino"><?php echo $viagem[0]->cidade_destino; ?> / <?php echo $viagem[0]->estado_destino; ?> ( Clique para editar )</a>
					<input type="hidden" value="0" name="v[editar_destino]" id="editarDestino" />

				</div>
				
				<div class="input" style="display: none;" id="camposDestino">
					<input class="" id="n_destino" name="v[n_destino]" size="30" type="text" value="<?php echo ( strlen($post['n_destino']) > 0) ? $post['n_destino'] : 'Criar nova cidade...' ; ?>">

					<select class="small" name="v[n_estado_destino]">
						<?php echo $options_est; ?>
					</select>

					<span class="help-inline">ou</span>

					<br /><br />

					<select class="small" name="v[estado_destino]" id="estadoDestino">
						<?php echo $options_est; ?>
					</select>

					<select name="v[destino]" id="cidadeDestino">
						<option>Selecione uma cidade...</option>
					</select>
				</div>

		    </div> <!-- /clearfix -->
		    
		    <div class="clearfix">

				<label for="nome">Volta - Data:</label>
				<div class="input">
					<input class="small" id="data_destino" name="v[data_volta]" size="30" type="text" value="<?php echo date( 'd-m-Y' , strtotime($viagem[0]->data_volta)); ?>">
				</div>

		   </div> <!-- /clearfix -->

			<div class="clearfix">

				<label for="email">Ônibus:</label>
				<div class="input">
					<select name="v[numero_onibus]">
						<option>Selecione um ônibus</option>
						<?php foreach($onibus as $o): ?>
							
							<option value="<?php echo $o->id; ?>" <?php echo ($o->numero == $viagem[0]->numero_onibus) ? 'selected="selected"' : '' ; ?>><?php echo $o->numero; ?></option>
							
						<?php endforeach; ?>
					</select>
				</div>

		    </div> <!-- /clearfix -->
		    
		    <div class="actions">
		    	
		    	<button type="submit" name="action" value="1" class="btn primary">Criar Viagem</button>
		    	
		    </div>
		</fieldset>
	</form>

