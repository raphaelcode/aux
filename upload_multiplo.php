<!DOCTYPE html>
<html>
<head lang="pt-br">
	<meta charset="UTF-8">
	<title>Upload de arquivos - Multiplo</title>
</head>
<body>
<?php
	if (isset($_POST['send'])) {
		$arq=$_FILES['arq'];

		//echo '<pre>'; echo print_r($arq); echo '</pre>';

		//permissao de extenções
		$permissao = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'text/plain');
		
		//validando extenções
		$ext = ($arq['type'] == 'text/plain' ? '.txt' : ($arq['type'] == 'image/png' ? '.png' : '.jpg'));

		//maximo tamanho permitido, 2 MB
		$size = 1024*1024*2;
		$dir = 'uploads/imagens';

		for ($i=0; $i < count($arq['tmp_name']); $i++) { 
			$arqNome = md5(time().$arq['tmp_name'][$i]).$ext;
			move_uploaded_file($arq['tmp_name'][$i], $dir.'/'.$arqNome);
		}
}

?>
<hr>
<form name="formCad" action="" method="post" enctype="multipart/form-data">
	<label>
		<span>Arquivo:</span><br>
		<input type="file" name="arq[]" multiple>
		<br><br>
		<input type="submit" name="send" value="Enviar">
	</label>
</form>
</body>
</html>