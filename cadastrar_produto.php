<?php
    include "conexao.php";
    $nome_produto=$_POST["nome_produto"];
    $descricao=$_POST["descricao"];
    $preco=$_POST["preco"];
	$foto=$_POST["foto"];
	$id=$_SESSION["tipo_usuario"];
	$verificar="nao foi nenhum"
	
    $insert= "INSERT INTO produtos(
                                    nome,
                                    preco,
                                    descricao,
									cod_vendedor
                                ) VALUES (
                                    ?,
                                    ?,
                                    ?,
                                    ?
                                )";


	if($stmt = mysqli_prepare($con, $insert)) { 
		$verificar="foi 1";
		mysqli_stmt_bind_param($stmt, "ssss", $nome_produto, $descricao, $preco, $id);
		

		mysqli_stmt_execute($stmt);
	  
		mysqli_stmt_close($stmt);
	}

   $id= mysqli_insert_id($con);
   
   $insert= "INSERT INTO fotos(
                                    foto,
									cod_produto
                                ) VALUES (
                                    ?,
                                    ?
                                )";
	
	if($stmt = mysqli_prepare($con, $insert)) { 
	$verificar+=" foi 2";

    mysqli_stmt_bind_param($stmt, "ss", $foto, $id);
    

    mysqli_stmt_execute($stmt);
  
    mysqli_stmt_close($stmt);
}
   
mysqli_close($con);
echo $verificar;
?>