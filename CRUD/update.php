<?php
require('config.php');
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

$uid = mysql_real_escape_string($_GET['id']);

if (isset($_POST['sendform'])) {
	//relacionando as variaveis ao formulario
	$f['titulo'] = htmlspecialchars(mysql_real_escape_string($_POST['titulo']));
	$f['conteudo'] = htmlspecialchars(mysql_real_escape_string($_POST['conteudo']));
	$f['data'] = htmlspecialchars(mysql_real_escape_string($_POST['data']));

	$qrr = "UPDATE posts SET titulo = '$f[titulo]', conteudo = '$f[conteudo]', data = '$f[data]' WHERE id='$uid'";
	if ($exe = mysql_query($qrr)) {
		echo 'Post atualizado com sucesso';
	} else {
		die(mysql_error());
	}
	 
	echo '<hr>';
}

$uid = mysql_real_escape_string($_GET['id']);
$query = "SELECT * FROM posts WHERE id='$uid'";
$exeqr = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($exeqr) <= 0) {
	//se passar um id inexistente, volta para a pagina de READ
	header('Location: read.php');
}

	$res = mysql_fetch_assoc($exeqr);

echo'
<form name="cadastra" action="" method="post">
	<fieldset>
		<label>
			<span>Titulo:</span><br>
			<input type="text" name="titulo" value="'.$res['titulo'].'">
		</label>
		<br><br>
		<label>
			<span>Conteudo:</span><br>
			<textarea name="conteudo" rows="3">'.$res['conteudo'].'</textarea>
		</label>
		<br><br>
		<label>
			<span>Data:</span><br>
			<input type="text" name="data"  value="'.$res['data'].'">
		</label>
		<br><br>
		<input type="submit" name="sendform" value="Atualizar">
	</fieldset>
</form>
<a href="read.php">Voltar</a>
';
?>