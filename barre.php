<!DOCTYPE html>
<html>
	<sideBar>
			<a href="siteWeb.html" class="home"><img src="home.png" alt="Home" width="30" height="30"></a>
			<a href="barre.php">Bunch</a>
			<a href="page3.html">of</a>
			<a href="phpTest.php">options</a>
		
	</sideBar>
	<div class = "main">
	<div class = "outil">
		 <head>
			 <meta charset = "utf-8">
			 <title>Barre de recherche</title>
			 <link rel="stylesheet" type="text/css" href="barre.css" />
		 </head>
		 <body>
			 

			
			<h2> Barre de recherche </h2>
			<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post" >
				<label for="query"> Entrez le code du gène (ex: BC1G_00001) :</label>
				<input type="search" name="query" id="query"/><br/>
				Recherche au niveau de :
				<select name = "filtre">
					<option value ="gene">Gène</option>
					<option value ="SummaryGene">Gene Summary</option>
					<option value ="sequence">Sequence</option>
				</select><br/>
				<input type="submit" value="Recherche">
			</form>
			
		<br/>
			
		<?php

		//~ require('connect_db.php');
		// Initialisation de la variable contenant les resultats 
		$resultats ="";
		// Traitement de la requête
		if(isset($_POST['query']) && !empty($_POST['query']))
		{
			// Nettoie notre query tout ce qui n'est pas a-z A-Z _ 0_9 est remplacé par un vide
			$query = $_POST['query'];
			
			// l'utilisateur choisi l'option gene
			if($_POST['filtre'] == "gene"){
				$sql = "SELECT Nom, GC, sequence FROM gene WHERE Nom = ?";

			// l'utilisateur choisie l'option Summary	
			}else if ($_POST['filtre'] == "SummaryGene"){
				$sql = "SELECT id_sum, Locus,Name,Strand, Chromosome FROM SummaryGene WHERE Locus = ?";
				
			// l'utilisateur choisi l'option séquence
			}else if ($_POST['filtre'] == "sequence"){
				$sql = "SELECT sequence FROM gene WHERE Nom = ?";

			}
			
			// Connexion a la BDD
			include('connect_db.php');
			
			$req = $dbh->prepare($sql);
			$req->execute(array($query));
			$count = $req->rowCount();
			
			if($count >= 1){
				echo "$count résultat(s) trouvé(s) pour <strong>$query</strong><br/> </div>"; ///////// fin balise div outil
				if($_POST['filtre'] == "gene"){

					while($data = $req->fetch(PDO::FETCH_OBJ)){
						echo "<div class=\"item\"><p>";
						echo ('#'.$data->Nom.' <br><br>
								<table>  
									<tr> 
										<td> GC:</td>
										<td>' .$data->GC.'</td> 
									</tr>
									<tr> 
										<td>Seq:</td> 
										<td style="word-break:break-word" >'.$data->sequence.'</td>
									</tr>
								</table>'
							);
						echo "</p></div>";
					}

				}else if($_POST['filtre'] == "SummaryGene"){

					while($data = $req->fetch(PDO::FETCH_OBJ)){
						echo "<div class=\"item\"><p>";
						echo ('#'.$data->id_sum.'- Locus: '.$data->Locus." Name: ".$data->Name.' Strand: '.$data->Strand. " Chromosome: ".$data->Chromosome);
						echo "</p></div>";
					}
				}
			}else{
				echo "<hr/> O résultats trouvé pour <strong>$query</strong><hr/>$sql";
			}
		}
		?> 
	<!-- "<div class=\"item\">"    "</div>" -->
					<!-- <ul>
						<li><a href="#">Page1</a></li>
						<li><a href="#">Page2</a></li>
						<li><a href="#">Page3</a></li>
					</ul> -->
			

		 </body>
	</div>
</html>
