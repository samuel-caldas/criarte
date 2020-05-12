<?php if( $cidades == false ): ?>

	<option>Nenhuma cidade encontrada</option>

<?php else: ?>

	<?php foreach( $cidades as $cidade ): ?>

		<option value="<?php echo $cidade->id; ?>"><?php echo $cidade->cidade; ?></option>

	<?php endforeach; ?>

<?php endif; ?>