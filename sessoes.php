<?php
ob_start();//inicialização de cache
session_start();//inicialização da sessão

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

if (isset($_POST['sendform'])) {
	//defininido atributos para a sessão em variaveis
	$ses['id'] = session_id();//este atributo é do proprio PHP
	$ses['on'] = time();//horario que logou
	$ses['end'] = time() + 5;//quanto tempo logado ate expirar a sessão
	$ses['ip'] = $_SERVER['REMOTE_ADDR'];//pega o IP
	$ses['nome'] = $_POST['nome'];//pega o nome atraves do formulario

	$_SESSION['user'] = $ses;
	header('Location: '.$_SERVER['PHP_SELF']);
}

//código de logout
if (!empty($_GET['acao']) && $_GET['acao'] == 'logoff') {
	unset($_SESSION['user']);
	header('Location: '.$_SERVER['PHP_SELF']);
}

//verificando se existe uma sessão
//caso não exista, mostra o formulario
if (empty($_SESSION['user'])) {
	echo'
		<form name="form" action="" method="post">
			Nome: 
			<input type="text" name="nome">
			<input type="submit" value="Iniciar Sessão" name="sendform">
		</form>
	';
} else{
	$tempoLog = $_SESSION['user']['on'];//informa quando o usuario logou
	$tempoNow = time();//informa o tempo atual
	$tempoOn = $tempoNow - $tempoLog;//informa a quantos segundos o usuario esta logado
	$tempoFim = $_SESSION['user']['end'] - $tempoNow;

	echo 'Ola '.$_SESSION['user']['nome'].'. Você está logado a '.$tempoOn.' segundos. Seu IP é '.$_SESSION['user']['ip'].'<br>';
	
	//verifica se o tempo de expiração ja passou
	if ($tempoFim <= 0) {
		//finalizar a sessão e redirecionar a pagina
		unset($_SESSION['user']);
		header('Refresh: 5;url='.$_SERVER['PHP_SELF']);
		echo 'Sua Sessão expirou. Você será redirecionado';
	} else{
		//atualizando mais 30 segundos na sessão
		$_SESSION['user']['end'] = time()+30;
		echo 'Sua Sessão expira em: '.$tempoFim.' segundos';
		echo '<br><br>';
		//finalizando sessão manualmente com link para logout
		echo '<a href="sessoes.php?acao=logoff">Logout</a>';
	}
}

echo '<hr><pre>'; print_r($_SESSION); echo'</pre>';

ob_end_flush();//finalização do cache
?>