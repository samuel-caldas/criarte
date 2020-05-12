<?php if( $msg['tipo'] != 0 ): ?>
	<div class="row">
		<?php if( $msg['tipo'] == 1 ): ?>
			<div class="alert-message success">
		<?php elseif( $msg['tipo'] == 2 ): ?>
			<div class="alert-message error">
		<?php endif; ?>
			<p><?php echo $msg['msg']; ?></p>
		</div>
	</div>
<?php endif; ?>
<table class="zebra-striped">
	<thead>
		<tr>
			<th>Partida</th>
			<th>Data</th>
			<th>Destino</th>
			<th>Volta</th>
			<th>Ônibus</th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td><?php echo $viagem->cidade_partida; ?> / <?php echo $viagem->estado_partida; ?></td>
			<td><?php echo date( 'd/m/Y' , strtotime( $viagem->data_partida ) ); ?></td>
			<td><?php echo $viagem->cidade_destino; ?> / <?php echo $viagem->estado_destino; ?></td>
			<td><?php echo date( 'd/m/Y' , strtotime( $viagem->data_volta ) ); ?></td>
			<td><?php echo $viagem->numero_onibus; ?></td>
			<td><a href="<?php echo base_url(); ?>consulta/relatorio/<?php echo $viagem->id; ?>" target="_blank" class="btn small">Relatório</a></td>
		</tr>

	</tbody>
</table>

