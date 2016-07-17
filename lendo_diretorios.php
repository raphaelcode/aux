<?php
//diretório base (root)
$baseDir = 'uploads/';
//pega a url do diretório
$abreDir = ($_GET['dir'] != '' ? $_GET['dir'] : $baseDir);
//abrir diretórios usando a função PHP dir() usando a variavel $abreDir. 
$openDir = dir($abreDir);

$strrdir = strrpos(substr($abreDir,0,-1),'/');
//diretório anterios
$backDir = substr($abreDir,0,$strrdir+1);


//update de arquivos
if (isset($_POST['sendup'])) {
	$arquivo = $_POST['adir'];
	$newarq = $_POST['ndir'];

	if (is_dir($arquivo) && file_exists($arquivo)) {
		rename($arquivo, $abreDir.$newarq);
	} elseif (!is_dir($arquivo) && file_exists($arquivo)) {
		$strrfile = strrpos($arquivo, '.');
		$arqext = substr($arquivo, $strrfile);
		$arqName = $newarq.$arqext;
		rename($arquivo, $abreDir.$arqName);
	}
}


//deleção de arquivos e diretórios
if (!empty($_GET['del'])) {
	$del = $_GET['del'];
	//exclusão de diretórios
	if (is_dir($del) && file_exists($del)) {
		if(!@rmdir($del)){
			echo 'Erro: O diretório deve estar vazio para exclusão';
		} else {
			header('Location: lendo_diretorios.php?dir='.$abreDir);
			echo 'Diretório excluido com sucesso';
		}
	}//exclusão de arquivos
	elseif (!is_dir($del) && file_exists($del)) {
		if(unlink($del)){
			header('Location: lendo_diretorios.php?dir='.$abreDir);
			echo 'Arquivo excluido com sucesso';
		}
	}
}


//criação de diretórios
if (isset($_POST['senddir'])) {
	$novoDiretorio = $_POST['diretorio'];
	if (!file_exists($abreDir.$novoDiretorio)) {
		mkdir($abreDir.$novoDiretorio, 0755);
	} else {
		echo 'diretório já existe';
	}
}

//envio de arquivos
if (isset($_POST['sendfile'])) {
	$arquivo = $_FILES['newarq'];
	//procura o ultimo ponto para achar a extenção
	$strrfile = strrpos($arquivo['name'], '.');
	//define a extenção excluindo tudo atrás do ultimo ponto
	$arqext = substr($arquivo['name'], $strrfile);
	//nomeando o arquivo
	$arqName = md5(time()).$arqext;
	//movendo o arquivo para o diretorio
	move_uploaded_file($arquivo['tmp_name'], $abreDir.'/'.$arqName);

}

if (empty($_GET['upd'])) {
	//formulario de criação de diretórios e uploads de arquivos
	echo '
		<form name="cadastra" action="" method="post" enctype="multipart/form-data">
			<fieldset style="width:747px; margin-bottom:10px;">
				<span>Nome do diretório:</span>
				<input type="text" name="diretorio">
				<input type="submit" name="senddir" value="Criar diretório">
			</fieldset>

			<fieldset style="width:747px;">
				<input type="file" name="newarq">
				<input type="submit" name="sendfile" value="Enviar arquivo">
			</fieldset>

		</form>
	';
} else {
	//formulario de atualização de nome
	echo'
		<form name="update" action="" method="post">
			<fieldset style="width:474px;">
				<span><strong>Renomear: </strong>'.$_GET['upd'].'</span><br><br>
				<input type="hidden" name="adir" value="'.$_GET['upd'].'" size="80">
				<input type="text" name="ndir" value="" size="60">
				<input type="submit" value="Atualizar" name="sendup">
			</fieldset>
		</form>
	';
}
//abrir diretórios usando a função PHP dir() usando a variavel $abreDir. 
$openDir = dir($abreDir);

//tabela mostrando os diretorios e arquivos
echo '<table width="500" border="1" cellspacing="0" cellpading="5">';
	while ($arq = $openDir->read()) {
		if($arq != '.' && $arq != '..'){
			if (is_dir($abreDir.$arq)) {
				echo '<tr>';
				echo '<td>'.$arq.'</td>';
				echo '<td align="center"><a href="lendo_diretorios.php?dir='.$abreDir.$arq.'/">Abrir</a></td>';
				echo '<td align="center"><a href="lendo_diretorios.php?upd='.$abreDir.$arq.'&dir='.$abreDir.'">Update</a></td>';
				echo '<td align="center"><a href="lendo_diretorios.php?del='.$abreDir.$arq.'&dir='.$abreDir.'">Excluir</a></td>';
				echo '</tr>';
			} else {
				echo '<tr>';
				echo '<td>'.$arq.'</td>';
				echo '<td align="center"><a href="'.$abreDir.$arq.'">Ver</a></td>';
				echo '<td align="center"><a href="lendo_diretorios.php?upd='.$abreDir.$arq.'&dir='.$abreDir.'">Update</a></td>';
				echo '<td align="center"><a href="lendo_diretorios.php?del='.$abreDir.$arq.'&dir='.$abreDir.'">Excluir</a></td>';
				echo '</tr>';
			}
		}
	}
echo '</table>';

//código de "voltar" por diretório
if ($abreDir != $baseDir) { //se o diretorio atual for direfente do diretorio raiz
	echo '<a href="lendo_diretorios.php?dir='.$backDir.'">voltar</a>';
}
$openDir->close();

?>