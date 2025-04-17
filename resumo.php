<html>
<meta charset=UTF-8>
	<center>
		<h1> Resumo das inscrições: </h1>
		<br>
	</center>
</html>

<?php
// ... (código de conexão) ...

	$host = 'localhost'; // Ou o endereço do servidor MariaDB
	$usuario = 'letty493';
	$senha = 'root123';
	$banco = 'inscricao';

	$conexao = new mysqli($host, $usuario, $senha, $banco);

	// Verificar se houve erro na conexão
	if ($conexao->connect_error) {
		die("Erro na conexão: " . $conexao->connect_error);
	}

	$sql = "SELECT * FROM pessoa";
	$resultado = $conexao->query($sql);

	if ($resultado) {
		if ($resultado->num_rows > 0) {
			while ($linha = $resultado->fetch_assoc()) {
				echo "ID: " . $linha["id"] . ", Nome: " . $linha["nome"] . ", CPF: " . $linha["cpf"] . ", Celular: " . $linha["celular"] . ", Email: " . $linha["email"] . "<br>";
			}
		} else {
			echo "Nenhum resultado encontrado.";
		}
		$resultado->free(); // Liberar a memória do resultado
	} else {
		echo "Erro na consulta: " . $conexao->error;
	}

	$conexao->close();
?>
