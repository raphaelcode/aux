<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Index de PHP</title>
</head>
<body>
	<?php
	if (isset($_POST['send'])) {
		$listbox = $_POST['listbox'];
		if (empty($listbox)) {
			echo "Escolha um sexo";
		} else {
			echo "Foi escolhido o sexo ".$listbox;
		}
	
		echo "<br>";

		$combobox = $_POST['combo'];
		if (!empty($combobox)) {
			$count = count($combobox);
			if ($count > 2) {
				echo "Informe apenas até 2 consoles diferentes";
			} else {
				$combobox = implode(', ', $combobox);
				echo $combobox;
			}
		} else {
			echo "Escolha ao menos 1 console"; 
		}
	}
	?>
	<hr>
	<form name="formCadastro" action="" method="post">
		<label>
			<select name="listbox">
				<option value="">Escolha um sexo</option>
				<option value="Feminino">Feminino</option>
				<option value="Masculino	">Masculino</option>
			</select>
		</label>

		<br><br>

		<label>
			<!-- colocando "[]" no name pra identificar que poderão ser enviados mais de uma opção na escolha
			multiple="multiple" é a condição que diferencia um listbox de um combobox-->
			<select name="combo[]" multiple="multiple" size="5">
				<option value="" disabled="disabled">Escolha ao menos 1 console</option>
				<option value="Nintendo64">Nintendo 64</option>
				<option value="XboxOne">Xbox One</option>
				<option value="Playstation4">Playstation 4</option>
				<option value="PC">PC</option>
			</select>
		</label>
		<br>
		<input type="submit" name="send" value="Enviar">
	</form>
</body>
</html>