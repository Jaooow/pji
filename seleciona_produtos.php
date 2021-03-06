<?php 
    //header("Content-Type: application/json");
    include "conexao.php";

	if(!empty($_POST))
    {
        $id=$_POST["id"];
		$id=strtoupper($id);
		$tabela="";
        $select="SELECT foto, produtos.nome as nome_produto, preco, tipo_produto, descricao, telefone, usuarios.nome as nome_usuario FROM produtos inner join usuarios on produtos.cod_vendedor=id_usuario inner join vendedores on vendedores.cod_vendedor=id_usuario where tipo_produto='$id'";
		$res = mysqli_query($con, $select) or die(mysqli_error($con));
		while($linha=mysqli_fetch_assoc($res)){
			$tabela.='<!-- Table Produtos e demais-->
		<div class="tabela-produtos">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="card">
							<img src="fotos/'.$linha["foto"].'" class="card-img-top" alt="Imagem Produto 4">
							<div class=" card-body">
								<!-- Nome Produto -->
								<h5 class = "card-title">'.$linha["nome_produto"].'</h5>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<!-- Nome Produto -->
						<h6>'.$linha["nome_produto"].'</h6>
						<!-- Informação -->
						<p class="info_produto">'.$linha["descricao"].'</p>
						<br/><br/>
						<i class="fas fa-phone"></i> '.$linha["telefone"].'
						<p class="produto_vendedor">'.$linha["nome_usuario"].'</p>
					</div>
					<div class="col-md-5">
						<!-- Preço -->
						<p class = "preco_produto">R$ '.$linha["preco"].'</p>
						<br/>
						<h7>Seção:</h7><p class=secao_produtos>'.$linha["tipo_produto"].'</p>
					</div>
				</div>
			</div>
		</div>
		<br />';
		}
		echo $tabela;
	}
    else{
        $select="SELECT nome, preco, descricao, cod_vendedor FROM produtos";
		$res = mysqli_query($con, $select) or die(mysqli_error($con));
		while($linha=mysqli_fetch_assoc($res)){
			$resultado[]= $linha;
		}
		echo json_encode($resultado);
    }
?>
