<!DOCTYPE html>
<html>
<head lang="pt-br">
	<meta charset="UTF-8">
	<title>Upload de arquivos - Unico</title>
</head>
<body>
<?php
	if (isset($_POST['send'])) {
		$arq=$_FILES['arq'];

		//echo "<pre>"; print_r($arq); echo "</pre>";

		//permissao de extenções
		$permissao = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'text/plain');
		
		//validando extenções
		$ext = ($arq['type'] == 'text/plain' ? '.txt' : ($arq['type'] == 'image/png' ? '.png' : '.jpg'));

		//maximo tamanho permitido, 2 MB
		$size = 1024*1024*2;

		if ($arq['size'] > $size) {
			echo 'Arquivo não pode ser maior do que 2 MB';
		} elseif(!in_array($arq['type'], $permissao)) {
			echo 'Formato de arquivo não aceito, enviar apenas imagens ou textos em .txt';
		} else {
			$dir = ($arq['type'] == 'text/plain'? 'textos' : 'imagens');
			$dir = 'uploads/'.$dir;
			$nome = md5(time()).$ext;

			if(move_uploaded_file($arq['tmp_name'], $dir.'/'.$nome)){
				echo 'Arquivo enviado com sucesso';
			} else {
				echo 'Erro ao enviar o arquivo';
			}
		}
	}

?>
<hr>
<form name="formCad" action="" method="post" enctype="multipart/form-data">
	<label>
		<span>Arquivo:</span><br>
		<input type="file" name="arq">
		<br><br>
		<input type="submit" name="send" value="Enviar">
	</label>
</form>
</body>
</html>