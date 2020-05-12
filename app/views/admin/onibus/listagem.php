<div class="page-header">
	<h2>Tipos de Ônibus</h2>
</div>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Número</th>
			<th>Andares</th>
			<th>Poltronas</th>
			<th>Tipo</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($todos as $key => $value): ?>

			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $value->numero; ?></td>
				<td><?php echo $value->andares; ?></td>
				<td><?php echo $value->poltronas; ?></td>
				<td>
					<?php
						switch ($value->tipo) {
							case 0:
								echo 'Semi-leito';
								break;
							case 1:
								echo 'Leito';
								break;
						}
					?>
					</td>
				<td>
					<a href="<?php echo base_url(); ?>onibus/editar/<?php echo $value->id; ?>" class="btn small">Editar</a>
					<a href="<?php echo base_url(); ?>onibus/remover/<?php echo $value->id; ?>" class="deleteUser btn small danger">Remover</a>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>

<div class="page-header">
	<h2>Ônibus Removidos</h2>
</div>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Número</th>
			<th>Andares</th>
			<th>Poltronas</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($todos_removidos as $key => $value): ?>

			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $value->numero; ?></td>
				<td><?php echo $value->andares; ?></td>
				<td><?php echo $value->poltronas; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>onibus/editar/<?php echo $value->id; ?>" class="btn small">Editar</a>
					<a href="<?php echo base_url(); ?>onibus/reativar/<?php echo $value->id; ?>" class="btn small primary">Reativar</a>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>