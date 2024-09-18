<?php
	// Configurações do banco de dados
	define('DB_SERVER', 'localhost'); // quem não tiver a porta do xamp como 3307 deixar apenas como localhost
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', ''); // Senha padrão do XAMPP MySQL é vazia
	define('DB_DATABASE', 'puc_achados'); // Substitua 'nome_do_banco' pelo nome do seu banco de dados

	// Função para criar uma conexão com o banco de dados
	function conectar() {
		$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		
		if ($conn->connect_error) {
			die("Falha na conexão: " . $conn->connect_error);
		}
		
		return $conn;
	}

	// Função para fechar a conexão com o banco de dados
	function fechar_conexao($conn) {
		$conn->close();
	}

	// Função para inserir dados
	function inserir_dado($tabela, $colunas, $valores) {
		$conn = conectar();
		
		$sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";

				
		if ($conn->query($sql) === TRUE) {
			$ultimo_id = $conn->insert_id;
			fechar_conexao($conn);
			return $ultimo_id;
		} else {
			fechar_conexao($conn);
			return "Erro: " . $conn->error;
		}
	}

	// Função para atualizar dados
	function atualizar_dado($tabela, $atributos, $condicao) {
		$conn = conectar();
		
		$sql = "UPDATE $tabela SET $atributos WHERE $condicao";
		
		if ($conn->query($sql) === TRUE) {
			fechar_conexao($conn);
			return "Registro atualizado com sucesso";
		} else {
			fechar_conexao($conn);
			return "Erro: " . $conn->error;
		}
	}

	// Função para deletar dados
	function deletar_dado($tabela, $condicao) {
		$conn = conectar();
		
		$sql = "DELETE FROM $tabela WHERE $condicao";
		
		if ($conn->query($sql) === TRUE) {
			fechar_conexao($conn);
			return "Registro deletado com sucesso";
		} else {
			fechar_conexao($conn);
			return "Erro: " . $conn->error;
		}
	}

	// Função para consultar dados
	function consultar_dado($sql) {
		$conn = conectar();
		
		$resultado = $conn->query($sql);
		$dados = array();
		
		if ($resultado->num_rows > 0) {
			while($row = $resultado->fetch_assoc()) {
				$dados[] = $row;
			}
		}
		
		fechar_conexao($conn);
		return $dados;
	}
?>