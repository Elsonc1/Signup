<?php

require_once 'pessoa.php';
$p = new People("crudpdo","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastro Pessoa</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
	if(isset($_POST['nome']))
	{
		$nome = addslashes($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		if (!empty($nome) && !empty($telefone) && !empty($email)) 
		{
			//cadastrar
			if(!$p->signpeople($nome, $telefone, $email))
			{
				echo "Email já está cadastrado!";
			}
		}
		else
		{
			echo "Preencha todos os campos";
		}
	}
	?>
	<section id="left">
		<form method="POST">
			<h2>Cadastrar Pessoa</h2>
			<label for="nome">Nome</label>
			<input type="text" name="nome" id="nome">
			<label for="telefone">Telefone</label>
			<input type="text" name="telefone" id="telefone">
			<label for="email">Email</label>
			<input type="text" name="email" id="email">
			<input type="submit" value="Cadastrar">
		</form>
	</section>
	<section id="right">
				<table>
			<tr id="Title">
				<td>NOME</td>
				<td>TELEFONE</td>
				<td colspan="2">EMAIL</td>
			</tr>
	<?php
		$data = $p->SearchData();
		if (count($data) > 0) // tem pessoas cadastradas no campo
		{
			for ($i=0;$i < count($data); $i++) 
			{
				echo "<tr>";
				foreach ($data[$i] as $k => $v) 
				{
					if ($k != "id") 
					{
						echo "<td>".$v."</td>";
					}
				}
				?>
					<td><a href="">Editar</a><a href="">Excluir</a></td>
				<?php
				echo "</tr>";
			}
		}
		else // banco vazio
		{
			echo "Ainda não há pessoas cadastradas";
		}
	?>	
		</table>
	</section>
</body>
</html>
