<html>
<meta charset=UTF-8> 
    <center> <h1> Formulário de Inscrição </h1>
    <form  method=POST>
        <h2> Informe as seguintes informações: </h2>
        Nome: <input type="text" name="Nome"><br><br>
        CPF: <input type="text" name="CPF"><br><br>
        Celular: <input type="text" name="Celular"><br><br>
        Email: <input type="text" name="Email"><br><br>
		<input type="submit" name="botao" value="Enviar Dados">
        <a href="resumo.php"> <input type="button" name="Botao2" value="Resumo"> </a>
    </form>
    </center>
</html>

<?php
	if(isset($_POST["botao"])){
		
		$host = 'localhost'; // Ou o endereço do servidor MariaDB
		$usuario = 'letty493';
		$senha = 'root123';
		$banco = 'inscricao';

		$conexao = new mysqli($host, $usuario, $senha, $banco);

		// Verificar se houve erro na conexão
		if ($conexao->connect_error) {
			die("Erro na conexão: " . $conexao->connect_error);
		}

		echo "Conexão bem-sucedida!";

		// ... (código de conexão mysqli) ...

		$nome = $_POST["Nome"];
		$cpf = $_POST["CPF"];
		$celular = $_POST["Celular"];
		$email = $_POST["Email"];
		
		$sql = "INSERT INTO pessoa (nome, cpf, celular, email) VALUES ('$nome','$cpf','$celular','$email')";

		if ($conexao->query($sql) === TRUE) {
			echo "Novo registro inserido com sucesso!";
		} else {
			echo "Erro ao inserir registro: " . $conexao->error;
		}

		// ... (código de conexão) ...

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
	}
?>
