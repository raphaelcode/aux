<?php
	//definindo constantes de conexão
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DBSA', 'consulta');

	//VARIAVEL DE CONEXAO
	$conecta = mysql_connect(HOST,USER,PASS) or die('Erro ao conectar com o banco');

	//escolhendo o banco
	$dbsa = mysql_select_db(DBSA, $conecta) or die('Erro ao selecionar o banco');
?>