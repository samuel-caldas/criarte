<div class="page-header">
	<h2>Administradores</h2>
</div>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>Login</th>
			<th>Email</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($todos_admin as $key => $value): ?>

			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $value->nome; ?></td>
				<td><?php echo $value->login; ?></td>
				<td><?php echo $value->email; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>usuarios/editar/<?php echo $value->login; ?>" class="btn small">Editar</a>
					<a href="<?php echo base_url(); ?>usuarios/reset/<?php echo $value->login; ?>" class="btn small primary">Resetar Senha</a>
					<?php if($this->session->userdata('login') != $value->login): ?>
						<a href="<?php echo base_url(); ?>usuarios/deletar/<?php echo $value->login; ?>" class="deleteUser btn small danger">Deletar</a>
					<?php endif; ?>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>

<div class="page-header">
	<h2>Vendedores</h2>
</div>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>Login</th>
			<th>Email</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($todos_vend as $key => $value): ?>

			<tr>
				<td><?php echo $key; ?></td>
				<td><?php echo $value->nome; ?></td>
				<td><?php echo $value->login; ?></td>
				<td><?php echo $value->email; ?></td>
				<td>
					<a href="<?php echo base_url(); ?>usuarios/editar/<?php echo $value->login; ?>" class="btn small">Editar</a>
					<a href="<?php echo base_url(); ?>usuarios/reset/<?php echo $value->login; ?>" class="btn small primary">Resetar Senha</a>
					<a href="<?php echo base_url(); ?>usuarios/deletar/<?php echo $value->id; ?>" class="deleteUser btn small danger">Deletar</a>
				</td>
			</tr>

		<?php endforeach; ?>

	</tbody>
</table>