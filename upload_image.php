<?php
require './bdconnect.php';
$msg = false;
if (isset($_POST['descricao'])) {
	$descricao = addslashes($_POST['descricao']);
	if (isset($_FILES['arquivo'])) {
		$descricao;
		$arquivo = $_FILES['arquivo']['name'];

		$extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

		$novo_nome = md5(time()) . "." . $extensao;

		$diretorio = "upload/";

		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

		$sql_code = "INSERT INTO arquivo(id, arquivo, data, descricao) VALUES('','$novo_nome', NOW(), '$descricao')";

		if (mysqli_query($conn, $sql_code))
			$msg = "Arquivo enviado com sucesso!";
		else
			$msg = "Falha ao enviar arquivo!";
	}
}
?>
<!DOCTYPE html>
<html>

<head lang="pt-br">
	<title>TESTE PROGRAMADOR</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/reset.css" type="text/css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>

<body>
	<div class="container">
		<div class="center">
			<div class="formulario-box">
				<?php
				if (isset($msg) && $msg != false) {
					echo "<p>$msg</p>";
				}
				?><br><br>

				<form action="upload_image.php" method="post" enctype="multipart/form-data" style="border: 1px solid; padding: 29px;">
					<label>Selecione o arquivo:</label><br>
					<input type="file" name="arquivo" required /><br><br>
					<label>Escreva o texto:</label><br>
					<textarea type="text" name="descricao" id="descricao" rows="5" cols="42" required placeholder=" Escreva aqui..."></textarea><br><br>
					<input type="submit" value="Enviar" style="padding: 5px 20px;" />
				</form>
			</div>
		</div>
	</div>
</body>
<script>
	function val() {
		if (trimAll(document.getElementById('descricao').value) === '') {
			alert('Empty !!');
		}
	}

	function trimAll(sString) {
		while (sString.substring(0, 1) == ' ') {
			sString = sString.substring(1, sString.length);
		}
		while (sString.substring(sString.length - 1, sString.length) == ' ') {
			sString = sString.substring(0, sString.length - 1);
		}
		return sString;
	}
</script>
<!-- include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<!-- font-awesome -->
<script defer src="font-awesome/js/all.js"></script>

</html>