<div class="row">

	<?php 
		# tipo 0 = semi leito
		# tipo 1 = leito
		
		$tipo = $onibus->tipo;
		$l = 3;

		if($tipo == 0)
			$l = 4;
	?>

	<div class="onibus">

		<div id="primeiroAndarOnibus">

			<div class="linha03 clearfix">

				<?php for( $x = 3; $x <= $onibus->primeiro_andar; $x+=$l ): ?>
					<?php if( $reservas === false ): ?>
						<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
					<?php else: ?>

						<?php if( in_array($x, $reservas_iv) ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
						<?php elseif( in_array($x, $reservas_ida) ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
						<?php elseif( in_array($x, $reservas_volta) ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
						<?php else: ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php endif; ?>
						
					<?php endif; ?>
				<?php endfor;?>

			</div>
			
			<div class="linha04 clearfix">

				<?php if( $tipo != 1 ): ?>
					<?php for( $x = 4; $x <= $onibus->primeiro_andar; $x+=$l ): ?>
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
					<?php endfor; ?>
				<?php endif;?>
			</div>
			
			<div class="linha02 clearfix">

				<?php for( $x = 2; $x <= $onibus->primeiro_andar; $x+=$l ): ?>
					
					<?php if( ($tipo == 1) && ($x % 2 == 1) ): ?>

						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo ($x-1); ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array(($x-1), $reservas_iv) ): ?>
								<a href="#" title="<?php echo ($x-1); ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array(($x-1), $reservas_ida) ): ?>
								<a href="#" title="<?php echo ($x-1); ?>" class="poltronaSemi"></a>
							<?php elseif( in_array(($x-1), $reservas_volta) ): ?>
								<a href="#" title="<?php echo ($x-1); ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo ($x-1); ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>

					<?php else: ?>
						
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
						
					<?php endif; ?>
						
				<?php endfor; ?>

			</div>
			
			<div class="linha01 clearfix">

				<?php for( $x = 1; $x <= $onibus->primeiro_andar; $x+=$l ): ?>
					<?php if( ($tipo == 1) && ($x % 2 == 0) ): ?>

						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo ($x+1); ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array(($x+1), $reservas_iv) ): ?>
								<a href="#" title="<?php echo ($x+1); ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array(($x+1), $reservas_ida) ): ?>
								<a href="#" title="<?php echo ($x+1); ?>" class="poltronaSemi"></a>
							<?php elseif( in_array(($x+1), $reservas_volta) ): ?>
								<a href="#" title="<?php echo ($x+1); ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo ($x+1); ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>

					<?php else: ?>
						
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
						
					<?php endif; ?>
						
				<?php endfor; ?>

			</div>

		</div>

		<?php if( $onibus->andares > 1 ): ?>

			<div id="segundoAndarOnibus">
				<div class="linha01 clearfix">
	
					<?php for( $x = ($onibus->primeiro_andar + 1); $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x+=4 ): ?>
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
	
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
					<?php endfor; ?>
	
				</div>
				
				<div class="linha02 clearfix">
	
					<?php for( $x = ($onibus->primeiro_andar + 2); $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x+=4 ): ?>
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
					<?php endfor; ?>
	
				</div>
				
				<div class="linha03 clearfix">
	
					<?php for( $x = ($onibus->primeiro_andar + 3); $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x+=4 ): ?>
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
					<?php endfor; ?>
	
				</div>
				
				<div class="linha04 clearfix">
	
					<?php for( $x = ($onibus->primeiro_andar + 4); $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x+=4 ): ?>
						<?php if( $reservas === false ): ?>
							<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
						<?php else: ?>
							
							<?php if( in_array($x, $reservas_iv) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaOcupada"></a>
							<?php elseif( in_array($x, $reservas_ida) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php elseif( in_array($x, $reservas_volta) ): ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaSemi"></a>
							<?php else: ?>
								<a href="#" title="<?php echo $x; ?>" class="poltronaVazia"></a>
							<?php endif; ?>
							
						<?php endif; ?>
					<?php endfor; ?>
	
				</div>
			</div>

		<?php endif; ?>

	</div>
	
	<div class="legenda clearfix">

		<img src="<?php echo base_url(); ?>assets/images/legenda.png" />
		
		<?php if( $onibus->andares > 1 ): ?>
			<div style="float: right;">
				<a href="#" class="btn primary" id="primeiroAndarBt">Primeiro Andar</a>
				<a href="#" class="btn" id="segundoAndarBt">Segundo Andar</a>	
			</div>
		<?php endif; ?>

	</div>

</div>

<div class="row" id="fazerReservaForm">

	<div class="page-header">
		<h3>Poltronas Disponíveis</h3>
	</div>

	<div class="span6 columns">
		
		<div class="page-header">
			<h4>Fazer Reserva</h4>
		</div>

		<form action="" method="post" class="form-stacked">

			<fieldset>

				<input type="hidden" name="r[viagem_id]" value="<?php echo $viagem->id; ?>" />
				<input type="hidden" name="r[poltrona]" value="" id="poltrona" />

				<div class="clearfix">

					<label for="nome">Nome:</label>
					<div class="input">
						<input class="xlarge" id="nome" name="r[nome]" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

				<div class="clearfix">

					<label for="email">Telefone:</label>
					<div class="input">
						<input class="xlarge" id="telefone" name="r[telefone]" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

				<div class="clearfix">

					<label for="login">RG ( Apenas Números ):</label>
					<div class="input">
						<input class="xlarge" id="rg" name="r[rg]" alt="phone" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

			    <div class="clearfix">

					<label for="senha">Embarque:</label>
					<div class="input">
						<input class="xlarge" id="embarque" name="r[embarque]" size="30" type="text">
					</div>

			    </div> <!-- /clearfix -->

			    <div class="clearfix">

					<div class="input">
						<label>
							<input type="checkbox" name="r[ida]" value="1" id="checkIda"><span>Ida</span>
						</label>
						<label>
							<input type="checkbox" name="r[volta]" value="1" id="checkVolta"><span>Volta</span>
						</label>
					</div>

			    </div> <!-- /clearfix -->

			    <div class="actions">

					<input type="hidden" name="r[vendedor]" value="<?= $this->session->userdata('user_id'); ?>" />

			    	<button type="submit" name="action_add" value="1" class="btn primary">Criar Reserva</button>

			    </div>
			</fieldset>
		</form>

	</div>
	
	<div class="span9 columns">

		<div class="page-header">
			<h4>Selecione a Poltrona</h4>
		</div>

		<?php for( $x = 1; $x <= ( $onibus->primeiro_andar + $onibus->segundo_andar ); $x++ ): ?>
			<?php if( $reservas === false ): ?>

				<a href="#" class="poltronaLivreBt btn large p<?php echo $x; ?>"><?php echo $x; ?></a>

			<?php else: ?>

				<?php if( in_array($x, $reservas_ida) ): ?>
				
					<a href="#" class="poltronaLivreBt ocupadaIda btWarning btn large p<?php echo $x; ?>"><?php echo $x; ?></a>
				
				<?php elseif( in_array($x, $reservas_volta) ): ?>
				
					<a href="#" class="poltronaLivreBt ocupadaVolta btWarning btn large p<?php echo $x; ?>"><?php echo $x; ?></a>
				
				<?php elseif( !in_array($x, $reservas_iv) ): ?>
					
					<a href="#" class="poltronaLivreBt btn large p<?php echo $x; ?>"><?php echo $x; ?></a>
					
				<?php endif; ?>

			<?php endif; ?>
		<?php endfor; ?>	

	</div>

</div>

<?php if( count($reservas) > 0 ): ?>

<div id="dataHolding" style="display: none;">

<?php

	$poltronas = array();
	$x = 0;

	foreach( $reservas as $res ):

		$poltronas[$x]['id'] = $res->id;
		$poltronas[$x]['poltrona'] = $res->poltrona;
		$poltronas[$x]['viagem_id'] = $res->id;
		$poltronas[$x]['ida'] = $res->ida;
		$poltronas[$x]['volta'] = $res->volta;
		$poltronas[$x]['nome'] = $res->nome;
		$poltronas[$x]['telefone'] = $res->telefone;
		$poltronas[$x]['rg'] = $res->rg;
		$poltronas[$x]['embarque'] = $res->embarque;

		$x++;

	endforeach;

	foreach( $poltronas as $dados ){
				
		$span = '<span ';
		
			$span .= 'class="pData' . $dados['poltrona'] . '" ';
			$span .= 'data-id="' . $dados['id'] . '" ';
			$span .= 'data-viagemid="' . $dados['viagem_id'] . '" ';
			$span .= 'data-ida="' . $dados['ida'] . '" ';
			$span .= 'data-volta="' . $dados['volta'] . '" ';
			$span .= 'data-nome="' . $dados['nome'] . '" ';
			$span .= 'data-telefone="' . $dados['telefone'] . '" ';
			$span .= 'data-rg="' . $dados['rg'] . '" ';
			$span .= 'data-embarque="' . $dados['embarque'] . '" ';
		
		$span .= '></span>';
		
		#var_dump($span);
		echo $span;
		
	}

?>

</div>

<div class="row">
	
	<div class="page-header">
		<h3>Poltronas Indisponíveis</h3>
	</div>

	<div class="span6 columns">
		
		<div class="page-header">
			<h4>Editar Reserva</h4>
		</div>

		<form action="" method="post" class="form-stacked">

			<fieldset>

				<input type="hidden" name="r[viagem_id]" value="<?php echo $viagem->id; ?>" />
				<input type="hidden" name="r[poltrona]" value="" id="poltrona_2" />
				<input type="hidden" name="id" value="" id="id_2" />

				<div class="clearfix">

					<label for="nome">Nome:</label>
					<div class="input">
						<input class="xlarge" id="nome_2" name="r[nome]" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

				<div class="clearfix">

					<label for="email">Telefone:</label>
					<div class="input">
						<input class="xlarge" id="telefone_2" name="r[telefone]" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

				<div class="clearfix">

					<label for="login">RG ( Apenas Números ):</label>
					<div class="input">
						<input class="xlarge" id="rg_2" name="r[rg]" alt="phone" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

			    <div class="clearfix">

					<label for="senha">Embarque:</label>
					<div class="input">
						<input class="xlarge" id="embarque_2" name="r[embarque]" size="30" type="text">
					</div>

			    </div> <!-- /clearfix -->

			    <div class="clearfix">

					<div class="input">
						<label>
							<input type="checkbox" name="r[ida]" value="1" id="checkIda_2"><span>Ida</span>
						</label>
						<label>
							<input type="checkbox" name="r[volta]" value="1" id="checkVolta_2"><span>Volta</span>
						</label>
					</div>

			    </div> <!-- /clearfix -->

			    <div class="actions">

			    	<button type="submit" name="action_editar" value="1" class="btn primary">Editar Reserva</button>
			    	<button type="submit" name="action_deletar" value="1" class="btn danger">Deletar Reserva</button>

			    </div>
			</fieldset>
		</form>

	</div>

	<div class="span6 columns">
		
		<div class="page-header">
			<h4>Editar Reserva</h4>
		</div>

		<form action="" method="post" class="form-stacked">

			<fieldset>

				<input type="hidden" name="r[viagem_id]" value="<?php echo $viagem->id; ?>" />
				<input type="hidden" name="r[poltrona]" value="" id="poltrona_3" />
				<input type="hidden" name="id" value="" id="id_3" />

				<div class="clearfix">

					<label for="nome">Nome:</label>
					<div class="input">
						<input class="xlarge" id="nome_3" name="r[nome]" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

				<div class="clearfix">

					<label for="email">Telefone:</label>
					<div class="input">
						<input class="xlarge" id="telefone_3" name="r[telefone]" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

				<div class="clearfix">

					<label for="login">RG ( Apenas Números ):</label>
					<div class="input">
						<input class="xlarge" id="rg_3s" name="r[rg]" alt="phone" size="30" type="text" value="">
					</div>

			    </div> <!-- /clearfix -->

			    <div class="clearfix">

					<label for="senha">Embarque:</label>
					<div class="input">
						<input class="xlarge" id="embarque_3" name="r[embarque]" size="30" type="text">
					</div>

			    </div> <!-- /clearfix -->

			    <div class="clearfix">

					<div class="input">
						<label>
							<input type="checkbox" name="r[ida]" value="1" id="checkIda_3"><span>Ida</span>
						</label>
						<label>
							<input type="checkbox" name="r[volta]" value="1" id="checkVolta_3"><span>Volta</span>
						</label>
					</div>

			    </div> <!-- /clearfix -->

			    <div class="actions">

			    	<button type="submit" name="action_editar" value="1" class="btn primary">Editar Reserva</button>
			    	<button type="submit" name="action_deletar" value="1" class="btn danger">Deletar Reserva</button>

			    </div>
			</fieldset>
		</form>

	</div>

	<div class="span3 columns">

		<div class="page-header">
			<h4>Selecione a Poltrona</h4>
		</div>

		<?php for( $x = 1; $x <= ( $onibus->primeiro_andar + $onibus->segundo_andar ); $x++ ): ?>
				<?php if( in_array($x, $reservas_ida) ): ?>

					<a href="#" class="poltronaOcupadaBt ocupadaIda btWarning btn large p<?php echo $x; ?>"><?php echo $x; ?></a>

				<?php elseif( in_array($x, $reservas_volta) ): ?>

					<a href="#" class="poltronaOcupadaBt ocupadaVolta btWarning btn large p<?php echo $x; ?>"><?php echo $x; ?></a>

				<?php elseif( in_array($x, $reservas_iv) ): ?>

					<a href="#" class="poltronaOcupadaBt ocupadaIdaVolta btn large p<?php echo $x; ?> danger"><?php echo $x; ?></a>

				<?php endif; ?>
		<?php endfor; ?>	

	</div>

</div>

<?php endif; ?>