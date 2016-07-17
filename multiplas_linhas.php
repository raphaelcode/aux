<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Index de PHP</title>
</head>
<body>
	<?php
	if (isset($_POST['send'])) {
		//texto usando nl2br formata e mostra a quebra de linha no textarea
		echo nl2br($_POST['texto']);
	}
	?>
	<hr>
	<form name="formCadastro" action="" method="post">
		<label>
			<span>Texto:</span><br>
			<textarea name="texto" rows="10"></textarea>
		</label>
		<input type="submit" name="send" value="Enviar">
	</form>
</body>
</html>