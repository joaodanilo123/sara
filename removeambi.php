<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<style type="text/css">
		</style>
	</head>
	<body>
		<?php
		    //captura o id repassado pela URL
		    $id = $_GET['id'];
		    //Conexão ao banco de dados
			//$dbc = mysqli_connect('localhost', 'root', 'usbw', 'tcc') or die ('Erro ao conectar ao servidor MySQL');
			$dbc = mysqli_connect('localhost', 'lucas_arcari', '967955', 'lucas_arcari') or die ('Erro ao conectar ao Banco de Dados');
			mysqli_set_charset($dbc,"utf8"); 
			//instrução a ser executada no banco de dados
			$query = "DELETE FROM ambiente WHERE id_ambi='$id' LIMIT 1";
			//execução da instrução no banco de dados
			$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
			echo '<p style="text-align: center;">O Registro '. $id . ' Foi removido com sucesso!</p>';
			//encerra a conexao com o banco
		    mysqli_close($dbc);
		    //retorna a pagina anterior após 5 segundos
			echo '<meta http-equiv="refresh" content="1;URL=indexadm.php" />';
		?>
	</body>
</html>