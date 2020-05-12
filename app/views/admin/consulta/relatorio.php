<?php  ?>

<table width="100%" cellspacing="0" cellpadding="5" border="1">
	<tr>
		<td align="center"><strong><font color="#F00">EDNANTUR TURISMO</font> - Mapa de Passageiros</strong></td>
	</tr>
</table>

<br />

<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<tr>
		<td align="right"><strong>Partida:</strong></td>
		<td><?php echo $viagem->cidade_partida . '/' . $viagem->estado_partida; ?></td>
		<td align="right"><strong>Data ( partida ):</strong></td>
		<td><?php echo date( 'd/m/Y' , strtotime( $viagem->data_partida ) ); ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Destino:</strong></td>
		<td><?php echo $viagem->cidade_destino . '/' . $viagem->estado_destino; ?></td>
		<td align="right"><strong>Data ( volta ):</strong></td>
		<td><?php echo date( 'd/m/Y' , strtotime( $viagem->data_volta ) ); ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Ônibus:</strong></td>
		<td colspan="3"><?php echo $viagem->numero_onibus; ?></td>
	</tr>
</table>

<br />

<table width="100%" cellspacing="0" cellpadding="5" border="1">
	<tr><td align="center"><strong>Ida:</strong></td></tr>
</table>

<br />

<?php
   # $this->load->model('usuarios_model','usuarios');
	
	if( $reservas_ida == null ) $reservas_ida = array();
	if( $reservas_volta == null ) $reservas_volta = array();
	if( $reservas_iv == null ) $reservas_iv = array();
?>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<?php if( $onibus->tipo == 0 ): ?>
		<?php
			for( $x = 1; $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x++ ){
				echo '<tr>';
				for( $y = 1; $y <= 4; $y++ ){
					$class = 'livre';
					if( in_array($x,$reservas_ida ) ) $class = 'ocupada';
					else if( in_array($x,$reservas_iv ) ) $class = 'ocupadaIdaVolta';
					
					echo '<td>';
						echo'<table border="0" style="border: 0px !important;"><tr><td><h2 class="' . $class . '">' . $x . '</h2></td><td>';
							if( $class == 'livre')
								echo '<strong>Poltrona livre.</strong>';
							else{
								echo '<table border="0" style="border: 0px !important;">';

									$c = 0;

									foreach( $reservas as $r ){
										if( $r->poltrona == $x && $r->ida == 1 && $c == 0){
											echo '<tr><td>Nome: <strong>' . $r->nome . '</strong></tr>
												  <tr><td>RG: <strong>' . $r->rg. '</strong></tr>
												  <tr><td>Telefone: <strong>' . $r->telefone. '</strong></tr>
												  <tr><td>Embarque: <strong>' . $r->embarque. '</strong></tr>
												  <tr><td>Vendedor: <strong>' . $this->usuarios_model->get_nome($r->vendedor) . '</strong></tr>';
											$c++;
										}
									}
								echo '</table>';	
							}
						echo '</td></tr></table>';
					echo '</td>';
					
					if($y < 4)
						$x++;
				}
				echo '</tr>';
			}
		?>
	<?php else: ?>
		<?php
			for( $x = 1; $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x++ ){
				echo '<tr>';
				for( $y = 1; $y <= 3; $y++ ){
					$class = 'livre';
					if( in_array($x,$reservas_ida ) ) $class = 'ocupada';
					else if( in_array($x,$reservas_iv ) ) $class = 'ocupadaIdaVolta';
					echo '<td>';
						echo'<table border="0" style="border: 0px !important;"><tr><td><h2 class="' . $class . '">' . $x . '</h2></td><td>';
							if( $class == 'livre')
								echo '<strong>Poltrona livre.</strong>';
							else{
								echo '<table border="0" style="border: 0px !important;">';
									$c = 0;
									foreach( $reservas as $r ){
										if( $r->poltrona == $x && $r->ida && $c == 0){
											echo '<tr><td>Nome: <strong>' . $r->nome . '</strong></tr>
												  <tr><td>RG: <strong>' . $r->rg. '</strong></tr>
												  <tr><td>Telefone: <strong>' . $r->telefone. '</strong></tr>
												  <tr><td>Embarque: <strong>' . $r->embarque. '</strong></tr>
												  <tr><td>Vendedor: <strong>' . $this->usuarios_model->get_nome($r->vendedor) . '</strong></tr>';
											$c++;
										}
									}
								echo '</table>';	
							}
						echo '</td></tr></table>';
					echo '</td>';
					
					if($y < 3) $x++;
				}
				echo '</tr>';
			}
		?>
	<?php endif; ?>
