<?php

	$total = count($viagens_encontradas);

?>

<div class="page-header">
	<h4>Resultado: <span class="viagemResultado"><?php echo $total; ?></span> viagem(s) encontrada(s)</h4>
</div>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Partida</th>
			<th>Data</th>
			<th>Destino</th>
			<th>Volta</th>
			<th>Ônibus</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($viagens_encontradas as $key => $value): ?>

			<tr>
				<td><?php echo ( $key + 1 ); ?></td>
				<td><?php echo $value->cidade_partida; ?> / <?php echo $value->estado_partida; ?></td>
				<td><?php echo date( 'd/m/Y' , strtotime( $value->data_partida ) ); ?></td>
				<td><?php echo $value->cidade_destino; ?> / <?php echo $value->estado_destino; ?></td>
				<td><?php echo date( 'd/m/Y' , strtotime( $value->data_volta ) ); ?></td>
				<td><?php echo $value->numero_onibus; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>consulta/reservas/<?php echo $value->id; ?>" class="btn small">Fazer reservas</a>
					<a href="<?php echo base_url(); ?>consulta/relatorio/<?php echo $value->id; ?>" class="btn small">Relatório</a>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>