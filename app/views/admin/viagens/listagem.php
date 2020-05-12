<div class="page-header">
	<h2>Viagens Abertas</h2>
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

		<?php foreach ($viagens_abertas as $key => $value): ?>

			<tr>
				<td><?php echo ( $key + 1 ); ?></td>
				<td><?php echo $value->cidade_partida; ?> / <?php echo $value->estado_partida; ?></td>
				<td><?php echo date( 'd/m/Y' , strtotime( $value->data_partida ) ); ?></td>
				<td><?php echo $value->cidade_destino; ?> / <?php echo $value->estado_destino; ?></td>
				<td><?php echo date( 'd/m/Y' , strtotime( $value->data_volta ) ); ?></td>
				<td><?php echo $value->numero_onibus; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>viagens/editar/<?php echo $value->id; ?>" class="btn small">Editar</a>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>

<div class="page-header">
	<h2>Viagens Fechadas</h2>
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

		<?php foreach ($viagens_fechadas as $key => $value): ?>

			<tr>
				<td><?php echo ( $key + 1 ); ?></td>
				<td><?php echo $value->cidade_partida; ?> / <?php echo $value->estado_partida; ?></td>
				<td><?php echo date( 'd/m/Y' , strtotime( $value->data_partida ) ); ?></td>
				<td><?php echo $value->cidade_destino; ?> / <?php echo $value->estado_destino; ?></td>
				<td><?php echo date( 'd/m/Y' , strtotime( $value->data_volta ) ); ?></td>
				<td><?php echo $value->numero_onibus; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>viagens/editar/<?php echo $value->id; ?>" class="btn small">Editar</a>
					<a href="<?php echo base_url(); ?>viagens/deletar/<?php echo $value->id; ?>" class="deleteUser btn small danger">X</a>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>