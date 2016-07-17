<?php
require('config.php');
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

if (isset($_POST['sendform'])) {
	//relacionando as variaveis ao formulario
	$f['titulo'] = htmlspecialchars(mysql_real_escape_string($_POST['titulo']));
	$f['conteudo'] = htmlspecialchars(mysql_real_escape_string($_POST['conteudo']));
	$f['data'] = htmlspecialchars(mysql_real_escape_string($_POST['data']));

	$queryCreate = "INSERT INTO posts (titulo, conteudo, data) VALUES ('$f[titulo]', '$f[conteudo]', '$f[data]')";
	$cadastra = mysql_query($queryCreate) or die("Erro ao cadastrar".mysql_error());

	if ($cadastra) {
		echo 'Post \''.$f['titulo'].'\' foi cadastrado com sucesso'; 		
	} else {
		echo 'Erro ao cadastrar';
	}

	echo '<hr>';
}

?>

<form name="cadastra" method="post" action="">
	<fieldset>
		<label>
			<span>Titulo:</span><br>
			<input type="text" name="titulo">
		</label>
		<br><br>
		<label>
			<span>Conteudo:</span><br>
			<textarea name="conteudo" rows="3"></textarea>
		</label>
		<br><br>
		<label>
			<span>Data:</span><br>
			<input type="text" name="data" value="<?php echo date('Y-m-d H:i:s'); ?>">
		</label>
		<br><br>
		<input type="submit" name="sendform" value="Cadastrar">
	</fieldset>
</form>
<a href="read.php">Painel de controle</a>