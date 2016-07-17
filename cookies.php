<?php

$dados['nome'] = 'Raphael';
$dados['email'] = 'lestervgt@gmail.com';
$dados['senha'] = md5('123'); 

//varrendo os dados do arrayh e setando eles no cookie
foreach ($dados as $key => $valor) {
	//setando o indice, o valor e o tempo (1 hora) de expiração do cookie
	//criptografando os cookies com base64
	setcookie($key,base64_encode($valor),time()+3600);
}

/*apagando cookies
foreach ($dados as $key => $valor) {
	//apago o valor e seto o tempo para negativo
	setcookie($key,'',time()-3600);
}*/

//verificando se existe cookie
if (empty($_COOKIE['nome'])) {
	echo 'Favor, logue-se';
} else {
	echo 'Ola '.base64_decode($_COOKIE['nome']).' Seu email é '.base64_decode($_COOKIE['email']).' e sua senha é '.base64_decode($_COOKIE['senha']);
}
echo '<hr><pre>'; print_r($_COOKIE); echo'</pre>';
?>