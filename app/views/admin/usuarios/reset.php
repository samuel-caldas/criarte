<div class="page-header">
	<h2>Resetar Senha</h2>
</div>

<div class="row">
	<?php if($status == false): ?>
		<div class="alert-message block-message error">
			<p>Ocorreu um erro ao gerar e salvar a nova senha.</p>
			<p>
				<a href="<?php echo base_url(); ?>usuarios/" class="btn small">Retornar a listagem.</a>
			</p>
		</div>
	<?php else: ?>
		<div class="alert-message block-message success">
			<p>Nova senha salva com sucesso!</p>
			<p>
				<h3>Usuário:</h3>
				<blockquote><?php echo $usuario; ?></blockquote>
				<h3>Nova senha:</h3>
				<blockquote><?php echo $senha; ?></blockquote>
			</p>
			<p>
				<a href="<?php echo base_url(); ?>usuarios/" class="btn small">Retornar a listagem.</a>
			</p>
		</div>
	<?php endif; ?>
</div>