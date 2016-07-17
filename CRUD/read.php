<?php
require('config.php');
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

	

	//verificamos se tem um GET "del" para exclusão
	if (!empty($_GET['del'])) {
		$delid = mysql_real_escape_string($_GET['del']);
		$queryDel = "DELETE FROM posts WHERE id='$delid'";
		//executando e ja mandando mensagem de erro ou sucesso
		if ($exeqrDel = mysql_query($queryDel)) {
			echo 'Post excluido com sucesso<br>';
		} else {
			die(mysql_error());
		}
	}

	$query = "SELECT * FROM posts";
	$exeqr = mysql_query($query) or die(mysql_error());

if (!empty($_GET['id'])) {
	$uid = mysql_real_escape_string($_GET['id']);
	$queryDois = "SELECT * FROM posts WHERE id='$uid'";
	$exeqrDois = mysql_query($queryDois) or die(mysql_error());
	$assoc = mysql_fetch_assoc($exeqrDois);

	echo '<fieldset style="width:500px; margin-bottom:15px;">';
	echo '<h1>'.$assoc['titulo'].'</h1>';
	echo '<p>'.$assoc['conteudo'].'</p>';
	echo '<p><strong>'.date('d/m/Y H:i', strtotime($assoc['data'])).'</strong></p>';
	echo '<a href="read.php">Voltar</a>';
	echo '</fieldset>';
}
	
	echo 'Nossa pesquisa retornou '.mysql_num_rows($exeqr).' resultados. Temos em nossa tabela '.mysql_num_fields($exeqr).' colunas<hr>';

	if (mysql_num_rows($exeqr) <= 0) {
		echo 'Tabela vazia';
	} else {
		//loop para pegar as linhas de dados
		echo '<ul>';
		while ($res = mysql_fetch_assoc($exeqr)) {
			echo '<li>';
			//abrindo post selecionado
				echo '<a href="read.php?id='.$res['id'].'">'.$res['titulo'].'</a> - ';
				echo '<a href="update.php?id='.$res['id'].'">Editar</a> - ';
				echo '<a href="read.php?del='.$res['id'].'">Excluir</a>';
			echo '</li>';
		}
		echo '</ul>';
	}
	echo '<a href="create.php">Inserir novo registro</a>';
?>