</table>

<br />

<table width="100%" cellspacing="0" cellpadding="5" border="1">
	<tr><td align="center"><strong>Volta:</strong></td></tr>
</table>

<br />

<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<?php if( $onibus->tipo == 0 ): ?>
		<?php
			for( $x = 1; $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x++ ){
				echo '<tr>';
				for( $y = 1; $y <= 4; $y++ ){
					$class = 'livre';
					if( in_array($x,$reservas_volta ) ) $class = 'ocupada';
					else if( in_array($x,$reservas_iv ) ) $class = 'ocupadaIdaVolta';
					echo '<td>';
						echo'<table border="0" style="border: 0px !important;"><tr><td><h2 class="' . $class . '">' . $x . '</h2></td><td>';
							if( $class == 'livre')
								echo '<strong>Poltrona livre.</strong>';
							else{
								echo '<table border="0" style="border: 0px !important;">';
									$c = 0;
									foreach( $reservas as $r ){
										if( $r->poltrona == $x && $r->volta == 1 && $c == 0){
											echo '<tr><td>Nome: <strong>' . $r->nome . '</strong></tr>
												  <tr><td>RG: <strong>' . $r->rg. '</strong></tr>
												  <tr><td>Telefone: <strong>' . $r->telefone. '</strong></tr>
												  <tr><td>Embarque: <strong>' . $r->embarque. '</strong></tr>
												  <tr><td>Vendedor: <strong>' . $this->usuarios_model->get_nome($r->vendedor) . '</strong></tr>';
											$c++;
										}
									}
								echo '</table>';	
							}
						echo '</td></tr></table>';
					echo '</td>';
					
					if($y < 4) $x++;
				}
				echo '</tr>';
			}
		?>
	<?php else: ?>
		<?php
			for( $x = 1; $x <= ($onibus->primeiro_andar + $onibus->segundo_andar); $x++ ){
				echo '<tr>';
				for( $y = 1; $y <= 3; $y++ ){
					$class = 'livre';
					if( in_array($x,$reservas_volta ) ) $class = 'ocupada';
					else if( in_array($x,$reservas_iv ) ) $class = 'ocupadaIdaVolta';
					echo '<td>';
						echo'<table border="0" style="border: 0px !important;"><tr><td><h2 class="' . $class . '">' . $x . '</h2></td><td>';
							if( $class == 'livre')
								echo '<strong>Poltrona livre.</strong>';
							else{
								echo '<table border="0" style="border: 0px !important;">';
									$c = 0;
									foreach( $reservas as $r ){
										if( $r->poltrona == $x && $r->volta == 1 && $c == 0){
											echo '<tr><td>Nome: <strong>' . $r->nome . '</strong></tr>
												  <tr><td>RG: <strong>' . $r->rg. '</strong></tr>
												  <tr><td>Telefone: <strong>' . $r->telefone. '</strong></tr>
												  <tr><td>Embarque: <strong>' . $r->embarque. '</strong></tr>
												  <tr><td>Vendedor: <strong>' . $this->usuarios_model->get_nome($r->vendedor) . '</strong></tr>';
											 $c++;
										}
									}
								echo '</table>';	
							}
						echo '</td></tr></table>';
					echo '</td>';
					
					if($y < 3) $x++;
				}
				echo '</tr>';
			}
		?>
	<?php endif; ?>
</table>


<?php
	#print_r($reservas);
?>

</table>