<?php
	session_start();
    include "conexao.php";
    $tipo_de_negocio=$_POST["tipo_de_negocio"];
	if($_POST["tipo_de_negocio"]==1){
		$tipo_de_negocio="Autonomo";
	}
	if($_POST["tipo_de_negocio"]==2){
		$tipo_de_negocio="Micro produtor / Micro empresario";
	}
	if($_POST["tipo_de_negocio"]==3){
		$tipo_de_negocio="Produtor ou vendedor de meio/alto porte";
	}
	$tipo_de_usuario=2;
	$id=$_SESSION["id_usuario"];
	$_SESSION["tipo_de_usuario"]=2;
	
    $update= "UPDATE usuarios SET
									tipo_de_negocio='$tipo_de_negocio',
									tipo_de_usuario='$tipo_de_usuario'
                                 WHERE 
									id_usuario = '$id'
                                ";
	mysqli_query($con, $update)or die(mysqli_error($con));
	
    $cnpj=$_POST["cnpj"];
    $documento=$_POST["documento"];
	$telefone=$_POST["telefone"];
	

    $insert= "INSERT INTO vendedores(
									tipo_negocio,
									cnpj,
									documentacao,
									cod_vendedor,
									telefone
                                ) VALUES (
                                    ?,
                                    ?,
                                    ?,
                                    ?,
									?
                                )";


if($stmt = mysqli_prepare($con, $insert)) { 

    mysqli_stmt_bind_param($stmt, "sssss", $tipo_de_negocio, $cnpj, $documento, $id, $telefone);
    

    mysqli_stmt_execute($stmt);
  
    mysqli_stmt_close($stmt);
}
mysqli_close($con);

//header("Location: index.php")
?>