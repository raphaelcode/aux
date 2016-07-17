<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Index de PHP</title>
</head>
<body>
	<?php
	if (isset($_POST['send'])) {
		$radio = $_POST['simounao'];
		if (empty($radio)) {
			echo "Escolha entre as opções abaixo";
		} else {
			echo $radio;
		}
		echo '<hr>';

		$check = $_POST['sabor'];
		if (!empty($check)) {
			$contador = count($check);
			if ($contador > 2) {
				echo 'Escolha apenas até 2 sabores';
			} else {
				$check = implode(', ', $check);
				echo $check;
			}
		}

	}
	?>
	<hr>
	<form name="formCadastro" action="" method="post">
		<span>Quer um sorvete?</span><br>
		<label><input type='radio' name="simounao" value="s">Sim</label>
		<label><input type='radio' name="simounao" value="n">Não</label>
		<hr>
		<span>Selecione até 2 sabores</span><br>
		<label><input type='checkbox' name="sabor[]" value="laranja"> Laranja</label><br>		
		<label><input type='checkbox' name="sabor[]" value="limao"> Limão</label><br>
		<label><input type='checkbox' name="sabor[]" value="uva"> Uva</label><br>
		<br><br>

		<input type="submit" name="send" value="Enviar">
	</form>
</body>
</html>