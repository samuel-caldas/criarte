<?php

	$options_est = '<option>UF</option>';
	foreach($data['estados'] as $estado){
		$options_est .= '<option value="' . $estado->id . '">' . $estado->sigla . '</option>';
	}

?>

<div class="row">

	<form>
		<div class="clearfix">
			
			<span class="span5 columns">
	
				<div class="page-header">
					<h4>Origem</h4>
				</div>
	
				<select class="extraSmall" name="origem_estado" id="estadoPartida">
					<?php echo $options_est; ?>
				</select>
				
				<select name="origem_cidade" id="cidadePartida">
					<option value="">Selecione um estado...</option>
				</select>
	
			</span>
	
			<span class="span5 columns">
	
				<div class="page-header">
					<h4>Destino</h4>
				</div>
	
				<select class="extraSmall" name="destino_estado" id="estadoDestino">
					<?php echo $options_est; ?>
				</select>
				
				<select name="destino_cidade" id="cidadeDestino">
					<option value="">Selecione um estado...</option>
				</select>
	
			</span>
	
			<span class="span3 columns">
	
				<div class="page-header">
					<h4>Data</h4>
				</div>
	
				<input class="small" id="dataViagem" name="data_viagem" size="30" type="text" />
	
			</span>
	
			<span class="span3 columns">
	
				<div class="page-header">
					<h4>&nbsp;</h4>
				</div>
	
				<button type="submit" name="action" value="1" class="btn primary" id="pesquisaViagem">Executar Consulta</button>
	
			</span>

		</div>

	</form>

</div>

<div class="row" id="resultadoPesquisa">
	

</div>